<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
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
        //\Session::get('user')['available'] = 1;
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        $res = $this->SendApiRequest('GET','/getMyNotifications/-/0/0',null);
        $list = $res['data'];
        $id0 = 0;$id1 = 1;$id2 = 2;$id3 = 3;$id4 = 4;$id5 = 5;
        $countNotify = array();
        $countNotify[0] = count(array_filter($list, function($var) use ($id0) {
            return $id0 === $var['notiType'];
        }));
        $countNotify[1] = count(array_filter($list, function($var) use ($id1) {
            return $id1 === $var['notiType'];
        }));
        $countNotify[2] = count(array_filter($list, function($var) use ($id2) {
            return $id2 === $var['notiType'];
        }));
        $countNotify[3] = count(array_filter($list, function($var) use ($id3) {
            return $id3 === $var['notiType'];
        }));
        $countNotify[4] = count(array_filter($list, function($var) use ($id4) {
            return $id4 === $var['notiType'];
        }));
        $countNotify[5] = count(array_filter($list, function($var) use ($id5) {
            return $id5 === $var['notiType'];
        }));
        
        return view('front.notifications.index',compact('list','countNotify'));
    }


    public function LoadMore(Request $request)
    {
        if (request()->ajax()) {
            $page = request()->page?request()->page:0;
            $cat = request()->cat?request()->cat:1;
            $cat = $cat < 0 ? '-': $cat;
            $res = $this->SendApiRequest('GET',"/getMyNotifications/$cat/$page/0",null);
            $list = $res['data'];
            return view('front.notifications.load_more',compact('list','page','cat'));
        }
    }
    public function replyPhoto(Request $request)
    {
            $form_params = [
                'statues'  => $request->status ,        
                'otherId'  => $request->otherId ,        
                 
            ];
            $data['form_params'] = $form_params;
            $res = $this->SendApiRequest('POST',"/replyPhoto",$data);
            if($res['status']=="success"){
                $message = " تمت الموافقة على عرض صورتك الشخصية ";
                if($request->status ==5) $message = " تم رفض عرض الصورة بنجاح ";
                return back()->with('message',$message);
            }
    
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
    }
    

}
