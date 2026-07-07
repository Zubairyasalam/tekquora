<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        // If already logged in, redirect to admin dashboard
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => 'admin@tekquora.com',
            'password' => 'admin',
        ];

        if ($request->email === $credentials['email'] && $request->password === $credentials['password']) {
            Session::put('admin_logged_in', true);
            Session::put('admin_email', $request->email);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        Session::forget('admin_email');
        
        return redirect()->route('admin.login');
    }
}
