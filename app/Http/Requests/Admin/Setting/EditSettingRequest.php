<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class EditSettingRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
   public function rules()
    {
        return [
            // 'websiteHomeUsers'                         => 'required',
            // 'seoTitle'                         => 'required',
            // 'seoDescription'                         => 'required',
            // 'seoMeta'                         => 'required',
            // 'abuseKeywords'                         => 'required',
            // 'mobile'                         => 'required',
            // 'Whatsapp'                         => 'required',
            // 'Facebook'                         => 'required',
            // 'Instagram'                         => 'required',
            // 'websiteLink'                         => 'required',
            // 'IphoneLink'                         => 'required',
            // 'AndroidLink'                         => 'required',
            'backageDesc'                         => 'required',

        ];
    }



}
