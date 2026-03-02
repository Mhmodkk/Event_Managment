<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * عرض بيانات الملف الشخصي للمستخدم الحالي
     */
    public function show()
    {
        $user = auth()->user()->load('faculty');

        return response()->json([
            'data' => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'faculty_id' => $user->faculty_id,
                'faculty'    => $user->faculty ? $user->faculty->only(['id', 'name']) : null,
                'image'      => $user->image ? Storage::url($user->image) : null,
                'created_at' => $user->created_at->toDateTimeString(),
            ]
        ]);
    }

    /**
     * تحديث بيانات الملف الشخصي
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'       => 'sometimes|required|string|max:255',
            'email'      => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'password'   => 'sometimes|nullable|string|min:8|confirmed',
            'faculty_id' => 'sometimes|nullable|exists:faculties,id',
            'image'      => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $path = $request->file('image')->store('profiles', 'public');
            $validated['image'] = $path;
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        $user->load('faculty');

        return response()->json([
            'message' => 'تم تحديث الملف الشخصي بنجاح',
            'data' => [
                'id'         => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'role'       => $user->role,
                'faculty_id' => $user->faculty_id,
                'faculty'    => $user->faculty ? $user->faculty->only(['id', 'name']) : null,
                'image'      => $user->image ? Storage::url($user->image) : null,
            ]
        ]);
    }

    /**
     * رفع أو تحديث صورة الملف الشخصي
     */
    public function uploadimage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = auth()->user();

        // حذف الصورة القديمة إذا وجدت
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $path = $request->file('image')->store('profiles', 'public');

        $user->update(['image' => $path]);

        return response()->json([
            'message' => 'تم رفع الصورة بنجاح',
            'image_url' => Storage::url($path)
        ], 201);
    }

    /**
     * حذف صورة الملف الشخصي
     */
    public function deleteimage()
    {
        $user = auth()->user();

        if (!$user->image) {
            return response()->json(['message' => 'لا توجد صورة للحذف'], 200);
        }

        Storage::disk('public')->delete($user->image);

        $user->update(['image' => null]);

        return response()->json(['message' => 'تم حذف الصورة بنجاح']);
    }
}
