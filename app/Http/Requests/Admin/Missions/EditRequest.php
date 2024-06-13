<?php

namespace App\Http\Requests\Admin\Missions;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ChallengePoints;
use App\Models\Challenges;
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
        ];
    }

    public function persist($id)
    {
        $end_lat_key = array_key_last($this->lat);
        $end_lng_key = array_key_last($this->lng);
        $address_key = array_key_last($this->address);

        $this->offsetSet('start_lat', $this->lat[0]);
        $this->offsetSet('start_lng', $this->lng[0]);
        $this->offsetSet('start_address', $this->address[0]);

        $this->offsetSet('end_lat', $this->lat[$end_lat_key]);
        $this->offsetSet('end_lng', $this->lng[$end_lng_key]);
        $this->offsetSet('end_address', $this->address[$address_key]);

        Challenges::find($id)->Update($this->request->all());
        ChallengePoints::where('challenge_id',$id)->delete();
        for($i=1;$i<$end_lat_key;$i++){
            if($this->lat && $this->lng && isset($this->lat[$i]) && isset($this->lng[$i]))
            {
                $ChallengePoints = new ChallengePoints;
                $ChallengePoints->challenge_id = $id;
                $ChallengePoints->lat = $this->lat[$i];
                $ChallengePoints->lng = $this->lng[$i];
                $ChallengePoints->address = $this->address[$i];
                $ChallengePoints->save();
            }
        }
    }
}
