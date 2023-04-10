<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Your Price</th>
            <th scope="col">Sale Price</th>
            <th scope="col">Category</th>
            <th scope="col">Brand</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($products as $product)
        <tr>
            <th scope="row">{{ ++$i }}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->your_price}}</td>
            <td>{{$product->sale_price}}</td>
            <td>
                @if($product->Category)
                {{$product->Category->name}}
                @endif
            </td>
            <td>
                @if($product->Brand)
                {{$product->Brand->name}}
                @endif
            </td>
            <td style="width: 100px;">
                <button type="button" class="btn btn-danger text-light btn-sm delete_product"
                    data-id="{{$product->id}}">
                    <i class="mdi mdi-trash-can font-size-16"></i>
                </button>
                <a href="{{ route('product-product', ['id'=>$product->id]) }}" class="btn btn-info text-light btn-sm">
                    <i class="mdi mdi-pencil font-size-16"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $products->links() !!}