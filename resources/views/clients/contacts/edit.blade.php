@extends('layouts.logged_in')
@section('content')
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container">
                            @include('inc.status')
                            <!-- Page-Title -->
                            @include('inc.quick_links', ['page_title' => 'Edit Contact'])
    
    
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <form method="POST" action="{{ route('groups.contacts.update', [ 'contact' => $contact, 'group' => $group ]) }}">
                          
                                        {{ csrf_field() }} {{ method_field('put') }}
    
                            <label >Contact Name:</label>
                            <!--<textarea id="elm1" name="area" class="col-md-10 col-md-offset-2 form-control"></textarea>-->
                            <input id="cname" type="text" class="form-control{{ $errors->has('cname') ? ' is-invalid' : '' }}" name="cname" value="{{ old('cname') ? old('cname') : $contact->cname }}" required autofocus>
    
                            @if ($errors->has('cname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('cname') }}</strong>
                                </span>
                            @endif
                            <div class="clearfix"></div>

                            <label >Mobile No.:</label>
                            <input id="cphone_no" type="text" class="form-control{{ $errors->has('cphone_no') ? ' is-invalid' : '' }}" name="cphone_no" value="{{ old('cphone_no') ? old('cphone_no') : $contact->cphone_no }}" required>
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            @if ($errors->has('cphone_no'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('cphone_no') }}</strong>
                                </span>
                            @endif
                            <div class="clearfix"></div>
    
                          <div class="row">
                            <div class="form-group fred">
    
    
                                <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> Update Contact</button>
    
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