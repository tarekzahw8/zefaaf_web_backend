<?php

namespace App\Http\Requests\Admin\AboutApp;

use App\Http\Requests\Admin\BaseRequest;
use Illuminate\Validation\Rule;


class EditAboutAppRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
   public function rules()
    {
        return [
            'title_ar'                         => 'required',
            'title_en'                         => 'required',
            'desc_ar'                         => 'required',
            'desc_en'                         => 'required',
            

        ];
    }

    public function persist($id)
    {
        Pages::find($id)->Update($this->request->all());
    }


}
