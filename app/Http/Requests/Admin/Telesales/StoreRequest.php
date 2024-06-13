<?php

namespace App\Http\Requests\Admin\Telesales;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name'          => 'required',
            'mobile'        => 'required',
            'code'        => 'required',
            'email'         => 'required|email',
            'countryId'     => 'required',
            'whats'         => 'required',
            'password'      => 'required',
            'password' => 'required|confirmed|min:6',
            'commision' => 'required',
            // 'paypalAccount' => 'required',
        ];
    }


}
