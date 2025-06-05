<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'contact_information' => 'nullable|email|max:255',
            'mobile_no' => 'nullable|string|max:20',
            'join_date' => 'nullable|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }
}