<?php

use Illuminate\Support\Facades\Route;

/* ================= HOME / LANDING PAGE ================= */
Route::get('/', function () {
    return view('index');
})->name('home'); // ✅ Named 'home' for redirects

/* ================= LOGIN ================= */
Route::get('/login', function () {
    return view('login');
})->name('login'); // optional, if you want to name it

Route::post('/login', function () {
    return "Login form submitted";
})->name('login.perform');

/* ================= REGISTER ================= */
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function () {
    return redirect()->route('payment'); // Redirect to payment page after registration
})->name('register.process');

/* ================= PAYMENT ================= */
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/payment', function () {
    // After payment submission, show success message and redirect to home
    return redirect()->route('payment')
        ->with('success', 'Your payment details have been submitted successfully. Please wait for the admin\'s approval. Thank you.')
        ->with('redirect', route('home')); //
})->name('payment.process');
