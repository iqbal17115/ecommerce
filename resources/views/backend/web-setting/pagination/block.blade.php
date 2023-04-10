<table class="table table-striped">

    <thead>
        <tr>
            <th scope="col">SL.</th>
            <th scope="col">Category</th>
            <th scope="col">Position</th>
            <th scope="col">Style</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($blocks as $block)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>
                @if($block->Category)
                {{$block->Category->name}}
                @endif
            </td>
            <td>{{$block->position}}</td>
            <td>{{$block->style}}</td>
            <td>
                <img src="{{ asset('storage/'.$block->image) }}" class="rounded" style="width: 55px; height: 40px;" />
            </td>
            <td>{{$block->is_active == 1? 'Active' : 'Inactive'}}</td>
            <td>
                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#blockModal" data-id="{{$block->id}}" data-category_id="{{$block->category_id}}" data-position="{{$block->position}}" data-style="{{$block->style}}" data-image="{{$block->image}}" data-is_active="{{$block->is_active}}">
                    <i class="mdi mdi-pencil font-size-16"></i>
                </button>
                <button type="button" class="btn btn-danger text-light btn-sm delete_block" data-id="{{$block->id}}">
                    <i class="mdi mdi-trash-can font-size-16"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $blocks->links() !!}