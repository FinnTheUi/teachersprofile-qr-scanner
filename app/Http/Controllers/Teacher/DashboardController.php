<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all offices for the form
        $offices = Office::all();
        
        $profile = Profile::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'office_id' => $offices->first()->id ?? 1, // Use first office if available, otherwise default to 1
                'specialization' => '',
                'educational_background' => '',
                'researches' => '',
                'subjects_taught' => '',
                'contact_number' => '',
                'course' => '',
                'social_links' => []
            ]
        );
        
        return view('teacher.dashboard', compact('profile', 'offices'));
    }
}