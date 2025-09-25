<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display the specified profile.
     */
    public function show($id)
    {
        $profile = Profile::with(['user', 'office'])->findOrFail($id);
        return view('profiles.show', compact('profile'));
    }
}
