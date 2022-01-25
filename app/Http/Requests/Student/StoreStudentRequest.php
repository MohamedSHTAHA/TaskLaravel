<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'first_name'    =>'required|string|min:3|max:199',
            'second_name'   =>'required|string|min:3|max:199',
            'third_name'    =>'required|string|min:3|max:199',
            'last_name'     =>'required|string|min:3|max:199',
            'email'         =>'required|email|unique:students,email',
        ];
    }
}
