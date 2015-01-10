@extends('layout.main')
@section('content')
    <form action="{{{URL::route('account-sign-in-post')}}}" method="post">
        <div class="field">
            Name : <input type="text" placeholder="username" name="username" value="{{{Input::old('username')}}}">
            @if($errors->has('username'))
                {{$errors->first('username')}}
            @endif
        </div>
        <div class="field">
            Password : <input type="password" placeholder="password" name="password" value="{{{Input::old('password')}}}">
            @if($errors->has('password'))
                {{$errors->first('password')}}
            @endif
        </div>
        {{Form::token()}}
        <div class="field">
            <input type="checkbox" name="remember" id="remember" >
            <label for="remember">Remember me</label>
            @if($errors->has('password'))
                {{$errors->first('password')}}
            @endif
        </div>
        <input value="SignIn" type="submit">
    </form>
@stop