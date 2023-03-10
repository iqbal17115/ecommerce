<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">SL.</th>
            <th scope="col">Type</th>
            <th scope="col">Inside Amount</th>
            <th scope="col">Outside Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($shipping_charges as $shipping_charge)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>{{$shipping_charge->type}}</td>
            <td>{{$shipping_charge->inside_amount}}</td>
            <td>{{$shipping_charge->outside_amount}}</td>
            <td>{{$shipping_charge->is_active == 1? 'Active' : 'Inactive'}}</td>
            <td>
                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal"
                    data-target="#blockModal" data-id="{{$shipping_charge->id}}" data-type="{{$shipping_charge->type}}"
                    data-inside_amount="{{$shipping_charge->inside_amount}}"
                    data-outside_amount="{{$shipping_charge->outside_amount}}"
                    data-is_active="{{$shipping_charge->is_active}}">
                    <i class="mdi mdi-pencil font-size-16"></i>
                </button>
                <button type="button" class="btn btn-danger text-light btn-sm delete_shipping_charge"
                    data-id="{{$shipping_charge->id}}">
                    <i class="mdi mdi-trash-can font-size-16"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $shipping_charges->links() !!}