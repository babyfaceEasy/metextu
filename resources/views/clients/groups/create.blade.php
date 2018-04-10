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
                            @include('inc.quick_links', ['page_title' => 'New group'])
    
    
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <form method="POST" action="{{ route('groups.store') }}">
                          
                                        {{ csrf_field() }}
    
                            <label >Group Name:</label>
                            <!--<textarea id="elm1" name="area" class="col-md-10 col-md-offset-2 form-control"></textarea>-->
                            <input id="gname" type="text" class="form-control{{ $errors->has('gname') ? ' is-invalid' : '' }}" name="gname" value="{{ old('gname') }}" required autofocus>
                            @if ($errors->has('gname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gname') }}</strong>
                                </span>
                            @endif
                            <div class="clearfix"></div>
    
                          <div class="row">
                            <div class="form-group fred">
    
    
                                <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> Create Group</button>
    
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