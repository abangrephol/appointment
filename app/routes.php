<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::api(['version'   =>  'v1' , 'prefix' => 'api','before'=>'apikey'],function(){
    Route::get('customer',function()
    {
        return Customer::all(array('first'))->toJson() ;
    });
    Route::group(['prefix'=>'setting'],function(){
        Route::get('days',function(){
            return Setting::get(Session::get('sid')[0].'.app.bussinessHour') ;
        });
        Route::get('currency',function(){
            return Setting::get(Session::get('sid')[0].'.app.currency') ;
        });
    });
    Route::group(array('prefix'=>'services'),function(){
        Route::get('/',function(){
            return Subscription::find(Session::get('sid'))->first()->service->toJson();
        });
    });
    Route::group(array('prefix'=>'angview'),function(){
        Route::get('index','AngularController@index');
        Route::get('services','AngularController@services');
        Route::get('serviceDetail','AngularController@serviceDetail');
        Route::get('timeAvailable','AngularController@timeAvailable');
        Route::get('cart','AngularController@cart');
        Route::get('checkout','AngularController@checkout');
    });
    Route::get('/','SiteController@iframe');
});
Route::get('login', array('as'=>'login','uses'=>"SiteController@login") );
Route::post('login', function(){
    $user = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );

    if (Auth::attempt($user,true)) {
        return Redirect::to('/')
            ->with('flash_notice', 'You are successfully logged in.');
    }

    // authentication failure! lets go back to the login page
    return Redirect::to('login')
        ->with('flash_error', 'Your username/password combination was incorrect.')
        ->withInput();
} );
Route::get('logout', array('as' => 'logout', function () {
    Auth::logout();

    return Redirect::route('login')
        ->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');

Route::get('frontend', "SiteController@frontend_index");
Route::get('front', "SiteController@frontend");
Route::get('appsys', "SiteController@feScript");

Route::group(array('before'=>'auth'),function(){
    Route::get('/',array( "uses"=>"SiteController@index"));

    Route::get('dashboard', "SiteController@dashboard");
    Route::group(array('prefix'=>'setting'),function(){
        Route::get('/',array('as'=>'setting','uses'=>'SiteController@setting'));
       Route::get('general',array('as'=>'setting.general','uses'=>'SiteController@settingGeneral'));
        Route::get('hours',array('as'=>'setting.hours','uses'=>'SiteController@settingHour'));
        Route::post('hours',array('as'=>'setting.hours','uses'=>function(){
                try{
                    Setting::set(Auth::user()->subscription_id.'.app.bussinessHour',Input::get('data'));
                    return Response::json(array('message'=>'Succeed save Business Hours.'));
                }catch (Exception $e){
                    return Response::json(array('message'=>'Failure to save data'));
                }
            }));
    });

    Route::resource("apikey","ApiKeysController");
    Route::resource("appointment","AppointmentsController");
    Route::resource("appservice","AppointmentServicesController");
    Route::resource("customer","CustomersController");
    Route::resource("employee","EmployeesController");
    Route::resource("payment","PaymentsController");
    Route::resource("serviceloc","ServiceLocationsController");
    Route::resource("service","ServicesController");
    Route::resource("subscription","SubscriptionsController");
    Route::resource("user","UsersController");

    Route::post("appointment/{id}","AppointmentsController@update");
    Route::get('/appointment/delete/{id}',"AppointmentsController@delete");
    Route::delete('appointment/delete/{id}',"AppointmentsController@destroy");

    Route::post("user/{id}","UsersController@update");
    Route::get('/user/delete/{id}',"UsersController@delete");
    Route::delete('user/delete/{id}',"UsersController@destroy");


    Route::post("employee/{id}","EmployeesController@update");
    Route::get('/employee/delete/{id}',"EmployeesController@delete");
    Route::delete('employee/delete/{id}',"EmployeesController@destroy");


    Route::post("customer/{id}","CustomersController@update");
    Route::get('/customer/delete/{id}',"CustomersController@delete");
    Route::delete('customer/delete/{id}',"CustomersController@destroy");
    Route::get('customer/json/{id}',array('as'=>'json.customer','uses'=>'CustomersController@getCustomerData'));

    Route::post("service/{id}","ServicesController@update");
    Route::get('/service/delete/{id}',"ServicesController@delete");
    Route::delete('service/delete/{id}',"ServicesController@destroy");


    Route::post("serviceloc/{id}","ServiceLocationsController@update");
    Route::get('/serviceloc/delete/{id}',"ServiceLocationsController@delete");
    Route::delete('serviceloc/delete/{id}',"ServiceLocationsController@destroy");

    Route::group(array('prefix'=>'dt'),function(){
        Route::get('users', array('as'=>'dt.users', 'uses'=>'UsersController@getDatatableAll'));
        Route::get('employees', array('as'=>'dt.employees', 'uses'=>'EmployeesController@getDatatableAll'));
        Route::group(array('prefix'=>'customers'),function(){
            Route::get('default', array('as'=>'dt.customers', 'uses'=>'CustomersController@getDatatableAll'));
            Route::get('appointment', array('as'=>'dt.customers.appointment', 'uses'=>'CustomersController@getDatatableAll'));
        });

        Route::get('services', array('as'=>'dt.services', 'uses'=>'ServicesController@getDatatableAll'));
        Route::get('servicelocs', array('as'=>'dt.servicelocs', 'uses'=>'ServiceLocationsController@getDatatableAll'));
        Route::get('appointments', array('as'=>'dt.appointments', 'uses'=>'AppointmentsController@getDatatableAll'));
    });

    Route::get('tab/service/{tabId}/{id}',array('as'=>'tab.service','uses'=>'ServicesController@tab'));

    Route::group(array('prefix'=>'tab/app'),function(){
        Route::get('service',array('as'=>'tab.app.service','uses'=>'AppointmentsController@tabAppService'));
        Route::group(array('prefix'=>'customer'),function(){
            Route::get('/',array('as'=>'tab.app.customer','uses'=>'AppointmentsController@tabAppCustomer'));
            Route::get('view',array('as'=>'tab.app.customer.view','uses'=>'AppointmentsController@tabAppCustomerView'));
        });

        Route::get('confirm',array('as'=>'tab.app.confirm','uses'=>'AppointmentsController@tabAppConfirm'));
    });

    Route::get('w/ta/{date}/{data}',array('as'=>'w.ta','uses'=>'AppointmentsController@getAvailableTime'));
});
