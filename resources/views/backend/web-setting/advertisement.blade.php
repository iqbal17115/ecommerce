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
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#sliderModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 slider_content">
               
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
            dropdownParent: $("#sliderModal"),
            placeholder: 'Select An Option'
        });
    });
</script>
@endsection