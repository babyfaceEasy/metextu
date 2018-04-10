@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Group</div>

                <div class="card-body">
                    @include('inc.status')

                    <p>
                        <a href="{{ route('groups.create') }}" class="btn btn-primary text-center">Create Group</a>
                    </p>
                    

                    {{-- Table to hold the details --}}
                    <div class="responsive-table">
                        <table class="table">
                            <tr>
                                <th>S/N</th>
                                <th>Group Name(s)</th>
                                <th>Total Contacts</th>
                                <th>Action</th>
                            </tr>
                        

                        @forelse($groups as $group)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $group->gname }}</td>
                                <td>{{ $group->contacts->count() }}</td>
                                <td>
                                    <a href="{{ route('groups.contacts.index', ['group' => $group]) }}">View Contact(s)</a> |
                                    <a href="{{ route('groups.edit', ['group' => $group ]) }}">Edit</a> |
                                    <a href="#" onclick="DelGroup({{$group->id}});">Delete</a>
                                    <form method="POST" action="{{ route('groups.destroy', ['group' => $group])}}" id="delete-form{{$group->id}}" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">There are currently no groups in your database.</td>                                
                            </tr>
                        @endforelse
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function DelGroup(group_id) {
        event.preventDefault();
        //alert(group_id);
        //create the form id and call it submit action
        var elt_id = 'delete-form'+group_id;
        document.getElementById(elt_id).submit();
    }
</script>
@endsection

