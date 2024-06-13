<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->view = 'chats';
        $view = 'chats';
        $route = 'chats';
        $OtherRoute = 'chat';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 0 ;
        $next_page = null;
        $prev_page = null;
        if(request()->page){
            $page = request()->page;
        }
        if($request->userId)
        {
            $userId= $request->userId;
            $url = "/getUserChatList/$userId";
            $res = $this->SendAdminRequest('GET',$url,null);

        }
        else 
        {
            $res = $this->SendAdminRequest('GET',"/getAllUsersChatList/$page",null);
            if($res['rowsCount'] == 40){
                $next_page = $page + 1;
                $prev_page = $page - 1;
            } 
        }
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $collection = $res['data'];
        
        return view("admin.$this->view.index",compact('collection','next_page','page','prev_page'));
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
        $res = $this->SendAdminRequest('GET',"/openChat/$id",null);
        if($res['status'] == 'false')
        {
            return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        $collection = $res['data'];
        return view("admin.$this->view.show",compact('collection'));
    }






}
