<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AdminController extends Controller
{
    //

    public function index()
    {
        

        $now = Carbon::now();
        
        $users  		        = null;
		$men  		        	= null;
		$women  		        = null;
        $users_months  		    = null;
        $purchases  		    = null;
        $purchases_months  		= null;
        $messages  		        = null;
        $Challenges  		    = null;
        $Packages  		        = null;
        $UserPackages  		    = null;
        $usersChart             = array();
        $paymentsChart          = array();
        $android = null;
        $iphone = null;
        $totalUsers = null;
        $freeMonthPurchase = null;
        $freeMonthPurchaseValue = null;
        $res = $this->SendAdminRequest('GET','/getHome',null);
        if(isset($res) && $res['data'])
        {
            $users = $res['data']['users']['todayUsers'];
            $users_android = $res['data']['users']['android'];
            $users_iphone = $res['data']['users']['iphone'];
            $users_months = $res['data']['users']['monthUsers'];
            $users_active = $res['data']['users']['waitingUsers'];
            $purchases = $res['data']['purchases']['todayPurchase'];
            $todayPurchaseValue = $res['data']['purchases']['todayPurchaseValue'];
            $purchases_months = $res['data']['purchases']['monthPurchase'];
            $monthPurchaseValue = $res['data']['purchases']['monthPurchaseValue'];
            $freeMonthPurchase = $res['data']['purchases']['freeMonthPurchase'];
            $freeMonthPurchaseValue = $res['data']['purchases']['freeMonthPurchaseValue'];
            $messages = $res['data']['messages']['newMessages'];
			$men = $res['data']['users']['men'];
			$women = $res['data']['users']['women'];
			$android = $res['data']['users']['android'];
			$iphone = $res['data']['users']['iphone'];
			$totalUsers = $res['data']['users']['totalUsers'];
			$paymentRefrences = $res['data']['paymentRefrences'];
			
			$totalAndroidPurchase = $res['data']['purchases']['totalAndroidPurchase'];
			$totalIphonePurchase = $res['data']['purchases']['totalIphonePurchase'];
			$todayAndroidPurchase = $res['data']['purchases']['todayAndroidPurchase'];
			$todayIphonePurchase = $res['data']['purchases']['todayIphonePurchase'];
			$monthAndroidPurchase = $res['data']['purchases']['monthAndroidPurchase'];
			$monthIphonePurchase = $res['data']['purchases']['monthIphonePurchase'];
			$freeMonthAndroidPurchase = $res['data']['purchases']['freeMonthAndroidPurchase'];
			$freeMonthIphonePurchase = $res['data']['purchases']['freeMonthIphonePurchase'];
        }

        $res = $this->SendAdminRequest('POST','/usersChart',null);
        if(isset($res) && $res['data'])
        {
            $usersChart = $res['data'];
        }
        $res = $this->SendAdminRequest('POST','/paymentsChart',null);
        if(isset($res) && $res['data'])
        {
            $paymentsChart = $res['data'];
        }
        //dd($usersChart);
        return view('admin.dashboard.index', compact('users','men','women','users_months','purchases_months','messages','purchases','Challenges','Packages','UserPackages','users_active','usersChart','paymentsChart','todayPurchaseValue','monthPurchaseValue','android','iphone','totalUsers','freeMonthPurchase','freeMonthPurchaseValue','paymentRefrences','users_android','users_iphone','totalAndroidPurchase','totalIphonePurchase','todayAndroidPurchase','todayIphonePurchase','monthAndroidPurchase','monthIphonePurchase','freeMonthAndroidPurchase','freeMonthIphonePurchase'));
    }
	
	
	public function TelesaleIndex()
	{
		return view('admin.dashboard.telesale_index');
	}

}
