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
            'title'          => 'required|string|max:255|min:5',
            'description'    => 'required|string|min:20',
            'start_date'     => 'required|date|after_or_equal:today',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'faculty_id'     => 'required|exists:faculties,id',
            'type'           => 'required|in:workshop,course,lecture,orientation,party,trip,exhibition,sports,hackathon,job_fair,other',
            'location'       => 'required|string|max:255',
            'num_tickets'    => 'nullable|integer|min:1',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'tags'           => 'nullable|array',
            'tags.*'         => 'exists:tags,id',
            'is_public'      => 'boolean',
            'excluded_days_json' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'         => 'عنوان الفعالية مطلوب',
            'title.min'              => 'يجب أن يكون العنوان 5 أحرف على الأقل',
            'description.min'        => 'يجب أن يكون الوصف 20 حرفاً على الأقل',
            'start_date.after_or_equal' => 'تاريخ البداية يجب أن يكون اليوم أو في المستقبل',
            'end_date.after_or_equal'   => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية أو يساويه',
            'faculty_id.required'    => 'يجب اختيار الكلية',
            'faculty_id.exists'      => 'الكلية المختارة غير موجودة',
            'type.required'          => 'يجب اختيار نوع الفعالية',
            'image.image'            => 'يجب أن يكون الملف صورة',
            'image.max'              => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت',
        ];
    }
}
