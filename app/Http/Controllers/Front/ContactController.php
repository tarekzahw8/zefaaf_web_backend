<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Redirect;

class ContactController extends Controller
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
            return redirect()->to(url('/'))->with('failed','يجب تسجيل الدخول أولاً');
        }
        $list = null;
        if(\Session::get('token'))
        {
            $res = $this->SendApiRequest('GET','/getMessagesList',null);
			
            $list = $res['data'];
            
        }
		\Session::put('updates.newMessages',0);
		return view('front.contact.index',compact('list'));
    }
	
	public function support()
    {
		if(!\Session::get('token'))
        {
            return redirect()->to(url('/'))->with('failed','يجب تسجيل الدخول أولاً');
        }
        
		return view('front.contact.support');
    }
    public function details($id)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        //$res = $this->SendApiRequest('GET','/getMessagesList',null);
        $res = $this->SendApiRequest('GET',"/getMessageDetails/$id",null);
		if($res['status']!="success"){
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        }
		if(isset($res['data']) && !empty($res['data']))
		{
			$item = $res['data'][0];
			return view('front.contact.details',compact('item'));
		}
		else
		{
			return redirect()->to(url('contact-us'))->with('failed','حدث خطأ برجاء المحاولة مرة اخرى');
		}
		
        
    }
    public function create(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $type=null;$otherId=null;
        if($request->type){
            $type=$request->type; 
        }
        if($request->other){
            $otherId=$request->other; 
        }
        return view('front.contact.create',compact('type','otherId'));
    }
    public function store(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        
        $rules = array(
            'reasonId' => 'required',
            'message' => 'required',
            'title' => 'required',
        );    
        $messages = array(
                        'reasonId.required' => 'نوع الرسالة مطلوب',
                        'message.required' => 'يجب كتابة الرسالة',
                        'title.required' => 'يجب كتابة عنوان الرسالة',
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
        $res = $this->SendApiRequest('POST','/sendMessage',$data);
        return back()->with('message', "تم إرسال الرسالة بنجاح");
    }
	
	
	// send marriage
	
	public function SendMarriage(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $type=null;$otherId=null;
        
        return view('front.contact.send_marriage',compact('type','otherId'));
    }
    public function StoreMarriage(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        
        $rules = array(
            'whats' => 'required',
            'age' => 'required',
            'realName' => 'required',
            'mariageStatues' => 'required',
            'mariageKind' => 'required',
            'aboutMe' => 'required|max:500',
            'aboutOther' => 'required|max:500',
        );    
        $messages = array(
                        'mariageKind.required' => 'نوع الزواج مطلوب',
                        'mariageStatues.required' => 'حالتك الاجتماعية مطلوبه',
                        'whats.required' => 'رقم الواتس مطلوب',
                        'age.required' => 'العمر مطلوب',
                        'realName.required' => 'إسمك الأول مطلوب',
						'aboutOther.required' => 'مواصفات زوجي(زوجتي) مطلوبة',
                        'aboutOther.max' => 'مواصفات زوجي(زوجتي) يجب ان لا تزيد عن 500 حرف',
						'aboutMe.required' => 'مواصفاتك  مطلوبة',
                        'aboutMe.max' => 'مواصفاتك  يجب ان لا تزيد عن 500 حرف',
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
        $res = $this->SendApiRequest('POST','/marriageRequest',$data);
        return back()->with('success_message', "تهانينا تم إرسال طلبك للمراجعة ومن ثم النشر");
    }
    

}
