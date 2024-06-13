<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AboutAppController extends Controller
{

    function __construct(){
        parent::__construct();
        $this->model = 'settings';
        $this->view = 'settings';
        $view = 'aboutApp';
        $route = 'page/edit';
        view()->share(compact('view','route'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $page_id = request()->route()->getAction()['id'];
        $res = $this->SendAdminRequest('GET','/getById/'.$this->model.'/1',null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        return view('admin.aboutApp.edit',compact('row','page_id'));
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->page_id == 1) 
        {
            $validator = Validator::make( $request->all(), [
                "aboutUs"           => "required",
    
            ]);
        }
        elseif ($request->page_id == 2) 
        {
            $validator = Validator::make( $request->all(), [
                "privacy"           => "required",
    
            ]);
        }
        elseif ($request->page_id == 3) 
        {
            $validator = Validator::make( $request->all(), [
                "registerCondetions"           => "required",
    
            ]);
        }
        else 
        {
            $validator = Validator::make( $request->all(), [
                "registerLicense"           => "required",
    
            ]);
        }
        
   
    	if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
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
    public function destroy($id)
    {
        //
    }
}
