<?php

namespace App\Http\Requests\Admin\Prizes;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PackagePrices;
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
            'title_ar'          => 'required',
            'title_en'          => 'required',
            'desc_ar'           => 'required',
            'desc_en'           => 'required',
            'package_id'        => 'required',
            //'file'              => 'required',
            'type'              => 'required',
        ];
    }

    public function persist($id)
    {
        PackagePrices::find($id)->Update($this->request->all());
    }
}
