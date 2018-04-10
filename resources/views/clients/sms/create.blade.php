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
                @include('inc.quick_links', ['page_title' => 'Send SMS'])


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <form method="POST" action="{{ route('send.sms') }}">
                                    {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-2 control-label">Sender</label>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="text" disabled="disabled" class="form-control" value="{{Auth::user()->username}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="radio radio-primary col-md-2">
                        <input id="radio1" type="radio" name="sender_name" value="{{Auth::user()->username}}">
                        <label for="radio1">
                        Use my Username
                        </label>
                        @if ($errors->has('sender_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('sender_name') }}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="radio radio-primary col-md-2 fred">
                        <!--<input id="radio1" type="radio" name="category">-->
                        <input id="radio1" type="radio" name="sender_name" value="{{Auth::user()->phone_number}}">
                        <label for="radio1">
                        Use my Phone Number
                        </label>
                    </div>
                </div>
                                        <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-email">Phone</label>
                        <div class="col-md-4">
                        <input type="text" id="dst_nos" name="dst_nos" class="form-control" placeholder="+2348125689235, +2347058654128">
                        @if ($errors->has('dst_nos'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('dst_nos') }}</strong>
                            </span>
                        @endif
                        </div>
                </div>
                <div class="form-group ">
                                            <label class="col-sm-2 control-label">Or Select Address Book</label><div class="col-sm-4 fred2" >

                                                <select name="group_nos" class="form-control">
                                                    @forelse ($groups as $group)
                                                        <option value="{{$group->id}}">{{$group->gname}}</option>
                                                    @empty
                                                        <option value="">No groups available for you</option>
                                                    @endforelse
                                                </select>

                                            </div>
                                            @if ($errors->has('group_nos'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('group_nos') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                        <div class="clearfix"></div>


                <label >Message</label>
                                    <textarea id="elm1" name="message" class="col-md-10 col-md-offset-2 form-control">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
<div class="clearfix"></div>

                <div class="row">
                <div class="form-group fred">


                        <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> <span>Send SMS</span> <i class="fa fa-send m-l-10"></i> </button>

                </div>
                </div>



                            </form>
                        </div>
                    </div>
                </div>

                <!-- End row -->




            </div> <!-- container -->

        </div> <!-- content -->
@endsection