<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

/* LOGIN PAGE */
Route::get('/login', function () {
    return view('login');
});

/* LOGIN FORM SUBMISSION */
Route::post('/login', function () {
    return "Login form submitted";
})->name('login.perform');

/* REGISTER PAGE */
Route::get('/register', function () {
    return view('register');
})->name('register');

/* REGISTER FORM SUBMISSION */
Route::post('/register', function () {
    return redirect()->route('payment');
})->name('register.process');

/* PAYMENT PAGE */
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/payment', function () {
    return redirect()->route('payment')
        ->with('success', 'Your payment details have been submitted successfully. Please wait for the admin\'s approval. Thank you.')
        ->with('redirect', route('/')); // store the redirect URL
})->name('payment.process');




