@extends('layouts.logged_in')
@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->                      
    <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    @include('inc.quick_links')

                    <div class="row">
                        <div class="col-sm-12">
                            @include('inc.status')
                        </div>
                    </div>
                    
                    
                    <div class="row">

                            
                        
                        <div class="col-lg-12 col-md-12"> 
                            <ul class="nav nav-tabs navtab-bg nav-justified"> 
                                <li class="active"> 
                                    <a href="#home1" data-toggle="tab" aria-expanded="true"> 
                                        <span class="visible-xs"><i class="fa fa-user"></i> Profile Settings</span> 
                                        <span class="hidden-xs">Profile Setting</span> 
                                    </a> 
                                </li> 
                                <li> 
                                    <a href="#profile1" data-toggle="tab" aria-expanded="false"> 
                                        <span class="visible-xs"><i class="fa fa-key"></i> Reset Password</span> 
                                        <span class="hidden-xs">Password Reset</span> 
                                    </a> 
                                </li> 
                                
                            </ul> 
                            <div class="tab-content"> 
                                <div class="tab-pane active" id="home1"> 
                                    
            <div class="card-box">
                    
                <form method="POST" name="sms" action="{{ route('update.profile') }}">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-2 control-label">email</label>
                        <div class="col-md-10" style="margin-bottom: 20px;">
                            <input type="email" class="form-control" value="{{Auth::user()->email}}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="example-email">Phone</label>
                            <div class="col-md-10">
                            <input id="phone_number" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') ? old('phone_number') : Auth::user()->phone_number }}" required>
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                            </div>
                    </div>
                    <hr/>
                                
        
                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="example-email">username</label>
                            <div class="col-md-10">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') ? old('username') : Auth::user()->username }}" required>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                            </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 control-label" for="example-email">Name</label>
                            <div class="col-md-10">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : Auth::user()->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                    </div>
                

                    <!--<div class="form-group row">
                        <label class="col-md-2 control-label">Last Name</label>
                        <div class="col-md-10" style="margin-bottom: 20px;">
                            <input type="text" class="form-control" placeholder="Last Name ">
                        </div>
                    </div>-->
                    
                                        
                    


                    <div class="row">
                    <hr>
                    <div class="form-group fred col-md-8">
                        
                        
                            <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> <span>Update Profile</span><i class="fa fa-user m-l-10"></i> </button>
                        
                    </div>
                    </div>
                    
                    
                
                </form>
            </div>
            
                                </div> 
                                <div class="tab-pane" id="profile1"> 
                                    
                                    <form method="post" name="sms" action="{{ route('change.password') }}">
                                        {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-md-4 control-label">Current Password</label>
                        <div class="col-md-8" style="margin-bottom: 20px;">
                            <input id="old_password" type="password" class="form-control{{ $errors->has('') ? ' is-invalid' : '' }}" name="old_password" required>
                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="clearfix"></div> 
                    <div class="form-group row">
                        <label class="col-md-4 control-label" for="example-email">New Password</label>
                            <div class="col-md-8">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>
                    </div>
                    <div class="clearfix"></div> 
                    <div class="form-group row">
                        <label class="col-md-4 control-label" for="example-email">Confirm Password</label>
                            <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                    </div>
                    
<div class="clearfix"></div>

                    <div class="row">
                    <hr/>
                    <div class="form-group fred col-md-8">
                        
                        
                            <button class="btn btn-purple waves-effect waves-light pull-right" type="submit"> <span>Update Password</span> <i class="fa fa-key m-l-10"></i> </button>
                        
                    </div>
                    </div>
                    
                    
                
                </form>
                                
                            </div> 
                        </div> 
                    </div>
                    

                    <!-- End row -->
                    
                    


                </div> <!-- container -->
                            
            </div> <!-- content -->
@endsection()