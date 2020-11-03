<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonStoreRequest extends FormRequest
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
            'title' => 'required|array',
            'title.*' => 'required:string|max:255',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'video_url' => 'required|array',
            'video_url.*' => 'required|string',
        ];
    }
}
