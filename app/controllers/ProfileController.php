<?php
class ProfileController extends BaseController {

    /*get profile by user name*/
    public function user($username){

        $user = User::where('username', '=', $username);

        if($user->count()){

            $user   =   $user->first();
           
            /*return View::make('profile.user')
                ->with('user', $user);*/
                return $user;
        }

        return App::about(404);
    }

    /*get all user*/
    public function users(){
    	return $user = User::all();
    }

}