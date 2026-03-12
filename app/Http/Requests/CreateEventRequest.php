<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin() || auth()->user()->isAdmin() || auth()->user()->isSuperAdmin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:155|min:2',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'faculty_id' => 'required|exists:faculties,id',
            'num_tickets' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'type' => 'required|string|in:workshop,course,lecture,orientation,party,trip,exhibition,sports,hackathon,job_fair',
            'location' => 'required|string|max:255',
            'excluded_days' => 'nullable|array',
            'excluded_days.*' => 'date|after_or_equal:start_date',
            'is_public' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => 'نوع الفعالية غير صحيح، اختر من القائمة المتاحة.',
            'excluded_days.*.date' => 'يجب أن تكون أيام العطل تواريخ صحيحة.',
        ];
    }
}
