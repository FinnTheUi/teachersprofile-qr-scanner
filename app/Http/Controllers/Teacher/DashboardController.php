<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id', auth()->id())->first();
        
        return view('teacher.dashboard', compact('profile'));
    }
}