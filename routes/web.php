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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    //Vertical
    Route::get('vertical','VerticalController@verticalList');
    Route::get('add_vertical','VerticalController@verticalCreate');
    Route::post('save_vertical','VerticalController@saveVertical');
    Route::get('edit_vertical','VerticalController@edit');
    Route::post('update_vertical/{id}','VerticalController@update');
    //Service Category
    Route::get('category','CategoryController@categoryList');
    Route::get('add_category','CategoryController@categoryCreate');
    Route::post('save_category','CategoryController@saveCategory');
    Route::get('edit_category','CategoryController@edit');
    Route::post('update_category/{id}','CategoryController@update');
    //Services
    Route::get('services','ServiceController@serviceList');
    Route::get('add_service','ServiceController@serviceCreate');
    Route::post('save_service','ServiceController@saveService');
    Route::get('edit_service','ServiceController@editService');
    Route::post('update_service/{id}','ServiceController@update');
    //Subscription
    Route::get('subscription','SubscriptionController@listSubscription');
    Route::get('add_subscription','SubscriptionController@addSubscription');
    Route::post('save_subscription','SubscriptionController@saveSubscription');
    Route::get('edit_subscription','SubscriptionController@editSubscription');
    Route::post('update_subscription/{id}','SubscriptionController@update');
    //Subscription field
    Route::get('client_form','SubscriptionController@clientForm');
    Route::post('save_client_field','SubscriptionController@saveClientField');
    Route::get('office_form','SubscriptionController@officeForm');
    Route::post('save_office_field','SubscriptionController@saveOfficeField');
    //User Subscribed field
    Route::get('user_subscrbed_field','UserSubscribedfield@showSubfield');
    Route::get('get_subscribeservices','UserSubscribedfield@showServices');
    Route::get('show_client_form','UserSubscribedfield@showClientForm');
    Route::post('update_office_data','UserSubscribedfield@updateOfficefield');
    
});
