<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{

    function __construct(){
        parent::__construct();
        if($this->settings['data'][0]['websiteStatues'] == 1)
        {
            \Redirect::to('/')->send();
        }
        
    }
    public function index()
    {
        
        return view('front.maintenance.index');
    }


}
