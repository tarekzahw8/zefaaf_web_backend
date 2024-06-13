<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Redirect;

class ChatController extends Controller
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
                \Session::put('token', $res['token']);
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            }
        $res = $this->SendApiRequest('GET','/getMyChatsList',null);
        $collection = $res['data'];
		
        return view('front.chat.index',compact('collection'));
    }
    public function details($id)
    {
        $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
        if(!\Session::get('token'))
        {
            return back()->with('failed','يجب تسجيل الدخول أولاً');
        }
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
                \Session::put('token', $res['token']);
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            }
       
            $form_params = [
                'otherId' => $id,        
            ];
            $data['form_params'] = $form_params;
            //dd($res);
            $res = $this->SendApiRequest('POST','/openChat',$data);
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return back()->with('failed','عفواً! لا يسمح لك بمراسلة هذا العضو');    
                }
				if(isset($res['errorCode']) && $res['errorCode'] == "package4"){
                    return back()->with('failed_message','هذه الخدمة لأصحاب الباقة الذهبية');    
                }
				if(isset($res['errorCode']) && $res['errorCode'] == "package5"){
                    return back()->with('failed_message','هذه الخدمة لأصحاب الباقة البلاتينية');    
                }
				if(isset($res['errorCode']) && $res['errorCode'] == "free package"){
                    return back()->with('failed_message','هذه الخدمة لأصحاب الباقة الفضية');    
                }
                return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
            }
            
            $user = null;
            if(isset($res['otherDetails']) && isset($res['otherDetails'][0])) $user = $res['otherDetails'][0];
            $collection = $res['data'];
            
            $chatId = isset($res['chatId'])?$res['chatId']:0;
            $collection = array_reverse($collection, true);
    
            $res = $this->SendApiRequest('GET','/getStickers',null);
            $stickers = null;$zefaafStickers = null;$stickersDir = null;$zefaafStickersDir = null;
            if($res['status']=="success"){
                $stickers = $res['stickers'];
                $zefaafStickers = $res['zefaafStickers'];
                $stickersDir = $res['stickersDir'];
                $zefaafStickersDir = $res['zefaafStickersDir'];
            }
            return view('front.chat.details',compact('collection','user','chatId','stickers','zefaafStickers','stickersDir','zefaafStickersDir'));
        
        
    }


    public function LoadMore()
    {
        $page = request()->page;
        $chatid = request()->chatid;
        $res = $this->SendApiRequest('GET',"/getMorechatMessages/$chatid/$page",null);
        $collection = $res['data'];
        $collection = array_reverse($collection, true);
        return view('front.chat.load_more_messages',compact('collection'));
    }

    public function HideChat()
    {
        
        $chatId = request()->chatId;
        $data = [
            'form_params' => []
        ];
        $data['form_params']['chatId']  = $chatId;
        $res = $this->SendApiRequest('POST',"/hideChat",null);
        if($res['status']=="success"){
            return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
        return response(['msg' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
    }

    public function HideChatGet($id)
    {
        
        $chatId = $id;
        $data = [
            'form_params' => []
        ];
        $data['form_params']['chatId']  = (int)$chatId;
        $res = $this->SendApiRequest('POST',"/hideChat",$data);
        
        if($res['status']=="success"){
            return redirect(url('/chats'))->with('message','تم اخفاء المحادثة بنجاح');
            //return response(['msg' => 'success','success'=>true, 'status' => 'success']);
        }
        return redirect()->back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        //return response(['msg' => '','success'=>false, 'status' => 'failed']);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $chat_message   = $request->chat_message;
            if($request->type == 2) // chat image
            {
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
                    
                    $res = $this->SendApiRequest('POST','/uploadMyPhoto',$data);
                    $fileName = null;
                    if($res['status'] == "success"){
                        $fileName = $res['fileName']; 
                        $chat_message   = $fileName;
                    }
                }
            }

            
            $chatId         = $request->chatId;
            $type           = $request->type;

            $data = [
                'form_params' => []
            ];
            $data['form_params']['message'] = $chat_message;
            $data['form_params']['chatId']  = $chatId;
            $data['form_params']['type']    = $type;
            $data['form_params']['voiceTime']    = $request->voiceTime?$request->voiceTime:1;
            $res = $this->SendApiRequest('POST','/sendChatMessage',$data);
            if($res['status']=="success"){
                $mytime = \Carbon\Carbon::now();
                return response(['message' => 'success',"chat_message"=>$chat_message,'success'=>true, 'status' => 'success',"time"=>$mytime,'messageId'=>$res['messageId']]);
            }
            if($res['status']!="success"){
                if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                    return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);
                }
            }
            return response(['message' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
        }
    }


    public function storeAudioOLD(Request $request)
    {
        if ($request->ajax()) {
            
            $base64File = $request->base64;
            $name = time() . '.mp3';
            \Storage::disk('public')->put($name,base64_decode($base64File)); 
            $fileName = "/app/public/$name";
            $path = storage_path();
            $data = [
                'multipart' => [
                    [
                        'name'     => 'attachment',
                        'contents' => fopen($path . $fileName, 'r'),
                        'headers'  => ['Content-Type' => 'multipart/form-data']
                    ],
                ],
            ];
            
            $res = $this->SendApiRequest('POST','/uploadSoundFile',$data);
            
            $filePath = null;
            if($res['status'] == "success"){
                $filePath = $res['filePath']; 
                $chat_message   = $filePath;
                $chatId         = $request->chatId;
                $type           = $request->type;

                $data = [
                    'form_params' => []
                ];
                $data['form_params']['filePath'] = $chat_message;
                $data['form_params']['chatId']  = $chatId;
                $data['form_params']['type']    = 3;
                $data['form_params']['voiceTime']    = $request->voiceTime?$request->voiceTime:1;
                $res = $this->SendApiRequest('POST','/sendChatMessage',$data);
                if($res['status']=="success"){
                    $mytime = \Carbon\Carbon::now();
                    return response(['message' => 'success',"chat_message"=>$chat_message,'success'=>true, 'status' => 'success',"time"=>$mytime,'messageId'=>$res['messageId']]);
                }
                if($res['status']!="success"){
                    if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                        return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);
                    }
                }
                return response(['message' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
            }
            elseif($res['status']=="error")
            {
                if($res['errorCode']=="file size is empty or too small") 
                {
                    return response(['message' => 'توجد مشكلة في التسجيل','success'=>false, 'status' => 'failed']);
                }
            }
            return response(['message' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
        }
    }


    public function storeAudio(Request $request)
    {
        if ($request->ajax()) {
            
            $file               = $request->file('data') ;//request('attachment');
            $name               = time() . '.wav';
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
            // $token = \Session::get('admin_token');
            // \Session::put('token', $token);
            //$data['form_params']['attachment']=$request->attachment;
            $res = $this->SendApiRequest('POST','/uploadSoundFile',$data);
            $filePath = null;
            if($res['status'] == "success"){
                $filePath = $res['filePath']; 
                $chat_message   = $filePath;
                $chatId         = $request->chatId;
                $type           = $request->type;

                $data = [
                    'form_params' => []
                ];
                $data['form_params']['filePath'] = $chat_message;
                $data['form_params']['chatId']  = $chatId;
                $data['form_params']['type']    = 3;
                $data['form_params']['voiceTime']    = $request->voiceTime?$request->voiceTime:1;
                $res = $this->SendApiRequest('POST','/sendChatMessage',$data);
                if($res['status']=="success"){
                    $mytime = \Carbon\Carbon::now();
                    return response(['message' => 'success',"chat_message"=>$chat_message,'success'=>true, 'status' => 'success',"time"=>$mytime,'messageId'=>$res['messageId']]);
                }
                if($res['status']!="success"){
                    if(isset($res['errorCode']) && $res['errorCode'] == "ignore list"){
                        return response(['message' => 'عفواً! لا يسمح لك بمراسلة هذا العضو','success'=>false, 'status' => 'failed']);
                    }
                }
                return response(['message' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
            }
            elseif($res['status']=="error")
            {
                if($res['errorCode']=="file size is empty or too small") 
                {
                    return response(['message' => 'توجد مشكلة في التسجيل','success'=>false, 'status' => 'failed']);
                }
            }
            return response(['message' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
        }
    }
	
	
	public function hideAllChats(Request $request)
    {
        if(!\Session::get('token'))
        {
            return redirect()->to(url('/chats'))->with('failed','يجب تسجيل الدخول أولاً');
        }
        $data = [
			'form_params' => []
        ];
        
		$res = $this->SendApiRequest('POST','/hideAllChats',$data);
		
        return  redirect()->to(url('/chats'))->with('message', "تم الحذف بنجاح");
    }
	
	public function DeleteChatMessage(Request $request)
    {
        if(!\Session::get('token'))
        {
            return redirect()->to(url('/chats'))->with('failed','يجب تسجيل الدخول أولاً');
        }
        $data = [
			'form_params' => []
        ];
        $data['form_params']['id'] = $request->id;
		$res = $this->SendApiRequest('POST','/deleteChatMessage',$data);
		
        if($res['status']=="success"){
            return response(['msg' => 'تم حذف الرسالة بنجاح','success'=>true, 'status' => 'success']);
        }
        return response(['msg' => 'خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة','success'=>false, 'status' => 'failed']);
    }
	
	
	public function SendHideChat(Request $request)
    {
        if(!\Session::get('token'))
        {
            return redirect()->to(url('/chats'))->with('failed','يجب تسجيل الدخول أولاً');
        }
        $chatId = request()->chatId;
        $data = [
            'form_params' => []
        ];
        $data['form_params']['chatId']  = (int)$chatId;
		
		$res = $this->SendApiRequest('POST',"/hideChat",$data);
		
        return  redirect()->to(url('/chats'))->with('message', "تم الحذف بنجاح");
    }
    
    

}
