<table class="table table-striped">

<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @php
    $i = 0;
    @endphp
    @foreach($attributes as $attribute)
    <tr>
        <th scope="row">{{ ++$i }}</th>
        <td>{{$attribute->name}}</td>
        <td>
            <button type="button" class="btn btn-info text-light btn-sm update_form"
                data-toggle="modal" data-target="#attributeModal" data-id="{{$attribute->id}}"
                data-name="{{$attribute->name}}">
                <i class="mdi mdi-pencil font-size-16"></i>
            </button>
            <button type="button" class="btn btn-danger text-light btn-sm delete_attribute"
                data-id="{{$attribute->id}}">
                <i class="mdi mdi-trash-can font-size-16"></i>
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

</table>
{!! $attributes->links() !!}
