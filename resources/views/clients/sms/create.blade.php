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
                        <div class="card-box">
                            <form method="POST" action="{{ route('send.sms') }}">
                                    {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-2 control-label">Sender</label>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <input type="text" class="form-control" value="{{Auth::user()->username}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="radio radio-primary col-md-2">
                        <input id="radio1" type="radio" name="category">
                        <label for="radio1">
                        Use my Username
                        </label>

                    </div>
                    <div class="radio radio-primary col-md-2 fred">
                        <input id="radio1" type="radio" name="category">
                        <label for="radio1">
                        Use my Phone Number
                        </label>
                    </div>
                </div>
                                        <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="example-email">Phone</label>
                        <div class="col-md-4">
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="+2348125689235, +2347058654128">
                        </div>
                </div>
                <div class="form-group ">
                                            <label class="col-sm-2 control-label">Or Select Address Book</label><div class="col-sm-4 fred2" >

                                                <select class="form-control">

                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>

                                            </div>
                                        </div>

                        <div class="clearfix"></div>


                <label >Message</label>
                <textarea id="elm1" name="area" class="col-md-10 col-md-offset-2 form-control"></textarea>
<div class="clearfix"></div>

                <div class="row">
                <div class="form-group fred">


                        <button class="btn btn-purple waves-effect waves-light pull-right"> <span>Send SMS</span> <i class="fa fa-send m-l-10"></i> </button>

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