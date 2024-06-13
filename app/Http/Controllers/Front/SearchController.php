<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
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

        if (request()->ajax()) {
            $page = request()->page?request()->page:0;
            $res = $this->SendApiRequest('GET',"/getMySearch/$page/id",null);
            $list = $res['data'];
            $rowsCount = $res['rowsCount'];
            $view = view('front.search.LoadMoreMemebers', ['list' => $list,'page' => $page])->render();
            return response(['view' => $view,'rowsCount'=>$rowsCount]);
            //return view('front.search.LoadMoreMemebers',compact('list','page'));
        }
        
        $res = $this->SendApiRequest('GET','/getMySearch/0/id',null);
        $list = $res['data'];
        $settingsExist = $res['settingsExist'];
        $rowsCount = $res['rowsCount'];
        return view('front.search.index',compact('list','settingsExist','rowsCount'));
    }

    public function filter()
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $collection = null;
        $res = $this->SendApiRequest('GET','/getMySearchSettings',null);
        if($res['status'] == "success")
        {
            if($res['data'] && $res['data'][0])
            {
                $collection = $res['data'][0];
            }
        }
        //dd($collection);
        return view('front.search.filter',compact('collection'));
    }


    public function store(Request $request)
    {

        // $rules = array(
        //     //'accept' => 'required',
        //     'userName' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8|max:12|same:confirmation_password',
        //     'confirmation_password' => 'required',
            
        // );    
        // $messages = array(
        //                 'email.required' => ' الايميل مطلوب ',
        //                 'email.email' => 'الايميل غير صحيح',
        //                 'userName.required' => 'إسم المستخدم مطلوب',
        //                 'password.required' => 'كلمة المرور مطلوبة',
        //                 'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف',
        //                 'password.max' => 'كلمة المرور يجب الا تزيد عن 12 حرف',
        //                 'password.same' => 'كلمة المرور غير متطابقة مع التاكيد',
        //                 'confirmation_password.required' => 'تاكيد كلمة المرور مطلوب',
        //                 //'accept.required' => 'الموافقة على الشروط والاحكام مطلوبة',
        //             );
        // $validator = Validator::make( $request->all(), $rules, $messages );
   
    	// if ($validator->fails()) {
        //     return back()->with('failed',$validator->messages()->first());
        // }

        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }

        $nationalityCountryId = "";
        $residentCountryId = "";

        $mariageStatues = "";
        $mariageKind = "";
        $prayer = "";
        $smoking = "";
        
        $financial = "";
        $education = "";
        $workField = "";
        $skinColor = "";
        $income = "";
        $helath = "";
        $veil = "";

        if($request->nationalityCountryId){
            $nationalityCountryId = implode(',',$request->nationalityCountryId);
        }
        if($request->residentCountryId){
            $residentCountryId = implode(',',$request->residentCountryId);
        }
        if($request->financial){
            $financial = implode(',',$request->financial);
        }
        if($request->education){
            $education = implode(',',$request->education);
        }
        if($request->workField){
            $workField = implode(',',$request->workField);
        }
        if($request->skinColor){
            $skinColor = implode(',',$request->skinColor);
        }
        if($request->income){
            $income = implode(',',$request->income);
        }
        if($request->helath){
            $helath = implode(',',$request->helath);
        }


        if($request->mariageStatues){
            $mariageStatues = implode(',',$request->mariageStatues);
        }
        if($request->mariageKind){
            $mariageKind = implode(',',$request->mariageKind);
        }
        if($request->prayer){
            $prayer = implode(',',$request->prayer);
        }
        if($request->smoking){
            $smoking = implode(',',$request->smoking);
        }
        if($request->veil){
            $veil = implode(',',$request->veil);
        }
        
        $form_params = [
            'nationalityCountryId'  => $nationalityCountryId ? $nationalityCountryId:"-1" ,        
            'residentCountryId'     => $residentCountryId ? $residentCountryId:"-1" ,        
            'mariageStatues'        => $mariageStatues ? $mariageStatues:"-1" ,        
            'mariageKind'           => $mariageKind ? $mariageKind:"-1" ,        
            'prayer'                => $prayer ? $prayer:"-1" ,        
            'smoking'               => $smoking ? $smoking:"-1" ,        
            'ageFrom'               => $request->agesFrom ? $request->agesFrom:"-1" ,        
            'ageTo'                 => $request->agesTo ? $request->agesTo:"-1" ,        
            'financial'             => $financial ? $financial:"-1" ,        
            'education'             => $education ? $education:"-1" ,        
            'workField'             => $workField ? $workField:"-1" ,        
            'skinColor'             => $skinColor ? $skinColor:"-1" ,        
            'income'                => $income ? $income:"-1" ,        
            'helath'                => $helath ? $helath:"-1" ,        
            'veil'                  => $veil ? $veil:"-1" ,        
            'weightFrom'            => $request->weightFrom ? $request->weightFrom:"-1" , 
            'weightTo'              => $request->weightTo ? $request->weightTo:"-1" , 
            'heightFrom'            => $request->heightFrom ? $request->heightFrom:"-1" , 
            'heightTo'              => $request->heightTo ? $request->heightTo:"-1" , 
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/updateMySearchSetings',$data);
        
        if($res['status']=="success"){
            //return back()->with('message','تم تغيير الاعدادات بنجاح');
            return redirect(url('/automated-search'))->with('message','تم تغيير الاعدادات بنجاح');
        }
        
        return redirect(url('/automated-search'));
        return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        
    }


    public function GetCities(Request $request)
    {
        if ($request->ajax()) {
            $res = $this->SendApiRequest('GET','/getCities/'.$request->country_id.'/',null);
            if($res['status']=="success"){
                $cities = $res['data'];
                return view("front.members.cities",compact('cities'));
            }
        }
    }
    

}
