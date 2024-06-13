<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StoriesController extends Controller
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
        $res = $this->SendApiRequest('GET','/getSuccessStories/0',null);
        $stories = $res['data'];
        return view('front.stories.index',compact('stories'));
    }

    public function details($id)
    {
        $res = $this->SendApiRequest('GET',"/getStoryDetails/$id",null);
        $row = $res['data'];
        return view('front.stories.details',compact('row'));
    }

    public function LoadMore(Request $request)
    {
        if (request()->ajax()) {
            $page = request()->page?request()->page:0;
            $res = $this->SendApiRequest('GET',"/getSuccessStories/$page",null);
            $stories = $res['data'];
            return view('front.stories.load_more',compact('stories','page'));
        }
    }


    public function create()
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        return view('front.stories.create');
    }


    public function store(Request $request)
    {
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
        
        $rules = array(
            'otherUserName' => 'required',
            'story' => 'required',
        );    
        $messages = array(
                        'otherUserName.required' => 'الاسم مطلوب',
                        'story.required' => 'القصة مطلوبة',
                    );
        $validator = Validator::make( $request->all(), $rules, $messages );
   
    	if ($validator->fails()) {
            return back()->with('failed',$validator->messages()->first());
        }


        $parms = $request->all();
            $data = [
                'form_params' => []
            ];
        foreach($parms as $key=>$value){
            if($key !="_token")
            {
                $data['form_params'][$key]=$value;
            }
        }

        $res = $this->SendApiRequest('POST','/addSuccessStory',$data);
        if($res['status'] == "error")
        {
            if($res['errorCode'] == "user not exists")
            {
                return back()->with('failed','الاسم غير موجود');
            }
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        }
        return redirect(url('/sucsses/stories'))->with('message','تم اضافة قصتك بنجاح');
    }

}
