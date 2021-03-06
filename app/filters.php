<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    /*
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *'); //GET, POST, OPTIONS
    header('Access-Control-Allow-Headers: *'); //Origin, Content-*, Accept, Authorization, X-Request-With
    header('Access-Control-Allow-Credentials: true');
    */
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth.adminapi',function($route,$request){
    $apikey = $request->header('apikey');
    $subscription = ApiKey::check($apikey)->first()->subscription->user;
    dd($subscription);
    $userModel = Sentry::getUserProvider()->createModel();

    $user =  $userModel->where('api_token',$payload)->first();

    if(!$payload || !$user) {

        $response = Response::json([
                'error' => true,
                'message' => 'Not authenticated',
                'code' => 401],
            401
        );

        $response->header('Content-Type', 'application/json');
        return $response;
    }

});
Route::filter('auth', function()
{
	/*if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}*/
    if (!Sentry::check()) return Redirect::route('login');
});

Route::filter('apikey',function(){
    $api = ApiKey::check(Input::get('apikey'));
    if($api->count()==0)
        return Response::make('Unauthorized', 401);
    Session::forget('sid');
    Session::push('sid',''.$api->first()->subscription_id);
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Sentry::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
