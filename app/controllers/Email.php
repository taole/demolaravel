<?php
/**
 * Created by PhpStorm.
 * User: taoln
 * Date: 12/23/14
 * Time: 10:27 AM
 */

class Email extends BaseController {

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

    public function send_email($from,$to,$subject,$mail_content,$template_mail){

        Mail::send($template_mail,array('name'=>$to),function($message,$subject,$to,$mail_content){
            $message->to($to,'This is test mail')->subject($subject);
        });

    }
}
