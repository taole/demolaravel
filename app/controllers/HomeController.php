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

	/*public function showWelcome()
	{
		return View::make('hello');
	}*/
    public function home(){
        return View::make('index');
    }

    /*public function send_email(){

        Mail::send('emails.auth.test',array('name'=>'Me'),function($message){
            $message->to('hopthucualetao@gmail.com','This is test mail')->subject('Test mail');
        });

        return View::make('home');
    }*/
}
