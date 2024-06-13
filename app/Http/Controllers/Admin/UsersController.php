<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\EditUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    
    function __construct(){
        parent::__construct();
        $this->model = "users";
        $this->view = 'users';
        $view = 'users';
        $route = 'users';
        $OtherRoute = 'user';
        view()->share(compact('view','route','OtherRoute'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 0 ;
        $data = null;
        if(request()->page){
            $page = request()->page;
        }

        $form_params = [
            'page' => $page,        
        ];

        if(request()->active !=null)
        {
            $form_params['active']=request()->active;
        }

        if(request()->userGender!=null)
        {
            $form_params['userGender']=request()->userGender;
        }
		$cities = null;
        if(request()->residentCountryId && request()->residentCountryId!="")
        {
            $form_params['residentCountryId']=request()->residentCountryId;
			$res = $this->SendAdminRequest('GET','/get/cities/-1/desc',null);
			
			if(isset($res) && $res['data']){
				$cities = $res['data'];
			}
        }

        if(request()->nationalityCountryId && request()->nationalityCountryId!="")
        {
            $form_params['nationalityCountryId']=request()->nationalityCountryId;
        }
		
		if(request()->mariageKind && request()->mariageKind!="")
        {
            $form_params['mariageKind']=request()->mariageKind;
        }
		if(request()->mariageStatues && request()->mariageStatues!="")
        {
            $form_params['mariageStatues']=request()->mariageStatues;
        }
		if(request()->cityId && request()->cityId!="")
        {
            $form_params['cityId']=request()->cityId;
        }
        if(request()->ageTo && request()->ageTo!="")
        {
            //dd(request()->ageTo);
            $form_params['ageTo']=request()->ageTo;
        }
		if(request()->packageId && request()->packageId!="")
        {
            $form_params['packageId']=request()->packageId;
        }

        if(request()->q && request()->q!="")
        {
            $form_params['search']=request()->q;
        }
        
        $data['form_params'] = $form_params;
        $res = $this->SendAdminRequest('POST','/listUsers',$data);
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
        if($page && $page > 0)
        {
            $prev_page = $page - 1;
        }
        $user_packages = null;
        //$res_packages = $this->SendAdminRequest('GET','/getAdminPackages');
        $res_packages = $this->SendAdminRequest('GET',"/getPackages/0/-1/-1/",null);
        if($res_packages['status'] == 'success')
        {
            $user_packages  = $res_packages['data'];
		//dd($user_packages);

        }
		
		//dd($collection);
        return view("admin.$this->view.index",compact('collection','next_page','page','prev_page','user_packages','cities'));

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view("admin.$this->view.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
        $request->rules();
        if($request->file){
            $file               = $request->file('file') ;//request('attachment');
            $response           = array();
            $name               = time() . '_' . $file->getClientOriginalName();
            $path               = base_path() .'/public/uploads/';
            $file->move($path, $name);
            $data = [
                'multipart' => [
                    [
                        'name'     => 'attachment',
                        'contents' => fopen($path . $name, 'r'),
                        'headers'  => ['Content-Type' => 'multipart/form-data']
                    ],
                ],
            ];
            // $token = \Session::get('admin_token');
            // \Session::put('token', $token);
            //$data['form_params']['attachment']=$request->attachment;
            $res = $this->SendAdminRequest('POST','/uploadFile',$data);
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['profileImage' => $fileName]);
            }
            //session()->forget('token');
        }
        if($request->gender == 1)
        {
            $request->request->add(['packageId' => 11]);
        }
        else
        {
            $request->request->add(['packageId' => 0]);
        }
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

        $res = $this->SendAdminRequest('GET','/get/cities/-1/desc',null);
        $cities = null;
        if(isset($res) && $res['data']){
            $cities = $res['data'];
        }
        return view("admin.$this->view.show",compact('row','show','cities'));
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
        $res = $this->SendAdminRequest('GET','/get/cities/-1/desc',null);
        $cities = null;
        if(isset($res) && $res['data']){
            $cities = $res['data'];
        }
        return view("admin.$this->view.edit",compact('row','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        //$request->persist($id);
        $request->rules($id);
        if($request->file){
            $file               = $request->file('file') ;//request('attachment');
            $response           = array();
            $name               = time() . '_' . $file->getClientOriginalName();
            $path               = base_path() .'/public/uploads/';
            $file->move($path, $name);
            $data = [
                'multipart' => [
                    [
                        'name'     => 'attachment',
                        'contents' => fopen($path . $name, 'r'),
                        'headers'  => ['Content-Type' => 'multipart/form-data']
                    ],
                ],
            ];
            
            $res = $this->SendAdminRequest('POST','/updateAgent',$data);
			
            $fileName = null;
            if($res['status'] == "success"){
                $fileName = $res['fileName']; 
                $request->request->add(['profileImage' => $fileName]);
            }
            //session()->forget('token');
        }
		if($request->img_deleted)
		{
			$request->request->add(['profileImage' => NULL]);
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
			
			$data = [
                'form_params' => [
                    "userId" => $id
                ]
            ];
            $response = $this->SendAdminRequest('POST',"/reActiveUser",$data);
            if($response['status']=="success")
            {
                return response(['msg' => 'deleted', 'status' => 'success']);
            }
			/* $request->request->add(['susbendedTillDate' => null]);
            $response = $this->FormatAdminRequest($request->all(),$this->model,'update',$id);
            if(!$response)
            {
                return response(['msg' => 'حدث خطأ برجاء المحاولة مرة اخرى!', 'status' => 'error']);
            }
            return response(['msg' => 'deleted', 'status' => 'success']); */
            
        }
    }

    /**
     * suspend the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function suspend(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = [
                'form_params' => [
                    "userId" => $id,
                    "tillDate" => date("Y-m-d",strtotime($request->susbendedTillDate)),
                ]
            ];
            $response = $this->SendAdminRequest('POST',"/susbendUser",$data);
            if($response['status']=="success")
            {
                return response(['msg' => 'deleted', 'status' => 'success']);
            }
            
            
            
        }
    }


    /**
     * subscribe the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, $id)
    {
        if ($request->ajax()) {
            // $form_params = [
            //     "userId" => $id,
            //     "packageId" =>$request->packageId,
            //     "paymentRefrence" =>"Visa",
            // ];
            // $data = [
            //     'form_params' => [
            //         "fields" =>json_encode($form_params)
            //     ]
            // ];
            // $this->SendAdminRequest('POST',"/add/purchases",$data);

            $form_params = [
                "packageId" =>$request->packageId,
                "userId" =>$id,
            ];

            $data = [
                'form_params' => $form_params
            ];
            
            $response = $this->SendAdminRequest('POST',"/subscripePackage",$data);

            if(isset($response) && isset($response['error']) && $response['error'] == false) 
            {
                return response(['msg' => 'deleted', 'status' => 'success']);
            }
            
            
            
        }
    }

    public function ListCities(Request $request)
    {
        if ($request->ajax()) {
            
            $countryId = $request->country_id;
            $res = $this->SendAdminRequest('GET',"/getByField/cities/countryId/$countryId/0",null);
            $cities = null;
            if(isset($res) && $res['data']){
                $cities = $res['data'];
            }
            return view("admin.$this->view.cities",compact('cities'));
        }
    }

    public function LoadUsers(Request $request)
    {
        if ($request->ajax()) {
            
            $search = $request->search;
            $type = $request->type;
            $res = $this->SendAdminRequest('GET',"/getUsers/$search",null);
            $users = null;
            if(isset($res) && $res['data']){
                $users = $res['data'];
            }
            return view("admin.$this->view.load_users",compact('users','type'));
        }
    }

    public function listPendingPhotos(Request $request)
    {
            
            $page = 0;
            if(request()->page){
                $page = request()->page;
            }
            $res = $this->SendAdminRequest('GET',"/listPendingPhotos/$page",null);
            if($res['status'] == 'false')
            {
                return redirect()->intended(config('app.admin_url').'/dashboard')->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
            }
            $collection = $res['data'];
		//   dd($collection);
            
            $next_page = null;
            $prev_page = null;
            if($res['rowsCount'] == 40){
                $next_page = $page + 1;
                $prev_page = $page - 1;
            } 
            if($page && $page > 0)
            {
                $prev_page = $page - 1;
            }

            return view("admin.user_images.index",compact('collection','next_page','page','prev_page'));
    }


    public function RequestUserImage(Request $request)
    {
        
        $form_params = [
            "userId" =>$request->userId,
        ];

        $data = [
            'form_params' => $form_params
        ];
        if($request->success)
        {
            $response = $this->SendAdminRequest('POST',"/confirmUploadPhoto",$data);
        }
        else
        {
            $response = $this->SendAdminRequest('POST',"/refuseUploadPhoto",$data);
        }
        if(!$response)
        {
            return redirect()->back()->with('error','حدث خطأ برجاء المحاولة مرة اخرى!');
        }
        return redirect()->back()->with('success' , __('admin.created') );
    }




}
