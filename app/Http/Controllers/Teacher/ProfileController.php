<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Office;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::where('user_id', auth()->id())->firstOrFail();
        $offices = Office::all();
        
        return view('teacher.profile.edit', compact('profile', 'offices'));
    }

    public function update(Request $request)
    {
        $profile = Profile::where('user_id', auth()->id())->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'contact_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ]);

        $profile->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}