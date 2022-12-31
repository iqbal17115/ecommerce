<table class="table table-striped">

    <thead>
        <tr>
            <th scope="col">SL.</th>
            <th scope="col">Page</th>
            <th scope="col">Style</th>
            <th scope="col">Type</th>
            <th scope="col">Image1</th>
            <th scope="col">Image2</th>
            <th scope="col">Image3</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($advertisements as $advertisement)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>{{$advertisement->page}}</td>
            <td>{{$advertisement->style}}</td>
            <td>{{$advertisement->type}}</td>
            <td>
                @if($advertisement->type == "Image Ads")
                <img src="{{ asset('storage/'.$advertisement->embed_code_or_image1) }}" class="rounded" style="width: 55px; height: 40px;" />
                @endif
            </td>
            <td>
                @if($advertisement->type == "Image Ads")
                <img src="{{ asset('storage/'.$advertisement->embed_code_or_image2) }}" class="rounded" style="width: 55px; height: 40px;" />
                @endif
            </td>
            <td>
                @if($advertisement->type == "Image Ads")
                <img src="{{ asset('storage/'.$advertisement->embed_code_or_image3) }}" class="rounded" style="width: 55px; height: 40px;" />
                @endif
            </td>
            <td>{{$advertisement->is_active == 1? 'Active' : 'Inactive'}}</td>
            <td>
                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#advertisementModal" data-id="{{$advertisement->id}}" data-page="{{$advertisement->page}}" data-position="{{$advertisement->position}}" data-style="{{$advertisement->style}}" data-type="{{$advertisement->type}}" data-embed_code_or_image1="{{$advertisement->embed_code_or_image1}}" data-embed_code_or_image2="{{$advertisement->embed_code_or_image2}}" data-embed_code_or_image3="{{$advertisement->embed_code_or_image3}}" data-url1="{{$advertisement->url1}}" data-url2="{{$advertisement->url2}}" data-url3="{{$advertisement->url3}}" data-is_active="{{$advertisement->is_active}}">
                    <i class="mdi mdi-pencil font-size-16"></i>
                </button>
                <button type="button" class="btn btn-danger text-light btn-sm delete_advertisement" data-id="{{$advertisement->id}}">
                    <i class="mdi mdi-trash-can font-size-16"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $advertisements->links() !!}