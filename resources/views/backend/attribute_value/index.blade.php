@extends('layouts.backend_app')

@section('individual__link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Attribute Value</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#attributeValueModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 attribute_value_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Attribute</th>
                            <th scope="col">Attribute Value</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($attributeValues as $attributeValue)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $attributeValue?->attribute?->name }}</td>
                            <td>{{ $attributeValue?->value }}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#attributeValueModal" data-id="{{$attributeValue->id}}" data-attribute_id="{{$attributeValue->attribute_id}}" data-value="{{$attributeValue->value}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_attribute_value" data-id="{{$attributeValue->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $attributeValues->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.attribute_value.modal.attribute_value')

@endsection
@section('script')

@include('backend.attribute_value.js.attribute_value_js')
{!! Toastr::message() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(".category_id").select2({
            dropdownParent: $("#attributeValueModal"),
            placeholder: 'Select An Option'
        });
    });
</script>
@endsection
