<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Messages\EditRequest;
use App\Http\Requests\Admin\Messages\StoreRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "messages";
        $this->view = 'messages';
        $view = 'messages';
        $route = 'messages';
        $OtherRoute = 'message';
        $reasons = array(
            0   => 'سؤال ',
            1   => 'شكوى',
            2   => 'اقتراح',
        );
        view()->share(compact('view','route','OtherRoute','reasons'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 0 ;
        if(request()->page){
            $page = request()->page;
        }
        if(request()->userId)
        {
            $userId = request()->userId;
            $url = "/getByField/$this->model/userId/$userId/$page";
            $res = $this->SendAdminRequest('GET',$url,null);
        }
        else 
        {
			$q = "";
			if(request()->q)
			{
				$q = request()->q;
				
			}
			$res = $this->SendAdminRequest('GET',"/listMessages2/$page/$q",null);
            
        }
        
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        //dd($res);
        $collection = $res['data'];
        $next_page = null;
        $prev_page = null;
        if($res['rowsCount'] == 40){
            $next_page = $page + 1;
            $prev_page = $page - 1;
        } 
        return view("admin.$this->view.index",compact('collection','next_page','page','prev_page'));

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$type = null;
		if(request()->message == "all")
		{
			$type = "all";
		}
		$create= true;
		return view("admin.$this->view.create",compact('create','type'));	
		
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        $request->rules();

		if($request->userId)
		{
			$message = "تم إرسال رسالة لك من زفاف";
			$this->SendMessageNotification($request,$message);	
		}
		
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
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['adminImage' => $fileName]);
            }
            
        }
		
		if($request->type == "all")
		{
			$parms = $request->all();
			$data = [
				'form_params' => []
			];
			foreach($parms as $key=>$value){
				if( ( $key=="userId" && $value >0 ) || ($key !="_token" && $key!="userId" && $key!= "type" && $key!= "other_message") )
				{
					$data['form_params'][$key]=$value;
				}
			}
			if(isset($request->other_message))
			{
				$data['form_params']["message"].=	$request->other_message;
			}
			$response = $this->SendAdminRequest('POST','/sendGeneralMessage',$data);
			//$response = $this->FormatAdminRequest($request->all(),null,'sendGeneralMessage');
		}
		else
		{
		$response = $this->FormatAdminRequest($request->all(),$this->model,'add');	
		}
        
        if(!$response)
        {
            return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('status' , __('admin.created') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //$row = $this->model->find($id);
        $show = "disabled";
        $res = $this->SendAdminRequest('GET','/getById/'.$this->model.'/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        $userId = $row['userId'];
        $res = $this->SendAdminRequest('GET',"/getById/users/$userId",null);
        $user = null;
        if(isset($res) && $res['data']){
            if($res['status'] == 'success')
            {
                $user = $res['data'];
            }
        }
        return view("admin.$this->view.show",compact('row','show','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$row = $this->model->find($id);
        $res = $this->SendAdminRequest('GET','/getById/'.$this->model.'/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $request_form = [
            "readed" => 1
        ];
        $this->FormatAdminRequest($request_form,$this->model,'update',$id);

        $row = $res['data'][0];
        $userId = $row['userId'];
        $res = $this->SendAdminRequest('GET',"/getById/users/$userId",null);
        $user = null;
        if(isset($res) && $res['data']){
            if($res['status'] == 'success')
            {
                $user = $res['data'][0];
            }
        }
        $otherUser = null;
        if($row['reasonId']==1)
        {
            $otherId = $row['otherId'];
            $res = $this->SendAdminRequest('GET',"/getById/users/$otherId",null);
            if(isset($res) && $res['data']){
                if($res['status'] == 'success')
                {
                    $otherUser = $res['data'][0];
                }
            }
        }
        $type = null;
		if(request()->message == "all")
		{
			$type = "all";
		}
        return view("admin.$this->view.edit",compact('row','user','otherUser','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        //$request->persist($id);
        $request->rules($id);
        $message = "تم إرسال رداً على رسالتك من زفاف";
        $this->SendMessageNotification($request,$message);
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
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['adminImage' => $fileName]);
            }
            
        }
        $response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
        if(!$response)
        {
            return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('status' , __('admin.updated') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $response = $this->FormatAdminRequest($request->all(),$this->model,'delete',$id);
            if(!$response)
            {
                //return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
                return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى!', 'status' => 'error']);
            }
            return response(['msg' => 'deleted', 'status' => 'success']);
            
        }
    }

    /**
     * ban the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ban(Request $request, $id)
    {
        if ($request->ajax()) {
            $response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
            if(!$response)
            {
                //return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
                return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى!', 'status' => 'error']);
            }
            return response(['msg' => 'deleted', 'status' => 'success']);
            
        }
    }
    /**
     * activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $id)
    {
        if ($request->ajax()) {
            $response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
            if(!$response)
            {
                return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى!', 'status' => 'error']);
            }
            return response(['msg' => 'deleted', 'status' => 'success']);
            
        }
    }
    public function hideMessage($id)
    {
        $request = new \Illuminate\Http\Request();

        $request->replace(['active' => 0]);

        $response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
        if(!$response)
        {
            return redirect()->back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , __('admin.updated') );
            
    }
    public function hideAll()
    {
        $response = $this->SendAdminRequest('GET','/readAllMessages',null);
        if(!$response)
        {
            return redirect()->back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , __('admin.updated') );
            
    }

    public function showAll()
    {
        $response = $this->SendAdminRequest('GET','/unReadAllMessages',null);
        if(!$response)
        {
            return redirect()->back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , __('admin.updated') );
            
    }


    public function SendMessageNotification($request,$message)
    {
        $data = [
            'form_params' => [
                "userId" => $request->userId,
                "title" => "رسالة لك من زفاف",
                "message" => $message,
                "type" => 12
            ]
        ];
        $this->SendAdminRequest('POST','/adminNotification',$data);
    }



}
