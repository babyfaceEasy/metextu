{{-- $model --}}
<td>
    <a title="Edit Contact"  href="{{ route('groups.contacts.edit', [ 'contact' => $model, 'group' => $model->group_id ]) }}" class="btn btn-primary waves-effect waves-light m-r-5 btn-xs"><i class="fa fa-edit"></i></a>
    <!--<a href="{{ route('groups.contacts.edit', [ 'contact' => $model, 'group' => $model->group_id ]) }}">Edit</a> | -->
    <!--<a href="#" onclick="DelContact({{$model->id}});">Delete</a>-->
    <a alt="Delete Contact" title="Delete Contact" href="#" onclick="DelContact({{$model->id}});" class="btn btn-danger waves-effect waves-light m-r-5 btn-xs"><i class="fa fa-trash-o"></i></button>
    <form method="POST" action="{{ route('groups.contacts.destroy', ['group' => $model->group_id, 'contact' => $model ])}}" id="delete-form{{$model->id}}" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
</td>