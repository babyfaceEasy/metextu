@extends('layouts.prod')

@section('content')

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    @include('inc.status')
    <div class=" card-box">
    <div class="panel-heading"> 
        <h3 class="text-center"> <img src="{{ asset('images/app.png') }}"> <strong class="text-custom"></strong> </h3>
    </div> 


    <div class="panel-body">
    <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    Enter your <b>Email</b> and instructions will be sent to you!
                </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{ old('email') }}" required autofocus placeholder="Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group ">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="checkbox-signup">
                            {{ __('Remember Me') }}
                    </label>
                </div>
                
            </div>
        </div>
        
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Login') }}</button>
            </div>
        </div>

        <div class="form-group m-t-30 m-b-0">
            <div class="col-sm-12">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
    </form> 
    
    </div>   
    </div>                              
        <div class="row">
        <div class="col-sm-12 text-center">
            <p>Don't have an account? 
                <a href="{{ route('register') }}" class="text-primary m-l-5">
                    <b>{{ __('Register') }}</b>
                </a>
            </p>
                
            </div>
    </div>
    
</div>
@endsection