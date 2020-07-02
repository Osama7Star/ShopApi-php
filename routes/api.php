<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function () {
    return [
        'app' => 'Laravel 6 API ',
        'version' => '1.0.0',
    ];
});


Route::group(['namespace' => 'Auth'], function () {

    Route::post('auth/login', ['as' => 'login', 'uses' => 'AuthController@login']);

    Route::post('auth/register', ['as' => 'register', 'uses' => 'RegisterController@register']);
    // Send reset password mail
    Route::post('auth/recovery', 'ForgotPasswordController@sendPasswordResetLink');
    // handle reset password form process
    Route::post('auth/reset', 'ResetPasswordController@callResetPassword');

});

Route::group(['middleware' => ['jwt', 'jwt.auth']], function () {

    Route::group(['namespace' => 'Profile'], function () {

        Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@me']);

        Route::post('updateProfile', ['as' => 'updateProfile', 'uses' => 'ProfileController@updateProfile']);

        Route::put('profile/password', ['as' => 'profile', 'uses' => 'ProfileController@updatePassword']);        
    });

    Route::group(['namespace' => 'Admin'], function () {

        Route::post('createProducer', ['as' => 'createProducer', 'uses' => 'AdminController@createProducer']);
        
        Route::post('deleteProducer', ['as' => 'deleteProducer', 'uses' => 'AdminController@deleteProducer']);
        
        Route::post('editProducer', ['as' => 'editProducer', 'uses' => 'AdminController@editProducer']);
        
        Route::post('createCar', ['as' => 'createCar', 'uses' => 'AdminController@createCar']);
        
        Route::post('deleteCar', ['as' => 'deleteCar', 'uses' => 'AdminController@deleteCar']);
        
        Route::post('editCar', ['as' => 'editCar', 'uses' => 'AdminController@editCar']);
        
        Route::post('getAgencyCarList', ['as' => 'getAgencyCarList', 'uses' => 'AdminController@getAgencyCarList']);        
        
        Route::post('carPublish', ['as' => 'carPublish', 'uses' => 'AdminController@carPublish']);
        
        Route::post('carUnpublish', ['as' => 'carUnpublish', 'uses' => 'AdminController@carUnpublish']);
        
        Route::get('getUserList', ['as' => 'getUserList', 'uses' => 'AdminController@getUserList']);
        
        Route::post('susbendUser', ['as' => 'susbendUser', 'uses' => 'AdminController@susbendUser']);
        
        Route::post('unSusbendUser', ['as' => 'unSusbendUser', 'uses' => 'AdminController@unSusbendUser']);
        
        Route::post('activiateUser', ['as' => 'activiateUser', 'uses' => 'AdminController@activiateUser']);
        
        Route::post('deActiviateUser', ['as' => 'deActiviateUser', 'uses' => 'AdminController@deActiviateUser']);
        
        Route::post('getUser', ['as' => 'getUser', 'uses' => 'AdminController@getUser']);
        
        Route::get('getCarCount', ['as' => 'getCarCount', 'uses' => 'AdminController@getCarCount']);
        
        Route::get('getCarList', ['as' => 'getCarList', 'uses' => 'AdminController@getCarList']);
        
        Route::get('getSoldCarCount', ['as' => 'getSoldCarCount', 'uses' => 'AdminController@getSoldCarCount']);
        
        Route::get('getSoldCarList', ['as' => 'getSoldCarList', 'uses' => 'AdminController@getSoldCarList']);
        
        Route::get('getWaitingCarList', ['as' => 'getWaitingCarList', 'uses' => 'AdminController@getWaitingCarList']);
        
        Route::get('getWaitingCarCount', ['as' => 'getWaitingCarCount', 'uses' => 'AdminController@getWaitingCarCount']);
        
        Route::get('getWaitingUserCount', ['as' => 'getWaitingUserCount', 'uses' => 'AdminController@getWaitingUserCount']);
        
        Route::get('getWaitingUserList', ['as' => 'getWaitingUserList', 'uses' => 'AdminController@getWaitingUserList']);
        
        Route::get('getUserCount', ['as' => 'getUserCount', 'uses' => 'AdminController@getUserCount']);
    
        Route::get('getAgencyList', ['as' => 'getAgencyList', 'uses' => 'AdminController@getAgencyList']);

    });

    Route::group(['namespace' => 'Agency'], function () {

        Route::get('getProducerList', ['as' => 'getProducerList', 'uses' => 'AgencyController@getProducerList']);
        
        Route::post('getProducer', ['as' => 'getProducer', 'uses' => 'AgencyController@getProducer']);

        Route::post('createCar', ['as' => 'createCar', 'uses' => 'AgencyController@createCar']);
        
        Route::post('deleteCar', ['as' => 'deleteCar', 'uses' => 'AgencyController@deleteCar']);
        
        Route::post('editCar', ['as' => 'editCar', 'uses' => 'AgencyController@editCar']);
        
        Route::post('getAgencyCarList', ['as' => 'getAgencyCarList', 'uses' => 'AgencyController@getAgencyCarList']);
        
        Route::post('getAgencySoldCarList', ['as' => 'getAgencySoldCarList', 'uses' => 'AgencyController@getAgencySoldCarList']);
        
        Route::post('getAgencyWaitingCarList', ['as' => 'getAgencyWaitingCarList', 'uses' => 'AgencyController@getAgencyWaitingCarList']);

        Route::post('searchCar', ['as' => 'searchCar', 'uses' => 'AgencyController@searchCar']);
        
        Route::post('getCar', ['as' => 'getCar', 'uses' => 'AgencyController@getCar']);

        Route::post('addCarImages', ['as' => 'addCarImages', 'uses' => 'AgencyController@addCarImages']);
        
        Route::post('addAgencyLocation', ['as' => 'addAgencyLocation', 'uses' => 'AgencyController@addAgencyLocation']);
        
        Route::post('getAgencyLocation', ['as' => 'getAgencyLocation', 'uses' => 'AgencyController@getAgencyLocation']);
        
        Route::post('editAgencyLocation', ['as' => 'editAgencyLocation', 'uses' => 'AgencyController@editAgencyLocation']);
        
        Route::post('deleteImage', ['as' => 'deleteImage', 'uses' => 'AgencyController@deleteImage']);
        
        Route::post('getCarViews', ['as' => 'getCarViews', 'uses' => 'AgencyController@getCarViews']);
                
        Route::post('getAgencyCarCount', ['as' => 'getAgencyCarCount', 'uses' => 'AgencyController@getAgencyCarCount']);
        
        Route::post('getAgencySoldCarCount', ['as' => 'getAgencySoldCarCount', 'uses' => 'AgencyController@getAgencySoldCarCount']);
        
        Route::post('getAgencyWaitingCarCount', ['as' => 'getAgencyWaitingCarCount', 'uses' => 'AgencyController@getAgencyWaitingCarCount']);
        
    });


    Route::group(['namespace' => 'Auth'], function () {

        Route::post('auth/logout', ['as' => 'logout', 'uses' => 'LogoutController@logout']);

    });



});




    //////////////////////////////
    ////// PRODUCTS 
    Route::group(['namespace' => 'Product'], function () {

        Route::get('getProduct', ['as' => 'getProduct', 'uses' => 'ProductController@getProduct']);
       
        
    });

    
