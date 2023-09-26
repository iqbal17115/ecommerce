@push('links')
    <link href="{{ URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/datatable/buttons.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/datatable/col-ordering.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/datatable/fixed_header.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/datatable/responsive.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('plugins/datatable/scroller.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/datatable.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{asset('plugins/datatable/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatable/col_reorder_with_resize.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatable/fixed_header.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatable/buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatable/responsive.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatable/scroller.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/panel/datatable.js')}}"></script>
@endpush
