<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

/* LOGIN PAGE */
Route::get('/login', function () {
    return view('login');
});

/* LOGIN FORM SUBMISSION (for later controller logic) */
Route::post('/login', function () {
    // Temporary placeholder
    return "Login form submitted";
})->name('login.perform');

Route::get('/register', function () {
    return view('register');
})->name('register');

/* Payment Page */
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

/* Payment Form Submission */
Route::post('/payment', function () {
    return redirect()->back()->with('success', 'Payment successful!');
})->name('payment.process');
