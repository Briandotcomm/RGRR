<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/* ================================================================
   PUBLIC ROUTES
================================================================ */

// Landing Page
Route::get('/', function () {
    return view('index');
})->name('home');

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    return "Login form submitted";
})->name('login.perform');

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');  // Updated
Route::post('/register', [RegisterController::class, 'process'])->name('register.process');  // Updated

// Payment
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/payment', function () {
    return redirect()->route('payment')
        ->with('success', 'Your payment details have been submitted successfully. Please wait for the admin\'s approval. Thank you.')
        ->with('redirect', route('home'));
})->name('payment.process');


/* ================================================================
   ADMIN ROUTES
================================================================ */
Route::prefix('admin')->name('admin.')->group(function () {
    // ->middleware(['auth', 'is_admin']) ← uncomment when auth is built

    // ---- DASHBOARD ----
    Route::get('/', function () {
        return view('admin.dashboard', [
            'memberCount'          => 0,
            'pendingCount'         => 0,
            'courseCount'          => 0,
            'revenueThisMonth'     => 0,
            'newMembersThisMonth'  => 0,
            'monthlyRegistrations' => collect(array_map(fn($m) => ['label' => $m, 'percent' => rand(20,100), 'count' => rand(1,10)], ['Jan','Feb','Mar','Apr','May','Jun','Jul'])),
            'recentActivity'       => [],
            'recentMembers'        => collect([]),
        ]);
    })->name('dashboard');

    // ---- OFFICIAL MEMBERS ----
    Route::get('/members', function () {
        return view('admin.official-members', [
            'members'         => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15),
            'totalMembers'    => 0,
            'activeMembers'   => 0,
            'onLeaveMembers'  => 0,
            'graduatedMembers'=> 0,
        ]);
    })->name('members');

    Route::post  ('/members',          [App\Http\Controllers\Admin\MemberController::class, 'store'])  ->name('members.store');
    Route::put   ('/members/{member}', [App\Http\Controllers\Admin\MemberController::class, 'update']) ->name('members.update');
    Route::delete('/members/{member}', [App\Http\Controllers\Admin\MemberController::class, 'destroy'])->name('members.destroy');

    // ---- PENDING APPLICATIONS ----
    Route::get('/pending', function () {
        return view('admin.pending', [
            'applicants'        => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15),
            'pendingCount'      => 0,
            'gcashCount'        => 0,
            'cashCount'         => 0,
            'rejectedThisMonth' => 0,
        ]);
    })->name('pending');

    Route::post('/pending/{applicant}/approve', [App\Http\Controllers\Admin\PendingController::class, 'approve'])->name('pending.approve');
    Route::post('/pending/{applicant}/reject',  [App\Http\Controllers\Admin\PendingController::class, 'reject']) ->name('pending.reject');

    // ---- MODULES / COURSES ----
    Route::get('/modules', function () {
        return view('admin.modules', [
            'courses'          => collect([]),
            'enrollments'      => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15),
            'totalCourses'     => 0,
            'totalEnrolled'    => 0,
            'totalModules'     => 0,
            'totalCompletions' => 0,
        ]);
    })->name('modules');

    Route::post  ('/modules',          [App\Http\Controllers\Admin\ModuleController::class, 'store'])  ->name('modules.store');
    Route::put   ('/modules/{course}', [App\Http\Controllers\Admin\ModuleController::class, 'update']) ->name('modules.update');
    Route::delete('/modules/{course}', [App\Http\Controllers\Admin\ModuleController::class, 'destroy'])->name('modules.destroy');
    Route::put   ('/enrollments/{enrollment}', [App\Http\Controllers\Admin\ModuleController::class, 'updateProgress'])->name('enrollments.update');

    // ---- MEMBER SKILLS ----
    Route::get('/skills', function () {
        return view('admin.member-skills', [
            'members'            => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 15),
            'allMembers'         => collect([]),
            'totalProfiles'      => 0,
            'publishedProfiles'  => 0,
            'unpublishedProfiles'=> 0,
            'totalSkillsLogged'  => 0,
        ]);
    })->name('skills');

    Route::put ('/skills/{member}',          [App\Http\Controllers\Admin\SkillController::class, 'update'])      ->name('skills.update');
    Route::post('/skills/{member}/publish',  [App\Http\Controllers\Admin\SkillController::class, 'publish'])     ->name('skills.publish');
    Route::post('/skills/{member}/unpublish',[App\Http\Controllers\Admin\SkillController::class, 'unpublish'])   ->name('skills.unpublish');
    Route::post('/skills/bulk-publish',      [App\Http\Controllers\Admin\SkillController::class, 'bulkPublish']) ->name('skills.bulkPublish');

    // ---- SETTINGS ----
    Route::get('/settings', function () {
        return view('admin.settings', [
            'settings' => [],
        ]);
    })->name('settings');

    Route::put   ('/settings/account',       [App\Http\Controllers\Admin\SettingsController::class, 'updateAccount'])      ->name('settings.account');
    Route::put   ('/settings/notifications', [App\Http\Controllers\Admin\SettingsController::class, 'updateNotifications']) ->name('settings.notifications');
    Route::put   ('/settings/system',        [App\Http\Controllers\Admin\SettingsController::class, 'updateSystem'])        ->name('settings.system');
    Route::put   ('/settings/site',          [App\Http\Controllers\Admin\SettingsController::class, 'updateSite'])          ->name('settings.site');
    Route::put   ('/settings/qrcode',        [App\Http\Controllers\Admin\SettingsController::class, 'updateQrCode'])        ->name('settings.qrcode');
    Route::get   ('/settings/export-members',[App\Http\Controllers\Admin\SettingsController::class, 'exportMembers'])       ->name('settings.exportMembers');
    Route::get   ('/settings/backup',        [App\Http\Controllers\Admin\SettingsController::class, 'backup'])              ->name('settings.backup');
    Route::delete('/settings/clear-rejected',[App\Http\Controllers\Admin\SettingsController::class, 'clearRejected'])       ->name('settings.clearRejected');
});