<table class="table table-striped">

<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Website</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    @php
    $i = 0;
    @endphp
    @foreach($categories as $category)
    <tr>
        <th scope="row">{{ ++$i }}</th>
        <td>{{$category->name}}</td>
        <td><img src="{{ asset('storage/'.$brand->image) }}" class="rounded" style="width: 55px; height: 40px;"/></td>
        <td>{{$category->is_active == 1? 'Active' : 'Inactive'}}</td>
        <td>
            <button type="button" class="btn btn-info text-light btn-sm update_form"
                data-toggle="modal" data-target="#brandModal" data-id="{{$brand->id}}"
                data-name="{{$brand->name}}" data-short_name="{{$brand->short_name}}"
                data-is_active="{{$brand->is_active}}">
                <i class="mdi mdi-pencil font-size-16"></i>
            </button>
            <button type="button" class="btn btn-danger text-light btn-sm delete_brand"
                data-id="{{$brand->id}}">
                <i class="mdi mdi-trash-can font-size-16"></i>
            </button>
        </td>
    </tr>
    @endforeach
</tbody>

</table>
{!! $categories->links() !!}