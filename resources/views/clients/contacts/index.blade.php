@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new Contact</div>

                <div class="card-body">
                    @include('inc.status')

                    <p>
                        <a href="{{ route('groups.contacts.create', ['group' => $group]) }}" class="btn btn-primary text-center">Create Contact</a>
                    </p>
                    

                    {{-- Table to hold the details --}}
                    <div class="responsive-table">
                        <p>
                            <h5>Contacts in the Group: {{ $group->gname }}</h5>
                        </p>
                        <table class="table">
                            <tr>
                                <th>S/N</th>
                                <th>Contact Name</th>
                                <th>Contact Digits</th>
                                <th>Action</th>
                            </tr>
                        

                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $contact->cname }}</td>
                                <td>{{ $contact->cphone_no }}</td>
                                <td>
                                    <a href="{{ route('groups.contacts.edit', [ 'contact' => $contact, 'group' => $group ]) }}">Edit</a> |
                                    <a href="#" onclick="DelContact({{$contact->id}});">Delete</a>
                                    <form method="POST" action="{{ route('groups.contacts.destroy', ['contact' => $contact, 'group' => $group ])}}" id="delete-form{{$contact->id}}" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">There are currently no contacts for this group ({{$group->gname}}).</td>                                
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

