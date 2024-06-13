<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class UsersListController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "lists";
        $this->view = 'lists';
        $view = 'lists';
        $route = 'lists';
        $OtherRoute = 'lists';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
        $page = 0 ;
        $next_page = null;
        $prev_page = null;
        if(request()->page){
            $page = request()->page;
        }
        $collection=null;
        $userID = $request->userId?$request->userId:0;
        $type = request()->route()->getAction()['type'];
        $res = $this->SendAdminRequest('GET',"/getUserFavorites/$userID/$type/$page/",null);
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
        return view("admin.$this->view.index",compact('collection','next_page','page','prev_page','type'));
    }




}
