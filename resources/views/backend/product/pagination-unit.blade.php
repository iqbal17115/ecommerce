<table class="table table-striped">

<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Short Name</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @php
    $i = 0;
    @endphp
    @foreach($units as $unit)
    <tr>
        <th scope="row">{{ ++$i }}</th>
        <td>{{$unit->name}}</td>
        <td>{{$unit->short_name}}</td>
        <td>{{$unit->is_active == 1? 'Active' : 'Inactive'}}</td>
        <td>
            <button type="button" class="btn btn-info text-light btn-sm update_form"
                data-toggle="modal" data-target="#unitModal" data-id="{{$unit->id}}"
                data-name="{{$unit->name}}" data-short_name="{{$unit->short_name}}"
                data-is_active="{{$unit->is_active}}">
                <i class="mdi mdi-pencil font-size-16"></i>
            </button>
            <button type="button" class="btn btn-danger text-light btn-sm delete_unit"
                data-id="{{$unit->id}}">
                <i class="mdi mdi-trash-can font-size-16"></i>
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

</table>
{!! $units->links() !!}