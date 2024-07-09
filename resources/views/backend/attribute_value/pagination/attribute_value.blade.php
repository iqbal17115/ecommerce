<table class="table table-striped">

    <thead>
        <tr>
            <th scope="col">SL.</th>
            <th scope="col">Slider Link</th>
            <th scope="col">Slider Image</th>
            <th scope="col">Slider Position</th>
            <th scope="col">Category</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($sliders as $slider)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>{{$slider->link}}</td>
            <td><img src="{{ asset('storage/'.$slider->image) }}" class="rounded" style="width: 55px; height: 40px;" /></td>
            <td>{{$slider->position}}</td>
            <td>
                @if($slider->Category)
                {{$slider->Category->name}}
                @endif
            </td>
            <td>{{$slider->is_active == 1? 'Active' : 'Inactive'}}</td>
            <td>
                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#sliderModal" data-id="{{$slider->id}}" data-link="{{$slider->link}}" data-image="{{$slider->image}}" data-position="{{$slider->position}}" data-category_id="{{$slider->category_id}}" data-is_active="{{$slider->is_active}}">
                    <i class="mdi mdi-pencil font-size-16"></i>
                </button>
                <button type="button" class="btn btn-danger text-light btn-sm delete_slider" data-id="{{$slider->id}}">
                    <i class="mdi mdi-trash-can font-size-16"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $sliders->links() !!}