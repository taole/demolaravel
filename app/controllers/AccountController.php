<?php
/**
 * Created by PhpStorm.
 * User: taoln
 * Date: 12/22/14
 * Time: 5:09 PM
 */
class AccountController extends BaseController{

//================ GET ==================

    public function getCreate(){
        return View::make('account.create');
    }

    public function getActivate($code){
        $user = User::where('code','=',$code)->where('active','=',0);

        if($user->count()){
            $user           =   $user->first();
            $user->code     =   '';
            $user->active   =   1;

            if($user->save()){
                return Redirect::route('home')
                    ->with('global','You can now sign in !');
            }
        }
        return Redirect::route('home')
            ->with('global','Please try again !');

    }

    public function getSignIn(){
        return View::make('account.signin');
    }

    public function getSignOut(){
        Auth::logout();
        Session::forget('token');
        return Redirect::route('home');
    }

    public function getChangePassword(){
        return View::make('account.password');
    }

    public function getForgotPassword(){
        return View::make('account.forgot-password');
    }

//================ POST ================

    public function postCreate(){
        $validator = Validator::make(Input::all(),
            array(
                'email'=>'required|max:50|email|unique:users',
                'username'=>'required|max:60|min:3|unique:users',
                'password'=>'required|min:6',
                'password_again'=>'required|same:password'
            )
        );
        if($validator->fails()){
            return Redirect::route('account-create')->withErrors($validator)->withInput();
        }else{
            $email      =   Input::get('email');
            $username   =   Input::get('username');
            $password   =   Input::get('password');

            //Activation code
            $code       =   str_random(60);

            $user = User::create(array(
                'email'     =>  $email,
                'username'  =>  $username,
                'password'  =>  Hash::make($password),
                'code'      =>  $code,
                'active'    =>  0
            ));
            if($user){

                Mail::send('emails.auth.active',array('link'=>URL::route('account-active',$code),'username'=>$username),function($message)use ($user) {

                    $message->to($user->email,$user->username)->subject('Activate your account');
                });

                return Redirect::route('home')->with('global','Please check you mail and active your account ');
            }


        }
    }

    public function postSignIn(){
        $validator = Validator::make(Input::all(),
            array(
                'username'=>'required',
                'password'=>'required',
            )
        );

        if($validator->fails()){
            return Redirect::route('account-sign-in-get')
                ->withErrors($validator)
                ->withInput();
        }else{

            $remember =(Input::has('remember')) ? true : false;

            $auth = Auth::attempt(array(
                'username'=> Input::get('username'),
                'password'=> Input::get('password'),
                'active'  => 1
            ),$remember);
            if($auth){
                Session::put('token', csrf_token());
                return Session::get('token');
            }else{
                return false;
                /*return Redirect::route('account-sign-in-get')
                    ->with('global','Username/Password wrong, or account not activated.');*/
            }

        }
        /*return Redirect::route('account-sign-in')
            ->with('global','There was a problem sign you in.');*/
            return false;
    }

    public function postChangePassword(){

        $validator = Validator::make(Input::all(),
            array(
                'old_password'=>'required|',
                'password'=>'required|min:6',
                'password_again'=>'required|same:password'
            )
        );

        if($validator->fails()){
            return Redirect::route('account-change-password')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $user           =   User::find(Auth::user()->id);

            $old_password   =   Input::get('old_password');
            $password       =   Input::get('password');

            if( Hash::check($old_password, $user->getAuthPassword() ) ){
                $user->password = Hash::make($password);

                if($user->save()){

                    return Redirect::route('home')->with('global','Your password has been changed');
                }
            }else{

                return Redirect::route('home')->with('global','Password wrong');
            }
        }
        return Redirect::route('home')->with('global','Your password could not be changed');

    }

    public function postForgotPassword(){
        $validator = Validator::make(Input::get('email'),
            array(
                'email'=>'required|email'
            )
        );

        if($validator->fails()){
            return Redirect::route('account-forgot-password')->withErrors($validator)->withInput();
        }else{

        }
        return Redirect::route('account-forgot-password')->with('global','Could not request new password');

    }
//================ DELETE ================
    public function deleteById($id){
        $user = User::find($id);
        $user->delete();        
        return 0;
    }


}