@extends('layouts.backend_app')
@push('links')
    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-7">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <h5 class="font-size-15 text-truncate">{{ $user->name }}</h5>
                                    <p class="text-muted mb-0 text-truncate">Joined {{ $user->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-muted mb-0 text-truncate">Joined Date:
                                        {{ date('d-M-Y H:i', strtotime($user->created_at)) }}</p>
                                    <p class="text-muted mb-0 text-truncate">Status: {{ ucwords($user->status) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Total Spent</p>
                                        <h5 class="font-size-18">
                                            {{ $currency->icon }}{{ $user->Contact?->Order->sum('total_amount') }}</h5>
                                    </div>

                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Last Order</p>
                                        <h5 class="font-size-18">
                                            {{ $user->Contact?->Order->count() > 0 ? $user->Contact?->Order->max('created_at')->diffForHumans() : 'No orders' }}
                                        </h5>
                                    </div>

                                    <div class="col-sm-4">
                                        <p class="text-muted mb-0">Total Orders</p>
                                        <h5 class="font-size-18">{{ $user?->Contact?->Order?->count() }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->


        </div>

        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Default Address</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Name :</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>{{ $user->mobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Personal Info</h4>

                    <ul class="nav nav-pills bg-light rounded" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#transactions-all-tab" role="tab">Orders
                                ({{ $user?->Contact?->Order?->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#customer-review-tab" role="tab">Reviews
                                ({{ $user?->reviews->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wishlist-tab" role="tab">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#transactions-sell-tab" role="tab">Stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#personal-info-tab" role="tab">Personal
                                Info</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Status</th>
                                            <th>Delivery Method</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user?->Contact?->Order as $order)
                                            <tr>
                                                <td><a href="javascript: void(0);"
                                                        class="text-body font-weight-bold">{{ $order->code }}</a> </td>
                                                <td>{{ ucwords($order->status) }}</td>
                                                <td>
                                                    COD
                                                </td>
                                                <td>
                                                    {{ date('d-M-Y H:i', strtotime($order->order_date)) }}
                                                </td>
                                                <td>
                                                    {{ $order->total_amount }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="customer-review-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Rating</th>
                                            <th>Review</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user?->reviews as $review)
                                            <tr>
                                                <td style="word-wrap: break-word; white-space: pre-line;">
                                                    {{ $review?->Product?->name }}</td>
                                                <td>
                                                    <span class="badge badge-success font-size-12"><i
                                                            class="mdi mdi-star mr-1"></i> {{ $review->rating }}</span>
                                                </td>

                                                <td>{{ $review->comment }}</td>
                                                <td>{{ ucwords($review->status) }}</td>
                                                <td>{{ date('d-M-Y', strtotime($review->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="wishlist-tab" role="tabpanel">
                            <table class="table table-centered mb-0 table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Auth::user()?->wishlist as $list)
                                        <tr>
                                            <td>
                                                <img @if ($list?->product?->ProductMainImage) src="{{ asset('storage/product_photo/' . $list?->product?->ProductMainImage->image) }}" @endif
                                                    alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td style="word-wrap: break-word; white-space: pre-line;">
                                                <h5 class="font-size-14 text-truncate"><a
                                                        href="ecommerce-product-detail.html"
                                                        class="text-dark">{{ $list?->product->name }}</a></h5>
                                            </td>
                                            <td>
                                                @if ($list?->product->sale_price &&
                                                        $list?->product->sale_start_date &&
                                                        $list?->product->sale_end_date &&
                                                        $list?->product->sale_start_date <= now() &&
                                                        $list?->product->sale_end_date >= now())
                                                    {{ $currency->icon }}{{ number_format($list?->product->sale_price, 2) }}
                                                @else
                                                    {{ $currency->icon }}{{ number_format($list?->product->your_price, 2) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="transactions-sell-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">

                            </div>
                        </div>

                        <div class="tab-pane" id="personal-info-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar>
                                <div class="card">
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label for="validationTooltip01">Full Name</label>
                                                        <input type="text" class="form-control"
                                                            id="validationTooltip01" value="{{ $user->name }}"
                                                            placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select id="gender" class="form-control">
                                                            <option value="">Choose...</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label for="inlineFormemail2">Email</label>
                                                        <div class="input-group mb-2 mr-sm-3">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">@</div>
                                                            </div>
                                                            <input type="email" class="form-control"
                                                                id="inlineFormemail2" value="{{ $user->email }}"
                                                                placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label>Date Of Birth</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="dd M, yyyy" data-date-format="dd M, yyyy"
                                                                data-provide="datepicker">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i
                                                                        class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $user->mobile }}" placeholder="+1234567890"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group position-relative">
                                                        <label for="alternative_phone">Alternative Phone</label>
                                                        <input type="text" class="form-control" id="alternative_phone"
                                                            placeholder="+1234567890" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group position-relative">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" class="form-control" id="facebook"
                                                            placeholder="+1234567890" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group position-relative">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" class="form-control" id="instagram"
                                                            placeholder="+1234567890" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group position-relative">
                                                        <label for="twitter">Twitter</label>
                                                        <input type="text" class="form-control" id="twitter"
                                                            placeholder="+1234567890" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
