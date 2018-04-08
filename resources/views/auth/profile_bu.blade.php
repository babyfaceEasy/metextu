@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile Details</div>
                    <div class="card-body">
                            @include('inc.status')
                        <div class="table-responsive">
                                <table class="table w-100 d-block d-md-table">
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{Auth::user()->name}}</td>
                                        </tr>

                                        <tr>
                                            <th>Email Address: </th>
                                            <td>{{Auth::user()->email}}</td>
                                        </tr>

                                        <tr>
                                            <th>Is Admin: </th>
                                            <td>{{Auth::user()->isAdmin()}}</td>
                                        </tr>

                                        <tr>
                                                <th>&nbsp;</th>
                                                <td>
                                                <a href="{{ route('show.edit.profile') }}" class="btn btn-default">Edit Profile</a>
                                                </td>
                                            </tr>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection