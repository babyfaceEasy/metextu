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
                    @include('inc.quick_links', ['page_title' => 'Buy More Credits', 'credits' => $credits])
                    @include('inc.status')
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                            <form method="POST" action="{{ route('purchase.credit') }}">
                                {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Credit Unit</label>
                        <div class="col-md-10" style="margin-bottom: 20px;">
                            <input type="text" name="units" class="form-control" placeholder="amount">
                            @if ($errors->has('units'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('units') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                                            <div class="clearfix"></div> 
                    

                    
                    

                    <div class="row">
                    <div class="form-group fred">
                        
                        
                            <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> <span>Purchase Unit</span> <i class="fa fa-money m-l-10"></i> </button>
                        
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