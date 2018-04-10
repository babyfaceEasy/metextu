@extends('layouts.logged_in')
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                @include('inc.status')
            </div>

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn-group pull-right m-t-15">
                        <a class="btn btn-default waves-effect waves-light fred3" href="{{ route('groups.create') }}">Add Group</a>
                        <!--<button class="btn btn-default waves-effect waves-light fred3" data-toggle="modal" data-target="#con-single-modal">Add Contact</button>
                        <button class="btn btn-default waves-effect waves-light fred3" data-toggle="modal" data-target="#con-view-modal">View Address Group</button>
                        <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add Address Book</button>-->
                    </div>

                    

                    <h4 class="page-title">Address Book</h4>
                    <ol class="breadcrumb">
                        <li>
                            <strong></strong>
                        </li>
                        
                    </ol>
                </div>
            </div>



            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <h5 class="m-t-0"><!--Falana Taye Fredrick Contacts is <b> 159 </b>--></h5>
                        <p class="text-muted font-13 m-b-30">
                            
                        </p>

                        <table id="groups_table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <!--<th>Total Contacts</th>-->
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>


            


        </div> <!-- container -->

    </div> <!-- content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            //alert('kunle');
            $('#groups_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dataTable.groups') }}',
                columns: [
                    {data: 'id', column: 'id'},
                    {data: 'gname', column: 'gname'},
                    {data: 'actions', column: 'actions'}
                ]
            });
        });
        </script>
@endsection