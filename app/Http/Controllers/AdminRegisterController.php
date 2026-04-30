<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\InvitationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{

    public function create()
    {
        $faculties = Faculty::all();
        return view('auth.admin-register', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'invitation_code' => ['required', 'string'],
        ]);

        $code = InvitationCode::where('code', $request->invitation_code)->first();

        if (!$code) {
            return back()->withErrors(['invitation_code' => 'رمز الدعوة غير صحيح أو غير موجود.']);
        }

        if ($code->used_count >= $code->max_uses) {
            return back()->withErrors(['invitation_code' => 'تم استهلاك هذا الرمز مسبقاً (العدد المسموح به).']);
        }

        if ($code->expires_at && now()->greaterThan($code->expires_at)) {
            return back()->withErrors(['invitation_code' => 'انتهت صلاحية هذا الرمز.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'faculty_id' => $request->faculty_id,
            'role' => 'admin',
            'student_id' => null,
        ]);

        $code->increment('used_count');

        return redirect()->route('login')->with('success', 'تم إنشاء حسابك بنجاح! يمكنك تسجيل الدخول الآن.');
    }
}
