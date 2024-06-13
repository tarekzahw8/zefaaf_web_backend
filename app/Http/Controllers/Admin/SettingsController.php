<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\EditSettingRequest;
use Illuminate\Http\Request;


class SettingsController extends Controller
{

    function __construct(){
        parent::__construct();
        $this->model = 'settings';
        $this->view = 'settings';
        $view = 'settings';
        $route = 'settings';
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
    public function store(StoreSettingRequest $request)
    {

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
    public function edit($id=1)
    {
        //
        $res = $this->SendAdminRequest('GET','/getById/'.$this->model.'/1',null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $row = $res['data'][0];
        return view('admin.settings.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSettingRequest $request, $id)
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
       
    }

    public function deleteAdminNotifications()
    {
       

        $response = $this->SendAdminRequest('GET','/deleteAdminNotifications',null);
        if(!$response)
        {
            return redirect()->back()->with('failed','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , __('admin.deleted') );
    }
} 
