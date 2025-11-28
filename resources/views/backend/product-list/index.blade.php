@extends('layouts.backend_app')
@section('title', 'Edit Product')

@section('styles')
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Products</h4>

        <a href="{{ route('products.store') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <!-- Search + Filter -->
    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" 
                   value="{{ request('search') }}"
                   placeholder="Search product name...">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="draft"     {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="active"    {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive"  {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">Filter</button>
        </div>
    </form>

    <!-- Product Table -->
    <div class="card">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $product->name }}</strong>

                                <div class="text-muted small">
                                    ID: {{ $product->id }}
                                </div>
                            </td>

                            <td>{{ $product->category?->name }}</td>
                            <td>{{ $product->brand?->name }}</td>

                            <td>
                                <span class="badge 
                                    @if($product->status == 'active') bg-success
                                    @elseif($product->status == 'draft') bg-warning
                                    @else bg-secondary @endif">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $products->withQueryString()->links() }}
    </div>

</div>
@endsection

@section('script')

@endsection