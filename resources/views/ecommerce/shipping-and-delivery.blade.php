@extends('layouts.ecommerce')
@section('content')
<main class="main about">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shipping & Delivery</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            @if($company_info && $company_info->shipping_and_delivery)
            {!! $company_info->shipping_and_delivery !!}
            @endif
        </div><!-- End .container -->
    </div><!-- End .about-section -->
</main><!-- End .main -->
@endsection
