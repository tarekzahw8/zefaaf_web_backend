<?php

namespace App\Http\Requests\Admin\successStories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            'husId'             => 'required',
            'wifId'             => 'required',
            'story'             => 'required',
            'active'            => 'required',
        ];
    }

    
}
