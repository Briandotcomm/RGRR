<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* ================================================================
       DASHBOARD
    ================================================================ */
    public function dashboard()
    {
        $user = auth()->user();

        // Preview mode — no logged in user
        if (!$user) {
            return view('user.dashboard', [
                'enrolledCourses'  => 3,
                'completedCourses' => 1,
                'skillsCount'      => 5,
                'enrollments'      => collect([]),
                'notifications'    => collect([]),
            ]);
        }

        $enrollments = collect();
        $completedCourses = 0;
        $enrolledCourses  = 0;
        $skillsCount      = 0;
        $notifications    = collect();

        if (method_exists($user, 'enrollments')) {
            $enrollments = $user->enrollments()->with('course')->get()->map(function ($e) {
                $e->percent = $e->course && $e->course->total_modules > 0
                    ? round(($e->completed_modules / $e->course->total_modules) * 100)
                    : 0;
                return $e;
            });
            $enrolledCourses  = $enrollments->count();
            $completedCourses = $enrollments->filter(fn($e) => $e->percent == 100)->count();
        }

        if ($user->skills) {
            $decoded = json_decode($user->skills);
            $skillsCount = is_array($decoded) ? count($decoded) : 0;
        }

        if (method_exists($user, 'notifications')) {
            $notifications = $user->notifications()->latest()->take(5)->get();
        }

        return view('user.dashboard', [
            'enrolledCourses'  => $enrolledCourses,
            'completedCourses' => $completedCourses,
            'skillsCount'      => $skillsCount,
            'enrollments'      => $enrollments,
            'notifications'    => $notifications,
        ]);
    }

    /* ================================================================
       MY PROFILE
    ================================================================ */
    public function profile()
    {
        return view('user.myprofile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'surname'    => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        auth()->user()->update([
            'first_name'     => $request->first_name,
            'surname'        => $request->surname,
            'middle_initial' => $request->middle_initial,
            'email'          => $request->email,
            'address'        => $request->address,
            'school'         => $request->school,
            'year_level'     => $request->year_level,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updateSkills(Request $request)
    {
        $skills = [];

        if ($request->filled('skills_raw')) {
            $skills = array_values(array_filter(
                array_map('trim', explode(',', $request->skills_raw))
            ));
        }

        auth()->user()->update([
            'bio'    => $request->bio,
            'skills' => json_encode($skills),
        ]);

        return back()->with('success', 'Skills and bio updated successfully.');
    }

    /* ================================================================
       NOTIFICATIONS
    ================================================================ */
    public function notifications()
    {
        // Ensure a user exists for the notifications page, or use default data
        $user = auth()->user();
        
        // If there's no logged-in user, return dummy data for testing
        if (!$user) {
            return view('user.notifications', [
                'notifications' => collect([]),
                'unreadCount'   => 0,
                'totalCount'    => 0,
            ]);
        }

        $notifications = collect();
        $unreadCount   = 0;
        $totalCount    = 0;

        if (method_exists($user, 'notifications')) {
            $notifications = $user->notifications()->latest()->paginate(20);
            $unreadCount   = $user->notifications()->whereNull('read_at')->count();
            $totalCount    = $user->notifications()->count();
        }

        return view('user.notifications', [
            'notifications' => $notifications,
            'unreadCount'   => $unreadCount,
            'totalCount'    => $totalCount,
        ]);
    }

    public function markRead($id)
    {
        $notif = auth()->user()->notifications()->findOrFail($id);
        $notif->update(['read_at' => now()]);

        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead()
    {
        auth()->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return back()->with('success', 'All notifications marked as read.');
    }

    /* ================================================================
       MY COURSES
    ================================================================ */
    public function courses()
    {
        $user = auth()->user();
        $enrollments = collect(); // Default empty collection in case of no user or no enrollments

        if ($user) {
            if (method_exists($user, 'enrollments')) {
                $enrollments = $user->enrollments()->with('course')->get();
            }
        }

        $totalEnrolled    = $enrollments->count();
        $completed        = $enrollments->filter(function ($e) {
            return $e->course && $e->completed_modules >= $e->course->total_modules && $e->course->total_modules > 0;
        })->count();
        $inProgress       = $enrollments->filter(function ($e) {
            return $e->completed_modules > 0 && $e->course && $e->completed_modules < $e->course->total_modules;
        })->count();
        $totalModulesDone = $enrollments->sum('completed_modules');

        return view('user.mycourses', [
            'enrollments'      => $enrollments,
            'totalEnrolled'    => $totalEnrolled,
            'completed'        => $completed,
            'inProgress'       => $inProgress,
            'totalModulesDone' => $totalModulesDone,
        ]);
    }

    /* ================================================================
       SETTINGS
    ================================================================ */
    public function settings()
    {
        return view('user.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function updateNotifPrefs(Request $request)
    {
        $prefs = [
            'notify_courses'       => $request->boolean('notify_courses'),
            'notify_announcements' => $request->boolean('notify_announcements'),
            'notify_profile'       => $request->boolean('notify_profile'),
        ];

        auth()->user()->update([
            'notification_preferences' => json_encode($prefs),
        ]);

        return back()->with('success', 'Notification preferences saved.');
    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();

        return redirect()->route('home')->with('success', 'Your account has been deleted.');
    }
}