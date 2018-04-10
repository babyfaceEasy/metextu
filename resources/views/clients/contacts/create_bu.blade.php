@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Contact</div>

                <div class="card-body">
                    @include('inc.status')
                    <form method="POST" action="{{ route('groups.contacts.store', ['group' => $group]) }}">
                        @csrf
                        <div class="form-group row">
                                <label for="gname" class="col-sm-4 col-form-label text-md-right">Contact Name</label>
    
                                <div class="col-md-6">
                                    <input id="cname" type="text" class="form-control{{ $errors->has('cname') ? ' is-invalid' : '' }}" name="cname" value="{{ old('cname') }}" required autofocus>
    
                                    @if ($errors->has('cname'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="cphone_no" class="col-sm-4 col-form-label text-md-right">Mobile No.</label>
        
                                    <div class="col-md-6">
                                        <input id="cphone_no" type="text" class="form-control{{ $errors->has('cphone_no') ? ' is-invalid' : '' }}" name="cphone_no" value="{{ old('cphone_no') }}" required>
                                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                                        @if ($errors->has('cphone_no'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('cphone_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Contact
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
