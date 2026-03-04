<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function show()
    {
        return view('register');
    }

    /**
     * Handle the registration form submission.
     * Saves user info to the database but keeps the status as 'pending' until payment is completed.
     */
    public function process(Request $request)
    {
        // -------------------------------------------------------
        // 1. VALIDATE REGISTRATION FORM
        // -------------------------------------------------------
        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'surname'        => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:1',
            'address'        => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'school'         => 'required|string|max:255',
            'year_level'     => 'required|string',
            'school_year'    => 'required|string|regex:/^\d{4}-\d{4}$/',
            'hours'          => 'required|integer|min:1',
            'password'       => 'required|string|min:8|confirmed',
            'document'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'school_id'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'terms'          => 'accepted',
        ], [
            'email.unique'        => 'This email is already registered.',
            'school_year.regex'   => 'School year must be in format: 2025-2026',
            'password.confirmed'  => 'Passwords do not match.',
            'school_id.required'  => 'School ID scan is required.',
            'terms.accepted'      => 'You must agree to the Terms and Conditions.',
        ]);

        // -------------------------------------------------------
        // 2. HANDLE FILE UPLOADS
        // -------------------------------------------------------

        // MOA (optional) — store in storage/app/private/moa/
        $moaPath = null;
        if ($request->hasFile('document')) {
            $moaPath = $request->file('document')->store('moa', 'private');
        }

        // School ID (required) — store in storage/app/private/school_ids/
        $schoolIdPath = $request->file('school_id')->store('school_ids', 'private');

        // -------------------------------------------------------
        // 3. CREATE USER (Status set to 'pending' initially)
        // -------------------------------------------------------
        $user = User::create([
            'first_name'     => $validated['first_name'],
            'surname'        => $validated['surname'],
            'middle_initial' => strtoupper($validated['middle_initial'] ?? ''),
            'name'           => $validated['first_name'] . ' ' . $validated['surname'],
            'email'          => $validated['email'],
            'home_address'   => $validated['address'],
            'school_name'    => $validated['school'],
            'year_level'     => $validated['year_level'],
            'school_year'    => $validated['school_year'],
            'required_hours' => $validated['hours'],
            'moa_path'       => $moaPath,
            'school_id_path' => $schoolIdPath,
            'role'           => 'member',
            'status'         => 'pending',  // Keep status as 'pending' until payment is confirmed
            'password'       => Hash::make($validated['password']),
        ]);

        // -------------------------------------------------------
        // 4. STORE USER ID IN SESSION FOR PAYMENT PAGE
        // -------------------------------------------------------
        session(['pending_user_id' => $user->id]);

        // -------------------------------------------------------
        // 5. REDIRECT TO PAYMENT PAGE
        // -------------------------------------------------------
        return redirect()->route('payment'); // Redirect to the payment page
    }

    /**
     * Handle the payment method selection.
     * This will store the payment method in the `payments` table.
     */
    public function storePaymentMethod(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:cash,gcash', // Cash or GCash
        ]);

        // Get the user ID from session
        $userId = session('pending_user_id');
        if (!$userId) {
            return redirect()->route('register')->with('error', 'User session expired or invalid.');
        }

        // Create a payment record in the payments table
        $payment = Payment::create([
            'user_id' => $userId,
            'method'  => $validated['payment_method'], // Store selected payment method
            'status'  => 'pending',  // Set payment status to pending initially
        ]);

        // Redirect to payment confirmation (for proof upload)
        return redirect()->route('payment.confirmation');
    }

    /**
     * Handle payment confirmation and update user status to 'approved'.
     * This method should be called once the user has completed payment.
     */
    public function confirmPayment(Request $request)
    {
        $userId = session('pending_user_id');
        if (!$userId) {
            return redirect()->route('register')->with('error', 'User session expired or invalid.');
        }

        // Find the user
        $user = User::findOrFail($userId);

        // Get the payment record for the user (status pending)
        $payment = Payment::where('user_id', $userId)->where('status', 'pending')->first();
        if ($payment) {
            // Store payment proof and update payment status
            $payment->update([
                'status' => 'completed', // Payment completed
                'proof_path' => $request->file('payment_proof')->store('payment_proofs', 'private'),
                'gcash_reference_number' => $request->input('gcash_reference_number', null), // Optional for GCash
            ]);
        }

        // Update user's status to 'approved'
        $user->status = 'approved';
        $user->save();

        // Clear session data
        session()->forget('pending_user_id');

        // Redirect to success page
        return redirect()->route('registration.success')->with('message', 'Your registration is complete!');
    }
}