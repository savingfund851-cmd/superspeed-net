<?php

namespace App\Http\Controllers;

use App\Models\ConnectionRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class NewConnectionController extends Controller
{
    public function create()
    {
        $packages = Package::all();
        return view('new-connection', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'package_id' => 'required|exists:packages,id',
            'remarks' => 'nullable|string',
        ]);

        ConnectionRequest::create($validated);

        return redirect()->back()->with('success', 'Your connection request has been submitted successfully! Our team will contact you soon.');
    }
}
