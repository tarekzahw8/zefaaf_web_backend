<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supervisors\EditRequest;
use App\Http\Requests\Admin\Supervisors\StoreRequest;
use Illuminate\Http\Request;

class SupervisorsController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "admins";
        $this->view = 'admins';
        $view = 'admins';
        $route = 'admins';
        $OtherRoute = 'user';
        view()->share(compact('view','route','OtherRoute'));
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
        
        $res = $this->SendAdminRequest('GET',"/get/$this->model/$page/desc",null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
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
        return view("admin.$this->view.create");
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
        $moduleId = $request->moduleId;
        $privileges = array();
        //for($i=0;$i<count($moduleId);$i++)
        foreach($moduleId as $key=>$value)
        {
            $moduleWrite = isset($request->moduleWrite) && isset($request->moduleWrite[$value]) ? $request->moduleWrite[$value] : 0;
            $moduleRead = isset($request->moduleRead) && isset($request->moduleRead[$value]) ? $request->moduleRead[$value] : 0;
            $moduleDelete = isset($request->moduleDelete) && isset($request->moduleDelete[$value]) ? $request->moduleDelete[$value] : 0;
            $privilege = array(
                "moduleId"  =>$value,
                "read"      =>$moduleRead,
                "write"     =>$moduleWrite,
                "delete"    =>$moduleDelete
            );
            array_push($privileges,$privilege);
            
        }
        $json = json_encode($privileges);
        
        $form_params = [];
        $parms = $request->all();
        foreach($parms as $key=>$value){
            if($key !="_token" && $key!="_method" && $key!="id" && $key!="moduleId" && $key!="moduleWrite" && $key!="moduleRead" && $key!="moduleDelete")
            {
                if(($key !="password") || ($key =="password" && $value!=""))
                {
                    if($key =="password" && $value!="") $value=md5($value);
                    $form_params[$key]=$value;
                }
                
                
            }
        }
        $form_params['privileges'] = $json;
        $data = [
            'form_params' => $form_params
        ];
        $call_url = '/addAdminUser';
        $response = $this->SendAdminRequest('POST',$call_url,$data);

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
        $res = $this->SendAdminRequest('GET','/getAdminUser/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        $admin_privlages = $res['privlages'];
        
        return view("admin.$this->view.show",compact('row','show','admin_privlages'));
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
        $res = $this->SendAdminRequest('GET','/getAdminUser/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        $admin_privlages = $res['privlages'];
        
        return view("admin.$this->view.edit",compact('row','admin_privlages'));
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
        $moduleId = $request->moduleId;
        $privileges = array();
        //for($i=0;$i<count($moduleId);$i++)
        foreach($moduleId as $key=>$value)
        {
            $moduleWrite = isset($request->moduleWrite) && isset($request->moduleWrite[$value]) ? $request->moduleWrite[$value] : 0;
            $moduleRead = isset($request->moduleRead) && isset($request->moduleRead[$value]) ? $request->moduleRead[$value] : 0;
            $moduleDelete = isset($request->moduleDelete) && isset($request->moduleDelete[$value]) ? $request->moduleDelete[$value] : 0;
            $privilege = array(
                "moduleId"  =>$value,
                "read"      =>$moduleRead,
                "write"     =>$moduleWrite,
                "delete"    =>$moduleDelete
            );
            array_push($privileges,$privilege);
            
        }
        $json = json_encode($privileges);
        
        $form_params = [];
        $parms = $request->all();
        foreach($parms as $key=>$value){
            if($key !="_token" && $key!="_method" && $key!="id" && $key!="moduleId" && $key!="moduleWrite" && $key!="moduleRead" && $key!="moduleDelete")
            {
                if(($key !="password") || ($key =="password" && $value!=""))
                {
                    if($key =="password" && $value!="") $value=md5($value);
                    $form_params[$key]=$value;
                }
                
                
            }
        }
        $form_params['privileges'] = $json;
        $form_params['id'] = $id;
        $data = [
            'form_params' => $form_params
        ];
        $call_url = '/updateAdminUser';
        $response = $this->SendAdminRequest('POST',$call_url,$data);
        //$response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
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




}
