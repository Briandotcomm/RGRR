public function process(Request $request)
{
    // Make sure we have a pending user from registration
    $userId = session('pending_user_id');

    if (!$userId) {
        return redirect()->route('register')
            ->with('error', 'Session expired. Please register again.');
    }

    // -------------------------------------------------------
    // 1. VALIDATE
    // -------------------------------------------------------
    $validated = $request->validate([
        'payment_method'   => 'required|in:cash,gcash',
        'reference_number' => 'nullable|string|max:255',
        'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    // Extra validation for GCash
    if ($validated['payment_method'] === 'gcash') {
        $request->validate([
            'reference_number' => 'required|string|max:255',
            'proof_of_payment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'reference_number.required' => 'GCash reference number is required.',
            'proof_of_payment.required' => 'Please upload your GCash payment proof.',
        ]);
    }

    // -------------------------------------------------------
    // 2. HANDLE PROOF OF PAYMENT UPLOAD (GCash only)
    // -------------------------------------------------------
    $proofPath = null;
    if ($request->hasFile('proof_of_payment')) {
        $proofPath = $request->file('proof_of_payment')->store('payment_proofs', 'private');
    }

    // -------------------------------------------------------
    // 3. SAVE PAYMENT RECORD
    // -------------------------------------------------------
    $payment = Payment::create([
        'user_id'                => $userId,
        'method'                 => $validated['payment_method'], // This is cash or gcash
        'gcash_reference_number' => $validated['reference_number'] ?? null, // Store GCash reference number if provided
        'proof_path'             => $proofPath, // Store file path if proof is provided
        'status'                 => 'pending',  // Set the payment status as pending until verified
        'submitted_at'           => now(),  // Timestamp for submission
    ]);

    // -------------------------------------------------------
    // 4. CLEAR SESSION & REDIRECT
    // -------------------------------------------------------
    session()->forget('pending_user_id');

    return redirect()->route('payment')
        ->with('success', 'Your payment details have been submitted successfully. Please wait for the admin\'s approval. Thank you.')
        ->with('redirect', route('home'));
}