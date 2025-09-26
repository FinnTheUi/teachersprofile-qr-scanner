<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
    $profile = Profile::where('user_id', Auth::id())->firstOrFail();
        $offices = Office::all();
        
        return view('teacher.profile.edit', compact('profile', 'offices'));
    }

    public function update(Request $request)
    {
    $profile = Profile::where('user_id', Auth::id())->firstOrFail();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'contact_number' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
        ]);

        $profile->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function downloadQr()
    {
        $profile = Profile::where('user_id', Auth::id())->firstOrFail();
        $path = "qrcodes/teacher-{$profile->id}.png";
        if (!Storage::disk('public')->exists($path)) {
            // Auto-generate QR code using goqr.me API if missing
            $data = "teacher:{$profile->id}";
            $query = http_build_query([
                'data' => $data,
                'size' => '400x400',
                'format' => 'png',
            ]);
            $url = "https://api.qrserver.com/v1/create-qr-code/?$query";
            $imageContents = @file_get_contents($url);
            if ($imageContents === false) {
                abort(500, 'Failed to generate QR code. The goqr.me API may be unavailable.');
            }
            Storage::disk('public')->put($path, $imageContents);
        }
        return response()->download(storage_path("app/public/{$path}"), "teacher-{$profile->id}-qr.png");
    }
}