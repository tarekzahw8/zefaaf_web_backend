<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{

    function __construct(){
        parent::__construct();
        if($this->settings['data'][0]['websiteStatues'] != 1)
        {
            \Redirect::to('maintenance')->send();
        }
        
    }

    public function index()
    {
        
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        
        $user = \Session::get('user'); 
        return view('front.settings.index',compact('user'));
    }

    public function store(Request $request)
    {
		
		
		
        $nationalities = "";
        $residents = "";
        if($request->nationalities){
            $nationalities = implode(',',$request->nationalities);
        }
        if($request->residents){
            $residents = implode(',',$request->residents);
        }
        
        $form_params = [
            'nationalities' => $nationalities,        
            'residents' => $residents,        
            'notifications' => $request->notifications,        
            'agesFrom' => $request->agesFrom,        
            'agesTo' => $request->agesTo,        
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/updateMySettings',$data);
        if($res['status']=="success"){
            $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';
            $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):"-";
            $form_params = [
                'detectedCountry' => $country,
                'loginWay' => 'web',
                'deviceToken' => $deviceToken,
            ];
            $data['form_params'] = $form_params;
            $res = $this->SendApiRequest('POST','/loginByToken',$data);
            if($res['status'] == "success"){
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            }
            return back()->with('message','تم تغيير الاعدادات بنجاح');
        }

        return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
    }
    

}
