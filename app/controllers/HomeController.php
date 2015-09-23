<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome($param)
	{		
		$user = new User;
		echo $user->getReminderEmail();
		//return View::make('hello');
		//return View::make('hello')->nest('name', 'Steve');
		return View::make('hello')->with('name', 'Steve');
	}

	public function redirectPage($param)
	{
		return Redirect::route('login', array('page' => $param));
		//return Redirect::route('login')->with('page', $param);
	}
}
?>