<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\user\UserController;

/* ================================================================
   PUBLIC ROUTES
================================================================ */

// Landing Page
Route::get('/', function () {
    return view('index');
})->name('home');

// Login
Route::get('/login',  [LoginController::class, 'show'])   ->name('login');
Route::post('/login', [LoginController::class, 'process'])->name('login.perform');

// Logout
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');  
Route::post('/register', [RegisterController::class, 'process'])->name('register.process');  

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
   USER / MEMBER ROUTES
================================================================ */
Route::prefix('user')->name('user.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // My Profile
    Route::get('/profile',        [UserController::class, 'profile'])      ->name('profile');
    Route::put('/profile',        [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/skills', [UserController::class, 'updateSkills']) ->name('profile.skills');

    // Notifications
    Route::get ('/notifications',           [UserController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [UserController::class, 'markRead'])     ->name('notifications.read');
    Route::post('/notifications/read-all',  [UserController::class, 'markAllRead'])  ->name('notifications.readAll');

    // My Courses
    Route::get('/courses', [UserController::class, 'courses'])->name('courses');

    // Settings
    Route::get   ('/settings',              [UserController::class, 'settings'])          ->name('settings');
    Route::put   ('/settings/password',     [UserController::class, 'updatePassword'])    ->name('settings.password');
    Route::put   ('/settings/notifications',[UserController::class, 'updateNotifPrefs'])  ->name('settings.notifications');
    Route::delete('/settings/delete',       [UserController::class, 'deleteAccount'])     ->name('settings.delete');

});


/* ================================================================
   ADMIN ROUTES
================================================================ */
Route::prefix('admin')->name('admin.')->group(function () {

    // ---- DASHBOARD ----
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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