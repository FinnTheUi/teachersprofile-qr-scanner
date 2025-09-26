<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the offices.
     */
    public function index()
    {
        $offices = Office::orderBy('college')->paginate(10);
        return view('admin.offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new office.
     */
    public function create()
    {
        return view('admin.offices.create');
    }

    /**
     * Store a newly created office in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'office_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
        ]);

        Office::create($validated);

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office created successfully');
    }

    /**
     * Show the form for editing the specified office.
     */
    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the specified office in storage.
     */
    public function update(Request $request, Office $office)
    {
        $validated = $request->validate([
            'office_name' => 'required|string|max:255',
            'college' => 'required|string|max:255',
        ]);

        $office->update($validated);

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office updated successfully');
    }

    /**
     * Remove the specified office from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('admin.offices.index')
            ->with('success', 'Office deleted successfully');
    }
}
