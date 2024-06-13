<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
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

        
        $res = $this->SendApiRequest('GET','/getMyFavorites/2/0/',null);
        $list = $res['data'];
        $res = $this->SendApiRequest('GET','/getMyFavorites/1/0/',null);
        $fav = $res['data'];
        $res = $this->SendApiRequest('GET','/getMyFavorites/0/0/',null);
        $ignor = $res['data'];
		
		$res = $this->SendApiRequest('GET','/getMyFavorites/8/0/',null);
		
		$mobile = $res['data'];
        return view('front.members.index',compact('list','fav','ignor','mobile'));
    }

    public function LoadMoreMemebers()
    {
        if (request()->ajax()) {
            $page = request()->page?request()->page:0;
            $cat = request()->cat?request()->cat:1;
            $res = $this->SendApiRequest('GET',"/getMyFavorites/$cat/$page",null);
            $list = $res['data'];
            return view('front.members.LoadMoreMemebers',compact('list','page','cat'));
        }

    }

    public function details($id)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }

        $res = $this->SendApiRequest('GET','/getUserDetails/'.$id,null);
		
        if($res['status']=="success"){
            $item = [];
            if($res['data'] && $res['data'][0]){
                $item = $res['data'][0];
                
                return view('front.members.details',compact('item'));
            }
            else
            {
                return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');        
            }
            
        }
        return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        
    }


    public function AddToFav(Request $request)
    {
        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            if($request->action == "remove"){// حذف من قائمة الاهتمام
                $res = $this->SendApiRequest('POST','/removeFromFavorites',$data);
                
                $msg = $request->listType==1? "تم الحذف من قائمة الإعجاب بنجاح" : "تم الحذف من قائمة التجاهل بنجاح";
                
            } 
            else
            {
                $res = $this->SendApiRequest('POST','/addToMyFavorites',$data);
                if($res['status']!="success"){
                    if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                        return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);    
                    }
                    return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
                }
                $msg = $request->listType==1?"تمت الإضافة إلى قائمة الإعجاب بنجاح":"تمت الإضافة إلى قائمة التجاهل بنجاح";
            }
            
            if($res['status']=="success"){
                return response(['message' => $msg,'success'=>true, 'status' => 'success']);
            }
            return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            
        }
    }
    public function RequestPhoto(Request $request)
    {
        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            $res = $this->SendApiRequest('POST','/requestPhoto',$data);
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);    
                }
                return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            }
            $msg = $request->listType==1?"تمت الإضافة إلى قائمة الإعجاب بنجاح":"تمت الإضافة إلى قائمة التجاهل بنجاح";
            if($res['status']=="success"){
                return response(['message' => 'تم إرسال طلب عرض الصورة بنجاح','success'=>true, 'status' => 'success']);
            }
            return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            
        }
    }

    public function cancelRequestPhoto(Request $request)
    {
        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            $res = $this->SendApiRequest('POST','/cancelRequestPhoto',$data);
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);    
                }
                return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            }
            $msg = $request->listType==1?"تمت الإضافة إلى قائمة الإعجاب بنجاح":"تمت الإضافة إلى قائمة التجاهل بنجاح";
            if($res['status']=="success"){
                return response(['message' => 'تم إلغاء طلب عرض الصورة بنجاح','success'=>true, 'status' => 'success']);
            }
            return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            
        }
    }
    public function search()
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        return view('front.members.search');
    }

    public function RemoveMember($id,$type)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $data = [
            'form_params' => []
        ];
        $data['form_params']['otherId']=$id;
        $data['form_params']['listType']=$type;
        $msg = "تم الحذف من القائمة بنجاح";
        $res = $this->SendApiRequest('POST','/removeFromFavorites',$data);
        return back()->with('success',$msg);
    }


    public function SearchMember()
    {

        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        if(request()->term){
            // if (!preg_match("/^[أ-يa-zA-Z0-9]+$/", request()->term)) {
            if (!preg_match("~^[a-z0-9\-'\s\p{Arabic}]{1,60}$~iu", request()->term)) {
                return back()->with('failed','إسم المستخدم يجب ان يكون حروف وارقام فقط');
            }
        }
        
        $page = request()->page?request()->page:0;
        $form_params= [];
        if(request()->mariageStatues) $form_params['mariageStatues']= request()->mariageStatues;
        if(request()->cityId) $form_params['cityId']= request()->cityId;
        if(request()->term) $form_params['userName']= request()->term;
        if(request()->nationalityCountryId) $form_params['nationalityCountryId']= request()->nationalityCountryId;
        if(request()->residentCountryId) $form_params['residentCountryId']= request()->residentCountryId;
        if(request()->veil) $form_params['veil']= request()->veil;

        if(request()->agesFrom) $form_params['ageFrom']= request()->agesFrom;
        if(request()->mariageKind) $form_params['mariageKind']= request()->mariageKind;
        
        if(request()->agesTo) $form_params['ageTo']= request()->agesTo;
        
        if(request()->weight) $form_params['weight']= request()->weight;

        if(request()->height) $form_params['height']= request()->height;

        if(request()->education) $form_params['education']= request()->education;

        if(request()->financial) $form_params['financial']= request()->financial;
        $form_params['page']= $page;
        
        $data['form_params'] = $form_params;
		//dd($data);
        $res = $this->SendApiRequest('POST','/search',$data);
        $list = $res['data'];
        if (request()->ajax()) {
            $rowsCount = $res['rowsCount'];
            $view = view('front.members.Load_more_search_result', ['list' => $list,'page' => $page])->render();
            return response(['view' => $view,'rowsCount'=>$rowsCount]);
            //return view('front.members.Load_more_search_result',compact('list','page','rowsCount'));
        }
        $rowsCount = $res['rowsCount'];
        return view('front.members.search_result',compact('list','rowsCount'));
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
	
	
	public function RequestMobile(Request $request)
    {
        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            $res = $this->SendApiRequest('POST','/requestMobile',$data);
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);    
                }
                return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            }
            
            if($res['status']=="success"){
                return response(['message' => 'تم إرسال طلب عرض رقم الهاتف بنجاح','success'=>true, 'status' => 'success']);
            }
            return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            
        }
    }
	
	
	public function CancelRequestMobile(Request $request)
    {
        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            $res = $this->SendApiRequest('POST','/cancelRequestMobile',$data);
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);    
                }
                return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            }
            if($res['status']=="success"){
                return response(['message' => 'تم إلغاء طلب عرض رقم الهاتف بنجاح','success'=>true, 'status' => 'success']);
            }
            return response(['message' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            
        }
    }
    
	
	public function replyRequestMobile(Request $request)
    {
            $form_params = [
                'statues'  => $request->status ,        
                'otherId'  => $request->otherId ,        
                 
            ];
            $data['form_params'] = $form_params;
            $res = $this->SendApiRequest('POST',"/replyRequestMobile",$data);
            if($res['status']=="success"){
                $message = "تم الموافقة على عرض رقم هاتفك بنجاح";
                if($request->status ==5) $message = "تم رفض عرض رقم هاتفك ";
                return back()->with('message',$message);
            }
    
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
    }

}
