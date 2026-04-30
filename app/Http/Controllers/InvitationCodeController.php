<?php

namespace App\Http\Controllers;

use App\Models\InvitationCode;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationCodeController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();

        $codes = InvitationCode::with('creator', 'faculty')->latest()->get();

        return view('admin.invitation-codes.index', compact('codes', 'faculties'));
    }
    public function create()
    {
        $faculties = Faculty::all();
        return view('admin.invitation-codes.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:invitation_codes,code',
            'faculty_id' => 'nullable|exists:faculties,id',
            'max_uses' => 'required|integer|min:1|max:100',
            'expires_at' => 'nullable|date|after:now',
        ]);

        InvitationCode::create([
            'code' => strtoupper($request->code),
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', '✅ تم إنشاء رمز الدعوة بنجاح! يمكنك مشاركته مع المشرف الآن.');
    }
}
