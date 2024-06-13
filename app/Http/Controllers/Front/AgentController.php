<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
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
		//dd($res);
        //$collection = $res['data'];
        $collection = array() ;
		$collection[] = $res['agent'];
		$packages = $res['agent']['agentPackages'];
		
		//$packages = $res['data'];
		
        return view('front.agents.index',compact('collection','packages'));
    }


    public function create()
    {
        return view('front.agents.create');
    }


    public function store(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        
        $rules = array(
            'countryId' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'whats' => 'required',
            // 'paypalAccount' => 'required',
        );    
        $messages = array(
                        'countryId.required' => 'الدولة مطلوبة',
                        'name.required' => 'الاسم مطلوب',
                        'mobile.required' => 'رقم الهاتف مطلوب',
                        'whats.required' => 'الواتس مطلوب',
                        // 'paypalAccount.required' => 'حساب باي بال مطلوب',
                        'email.required' => 'البريد الالكتروني مطلوب',
                        'email.email' => 'يجب كتابة بريد الكتروني صحيح',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );
   
    	if ($validator->fails()) {
            return back()->with('failed',$validator->messages()->first());
        }

        $fileName = null;
        if($request->file){
            $file               = $request->file('file') ;//request('attachment');
            $response           = array();
            $name               = time() . '_' . $file->getClientOriginalName();
            $path               = base_path() .'/public/uploads/';
            $file->move($path, $name);
            $data = [
                'multipart' => [
                    [
                        'name'     => 'attachment',
                        'contents' => fopen($path . $name, 'r'),
                        'headers'  => ['Content-Type' => 'multipart/form-data']
                    ],
                ],
            ];
            
            //$data['form_params']['attachment']=$request->attachment;
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
            }
        }

        $parms = $request->all();
            $data = [
                'form_params' => []
            ];
        foreach($parms as $key=>$value){
            if($key !="_token" && $key != 'file')
            {
                $data['form_params'][$key]=$value;
            }
        }

        if($fileName)
        {
            $data['form_params']['imageFile'] = $fileName;
        }
        $res = $this->SendApiRequest('POST','/addAgent',$data);
        if($res['status'] == "success"){
            return back()->with('message', "تم الارسال بنجاح");
        }
        if($res['status']=="error" && $res['errorCode']==1)
		{
		    return back()->with('failed','البريد الالكتروني مسجل من قبل');
        }
        return back()->with('failed','حدث خطأ أثناء عملية الدفع برجاء المحاولة مرة أخرى');

    }
    
}
