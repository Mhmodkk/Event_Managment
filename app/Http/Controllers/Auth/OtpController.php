<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * عرض صفحة إدخال رمز التحقق (OTP)
     */
    public function show()
    {
        if (!session()->has('otp_user_id')) {
            return redirect()->route('register')
                ->with('error', 'جلسة التسجيل انتهت. يرجى التسجيل مرة أخرى.');
        }

        return view('auth.verify-otp');
    }

    /**
     * التحقق من رمز OTP
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',   // نفترض 6 أرقام
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('register')
                ->with('error', 'جلسة التسجيل غير صالحة. يرجى إعادة التسجيل.');
        }

        $user = User::findOrFail($userId);

        // التحقق من الرمز وصلاحيته
        if ($user->otp === $request->otp && now()->lt($user->otp_expires_at)) {

            // تفعيل الحساب
            $user->update([
                'otp'              => null,
                'otp_expires_at'   => null,
                'email_verified_at' => now(),
            ]);

            // تسجيل الدخول
            Auth::login($user);

            // تنظيف الجلسة
            session()->forget('otp_user_id');

            return redirect()->route('dashboard')
                ->with('success', 'تم تفعيل حسابك بنجاح! مرحباً بك في المنصة.');
        }

        // إذا فشل التحقق
        return back()
            ->withErrors(['otp' => 'الرمز الذي أدخلته غير صحيح أو انتهت صلاحيته.'])
            ->withInput();
    }
}
