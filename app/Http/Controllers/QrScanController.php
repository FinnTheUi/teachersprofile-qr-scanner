<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrScanController extends Controller
{
    /**
     * Show the QR scanner form.
     */
    public function showForm()
    {
        return view('qr.scan');
    }

    /**
     * Process the QR code scan.
     */
    public function scan(Request $request)
    {
        // TODO: Implement QR code scanning logic
        return redirect()->back()->with('message', 'QR scanning functionality coming soon!');
    }
}
