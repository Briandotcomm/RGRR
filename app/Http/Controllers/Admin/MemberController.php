<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Ensure to import the User model

class MemberController extends Controller
{
    public function index(Request $request)
    {
        // Get the total number of members
        $totalMembers = User::count();

        // Get the count of active, on leave, and graduated members
        $activeMembers = User::where('status', 'active')->count();
        $onLeaveMembers = User::where('status', 'on_leave')->count();
        $graduatedMembers = User::where('status', 'graduated')->count();

        // Paginate the members list (can be modified as needed)
        $members = User::where('status', 'approved')
                    ->when($request->status, function ($query) use ($request) {
                        return $query->where('status', $request->status);
                    })
                    ->when($request->year_level, function ($query) use ($request) {
                        return $query->where('year_level', $request->year_level);
                    })
                    ->paginate(10);  // You can change pagination as needed

        // Return the view with the data
        return view('admin.official-members', compact(
            'totalMembers', 'activeMembers', 'onLeaveMembers', 'graduatedMembers', 'members'
        ));
    }
}