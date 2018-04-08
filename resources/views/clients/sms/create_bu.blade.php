@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Send New Message</div>

                <div class="card-body">
                    @include('inc.status')
                    <form method="POST" action="{{ route('send.sms') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                                <label for="sender_name" class="col-sm-4 col-form-label text-md-right">Sender Name</label>
    
                                <div class="col-md-6">
                                    <input id="sender_name" type="text" class="form-control{{ $errors->has('sender_name') ? ' is-invalid' : '' }}" name="sender_name" value="{{ old('sender_name') }}" required autofocus>
    
                                    @if ($errors->has('sender_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('sender_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="dst_nos" class="col-sm-4 col-form-label text-md-right">Phone numbers</label>
        
                                    <div class="col-md-6">
                                        <input id="dst_nos" type="text" class="form-control{{ $errors->has('dst_nos') ? ' is-invalid' : '' }}" name="dst_nos" value="{{ old('dst_nos') }}" required>
                                        <!--<input type="hidden" name="group_id" value="{{-- $group->id --}}">-->
                                        @if ($errors->has('dst_nos'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('dst_nos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="message" class="col-sm-4 col-form-label text-md-right">Message</label>
        
                                    <div class="col-md-6">
                                        <textarea name="message" id="message" cols="30" rows="10" required>{{ old('dst_nos') }}</textarea>
                                        <!--<input type="hidden" name="group_id" value="{{-- $group->id --}}">-->
                                        @if ($errors->has('message'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send SMS
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
