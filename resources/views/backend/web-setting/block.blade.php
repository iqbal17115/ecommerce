@extends('layouts.backend_app')

@section('individual__link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Block List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#blockModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 block_content">
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
            </div>
        </div>
    </div>

</div>

@include('backend.web-setting.modal.block')

@endsection
@section('script')

@include('backend.web-setting.js.block-js')
{!! Toastr::message() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(".category_id").select2({
            dropdownParent: $("#blockModal"),
            placeholder: 'Select An Option'
        });
    });
</script>
@endsection