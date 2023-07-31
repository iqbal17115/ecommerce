<table class="table table-bordered">
    <thead>
        <tr>
            <th class="bg-light">#</th>
            <th class="bg-light">Shipping Method</th>
            <th class="bg-light">Shipping Class</th>
            <th class="bg-light">Charge(Inside-Outside)</th>
            <th class="bg-light">Quantity</th>
            <th class="bg-light">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @forelse ($shippingCharges as $shippingCharge)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $shippingCharge->shippingMethod->name }}</td>
                <td>{{ $shippingCharge->shipping_class }}</td>
                <td>{{ $shippingCharge->charge_1 }}-{{ $shippingCharge->charge_2 }}</td>
                <td>{{ $shippingCharge->min_quantity }}-{{ $shippingCharge->max_quantity }}</td>
                <td>
                    <a href="{{ route('shipping_charge.edit', $shippingCharge->id) }}"
                        class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('shipping_charge.destroy', $shippingCharge->id) }}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this shipping charge?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="6">No shipping charges found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $shippingCharges->links() }}
