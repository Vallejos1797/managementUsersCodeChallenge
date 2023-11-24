<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'secondName' => 'nullable|string|max:255',
            'lastName' => 'required|string|max:255',
            'secondLastName' => 'nullable|string|max:255',
            'departmentId' => 'nullable|numeric|exists:departments,id',
            'positionId' => 'nullable|numeric|exists:positions,id',
        ];
    }
}
