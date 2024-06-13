<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{

    function __construct(){
        parent::__construct();
        if($this->settings['data'][0]['websiteStatues'] != 1)
        {
            \Redirect::to('maintenance')->send();
        }
        
    }

    public function about()
    {

        return view('front.page.about');
    }
    public function privacy()
    {

        return view('front.page.privacy');
    }
    public function conditions()
    {

        return view('front.page.conditions');
    }
    public function usage()
    {

        return view('front.page.usage');
    }
    

}
