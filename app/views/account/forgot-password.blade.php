@extends('layout.main')

@section('content')

 <form action="{{{URL::route('account-forgot-password-post')}}}" method="post">
    <div class="field">
        Email : <input type="email" placeholder="email" name="email">
        @if($errors->has('email'))
            {{$errors->first('email')}}
        @endif
    </div>
    {{ Form::token() }}
    <input type="submit" name="Forgot Password">
 </form>

@stop