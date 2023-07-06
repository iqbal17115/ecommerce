<table class="table table-centered table-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($customers as $customer)
            <tr>
                <td>
                    {{ $i++ }}
                </td>
                <td>Juan Mays</td>
                <td>
                    {{ $customer->name }}
                </td>

                <td>
                    {{ $customer->email }}
                </td>
                <td>
                    {{ $customer->mobile }}
                </td>
                <td>
                    @if ($customer->status == 'active')
                        <span
                            class="badge badge-pill badge-success font-size-12">{{ ucwords($customer->status) }}</span>
                    @elseif($customer->status == 'inactive')
                        <span
                            class="badge badge-pill badge-danger font-size-12">{{ ucwords($customer->status) }}</span>
                    @else
                        <span
                            class="badge badge-pill badge-warning font-size-12">{{ ucwords($customer->status) }}</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $customers->links() }}