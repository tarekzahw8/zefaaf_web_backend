<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\EditRequest;
use App\Http\Requests\Admin\Posts\StoreRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "blog";
        $this->view = 'posts';
        $view = 'posts';
        $route = 'posts';
        $OtherRoute = 'post';
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
        if(request()->field && request()->q)
        {
            $page = 0 ;
            $field = request()->field;
            $q = request()->q;
            $url = "/getByLikeField/$this->model/$field/$q";
            $res = $this->SendAdminRequest('GET',$url,null);

        }
        elseif(!request()->field && !request()->q && request()->cat_id)
        {
            $cat_id = request()->cat_id;
            $url = "/getByField/$this->model/catId/$cat_id/$page";
            $res = $this->SendAdminRequest('GET',$url,null);
        }
        else 
        {
            $res = $this->SendAdminRequest('GET',"/get/$this->model/$page/desc",null);
        }
        
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

    public function search( Request $request )
    {
        $query =  $request->q;
        
        if ( $query == "") {
            return redirect()->back();
        }else{

            

             $collection   = $this->model->where([['title_ar', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere([['title_en', 'LIKE', '%' . $query. '%']] )
                                     ->orWhere('desc_ar','LIKE','%'.$query.'%')
                                     ->orWhere('desc_en','LIKE','%'.$query.'%')
                                     ->orWhere('duration','LIKE','%'.$query.'%')
                                     ->orWhere('cost','LIKE','%'.$query.'%')

                                     ->latest()->paginate(10);
            $collection->appends( ['q' => $request->q] );

            if (count ( $collection ) > 0){
                return view("admin.$this->view.index",[ 'collection' => $collection ])->withQuery($query);
            }else{
                return view("admin.$this->view.index",[ 'collection'=>null ,'message' => __('admin.no_result') ]);
            }
            //dd($users);
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $res = $this->SendAdminRequest('GET','/get/blogCats/0/desc',null);
        $cats = null;
        if(isset($res) && $res['data']){
            $cats = $res['data'];
        }
        return view("admin.$this->view.create",compact('cats'));
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
            // $token = \Session::get('admin_token');
            // \Session::put('token', $token);
            //$data['form_params']['attachment']=$request->attachment;
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['featureImage' => $fileName]);
            }
            //session()->forget('token');
        }
        
        $response = $this->FormatAdminRequest($request->all(),$this->model,'add');
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
        $res = $this->SendAdminRequest('GET','/get/blogCats/0/desc',null);
        $cats = null;
        if(isset($res) && $res['data']){
            $cats = $res['data'];
        }
        return view("admin.$this->view.show",compact('row','show','cats'));
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
        $row = $res['data'][0];
        $res = $this->SendAdminRequest('GET','/get/blogCats/0/desc',null);
        $cats = null;
        if(isset($res) && $res['data']){
            $cats = $res['data'];
        }
        return view("admin.$this->view.edit",compact('row','cats'));
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
            //$token = \Session::get('admin_token');
            //\Session::put('token', $token);
            //$data['form_params']['attachment']=$request->attachment;
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['featureImage' => $fileName]);
            }
            //session()->forget('token');
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




}
