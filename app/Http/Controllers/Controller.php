<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $packages=[];

    function __construct(){

        Carbon::setLocale('ar');
        app()->setLocale('ar');
        $this->api_url = \Config::get('app.api_url');
        $this->admin_api_url = \Config::get('app.admin_api_url');

        $api_url = $this->api_url;
        $admin_api_url = $this->admin_api_url;

        if (!request()->is('admin/*') || !request()->is('admin')) {
            //if (request()->isMethod('get')) {
                $settings = $this->SendApiRequest('GET','/getAppSettings');
           

                $this->settings = $settings;

                $fixedData = $settings['fixedData'];
                $allFixedData = $fixedData;
                $fixedData = $this->array_flatten($fixedData);

                $footerStatistic = $settings['footerStatistic'];
                $settings = $settings['data'][0];

                $countries = $this->SendApiRequest('GET','/getCountries/');
                $countries = $countries['data'];

                $packages = $this->SendApiRequest('GET','/getPackages');

                $packages = $packages['data'];
                $this->packages = $packages;
                view()->share(compact('settings','countries','packages','footerStatistic','fixedData','allFixedData'));
            //}
        }

        $privilege = array(
            1   => 'المشرفين',
            2   => 'الاعدادات',
            3   => 'الصفحات الثابته',
            4   => 'الدول',
            5   => 'المدن',
            6   => 'الصفحات الثابتة',
            7   => 'الباقات',
            10  => 'الأعضاء',
            11  => 'الإشتراكات',
            12  => 'الاشعارات',
            13  => 'المقالات',
            14  => 'قصص النجاح',
            15  => 'الرسائل',
            16  => 'التقارير',
            17  => 'المحادثات',
        );


        view()->share(compact('api_url','admin_api_url','privilege'));
    }




    public function SendNotification($token=null,$from=null,$type=null)
    {
        $message = "";
        $title = "";
        $privateDate = "";
        $type = 1;
        $userID = "";
        if($from=='front')
        {
            $userID = \Session::get('user')['id'];
            $userName = \Session::get('user')['userName'];
            if($type=="view")
            {
                $message = " قام $userName بمشاهدة ملفك الشخصى ";
                $title = " مشاهدة الملف الشخصى ";
                $type = 1;
            }
            if($type=="interest")
            {
                $message = " قام $userName بالإعجاب بك ";
                $title = " إعجاب بك ";
                $type = 2;
            }

            if($type=="photo-request")
            {
                $message = " قام $userName بطلب مشاهدة الصورة الشخصية ";
                $title = " مضاهدة الصورة الشخصية ";
                $type = 3;
            }

            if($type=="photo-approved")
            {
                $message = " قام $userName بالموافقة على مشاهدة صورتك الشخصية ";
                $title = " موافقة على مشاهدة الصورة الشخصية ";
                $type = 4;
            }

            if($type=="photo-declined")
            {
                $message = " قام $userName برفض مشاهدة الصورة الشخصية ";
                $title = " رفض مشاهدة الصورة الشخصية ";
                $type = 5;
            }
            if($type=="new-message")
            {
                $message = " قام $userName بإرسال رسالة جديدة ";
                $title = " رسالة جديدة ";
                $type = 8;
            }
            if($type=="new-chat")
            {
                $message = " قام $userName بإرسال رسالة جديدة ";
                $title = " رسالة جديدة ";
                $type = 9;
            }

            $form_params = [
                "type" => $type,
                "id" => $userID
            ];
            $privateDate= json_encode($form_params);
        }

        $data = [
            'form_params' => [
                "notificaionsTokens" => $token,
                "message" => $message,
                "title" => $title,
                "privateDate" => $privateDate,
            ]
        ];

        $this->SendApiRequest('POST','/testNotification',$data);

    }

    public function SendApiRequest($request_type,$url,$data=null){
        $client = new Client();

        if(\Session::get('token'))
        {
            $token = \Session::get('token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'                => 'application/json',
            ];
            $data['headers'] = $headers;
			//dd($request_type,$this->api_url.$url,$data,$token);
        }


        if($data)
        {
            $res = $client->request($request_type,$this->api_url.$url,$data);
        }
        else
        {
            $res = $client->request($request_type,$this->api_url.$url);
        }
        $data = json_decode($res->getBody()->getContents(),true);
        return $data;
    }

    public function SendAdminRequest($request_type,$url,$data=null){
        $client = new Client();

        if(\Session::get('admin_token'))
        {
            $token = \Session::get('admin_token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'                => 'application/json',
            ];
            $data['headers'] = $headers;
        }
        elseif(\Session::get('token'))
        {
            $token = \Session::get('token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'                => 'application/json',
            ];
            $data['headers'] = $headers;
        }
		//dd($request_type,$this->admin_api_url.$url,$data);

        if($data)
        {
            $res = $client->request($request_type,$this->admin_api_url.$url,$data);
        }
        else
        {
            $res = $client->request($request_type,$this->admin_api_url.$url);
        }
		//dd($res->getBody()->getContents());
        $data = json_decode($res->getBody()->getContents(),true);
		//dd($data);
        return $data;

    }


    public function SendAgentRequest($request_type,$url,$data=null){
        $client = new Client();

        if(\Session::get('agent_token'))
        {
            $token = \Session::get('agent_token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'                => 'application/json',
            ];
            $data['headers'] = $headers;
        }
        elseif(\Session::get('token'))
        {
            $token = \Session::get('token');
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'                => 'application/json',
            ];
            $data['headers'] = $headers;
        }
        if($data)
        {
            $res = $client->request($request_type,$this->admin_api_url.$url,$data);
        }
        else
        {
            $res = $client->request($request_type,$this->admin_api_url.$url);
        }
        $data = json_decode($res->getBody()->getContents(),true);
        return $data;

    }

    public function FormatAdminRequest($request=[],$model=null,$type=null,$id=null)
    {
        if(empty($request))
        {
            return false;
        }
        $parms = $request;
        $form_params = [];
        foreach($parms as $key=>$value){
            if($value == null && ($key != "reply" && $key != "susbendedTillDate" && $key != "profileImage")) $value = 0;
            if($key !="_token" && $key!="_method" && $key!="id" && $key!="page_id" && $key !='file' && $key !='img_deleted')
            {
                if(($key !="password") || ($key =="password" && $value!=""))
                {
                    if($key =="password" && $value!="") $value=md5($value);
                    $form_params[$key]=$value;
                }


            }
        }
        $data = null;
        if($type != "delete")
        {
            $data = [
                'form_params' => [
                    "fields" =>json_encode($form_params)
                ]
            ];
        }
        if($type)
        {
            $call_url = '/'.$type;
        }
		if($model)
		{
			$call_url = $call_url.'/'.$model;
		}

        if($id)
        {
            $call_url = $call_url.'/'.$id;
        }

        $res = $this->SendAdminRequest('POST',$call_url,$data);
        if(isset($res) && isset($res['error']) && $res['error'] == false) {
            return true;
        }
        elseif(isset($res) && isset($res['status']) && $res['status'] == 'success') {
            return true;
        }
        else {
            return false;
        }
        // if(( isset($res['error']) && $res['error'] == 'false') || ( isset($res['status']) && $res['status'] == 'success'))
        // {
        //     return true;
        // }


    }


    public function array_flatten($arr)
    {
        $register_array=[];
        foreach($arr as $key=>$value){
            if($value['type'] == 1)
            {
                $register_array['marriageStatus'][] = $value;
            }
            elseif ($value['type'] == 2)
            {
                $register_array['mariageKind'][] = $value;
            }
            elseif ($value['type'] == 3)
            {
                $register_array['study'][] = $value;
            }
            elseif ($value['type'] == 4)
            {
                $register_array['moneyStatus'][] = $value;
            }
            elseif ($value['type'] == 5)
            {
                $register_array['financeStatus'][] = $value;
            }
            elseif ($value['type'] == 6)
            {
                $register_array['job'][] = $value;
            }
            elseif ($value['type'] == 7)
            {
                $register_array['medicalStatus'][] = $value;
            }
            elseif ($value['type'] == 8)
            {
                $register_array['smokingStatus'][] = $value;
            }
            elseif ($value['type'] == 9)
            {
                $register_array['relegionStatus'][] = $value;
            }
            elseif ($value['type'] == 10)
            {
                $register_array['prayStatus'][] = $value;
            }
            elseif ($value['type'] == 11)
            {
                $register_array['color'][] = $value;
            }
            elseif ($value['type'] == 12)
            {
                $register_array['veil'][] = $value;
            }
        }
        return $register_array;
    }

}
