<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    public function loginIndex()
    {
        if(Session::get('admin_token'))
        {
            return redirect(config('app.admin_url').'/dashboard');
        }
        else
        {
            return view('admin.auth.login');
        }

    }

    public function AgentloginIndex()
    {
        if(Session::get('agent_token'))
        {
            return redirect(url('/').'/agent_dashboard/dashboard');
        }
        else
        {
            return view('admin.auth.agent_login');
        }
    }


    public function Agentlogin(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $parms = $request->all();
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
            $data['form_params'][$key]=$value;
        }
        $res = $this->SendAdminRequest('POST','/agentLogin',$data);
        if($res['status'] == "error"){
            return back()->with('failed',' البريد الالكترونى او كملة المرور غير صحيحة ');
        }
        \Session::put('agent_token', $res['token']);
        \Session::put('agent', $res['data'][0]);
        return redirect(url('/').'/agent_dashboard/dashboard');

    }


    public function login( Request $request )
    {
        
    	$validator = Validator::make($request->all() , [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            //return back()->with('failed','يجب إدخال إستخدم المستخدم وكلمة السر');
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $parms = $request->all();
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
            $data['form_params'][$key]=$value;
        }
        $res = $this->SendAdminRequest('POST','/login',$data);
        if($res['status'] == "error"){
            return back()->with('failed',' البريد الالكترونى او كملة المرور غير صحيحة ');
        }
        \Session::put('admin_token', $res['token']);
        \Session::put('admin', $res['data'][0]);
        \Session::put('privlages', $res['privlages']);
        return redirect()->intended(config('app.admin_url').'/dashboard');
       
    }

    public function profile()
    {


        $admin = Session::get('admin');
        return view('admin.auth.profile', compact('admin'));


    }

    public function updateProfile( Request $request )
    {


        $admin = Session::get('admin_token');

            $validator = Validator::make( $request->all(), [
                'name'      => 'required',
                'email'     => ['required','email'],
                'password'  => 'nullable|string'

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }
            $response = $this->FormatAdminRequest($request->all(),'admins','update',Session::get('admin')['id']);
        if(!$response)
        {
            return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        Session::put('admin.name', $request->name);
        Session::put('admin.email', $request->email);
        return redirect()->back()->with('status' , __('admin.updated') );

    }




    public function logout( Request $request )
    {
        Session::get('admin_token');
        Session::flush();
        $url = url('/').'/admin';
        return redirect($url);
    }
	
	
	public function TelesaleloginIndex()
    {
        if(Session::get('agent_token'))
        {
            return redirect(url('/').'/telesale_dashboard/dashboard');
        }
        else
        {
            return view('admin.auth.telesale_login');
        }
    }


    public function Telesalelogin(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $parms = $request->all();
        $data = [
            'form_params' => []
        ];
        foreach($parms as $key=>$value){
			if($key !="_token") $data['form_params'][$key]=$value;
        }
        $res = $this->SendAdminRequest('POST','/telesalesLogin',$data);
        if($res['status'] == "error"){
            return back()->with('failed',' البريد الالكترونى او كملة المرور غير صحيحة ');
        }
        \Session::put('telesale_token', $res['token']);
        \Session::put('telesale', $res['data'][0]);
        return redirect(url('/').'/telesale_dashboard/dashboard');

    }


}
