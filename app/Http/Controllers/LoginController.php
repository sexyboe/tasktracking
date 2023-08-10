<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // Make sure to add this import
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class LoginController extends Controller

{

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showResetView()
    {
        return view('auth.resetpassword');
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('frontend.updateProfile', compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'newpassword' => 'required|min:8',
            'oldpassword' => 'required|',

        ]);

        $user = Auth::user();
        $user_id = $user->id;

        // Verify old password
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Incorrect old password.']);
        }

        // Update the password


        $users = new User;
        $user = $users->where('id', $user_id)->First();
        $user->password = Hash::make($request->newpassword);

        $user->update();

        // Send notification or confirmation email

        return redirect('profile')->with('success', 'Password has been reset successfully.');



        // return redirect('profile')->with('reset', 'Password Reset Successfully');
    }

    // Handle the login form submission

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('success', 'You have been successfully logged in.');
        } else {
            Session::flash('old_email', $request->input('email'));
            return redirect()->back()->withInput()->withErrors(['error' => 'Invalid credentials. Please try again.']);
        }
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
