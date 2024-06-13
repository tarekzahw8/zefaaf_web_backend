<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{

    function __construct(){
        parent::__construct();
        if($this->settings['data'][0]['websiteStatues'] != 1)
        {
            \Redirect::to('maintenance')->send();
        }
        
    }

    public function index()
    {
        $res = $this->SendApiRequest('GET','/getPostsCategories',null);
        $categories = $res['data'];
        $posts = [];
        foreach($categories as $key=>$value) {
            $id = $value['id'];
            $res = $this->SendApiRequest('GET','/getPosts/'.$id.'/0',null);
            $posts[] = $res['data'];
        }
        
        
        $type='articles';
        return view('front.posts.index',compact('categories','posts','type'));
    }
    public function marriage()
    {
        $res = $this->SendApiRequest('GET','/getPosts/1/0',null);
        $posts = $res['data'];
        $type='marriage';
        $page = 0;
        return view('front.posts.marriage',compact('posts','type','page'));
    }

    public function LoadMorePosts()
    {
        if (request()->ajax()) {
            $page = request()->page?request()->page:0;
            $cat = request()->cat?request()->cat:1;
            $res = $this->SendApiRequest('GET',"/getPosts/$cat/$page",null);
            $posts = $res['data'];
            $type='marriage';
            return view('front.posts.LoadMorePosts',compact('posts','type','page'));
        }

    }
    
    public function details($id,$cat)
    {
        if(\Session::get('token'))
        {
			$form_params = [
				'blogId' => $id,        
			];
			$data['form_params'] = $form_params;
			$this->SendApiRequest('POST','/updateBlogViews',$data);
		}
        //$res = $this->SendApiRequest('GET',"/getPosts/$cat/0",null);
        $res = $this->SendApiRequest('GET',"/getPostDetails/$id",null);
        if($res['status']!="success"){
            return back()->with('failed','خطأ تأكد من اتصالك بالإنترنت وأعد المحاولة');
        }
        $item = $res['data'][0];
        return view('front.posts.details',compact('item'));
    }

}
