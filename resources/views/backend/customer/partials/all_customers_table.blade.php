<table class="table table-centered table-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Action</th>
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
                <td>
                    <img class="rounded-circle avatar-sm" src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                        alt="">
                </td>
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
                        <span class="badge badge-pill badge-success font-size-12">{{ ucwords($customer->status) }}</span>
                    @elseif($customer->status == 'inactive')
                        <span class="badge badge-pill badge-danger font-size-12">{{ ucwords($customer->status) }}</span>
                    @else
                        <span class="badge badge-pill badge-warning font-size-12">{{ ucwords($customer->status) }}</span>
                    @endif
                </td>
                <td>
                    <ul class="list-inline font-size-20 contact-links mb-0">
                        <li class="list-inline-item px-2">
                            <a href="{{ route('customers.profile', ['user' => $customer]) }}" data-toggle="tooltip" data-placement="top" title="Profile"><i class="bx bx-user-circle"></i></a>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $customers->links() }}
