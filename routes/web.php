<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('front/home/index');
// });
Route::group(['namespace'=>'Front'], function() {
    Route::get('/','HomeController@index');
    Route::post('/login','UserController@login');
    Route::get('/logout','UserController@logout');
    Route::get('/delete/account','UserController@DeleteAccount');
    Route::get('/register','UserController@index');
    Route::post('send/sms','UserController@SendSMS');
    Route::post('register','UserController@Register');
    Route::get('profile','UserController@profile');
    Route::get('user/password/change','UserController@ChangePassword');
    Route::post('user/change/password','UserController@StorePassword');
    Route::post('user/change/status','UserController@ChangeStatus');
    Route::get('user/change/status','UserController@ChangeStatus');
    Route::post('user/uploadPhoto','UserController@uploadPhoto');
    Route::post('user/firebase/token','UserController@SendToken');

    Route::post('user/forget/password','UserController@requestChangePassword');
    Route::get('user/change/password','UserController@ForgetChangePassword');
    Route::post('user/forget/change/password','UserController@ForgetRequestChangePassword');
    

    Route::post('check/forget/pass','UserController@CheckForgetPass');

    Route::get('user/change/phone','UserController@ChangePhone');
    Route::post('user/change/phone','UserController@StorePhone');
    Route::post('send/sms/change/phone','UserController@SendSMSChangePhone');

    Route::post('check/username','UserController@checkUsername');
    Route::post('check/mobile','UserController@checkMobile');
    Route::post('get/cities','UserController@getCities');
    
    Route::get('articles','PostsController@index');
    Route::get('marriage','PostsController@marriage');
    Route::get('articles/details/{id}/{cat}','PostsController@details');
    Route::get('marriage/details/{id}/{cat}','PostsController@details');
    Route::get('posts/load/more','PostsController@LoadMorePosts');

    Route::get('packages','PackagesController@index');
    Route::get('packages/details/{id}','PackagesController@details');
    Route::get('packages/purchase/{id}','PackagesController@purchasePackage');
    Route::get('packages/script/{id}','PackagesController@LoadScript');

    Route::get('our-mission','PageController@about');
    Route::get('privacy','PageController@privacy');
    Route::get('usage','PageController@usage');
    Route::get('conditions','PageController@conditions');
    Route::get('sucsses/stories','StoriesController@index');
    Route::get('sucsses/stories/details/{id}','StoriesController@details');
    Route::get('sucsses/stories/add','StoriesController@create');
    Route::post('add/sucsses/story','StoriesController@store');
    Route::get('sucsses/stories/load/more','StoriesController@LoadMore');

    Route::get('contact-us','ContactController@index');
    Route::get('support','ContactController@support');
    Route::get('contact-us/message/details/{id}','ContactController@details');
    Route::get('contact-us/send/message','ContactController@create');
    Route::post('contact-us','ContactController@store');

    Route::get('notifications','NotificationsController@index');
    Route::get('notifications/load/more','NotificationsController@LoadMore');
    Route::get('notifications/replyPhoto','NotificationsController@replyPhoto');


    Route::get('settings','SettingsController@index');
    Route::post('settings','SettingsController@store');

    Route::get('members','MembersController@index');
    Route::get('search','MembersController@search');
    Route::post('members/search','MembersController@SearchMember');
    Route::get('members/search','MembersController@SearchMember');
    Route::get('members/remove/{id}/{type}','MembersController@RemoveMember');
    Route::get('members/load/more','MembersController@LoadMoreMemebers');
    Route::get('members/details/{id}','MembersController@details');
    Route::post('add/to/fav','MembersController@AddToFav');
    Route::post('request/photo','MembersController@RequestPhoto');
    Route::post('cancel/request/photo','MembersController@cancelRequestPhoto');

    Route::get('country/load/cities','MembersController@GetCities');
    Route::post('user/detected/country','UserController@detectedCountry');


    Route::get('wedding-plan','WeddingController@index');
    Route::get('wedding-accessories','WeddingController@index');
    Route::get('wedding-kosha','WeddingController@index');
    Route::get('wedding-cake','WeddingController@index');
    Route::get('wedding-pictorial-programs','WeddingController@index');


    Route::get('automated-search','SearchController@index');
    Route::get('automated-search/filter','SearchController@filter');
    Route::post('automated-search/filter/store','SearchController@store');
    
    Route::get('maintenance','MaintenanceController@index');
    Route::get('thankyou','HomeController@thankyou');
    Route::get('failed/payment','HomeController@failedPayment');


    Route::get('chats','ChatController@index');
    Route::get('chats/details/{id}','ChatController@details');
    Route::get('chat/load/more','ChatController@LoadMore');
    Route::post('chats/send/message','ChatController@store');
    Route::post('chats/send/audio','ChatController@storeAudio');

    Route::get('agents','AgentController@index');
    Route::get('add/agent','AgentController@create');
    Route::post('add/agent','AgentController@store');
    
    
    Route::get('test','HomeController@test');
    Route::post('test','HomeController@testPost');
    Route::post('hide/chat','ChatController@HideChat');
    Route::get('hide/chat/{id}','ChatController@HideChatGet');
	
	
	Route::get('contact-us/send/marriage','ContactController@SendMarriage');
	Route::post('contact-us/store/marriage','ContactController@StoreMarriage');
	
	Route::get('hideAllChats','ChatController@hideAllChats');
	Route::get('hideChat','ChatController@SendHideChat');
	
	
	Route::post('request/mobile','MembersController@RequestMobile');
	Route::post('cancel/request/mobile','MembersController@CancelRequestMobile');
	
	Route::get('members/replyMobile','MembersController@replyRequestMobile');
	Route::post('delete/chat/message','ChatController@DeleteChatMessage');
	Route::get('remove/user/img','UserController@deleteMyProfileImage');
	

});
