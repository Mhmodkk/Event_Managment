<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:155|min:2',
            'image' => 'image|required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'faculty_id' => 'required|exists:faculties,id',
            'description' => 'required',
            'num_tickets' => 'required|integer|min:1',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
