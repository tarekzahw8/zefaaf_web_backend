<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;


class HomeController extends Controller
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
        $url = '/getWebHome/-1/';
        
        if(\Session::get('token'))
        {
            $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';
            $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):"-";
            $form_params = [
                'detectedCountry' => $country,
                'loginWay' => 'web',
                'deviceToken' => $deviceToken,
            ];
            $data['form_params'] = $form_params;
            $res = $this->SendApiRequest('POST','/loginByToken',$data);
            
            if($res['status'] == "success"){
                \Session::put('token', $res['token']);
                \Session::put('user', $res['data'][0]);
                \Session::put('updates', $res['updates']);
                \Session::put('latestUsers', $res['latestUsers']);
            } 

            $user = \Session::get('user');
            $url = '/getWebHome/'.$user['gender']."/".$user['residentCountryId'];
        }
        
        $res = $this->SendApiRequest('GET',$url,null);
        $list = $res;
        $main_header = true;
        return view('front.home.index',compact('main_header','list'));
    }


    public function thankyou()
    {

        if(\Session::get('token'))
        {
        $deviceToken = (\Session::get('deviceToken'))?\Session::get('deviceToken'):'f1j-0bCbbyk:APA91bFqge_5G4bHswIZsgxk5ZGQZvPThUerzRryyCWymgxFE1e8InKOfuJGkktv29f81ZN0gfj7uE7tEmG5YR035UZEyHQh7BipA6aRFfNdJD0ls97tE09XS5LpQzWO29eSDZuVrhLL';

        $country = (\Session::get('detectedCountry'))?\Session::get('detectedCountry'):null;
        $form_params = [
            'detectedCountry' => $country,
            'loginWay' => 'web',
            'deviceToken' => $deviceToken,
        ];
        $data['form_params'] = $form_params;
        $res = $this->SendApiRequest('POST','/loginByToken',$data);
        if($res['status'] == "success"){
            \Session::put('user', $res['data'][0]);
            \Session::put('updates', $res['updates']);
            \Session::put('latestUsers', $res['latestUsers']);
        }
        return redirect(url('/'))->with('message','تم الإشتراك في الباقة بنجاح');
        }
        else
        {
            return redirect(url('/'));
        }
    }

    public function failedPayment()
    {
        return redirect(url('/'))->with('failed','حدث خطأ أثناء عملية الدفع برجاء المحاولة مرة أخرى');
    }
    public function test()
    {
		dd(\Session::get('user'));
        return view('front.test');
    }

    public function testPost(Request $request)
    {
		
        // $data = file_put_contents('audio.mp3', base64_decode($request->base64));
        // $data2 = file_put_contents('audio.mp3', base64_decode($request->url));
        $base64File = $request->base64;
        $name = time() . '.mp3';
        \Storage::disk('public')->put($name,base64_decode($base64File)); 
        $fileName = "/app/public/$name";
        $path = storage_path();
        $data = [
            'multipart' => [
                [
                    'name'     => 'attachment',
                    'contents' => fopen($path . $fileName, 'r'),
                    'headers'  => ['Content-Type' => 'multipart/form-data']
                ],
            ],
        ];
        
        $res = $this->SendApiRequest('POST','/uploadSoundFile',$data);
        dd($res);
       
    }

}
