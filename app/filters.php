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
	//
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

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::route("user/login");
});

Route::filter('auth.admin', function()
{
    if (Auth::user()->permission != "administrator") 
    	return Redirect::to('/')->with('error', 'You are not allowed to access this location');
});

Route::filter('auth.teacher', function()
{
    if (Auth::user() && Auth::user()->permission != "teacher")
    	return Redirect::to('/')->with('error', 'You are not allowed to access this location');    	
});

Route::filter('auth.student', function()
{
    if (Auth::user() && Auth::user()->permission != "student")
    	return Redirect::to('/')->with('error', 'You are not allowed to access this location');  
});


App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);

        case 404:
            return Response::view('errors.404', array(), 404);

        //case 500:
        //    return Response::view('errors.500', array(), 500);
    }
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

// Route::filter("guest", function()
// {
//     if (Auth::guest())
//     {
//         return Redirect::route("user/login");
//     }
// });

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

Route::filter("csrf", function()
{
    if (Session::token() != Input::get("_token"))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});