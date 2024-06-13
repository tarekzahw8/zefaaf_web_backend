<?php

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

if (!defined('ADMIN_PATH')) {
	define('ADMIN_PATH', 'admin');
}

if (!defined('AGENT_PATH')) {
	define('AGENT_PATH', 'agent_dashboard');
}

if (!defined('TELESALE_PATH')) {
	define('TELESALE_PATH', 'telesale_dashboard');
}

Route::group(['prefix'=>AGENT_PATH],function(){
    
    Route::group(['namespace'=>'Admin'],function(){


        Route::group(['prefix' => '/auth'], function() {
            Route::post('/login', 'AuthController@Agentlogin');
        });
        Route::get('/', 'AuthController@AgentloginIndex');
        Route::get('/login', 'AuthController@AgentloginIndex');
    
        Route::group(['middleware' => 'agent'], function () {
            Route::get('/dashboard', 'CouponsController@AgentIndex');
            Route::get('/counpon/search/user', 'CouponsController@SearchUser');
            Route::post('/counpon/assign', 'CouponsController@assign');

        });
    
    });
});


Route::group(['prefix'=>TELESALE_PATH],function(){
    
    Route::group(['namespace'=>'Admin'],function(){


        Route::group(['prefix' => '/auth'], function() {
            Route::post('/login', 'AuthController@Telesalelogin');
        });
        Route::get('/', 'AuthController@TelesaleloginIndex');
        Route::get('/login', 'AuthController@Telesalelogin');
    
        Route::group(['middleware' => 'telesale'], function () {
            Route::get('/dashboard', 'AdminController@TelesaleIndex');

        });
    
    });
});
// Route::group(['prefix' => LaravelLocalization::setLocale(),
// 	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

Route::group(['prefix'=>ADMIN_PATH],function(){


	Route::group(['namespace'=>'Admin'],function(){

        Route::group(['prefix' => '/auth'], function() {
            Route::post('/login', 'AuthController@login');
        });

        Route::get('/', 'AuthController@loginIndex');
        Route::get('/login', 'AuthController@loginIndex');

        Route::group(['middleware' => 'admin'], function () {

            Route::get('/profile'         , 'AuthController@profile');
		    Route::post('/profile/edit'	, 'AuthController@updateProfile');

            Route::get('/dashboard', 'AdminController@index');
            Route::get('/logout', 'AuthController@logout');

            Route::resource('users', 'UsersController');
            Route::get('/user/search'            , 'UsersController@search');
            Route::post('/user/ban/{id}'            , 'UsersController@ban');
            Route::post('/user/activate/{id}'            , 'UsersController@activate');
            Route::get('/user/cities'            , 'UsersController@ListCities');
            Route::get('/user/load/users'            , 'UsersController@LoadUsers');
            Route::post('/user/suspend/{id}'            , 'UsersController@suspend');
            Route::post('/user/subscribe/{id}'            , 'UsersController@subscribe');
            
            Route::get('/image/users'            , 'UsersController@listPendingPhotos');
            Route::get('/image/user/request'            , 'UsersController@RequestUserImage');

            Route::get('abouts',['uses' => 'AboutAppController@edit', 'id' => 1]);
            Route::get('privacy',['uses' => 'AboutAppController@edit', 'id' => 2]);
            Route::get('register',['uses' => 'AboutAppController@edit', 'id' => 3]);
            Route::get('License',['uses' => 'AboutAppController@edit', 'id' => 4]);
            Route::patch('page/edit/{id}','AboutAppController@update');

            Route::resource('packages', 'PackagesController');
            Route::get('/package/search'            , 'PackagesController@search');

            Route::resource('categories', 'CategoriesController');
            Route::get('/category/search'            , 'CategoriesController@search');

            Route::resource('posts', 'PostsController');
            Route::get('/post/search'            , 'PostsController@search');
            Route::post('/post/ban/{id}'            , 'PostsController@ban');
            Route::post('/post/activate/{id}'            , 'PostsController@activate');
            
            Route::resource('successStories', 'successStoriesController');
            Route::get('/successStory/search'            , 'successStoriesController@search');
            Route::post('/successStory/ban/{id}'            , 'successStoriesController@ban');
            Route::post('/successStory/activate/{id}'            , 'successStoriesController@activate');

            Route::get('settings','SettingsController@edit');
            Route::patch('settings/edit/{id}','SettingsController@update');
            Route::get('setting/deleteAdminNotifications','SettingsController@deleteAdminNotifications');

            Route::get('subscriptions','SubscriptionsController@index');
            Route::get('FailedSubscriptions','SubscriptionsController@FailedSubscriptions');
            Route::get('subscription/search','SubscriptionsController@search');

            Route::resource('countries', 'CountriesController');
            Route::post('/country/ban/{id}'            , 'CountriesController@ban');
            Route::post('/country/activate/{id}'            , 'CountriesController@activate');
            
            Route::resource('cities', 'CitiesController');
            Route::post('/city/ban/{id}'            , 'CitiesController@ban');
            Route::post('/city/activate/{id}'            , 'CitiesController@activate');
        
            Route::resource('fixedDatas', 'fixedDatasController');
            Route::post('/fixedData/ban/{id}'            , 'fixedDatasController@ban');
            Route::post('/fixedData/activate/{id}'            , 'fixedDatasController@activate');
            
            Route::resource('messages', 'MessagesController');
            Route::post('/messages/ban/{id}'            , 'MessagesController@ban');
            Route::post('/messages/activate/{id}'            , 'MessagesController@activate');
            Route::get('/message/hide/{id}'            , 'MessagesController@hideMessage');
            Route::get('/message/hideAll'            , 'MessagesController@hideAll');
            Route::get('/message/showAll'            , 'MessagesController@showAll');
            
            Route::resource('notifications', 'NotificationsController');
            Route::post('/notification/ban/{id}'            , 'NotificationsController@ban');
            Route::post('/notification/activate/{id}'            , 'NotificationsController@activate');

            Route::resource('admins', 'SupervisorsController');
            Route::post('/admin/ban/{id}'            , 'SupervisorsController@ban');
            Route::post('/admin/activate/{id}'            , 'SupervisorsController@activate');
            
            Route::get('/UsersReport'            , 'ReportsController@UsersReport');
            Route::get('/paymentsReport'            , 'ReportsController@paymentsReport');

            Route::get('favs',['uses' => 'UsersListController@lists', 'type' => 1]);
            Route::get('ignors',['uses' => 'UsersListController@lists', 'type' => 0]);
            Route::get('photos',['uses' => 'UsersListController@lists', 'type' => 2]);

            Route::get('/chats'            , 'ChatController@index');
            Route::get('/chats/{id}'            , 'ChatController@show');


            Route::resource('agents', 'AgentsController');
            Route::post('/agent/addCopouns/{id}'            , 'AgentsController@addCopouns');
            
            Route::resource('coupons', 'CouponsController');
			Route::get('/coupon/deleteAllCopouns'            , 'CouponsController@deleteAllCopouns');
			
			Route::resource('telesales', 'TelesalesController');

        });


    });
});

// });