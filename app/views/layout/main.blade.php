<?php
/**
 * Created by PhpStorm.
 * User: taoln
 * Date: 12/22/14
 * Time: 3:26 PM
 */
 ?>
 <!DOCTYPE html>
 <html>
     <head>
         <title>Test email</title>
     </head>
     <body>
     @if(Session::has('global'))
        <p>{{ Session::get('global') }}</p>
     @endif

     @include('layout.navigation')
     @yield('content')
     </body>
 </html>