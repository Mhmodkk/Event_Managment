<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{

    public function create(): View
    {
        $faculties = Faculty::orderBy('name')->get();
        return view('auth.register', compact('faculties'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'email' => $request->email,
            'faculty_id' => $request->faculty_id,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new OtpMail($user, $otp));
        event(new Registered($user));

        session(['otp_user_id' => $user->id]);

        return redirect()->route('otp.verify');
    }
}
