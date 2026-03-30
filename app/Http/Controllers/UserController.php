<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:student,admin,super_admin',
        ]);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك تغيير دور حسابك الخاص.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'تم تغيير الدور بنجاح.');
    }
}
