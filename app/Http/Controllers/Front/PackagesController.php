<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
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
		$res = $this->SendApiRequest('GET','/getPackages2',null);
		
		$agent = null;
		if(isset($res['agent']) && count($res['agent']) > 0)
		{
			if(isset($res['agent']['agentPackages']) && count($res['agent']['agentPackages']) > 0) $agent = $res['agent'];	
		}
		$packages = $res['data'];
		
        return view('front.packages.index',compact('agent','packages'));
    }
    public function details($id)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $item = null;
        foreach($this->packages as $struct) {
            if ($id == $struct['id']) {
                $item = $struct;
                break;
            }
        }
        return view('front.packages.details',compact('item'));
    }
    public function LoadScript(Request $request,$id)
    {
        if ($request->ajax()) {

            $res = $this->SendApiRequest('GET','/getPaymentTokens',null);
            if($res['status'] == "success")
            {
                $list = $res['data'];
                $item = null;
                foreach($list as $struct) {
                    if ($id == $struct['id']) {
                        $item = $struct;
                        return response(['data' => $item,'success'=>true]);
                    }
                }
            }
            return response(['data' => $item,'success'=>false]);
        }
    }

    public function purchasePackage($id)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):null;
        $form_params = [
            'packageId' => $id,        
            'paymentRefrence' => "test",        
            'paymentValue' => 10,        
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/purchasePackage',$data);
        if($res['status']=="success")
        {
            $form_params = [
                'detectedCountry' => $country,
                'loginWay' => 'web',
                'deviceToken' => 'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL',
            ];
            $data['form_params'] = $form_params;
            $res = $this->SendApiRequest('POST','/loginByToken',$data);
            if($res['status'] == "success"){
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            }
            
            return back()->with('success','مُبارك عليك العضوية');
        }
        else
        {
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        }
    }

}
