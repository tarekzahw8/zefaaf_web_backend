<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;

class UserController extends Controller
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
        if(\Session::get('token')){
            return redirect(url('/'));
        }
        return view('front.user.register');
    }

    public function login(Request $request)
    {
            $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):"-";
            if(!$country)
            {
                //return back()->with('failed','عفواً يجب السماح بالتعرف على موقعك للسماح بالدخول');
            }
            $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';
            $data = [
                'form_params' => [
                    'mobile' => $request->login_mobile,
                    'password' => $request->login_password,
                    'detectedCountry' => $country,
                    'loginWay' => 'web',
                    'deviceToken' => $deviceToken,
                ]
            ];
            $res = $this->SendApiRequest('POST','/login',$data);
            if($res['status'] == "error"){
                return back()->with('failed','خطأ بإسم المستخدم أو كلمة المرور ');
            }
            // if($request->remeber)
            // {
                \Session::put('token', $res['token']);
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            // }


            return back()->with('message','تم تسجيل الدخول بنجاح');

    }

    public function SendSMS(Request $request)
    {

        if ($request->ajax()) {
            $rules = array(
                //'accept' => 'required',
                'mobile' => 'required|regex:/^[0-9_\-]*$/',

            );
            $messages = array(
                            'mobile.required' => ' رقم الموبيل مطلوب ',
                            'regex.regex' => 'رقم الموبيل يجب ان لا يحتوى على ارقام عربية ',
                        );
            $validator = Validator::make( $request->all(), $rules, $messages );

            if ($validator->fails()) {
                return response(['msg' => $validator->messages()->first(),'success'=>false, 'status' => 'failed']);
            }
            $res = $this->SendApiRequest('GET','/checkMobile/'.$request->mobile,null);
            if($res['status']=="success"){
                if($res['rowsCount'] > 0){
                    return response(['message' => 'رقم الهاتف مسجل من قبل','success'=>false, 'status' => 'success']);
                }
            }
            $verify_code    = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
            \Session::put('verify_code', $verify_code);
            return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
    }
    public function checkUsername(Request $request)
    {
        if ($request->ajax()) {


            //if (!preg_match("/^[a-zA-Z0-9]+$/", $request->userName)) {
            /*if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->userName)) {*/
            if (!preg_match("~^[a-zA-Z0-9-_'\s\p{Arabic}]{1,60}$~iu", $request->userName) && !preg_match("/^[a-zA-Z0-9]+$/", $request->userName)) {
                return response(['message' => 'إسم المستخدم يجب ان يكون حروف وارقام فقط','success'=>false, 'status' => 'success','name'=>$request->userName]);
            }

            $userName = $request->userName;
            if(mb_detect_encoding($userName) == 'UTF-8') {
                $userName = utf8_decode($userName);
            }
            if(strlen($userName) > 12 || strlen($userName) < 8){
                return response(['message' => 'إسم المستخدم يجب ان يكون من 8 الى 12 حرف','success'=>false, 'status' => 'success','count'=>strlen($request->userName)]);
            }

            $res = $this->SendApiRequest('GET','/checkUserName/'.$request->userName,null);
            if($res['status']=="success"){
                if($res['rowsCount'] > 0){
                    return response(['message' => 'إسم المستخدم مسجل من قبل','success'=>false, 'status' => 'success']);
                }
            }
            return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
    }
    public function checkMobile(Request $request)
    {
        if ($request->ajax()) {
            $res = $this->SendApiRequest('GET','/checkMobile/'.$request->login_mobile,null);
            if($res['status']=="success"){
                if($res['rowsCount'] > 0){
                    return response(['msg' => 'success','success'=>true, 'status' => 'success']);
                }
            }
            return response(['message' => 'رقم الهاتف غير مسجل ','success'=>false, 'status' => 'success']);
        }
    }
    public function getCities(Request $request)
    {
        if ($request->ajax()) {
            $res = $this->SendApiRequest('GET','/getCities/'.$request->country_id.'/',null);
            if($res['status']=="success"){
                $cities = $res['data'];
                return view("front.user.cities",compact('cities'));
            }
        }
    }

	public function RegisterLogin($mobile,$password)
    {
        $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):"-";
            /* if(!$country)
            {
                return false;
            } */
            $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';
            $data = [
                'form_params' => [
                    'mobile' => $mobile,
                    'password' => $password,
                    'detectedCountry' => $country,
                    'loginWay' => 'web',
                    'deviceToken' => $deviceToken,
                ]
            ];
            $res = $this->SendApiRequest('POST','/login',$data);
            if($res['status'] == "error"){
               return false;
            }

                \Session::put('token', $res['token']);
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
                return true;
    }

    public function Register(Request $request)
    {
        $rules = array(
            //'accept' => 'required',
            'userName' => 'required',
            //'email' => 'required|email',
            'password' => 'required|min:8|max:12|same:confirmation_password',
            'confirmation_password' => 'required',
            'aboutOther' => 'required|min:10|max:50',
            'aboutMe' => 'required|min:10|max:200',
            'job' => 'max:30',

        );
        $messages = array(
                        /* 'email.required' => ' البريد الالكترونى مطلوب ',
                        'email.email' => 'البريد الالكترونى غير صحيح', */
                        'userName.required' => 'إسم المستخدم مطلوب',
                        'password.required' => 'كلمة المرور مطلوبة',
                        'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف',
                        'password.max' => 'كلمة المرور يجب الا تزيد عن 12 حرف',
                        'password.same' => 'كلمة المرور غير متطابقة مع التاكيد',
                        'confirmation_password.required' => 'تاكيد كلمة المرور مطلوب',

                        'aboutOther.required' => 'مواصفات شريك الحياة مطلوبة',
                        'aboutOther.min' => 'مواصفات شريك الحياة يجب أن لا تقل عن 10 حرف',
                        'aboutOther.max' => 'مواصفات شريك الحياة يجب الا تزيد عن 50 حرف',
                        'aboutMe.required' => 'تحدث عن نفسك مطلوبة',
                        'aboutMe.min' => 'تحدث عن نفسك يجب أن لا تقل عن 10 حرف',
                        'aboutMe.max' => 'تحدث عن نفسك يجب الا تزيد عن 200 حرف',
                        'job.max' => 'الوظيفة يجب الا تزيد عن 30 حرف',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

    	if ($validator->fails()) {
            return response(['msg' => $validator->messages()->first(),'success'=>false, 'status' => 'failed']);
        }

        if ($request->ajax()) {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):"-";
            //if(!$country)
            //{
                //return response(['msg' => 'عفواً يجب السماح بالتعرف على موقعك للسماح بالدخول','success'=>false, 'status' => 'failed']);
                //return response(['msg' => 'success','success'=>true, 'status' => 'success']);
                //return back()->with('failed','عفواً يجب السماح بالتعرف على موقعك للسماح بالدخول');
            //}

            $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';

            $data['form_params']['detectedCountry']=$country;
            $data['form_params']['deviceToken']=$deviceToken;

            $res = $this->SendApiRequest('POST','/register',$data);

            if($res['status']=="success"){
				$this->RegisterLogin($request->mobile,$request->password);
                return response(['msg' => 'success','success'=>true, 'status' => 'success']);
            }
			elseif($res['status']=="error" && $res['errorCode']==2)
			{
				return response(['msg' => 'عفوا توجد كلمات غير مسموح بها في عن نفسي أو عن الطرف الآخر','success'=>false, 'status' => 'failed']);
			}
			else
            {
                return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى و تأكد من البيانات','success'=>false, 'status' => 'failed']);
            }


        }
    }


    public function profile()
    {
        //dd(\Session::get('user'));
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $user = \Session::get('user');
        return view('front.user.profile',compact('user'));
    }
    public function ChangePassword()
    {
        //dd(\Session::get('user'));
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $user = \Session::get('user');
        return view('front.user.change_password',compact('user'));
    }

    public function StorePassword(Request $request)
    {
        $rules = array(
            'password' => 'required|min:8|max:12|same:confirmation_password',
            'confirmation_password' => 'required',

        );
        $messages = array(
                        'password.required' => 'كلمة المرور مطلوبة',
                        'password.same' => 'كلمة المرور غير متطابقة مع التاكيد',
                        'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف',
                        'password.max' => 'كلمة المرور يجب الا تزيد عن 12 حرف',
                        'confirmation_password.required' => 'تاكيد كلمة المرور مطلوب',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

    	if ($validator->fails()) {
            return back()->with('failed',$validator->messages()->first());
        }

        $form_params = [
            'password' => $request->password,
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/updateMyPassword',$data);
        if($res['status']=="success"){
            return back()->with('message','تم تغيير كلمة المرور بنجاح');
        }

        return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');

    }


    public function ChangePhone()
    {
        //dd(\Session::get('user')['mobile']);
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $user = \Session::get('user');
        return view('front.user.change_phone',compact('user'));
    }

    public function StorePhone(Request $request)
    {
        $rules = array(
            'mobile' => 'required',

        );
        $messages = array(
                        'mobile.required' => 'رقم الهاتف مطلوب',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );

    	if ($validator->fails()) {
            return response(['msg' => $validator->messages()->first(),'success'=>false, 'status' => 'success']);
        }

        $form_params = [
            'mobile' => $request->mobile,
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/updateMyMobile',$data);
        if($res['status']=="success")
        {
            return response(['msg' =>'تم تغيير رقم الهاتف بنجاح','success'=>true, 'status' => 'success']);
        }

        return response(['msg' =>'حدث خطأ برجاء المحاولة مرة اخرى!','success'=>false, 'status' => 'success']);

    }

    public function SendSMSChangePhone(Request $request)
    {
        if ($request->ajax()) {
            $user_phone = \Session::get('user')['mobile'];
            $res = $this->SendApiRequest('GET','/checkMobile/'.$request->mobile,null);
            if($res['status']=="success"){
                if($res['rowsCount'] > 0 && $user_phone != $request->mobile){
                    return response(['message' => 'رقم الهاتف مسجل من قبل','success'=>false, 'status' => 'success']);
                }
            }
            $verify_code    = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
            \Session::put('change_phone_code', $verify_code);
            return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
    }

    public function logout(){
        \Session::forget('token');
        \Session::forget('user');
        \Session::forget('updates');
        \Session::forget('latestUsers');
        return redirect(url('/'))->with('message','تم تسجيل الخروج بنجاح');
    }
    public function DeleteAccount(){
        $this->SendApiRequest('POST','/terminateMyAccount',null);
        \Session::forget('token');
        \Session::forget('user');
        \Session::forget('updates');
        \Session::forget('latestUsers');
        session()->flush();
        return redirect(url('/'))->with('message','تم الغاء الحساب بنجاح');
    }


    public function CheckForgetPass(Request $request)
    {
        if ($request->ajax()) {
            $res = $this->SendApiRequest('GET','/checkMobile/'.$request->forget_mobile,null);
            if($res['status']=="success"){
                if($res['rowsCount'] == 0){
                    return response(['message' => 'رقم الهاتف غير مسجل لدينا','success'=>false, 'status' => 'success']);
                }
            }
            $verify_code    = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
            \Session::put('forget_verify_code', $verify_code);
            return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
    }
    public function ChangeStatus(Request $request)
    {
        if ($request->ajax()) {
			$status = (int) $request->status;
            $data = [
                'form_params' => []
            ];
            $data['form_params']['status']=$status;
            $res = $this->SendApiRequest('POST','/changeMyStatus',$data);
            if($res['status']=="success"){
                if($res['rowsCount'] == 1){
                    \Session::put('user.available', $status);
                    return response(['message' => 'تم تغيير الحالة بنجاح','success'=>true, 'status' => 'success']);
                }
            }
            return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى!','success'=>false, 'status' => 'success']);
        }
        else
        {
			$status = (int) $request->status;
            $data = [
                'form_params' => []
            ];
            $data['form_params']['status']=$status;
            $res = $this->SendApiRequest('POST','/changeMyStatus',$data);
            if($res['status']=="success"){
                if($res['rowsCount'] == 1){
                    \Session::put('user.available', $status);
                    return back()->with('success','تم تغيير الحالة بنجاح');
                }
            }
            return back()->with('success','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
    }

    public function uploadPhoto(Request $request)
    {
        $file               = $request->file('attachment') ;//request('attachment');
        $file_path          = $file->getPathname();
        $file_mime          = $file->getMimeType('image');
        $file_uploaded_name = $file->getClientOriginalName();
        $response = array();
        $name = time() . '_' . $file->getClientOriginalName();
        $path = base_path() .'/public/uploads/';
        $resource = fopen($file,"r");
        $file->move($path, $name);
        $fileinfo = array(
            'name'          =>  $name,
            'clientNumber'  =>  "102425",
            'type'          =>  'Writeoff',
        );
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
        $res = $this->SendApiRequest('POST','/uploadMyPhoto',$data);
        if($res && $res['status'] == "success"){

            //\Session::put('user.profileImage', $res['fileName']);
            return back()->with('success','صورتك بانتظار الموافقة');
        }
        return back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
    }


    public function detectedCountry(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBkgu7k3juP6jiYhKxRLgrAalnTu8sGayA&latlng='.trim($lat).','.trim($lng).'&sensor=false&language=ar';
        $result = file_get_contents($url);
        $output= json_decode($result);
        for($j=0;$j<count($output->results[0]->address_components);$j++){

            $cn=array($output->results[0]->address_components[$j]->types[0]);

            if(in_array("country", $cn)){
                $country= $output->results[0]->address_components[$j]->long_name;
                \Session::put('detectedCountry', $country);
            }
        }

        $google_time = file_get_contents("https://maps.googleapis.com/maps/api/timezone/json?location=".trim($lat).",".trim($lng)."&timestamp=1331161200&key=AIzaSyBkgu7k3juP6jiYhKxRLgrAalnTu8sGayA");
        $timez = json_decode($google_time);
        if($timez->status == "OK")
        {
            \Session::put('timeZone', $timez->timeZoneId); //$timez->timeZoneId
        }
        return true;
    }

    public function SendToken(Request $request)
    {
        \Session::put('deviceToken', $request->token);
        return true;
    }



    public function requestChangePassword(Request $request)
    {

            $data = [
                'form_params' => [
                    'userName' => $request->forget_username
                ]
            ];
            $res = $this->SendApiRequest('POST','/requestChangePassword',$data);
            if($res['status'] == "error"){
                return back()->with('failed','إسم المستخدم غير صحيح');
            }
            \Session::put('forget_user_name', $request->forget_username);
            return redirect(url('/user/change/password'))->with('message','تم إرسال بريد الكترونى لتغيير كلمة المرور');
            //return back()->with('message','تم إرسال بريد الكترونى لتغيير كلمة المرور');

    }



    public function ForgetChangePassword(Request $request)
    {

            return view('front.user.forget_change_password');
            //return back()->with('message','تم إرسال بريد الكترونى لتغيير كلمة المرور');

    }


    public function ForgetRequestChangePassword(Request $request)
    {

            $rules = array(
                //'accept' => 'required',
                'tempPassword' => 'required',
                'password' => 'required|min:8|max:12|same:confirmation_password',
                'confirmation_password' => 'required',

            );
            $messages = array(

                            'tempPassword.required' => 'كود تأكيد كلمة المرور مطلوب',
                            'password.required' => 'كلمة المرور مطلوبة',
                            'password.min' => 'كلمة المرور يجب الا تقل عن 8 احرف',
                            'password.max' => 'كلمة المرور يجب الا تزيد عن 12 حرف',
                            'password.same' => 'كلمة المرور غير متطابقة مع التاكيد',
                            'confirmation_password.required' => 'تاكيد كلمة المرور مطلوب',
                            //'accept.required' => 'الموافقة على الشروط والاحكام مطلوبة',
                        );
            $validator = Validator::make( $request->all(), $rules, $messages );

            if ($validator->fails()) {
                //return response(['msg' => $validator->messages()->first(),'success'=>false, 'status' => 'failed']);
                return back()->with('failed',$validator->messages()->first());
            }

            $forget_user_name = (\Session::get('forget_user_name'))?\Session::get('forget_user_name'):'';
            $data = [
                'form_params' => [
                    'password' => $request->password,
                    'tempPassword' => $request->tempPassword,
                    'userName' => $forget_user_name,
                ]
            ];
            $res = $this->SendApiRequest('POST','/changePasswordNew',$data);
            if($res['status'] == "error"){
                return back()->with('failed','حدث خطأ برجاء التأكد من البيانات');
            }
            \Session::put('forget_user_name', $request->forget_username);
            return redirect(url('/'))->with('message','تم تغيير كلمة المرور بنجاح');

    }

	public function deleteMyProfileImage(Request $request)
    {

            $data = [
                'form_params' => [
                    'userName' => $request->forget_username
                ]
            ];
            $res = $this->SendApiRequest('POST','/deleteMyProfileImage',null);
            if($res['status'] == "error"){
                return back()->with('failed','حدث خطأ برجاء التأكد من البيانات');
            }
            \Session::put('forget_user_name', $request->forget_username);
			\Session::put('user.profileImage', null);
             return redirect(url('/'))->with('message','تم حذف الصورة بنجاح');
            //return back()->with('message','تم إرسال بريد الكترونى لتغيير كلمة المرور');

    }



}
