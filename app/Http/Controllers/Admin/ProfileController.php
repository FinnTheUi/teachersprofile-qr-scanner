<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Office;
use App\Models\User;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::with(['user', 'office'])->paginate(10);
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'teacher')->doesntHave('profile')->get();
        $offices = Office::all();
        return view('admin.profiles.create', compact('users', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'office_id' => 'required|exists:offices,id',
            'specialization' => 'required|string|max:255',
            'educational_background' => 'required|string',
            'researches' => 'nullable|string',
            'subjects_taught' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'course' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png|max:2048',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $profile = Profile::create($validated);

        // Generate QR code
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $qrCode = new QrCode("teacher:{$profile->id}");
        $qrImage = $renderer->render($qrCode);

        // Store QR code
        Storage::disk('public')->put("qrcodes/teacher-{$profile->id}.svg", $qrImage);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profile created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $profile->load(['user', 'office']);
        return view('admin.profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $offices = Office::all();
        $profile->load('user');
        return view('admin.profiles.edit', compact('profile', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'specialization' => 'required|string|max:255',
            'educational_background' => 'required|string',
            'researches' => 'nullable|string',
            'subjects_taught' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'course' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png|max:2048',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $profile->update($validated);

        return redirect()->route('admin.profiles.index')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Download the QR code for the specified profile.
     */
    public function downloadQr(Profile $profile)
    {
        $path = "qrcodes/teacher-{$profile->id}.svg";
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download($path, "teacher-{$profile->id}-qr.svg");
    }
}
