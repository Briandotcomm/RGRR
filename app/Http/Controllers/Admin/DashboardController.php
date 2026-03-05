<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import User model

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch recent approved members (e.g., last 5 approved members)
        $recentMembers = User::where('status', 'approved')->latest()->take(5)->get(); // Only approved members

        // Get the member statistics
        $memberCount = User::count(); // Total number of members
        $newMembersThisMonth = User::whereMonth('created_at', now()->month)->count(); // Members joined this month

        // Official and Pending Member Count
        $officialMembersCount = User::where('status', 'approved')->count(); // Count of official members
        $pendingCount = User::where('status', 'pending')->count(); // Count of pending members

        // Placeholder for active courses and revenue
        $courseCount = 0; // Placeholder for active course count, modify this if needed
        $revenueThisMonth = 0; // Replace with revenue calculation logic if needed

        // Monthly registrations for the chart
        $monthlyRegistrations = $this->getMonthlyRegistrations();

        return view('admin.dashboard', compact(
            'recentMembers', 'memberCount', 'newMembersThisMonth', 
            'officialMembersCount', 'pendingCount', 'courseCount', 'revenueThisMonth', 'monthlyRegistrations'
        ));
    }

    private function getMonthlyRegistrations()
    {
        $months = [];
        for ($i = 0; $i < 6; $i++) {
            $month = now()->subMonths($i);
            $count = User::whereMonth('created_at', $month->month)
                         ->whereYear('created_at', $month->year)
                         ->count();
            $months[] = [
                'label' => $month->format('M'),
                'count' => $count,
                'percent' => $count ? ($count / User::whereYear('created_at', $month->year)->count()) * 100 : 0,
            ];
        }
        return $months;
    }
}