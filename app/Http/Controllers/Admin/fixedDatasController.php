<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\fixedDatas\EditRequest;
use App\Http\Requests\Admin\fixedDatas\StoreRequest;
use Illuminate\Http\Request;

class fixedDatasController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "fixedData";
        $this->view = 'fixedDatas';
        $view = 'fixedDatas';
        $route = 'fixedDatas';
        $OtherRoute = 'fixedData';
        $types = array(
            1   => 'الحالة الإجتماعية',
            2   => 'نوع الزواج',
            3   => 'المؤهل التعليمي',
            4   => 'الوضع المادي',
            5   => 'مستوى الدخل الشهري',
            6   => 'مجال العمل',
            7   => 'الحالة الصحية',
            // 8   => 'حالة التدخين',
            // 9   => 'مستوى التدين',
            10  => 'إلتزام الصلاة',
            11  => 'لون البشرة',
        );
        view()->share(compact('view','route','OtherRoute','types'));
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
        if(request()->field){
            $page = 0 ;
            $field = request()->field;
            $url = "/getByLikeField/$this->model/type/$field";
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
        $res = $this->SendAdminRequest('GET','/get/countries/0/desc',null);
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
        $res = $this->SendAdminRequest('GET','/get/countries/0/desc',null);
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
        $res = $this->SendAdminRequest('GET','/getById/'.$this->model.'/'.$id,null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        $res = $this->SendAdminRequest('GET','/get/countries/0/desc',null);
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
