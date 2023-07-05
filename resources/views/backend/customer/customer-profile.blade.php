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
                                (0)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#transactions-sell-tab" role="tab">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#transactions-sell-tab" role="tab">Stores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#transactions-sell-tab" role="tab">Personal
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
                                                    @foreach($user?->reviews as $review)
                                                    <tr>
                                                        <td style="word-wrap: break-word; white-space: pre-line;">{{ $review?->Product->name}}</td>
                                                        <td>
                                                        <span class="badge badge-success font-size-12"><i class="mdi mdi-star mr-1"></i> {{$review->rating}}</span>
                                                        </td>
                                                        
                                                        <td>{{$review->comment}}</td>
                                                        <td>{{ ucwords($review->status) }}</td>
                                                        <td>{{ date('d-M-Y', strtotime($review->created_at)) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="transactions-sell-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
