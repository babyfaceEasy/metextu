@extends('layouts.prod')

@section('content')
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    @include('inc.status')
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> <img src="{{ asset('images/app.png') }}"> </h3>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route('password.email') }}" role="form" class="text-center">
                {{ csrf_field() }}
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    Enter your <b>Email</b> and instructions will be sent to you!
                </div>
                <div class="form-group m-b-0">
                    <div class="input-group">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-purple w-sm waves-effect waves-light">
                                {{ __('Send Password Reset Link') }}
                            </button> 
                        </span>
                    </div>
                </div>

            </form>
        </div>
    </div>
    

</div>
@endsection
