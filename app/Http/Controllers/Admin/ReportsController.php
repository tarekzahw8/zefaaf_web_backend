<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->view = 'reports';
        $view = 'reports';
        $route = 'reports';
        $OtherRoute = 'report';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UsersReport(Request $request)
    {
        $page = 0 ;
        $next_page = null;
        $prev_page = null;
        if(request()->page){
            $page = request()->page;
        }
        $collection=null;
        if(!empty($request->all()))
        {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            if($request->page)
            {
                //$data['form_params']['page']=$request->page;
            }
            $response = $this->SendAdminRequest('POST','/listUsers',$data);
            if($response['status'] == "success")
            {
                $collection = $response['data'];
                $next_page = null;
                $prev_page = null;
                if($response['rowsCount'] == 40){
                    $next_page = $page + 1;
                    $prev_page = $page - 1;
                } 
            }
            
        }
        if($collection)
        {
            return view("admin.$this->view.load_user_reports",compact('collection','next_page','page','prev_page'));    
        }
        return view("admin.$this->view.user_report",compact('collection','next_page','page','prev_page'));
    }


    public function paymentsReport(Request $request)
    {
        $page = 0 ;
        $next_page = null;
        $prev_page = null;
        if(request()->page){
            $page = request()->page;
        }
        $collection=null;
        if(!empty($request->all()))
        {
            $parms = $request->all();
            $data = [
                'form_params' => []
            ];
            foreach($parms as $key=>$value){
                $data['form_params'][$key]=$value;
            }
            if($request->page)
            {
                $data['form_params']['page']=$request->page;
            }
           
            $response = $this->SendAdminRequest('POST','/listPurchases',$data);
            if($response['status'] == "success")
            {
                $collection = $response['data'];
                $next_page = null;
                $prev_page = null;
                if($response['rowsCount'] == 40){
                    $next_page = $page + 1;
                    $prev_page = $page - 1;
                } 
            }
            
        }

        if($collection)
        {
            return view("admin.$this->view.load_payment_report",compact('collection','next_page','page','prev_page'));    
        }
        return view("admin.$this->view.payment_report",compact('collection','next_page','page','prev_page'));
    }





}
