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
                            @include('inc.quick_links', ['page_title' => 'Transfer Credit'])
                            @include('inc.status')

                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                    <form method="POST" action="{{ route('transfer.credit') }}">
                                        {{ csrf_field() }}
                          <div class="form-group">
                             <label class="col-md-2 control-label">Receiver E-mail</label>
                                <div class="col-md-6" style="margin-bottom: 20px;">
                                  <input type="text" id="email_to" name="email_to" required="" value="{{ old('email_to') }}"  class="form-control" placeholder="metextyou@yahoo.co.uk">
                                  @if ($errors->has('email_to'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email_to') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                                                  <div class="clearfix"></div> 
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Credit Amount</label>
                                  <div class="col-md-6">
                                    <input type="text" name="units" id="units" required="" value="{{ old('units') }}" class="form-control" placeholder="90">
                                    @if ($errors->has('units'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('units') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                            </div>
                            
    <div class="clearfix"></div>
    
                          <div class="row">
                            <hr/>
                            <div class="form-group fred col-md-8">
                                
                             
                                    <button type="submit" class="btn btn-purple waves-effect waves-light pull-right"> <span>Transfer Credit</span> <i class="fa fa-send m-l-10"></i> </button>
                                
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