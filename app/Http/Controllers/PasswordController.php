<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * PasswordController
 * Handles CRUD operations for passwords.
 */
class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all passwords. In a real app, filter by auth()->id()
        // $passwords = Password::where('user_id', auth()->id())->latest()->get();
        $passwords = Password::latest()->get();
        
        // Return the index view with passwords
        return view('passwords.index', compact('passwords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the create view
        return view('passwords.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'website_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        // Create new password record
        Password::create([
            // 'user_id' => auth()->id(), // Uncomment if auth is used
            'website_name' => $request->website_name,
            'username' => $request->username,
            // Encrypt the password before saving
            'password' => Crypt::encryptString($request->password),
        ]);

        return redirect()->route('passwords.index')->with('success', 'Password created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Password $password)
    {
        // Decrypt password to show in the form (optional, or leave blank to require re-entry)
        // Here we verify encryption works by decrypting it for the edit form
        try {
            $decryptedPassword = Crypt::decryptString($password->password);
        } catch (\Exception $e) {
            $decryptedPassword = '';
        }

        return view('passwords.edit', compact('password', 'decryptedPassword'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Password $password)
    {
        // Validate the request
        $request->validate([
            'website_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        // Update the record
        $password->update([
            'website_name' => $request->website_name,
            'username' => $request->username,
            // Encrypt the new password
            'password' => Crypt::encryptString($request->password),
        ]);

        return redirect()->route('passwords.index')->with('success', 'Password updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password)
    {
        // Delete the record
        $password->delete();

        return redirect()->route('passwords.index')->with('success', 'Password deleted successfully.');
    }
}
