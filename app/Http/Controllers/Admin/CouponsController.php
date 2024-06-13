<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Agent\EditRequest;
use App\Http\Requests\Admin\Agent\StoreRequest;
use Illuminate\Http\Request;

class CouponsController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "blogCats";
        $this->view = 'coupons';
        $view = 'coupons';
        $route = 'coupons';
        $OtherRoute = 'coupon';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SearchUser(Request $request)
    {
        if ($request->ajax()) {
            
            $search = $request->search;
            $type = $request->type;
            $res = $this->SendAgentRequest('GET',"/getUsers/$search",null);
            $users = null;
            if(isset($res) && $res['data']){
                $users = $res['data'];
            }
            return view("admin.coupons.load_users",compact('users','type'));
        }
    }
    public function assign(Request $request)
    {
        $parms = $request->all();
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
            if( ( $key=="userId" && $value >0 ) || ($key !="_token" && $key!="userId") )
            {
                $data['form_params'][$key]=$value;
            }
        }
        $response = $this->SendAgentRequest('POST','/assignCopoun',$data);
        //dd($response);
        if($response['status'] == "error")
        {
            return redirect()->back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , 'تم التخصيص بنجاح');
    }
    public function AgentIndex()
    {
        $collection = null;
        $gentId = \Session::get('agent')['id'];
        $page = 0 ;
        if(request()->page){
            $page = request()->page;
        }
        if(request()->status && request()->status!="" && request()->status!=null){
            $status = request()->status == 3 ? 0 : request()->status;
            $res = $this->SendAgentRequest('GET','/listCopouns/'.$status.'/'.$page.'/'.$gentId,null);
            if($res['status'] == 'false')
            {
                return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
            }
            $collection = $res['data'];
        }
        
        
        $next_page = null;
        $prev_page = null;
        if(isset($res) && $res['rowsCount'] == 40){
            $next_page = $page + 1;
            $prev_page = $page - 1;
        } 
        if($page && $page > 0)
        {
            $prev_page = $page - 1;
        }
        return view("admin.$this->view.agent_index",compact('collection','next_page','page','prev_page'));
    } 

    public function index()
    {
        $ress = $this->SendAdminRequest('GET','/listAgents',null);
        $collection = null;
        $agents = null;
        $page = 0 ;
        if(request()->page){
            $page = request()->page;
        }
        if(isset($ress) && $ress['data']){
            $agents = $ress['data'];
        }
        if(request()->agentId && request()->agentId!="" && request()->status && request()->status!="" && request()->status!=null){
            $gentId = request()->agentId;
            $status = request()->status == 3 ? 0 : request()->status;
            $res = $this->SendAdminRequest('GET','/listCopouns/'.$status.'/'.$page.'/'.$gentId,null);
            if($res['status'] == 'false')
            {
                return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
            }
            $collection = $res['data'];
        }
        $next_page = null;
        $prev_page = null;
        if(isset($res) && $res['rowsCount'] == 40){
            $next_page = $page + 1;
            $prev_page = $page - 1;
        } 
        if($page && $page > 0)
        {
            $prev_page = $page - 1;
        }
        return view("admin.$this->view.index",compact('agents','collection','next_page','page','prev_page'));

    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $res = $this->SendAdminRequest('GET','/get/countries/-1/desc',null);
        $countries = null;
        if(isset($res) && $res['data']){
            $countries = $res['data'];
        }
        return view("admin.$this->view.create",compact('countries'));
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
            
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['imageFile' => $fileName]);
            }
            //session()->forget('token');
        }
        $parms = $request->except(['password_confirmation','file']);
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
            if( ( $key=="userId" && $value >0 ) || ($key !="_token" && $key!="userId") )
            {
                if($key =="password" && $value!="") $value=md5($value);
                
                $data['form_params'][$key]=$value;
            }
        }
        
        $response = $this->SendAdminRequest('POST','/addAgent',$data);
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
        $res = $this->SendAdminRequest('GET','/getAgentDetails/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];

        $res = $this->SendAdminRequest('GET','/get/countries/-1/desc',null);
        $countries = null;
        if(isset($res) && $res['data']){
            $countries = $res['data'];
        }
        return view("admin.$this->view.show",compact('row','show','countries'));
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
        $res = $this->SendAdminRequest('GET','/getAgentDetails/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];

        $res = $this->SendAdminRequest('GET','/get/countries/-1/desc',null);
        $countries = null;
        if(isset($res) && $res['data']){
            $countries = $res['data'];
        }

        return view("admin.$this->view.edit",compact('row','countries'));
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
            
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['imageFile' => $fileName]);
            }
            //session()->forget('token');
        }
        $parms = $request->except(['password_confirmation','file']);
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
            if( ( $key=="userId" && $value >0 ) || ($key !="_token" && $key!="userId") )
            {
                if($key =="password" && $value!="") $value=md5($value);

                $data['form_params'][$key]=$value;
            }
        }
        $response = $this->SendAdminRequest('POST','/updateAgent',$data);
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
		//dd($id,$request->all());
        if ($request->ajax()) {
            $res = $this->SendAdminRequest('GET','/deleteCopoun/'.$id,null);
            if($res['status'] == 'false')
            {
                return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
            }
            return response(['msg' => 'deleted', 'status' => 'success']);
            
        }
    }
	
	public function deleteAllCopouns(Request $request)
    {
			$agentId = $request->agentId;
			$res = $this->SendAdminRequest('GET','/deleteAllCopouns/'.$agentId,null);
			
            if($res['status'] == 'success')
            {
                return redirect()->back()->with('status' , "تم الحذف بنجاح" );
            }
			else
			{
				return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
			}
            
    }

}
