<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        switch ($this->validate_rule) {
            case config('validate.update_email'):
                $rules = ['email' => 'required|email|unique:users',];

                break;
            case config('validate.update_information'):
                $rules = [
                    'name' => 'required|string|max:255',
                    'phone' => 'required|string|max:15',
                    'date_of_birth' => 'required|string|max:20',
                    'address' => 'required|string',
                ];

                break;
            case config('validate.update_avatar'):
                $rules = ['photo' => 'required|image',];
                
                break;
            default:
                $rules = ['github_url' => 'required|string',];
        }
        
        return $rules;
    }
}
