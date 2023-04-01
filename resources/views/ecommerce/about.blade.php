@extends('layouts.ecommerce')
@section('content')
<main class="main about">
			<div class="page-header page-header-bg text-left"
				style="background: 50%/cover #D4E1EA url('storage/{{$company_info->about_us_image}}');">
				<div class="container">
					<h1><span>ABOUT US</span>
                    @if($company_info && $company_info->name) 
                      {{$company_info->name}} 
                    @endif
                </h1>
					<a href="contact.html" class="btn btn-dark">Contact</a>
				</div><!-- End .container -->
			</div><!-- End .page-header -->

			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">About Us</li>
					</ol>
				</div><!-- End .container -->
			</nav>

			<div class="about-section">
				<div class="container">
                @if($company_info && $company_info->about_us) 
                   {!! $company_info->about_us !!} 
                @endif
				</div><!-- End .container -->
			</div><!-- End .about-section -->
		</main><!-- End .main -->
@endsection
