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

Route::get('/',array(
    'as'=>'home',
    'uses'=>'HomeController@home'
));


/*Route::get('profile', array('before' => 'auth.basic', function(){
    // Only authenticated users may enter...
    return View::make('hello');

}));*/
Route::group( array('before'=>'auth'), function(){
    Route::get('/users',array(
        'as'=>'profile-user',
        'uses'=>'ProfileController@users'
    ));
    // Route::get('/user/{username}',array(
    //     'as'=>'profile-user',
    //     'uses'=>'ProfileController@user'
    // ));
});

/*Route::get('/send-email',array(
    'as'=>'send-email',
    'uses'=>'HomeController@send_email'
));*/

/*==================== USER =========================*/
    //Sign in account (POST)
    Route::post('/account/sign-in',array(
        'as'=>'account-sign-in-post',
        'uses'=>'AccountController@postSignIn'
    ));
Route::group( array('before' => 'guest'), function(){


    

    /*Route::group( array('before' => 'csrf'), function(){

        //Create account (POST)
        Route::post('/account/create',array(
            'as'=>'account-create-post',
            'uses'=>'AccountController@postCreate'
        ));

        //Sign in account (POST)
        Route::post('/account/sign-in',array(
            'as'=>'account-sign-in-post',
            'uses'=>'AccountController@postSignIn'
        ));

        //Forgot password (POST)
        Route::get('/account/forgot-password',array(
            'as'=>'account-forgot-password-post',
            'uses'=>'AccountController@postForgotPassword'
        ));

    });
*/

    //Sign in account (GET)
    Route::get('/account/sign-in',array(
        'as'=>'account-sign-in-get',
        'uses'=>'AccountController@getSignIn'
    ));

    //Create account (GET)
    Route::get('/account/create',array(
        'as'=>'account-create',
        'uses'=>'AccountController@getCreate'
    ));
    //Active account (GET)
    Route::get('/account/active/{code}',array(
        'as'=>'account-active',
        'uses'=>'AccountController@getActivate'
    ));
    //Forgot password (GET)
    Route::get('/account/forgot-password',array(
        'as'=>'account-forgot-password',
        'uses'=>'AccountController@getForgotPassword'
    ));

});

Route::group( array('before' => 'auth'), function(){

    //Delete Account (POST)
        Route::delete('/account/{id}',array(
            'as'=>'account-delete',
            'uses'=>'AccountController@deleteById'
        ));

    Route::group( array('before' => 'csrf'), function(){

        //Change Account (POST)
        Route::post('/account/change-password',array(
            'as'=>'account-change-password-post',
            'uses'=>'AccountController@postChangePassword'
        ));

        

    });

    /*  Sign Out*/
    Route::get('/account/sign-out',array(
        'as'=>'account-sign-out',
        'uses'=>'AccountController@getSignOut'
    ));

    //Change password (GET)
    Route::get('/account/change-password',array(
        'as'=>'account-change-password',
        'uses'=>'AccountController@getChangePassword'
    ));

});

//
/*Route::get( '/{all_link}', function () {
    echo 'Link nay ko ton tai nhe !';
})->where('all_link', '.*');*/
