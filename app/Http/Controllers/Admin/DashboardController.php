<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalTeachers = Profile::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentProfiles = Profile::with('user', 'office')
                                ->latest()
                                ->take(5)
                                ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTeachers',
            'recentUsers',
            'recentProfiles'
        ));
    }
}