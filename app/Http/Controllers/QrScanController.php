<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use BaconQrCode\Decoder\Decoder;
use BaconQrCode\Decoder\ImageLoader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class QrScanController extends Controller
{
    /**
     * Show the QR code scan form.
     */
    public function showForm()
    {
        return view('scan.index');
    }

    /**
     * Process the uploaded QR code image.
     */
    public function scan(Request $request)
    {
        $request->validate([
            'qr_image' => 'required|image|mimes:jpeg,png|max:2048'
        ]);

        try {
            $image = $request->file('qr_image');
            $path = $image->store('temp');
            $fullPath = Storage::path($path);

            // Load and decode QR code
            $imageLoader = new ImageLoader();
            $decoder = new Decoder();
            $qrCode = $decoder->decode($imageLoader->load($fullPath))->getText();

            // Clean up temporary file
            Storage::delete($path);

            // Extract profile ID from QR code (format: teacher:123)
            if (!preg_match('/^teacher:(\d+)$/', $qrCode, $matches)) {
                throw ValidationException::withMessages([
                    'qr_image' => ['Invalid QR code format']
                ]);
            }

            $profileId = $matches[1];

            // Find the profile with relationships
            $profile = Profile::with(['user', 'office'])
                ->findOrFail($profileId);

            return view('scan.result', compact('profile'));

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'qr_image' => ['Unable to read QR code. Please try again with a clearer image.']
            ]);
        }
    }
}
