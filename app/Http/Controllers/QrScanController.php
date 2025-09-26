<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Zxing\QrReader;

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

            // Decode QR code using khanamiryan/qrcode-detector-decoder
            $qrcode = new QrReader($fullPath);
            $qrCodeText = $qrcode->text();

            // Clean up temporary file
            Storage::delete($path);

            // Extract profile ID from QR code (format: teacher:123)
            if (!preg_match('/^teacher:(\d+)$/', $qrCodeText, $matches)) {
                throw ValidationException::withMessages([
                    'qr_image' => ['Invalid QR code format']
                ]);
            }

            $profileId = $matches[1];

            // Find the profile with relationships
            $profile = Profile::with(['user', 'office'])
                ->findOrFail($profileId);

            // If AJAX, return only the profile card partial (no layout)
            if ($request->ajax()) {
                return response()->view('scan.result', compact('profile'), 200)
                    ->header('X-Partial', 'true');
            }
            // Otherwise, return full page
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
