@extends('layout.main')

@section('content')
    <form action="{{{URL::route('account-create-post')}}}" method="post">
        <div class="field">
            Name : <input type="text" placeholder="username" name="username" value="{{{Input::old('username')}}}">
            @if($errors->has('username'))
                {{$errors->first('username')}}
            @endif
         </div>

        <div class="field">
            Email : <input type="text" placeholder="email" name="email"{{(Input::old('email') ? 'value="' .e(Input::old('email')). '"' : '' )}} >
            @if($errors->has('email'))
                {{$errors->first('email')}}
            @endif
        </div>
        <div class="field">
            Password : <input type="password" placeholder="password" name="password">
        @if($errors->has('username'))
            {{$errors->first('password')}}
        @endif
        </div>
        <div class="field">
            Password again : <input type="password" placeholder="password" name="password_again">
            @if($errors->has('username'))
                {{$errors->first('password_again')}}
            @endif
        </div>

        <input type="submit" value="post">
        {{ Form::token() }}
    </form>
@stop
