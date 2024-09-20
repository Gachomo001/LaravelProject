<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'phone' => 'required|numeric|unique:staff,phone',
            'email' => 'required|email|unique:staff,email',
            'passport_photo' => 'required|image',
            'id_front' => 'required|image',
            'id_back' => 'required|image',
            'user_role' => 'required|string|in:user,staff',
            'password' => 'required|string|min:8',
        ]);

        // Save passport photo and ID files
        $passportPhotoPath = $request->file('passport_photo')->store('photos');
        $idFrontPath = $request->file('id_front')->store('ids');
        $idBackPath = $request->file('id_back')->store('ids');

        // Create staff
        $staff = Staff::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'passport_photo' => $passportPhotoPath,
            'id_front' => $idFrontPath,
            'id_back' => $idBackPath,
            'user_role' => $request->user_role,
            'status' => 'active',
        ]);

        // Auto-generate password
        $generatedPassword = Str::random(12);

        // Create user
        User::create([
            'username' => $request->email,
            'staff_id' => $staff->id,
            'password' => Hash::make($generatedPassword),
        ]);

        // Send the generated password to the user's email
        Mail::raw("Your account has been created. Here is your password: {$password}", function ($message) use ($user) {
        $message->to($user->username)
                ->subject('Your Auto-Generated Password');
    });

    // Conditional logic based on role
    if ($request->role === 'staff') {
        $user->is_staff = true; // or set any other staff-specific attributes
    } else {
        $user->is_staff = false;
    }

    $user->save();

    // Optionally, log in the user
    Auth::login($user);

    return redirect()->route('home');

    // Show password on the show_password view
        return view('auth.show_password', ['password' => $password]);
}

    public function showLoginForm()
        {
            return view('auth.login');
        }
  
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials']);
    }
}
