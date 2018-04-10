{{-- $model --}}

<a href="{{ route('groups.contacts.index', ['group' => $model]) }}" title="View Contact(s)" alt="View Contact(s)" class="btn btn-purple waves-effect btn-xs waves-light"> <i class="fa fa-eye"></i> </a>
<a href="{{ route('groups.edit', ['group' => $model ]) }}"  title="Edit Group" alt="Edit Group" class="btn btn-primary waves-effect waves-light m-r-5 btn-xs"><i class="fa fa-edit"></i></a>
<a title="Delete Group" alt="Delete Group" href="#" onclick="DelGroup({{$model->id}});" class="btn btn-danger waves-effect waves-light m-r-5 btn-xs"><i class="fa fa-trash-o"></i></a>
<form method="POST" action="{{ route('groups.destroy', ['group' => $model])}}" id="delete-form{{$model->id}}" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
        
<script>
    function DelGroup(group_id) {
        var result = confirm('Are you sure you want to delete this group?');

        if (result) {
            event.preventDefault();
            //alert(group_id);
            //create the form id and call it submit action
            var elt_id = 'delete-form'+group_id;
            document.getElementById(elt_id).submit();
        }//end of if(result)
    }
</script>
