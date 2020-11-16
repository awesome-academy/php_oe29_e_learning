<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookMentorRequest extends FormRequest
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
            'mentor_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
        ];
    }
}
