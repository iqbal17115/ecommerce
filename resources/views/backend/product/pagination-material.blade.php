<table class="table table-striped">

<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @php
    $i = 0;
    @endphp
    @foreach($materials as $material)
    <tr>
        <th scope="row">{{ ++$i }}</th>
        <td>{{$material->name}}</td>
        <td>{{$material->is_active == 1? 'Active' : 'Inactive'}}</td>
        <td>
            <button type="button" class="btn btn-info text-light btn-sm update_form"
                data-toggle="modal" data-target="#materialModal" data-id="{{$material->id}}"
                data-name="{{$material->name}}"
                data-is_active="{{$material->is_active}}">
                <i class="mdi mdi-pencil font-size-16"></i>
            </button>
            <button type="button" class="btn btn-danger text-light btn-sm delete_material"
                data-id="{{$material->id}}">
                <i class="mdi mdi-trash-can font-size-16"></i>
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

</table>
{!! $materials->links() !!}