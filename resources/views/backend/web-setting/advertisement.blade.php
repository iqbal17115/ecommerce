@extends('layouts.backend_app')

@section('individual__link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Advertisement List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#advertisementModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 advertisement_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Page</th>
                            <th scope="col">Style</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sub-title</th>
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
                            <td>
                                @if($advertisement->image)
                                <img src="{{ asset('storage/'.$advertisement->image) }}" class="rounded" style="width: 55px; height: 40px;" />
                                @endif
                            </td>
                            <td>{{$advertisement->title}}</td>
                            <td>{{$advertisement->sub_title}}</td>
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
            </div>
        </div>
    </div>

</div>

@include('backend.web-setting.modal.advertisement')

@endsection
@section('script')

@include('backend.web-setting.js.advertisement-js')
{!! Toastr::message() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(".category_id").select2({
            dropdownParent: $("#advertisementModal"),
            placeholder: 'Select An Option'
        });
    });
</script>
@endsection