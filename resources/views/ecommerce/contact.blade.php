@extends('layouts.ecommerce')
@section('content')

<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="demo4.html"><i class="icon-home"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
						Contact Us
						</li>
					</ol>
				</div>
			</nav>

			<div id="map">
            @if($company_info && $company_info->google_map_location)
               {!! $company_info->google_map_location !!}
            @endif
            </div>

			<div class="container contact-us-container">
				<div class="contact-info">
					<div class="row">
						<div class="col-12">
							<h2 class="ls-n-25 m-b-1">
							Contact Info
							</h2>

							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing
								elit. Sed imperdiet libero id nisi euismod, sed
								porta est consectetur. Vestibulum auctor felis eget
								orci semper vestibulum. Pellentesque ultricies nibh
								gravida, accumsan libero luctus, molestie nunc.L
								orem ipsum dolor sit amet, consectetur adipiscing
								elit.
							</p>
						</div>

						<div class="col-sm-6 col-lg-3">
							<div class="feature-box text-center">
								<i class="sicon-location-pin"></i>
								<div class="feature-box-content">
									<h3>address</h3>
									<h5>
                                    @if($company_info && $company_info->address)
                                        {!! $company_info->address !!}
                                    @endif
                                    </h5>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="feature-box text-center">
								<i class="fa fa-mobile-alt"></i>
								<div class="feature-box-content">
									<h3>Phone Number</h3>
									<h5>
                                    @if($company_info && $company_info->phone)
                                        {!! $company_info->phone !!}
                                    @endif
                                    </h5>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="feature-box text-center">
								<i class="far fa-envelope"></i>
								<div class="feature-box-content">
									<h3>Email Address</h3>
									<h5>
                                    @if($company_info && $company_info->email)
                                        {!! $company_info->email !!}
                                    @endif
                                    </h5>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="feature-box text-center">
								<i class="far fa-calendar-alt"></i>
								<div class="feature-box-content">
									<h3>Working days hours</h3>
									<h5>Mon - Sun / 9:00AM - 8:00PM</h5>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<h2 class="mt-6 mb-2">Sending Us Message</h2>

						<form class="mb-0" action="#">
							<div class="form-group">
								<label class="mb-1" for="contact-name">Your Name
									<span class="required">*</span></label>
								<input type="text" class="form-control" id="contact-name" name="contact-name"
									required />
							</div>

							<div class="form-group">
								<label class="mb-1" for="contact-email">Your Email
									<span class="required">*</span></label>
								<input type="email" class="form-control" id="contact-email" name="contact-email"
									required />
							</div>

							<div class="form-group">
								<label class="mb-1" for="contact-message">Your_message
									<span class="required">*</span></label>
								<textarea cols="30" rows="1" id="contact-message" class="form-control"
									name="contact-message" required></textarea>
							</div>

							<div class="form-footer mb-0">
								<button type="submit" class="btn btn-dark font-weight-normal">
								Send Message
								</button>
							</div>
						</form>
					</div>

					<div class="col-lg-6">
						<h2 class="mt-6 mb-1">Frequently Asked Questions</h2>
						<div id="accordion">
							<div class="card card-accordion">
								<a class="card-header" href="#" data-toggle="collapse" data-target="#collapseOne"
									aria-expanded="true" aria-controls="collapseOne">
									Curabitur eget leo at velit imperdiet viaculis
									vitaes?
								</a>

								<div id="collapseOne" class="collapse show" data-parent="#accordion">
									<p>Lorem ipsum dolor sit amet, consectetur
										adipiscing elit. Curabitur eget leo at velit
										imperdiet varius. In eu ipsum vitae velit
										congue iaculis vitae at risus. Nullam tortor
										nunc, bibendum vitae semper a, volutpat eget
										massa.</p>
								</div>
							</div>

							<div class="card card-accordion">
								<a class="card-header collapsed" href="#" data-toggle="collapse"
									data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
									Curabitur eget leo at velit imperdiet vague
									iaculis vitaes?
								</a>

								<div id="collapseTwo" class="collapse" data-parent="#accordion">
									<p>Lorem ipsum dolor sit amet, consectetur
										adipiscing elit. Curabitur eget leo at velit
										imperdiet varius. In eu ipsum vitae velit
										congue iaculis vitae at risus. Nullam tortor
										nunc, bibendum vitae semper a, volutpat eget
										massa. Lorem ipsum dolor sit amet,
										consectetur adipiscing elit. Integer
										fringilla, orci sit amet posuere auctor,
										orci eros pellentesque odio, nec
										pellentesque erat ligula nec massa. Aenean
										consequat lorem ut felis ullamcorper posuere
										gravida tellus faucibus. Maecenas dolor
										elit, pulvinar eu vehicula eu, consequat et
										lacus. Duis et purus ipsum. In auctor mattis
										ipsum id molestie. Donec risus nulla,
										fringilla a rhoncus vitae, semper a massa.
										Vivamus ullamcorper, enim sit amet consequat
										laoreet, tortor tortor dictum urna, ut
										egestas urna ipsum nec libero. Nulla justo
										leo, molestie vel tempor nec, egestas at
										massa. Aenean pulvinar, felis porttitor
										iaculis pulvinar, odio orci sodales odio, ac
										pulvinar felis quam sit.</p>
								</div>
							</div>

							<div class="card card-accordion">
								<a class="card-header collapsed" href="#" data-toggle="collapse"
									data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									Curabitur eget leo at velit imperdiet viaculis
									vitaes?
								</a>

								<div id="collapseThree" class="collapse" data-parent="#accordion">
									<p>Lorem ipsum dolor sit amet, consectetur
										adipiscing elit. Curabitur eget leo at velit
										imperdiet varius. In eu ipsum vitae velit
										congue iaculis vitae at risus. Nullam tortor
										nunc, bibendum vitae semper a, volutpat eget
										massa.</p>
								</div>
							</div>

							<div class="card card-accordion">
								<a class="card-header collapsed" href="#" data-toggle="collapse"
									data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
									Curabitur eget leo at velit imperdiet vague
									iaculis vitaes?
								</a>

								<div id="collapseFour" class="collapse" data-parent="#accordion">
									<p>Lorem ipsum dolor sit amet, consectetur
										adipiscing elit. Curabitur eget leo at velit
										imperdiet varius. In eu ipsum vitae velit
										congue iaculis vitae at risus. Nullam tortor
										nunc, bibendum vitae semper a, volutpat eget
										massa. Lorem ipsum dolor sit amet,
										consectetur adipiscing elit. Integer
										fringilla, orci sit amet posuere auctor,
										orci eros pellentesque odio, nec
										pellentesque erat ligula nec massa. Aenean
										consequat lorem ut felis ullamcorper posuere
										gravida tellus faucibus. Maecenas dolor
										elit, pulvinar eu vehicula eu, consequat et
										lacus. Duis et purus ipsum. In auctor mattis
										ipsum id molestie. Donec risus nulla,
										fringilla a rhoncus vitae, semper a massa.
										Vivamus ullamcorper, enim sit amet consequat
										laoreet, tortor tortor dictum urna, ut
										egestas urna ipsum nec libero. Nulla justo
										leo, molestie vel tempor nec, egestas at
										massa. Aenean pulvinar, felis porttitor
										iaculis pulvinar, odio orci sodales odio, ac
										pulvinar felis quam sit.</p>
								</div>
							</div>

							<div class="card card-accordion">
								<a class="card-header collapsed" href="#" data-toggle="collapse"
									data-target="#collapseFive" aria-expanded="true" aria-controls="collapseThree">
									Curabitur eget leo at velit imperdiet varius
									iaculis vitaes?
								</a>

								<div id="collapseFive" class="collapse" data-parent="#accordion">
									<p>Lorem ipsum dolor sit amet, consectetur
										adipiscing elit. Curabitur eget leo at velit
										imperdiet varius. In eu ipsum vitae velit
										congue iaculis vitae at risus. Nullam tortor
										nunc, bibendum vitae semper a, volutpat eget
										massa. Lorem ipsum dolor sit amet,
										consectetur adipiscing elit. Integer
										fringilla, orci sit amet posuere auctor,
										orci eros pellentesque odio, nec
										pellentesque erat ligula nec massa. Aenean
										consequat lorem ut felis ullamcorper posuere
										gravida tellus faucibus. Maecenas dolor
										elit, pulvinar eu vehicula eu, consequat et
										lacus. Duis et purus ipsum. In auctor mattis
										ipsum id molestie. Donec risus nulla,
										fringilla a rhoncus vitae, semper a massa.
										Vivamus ullamcorper, enim sit amet consequat
										laoreet, tortor tortor dictum urna, ut
										egestas urna ipsum nec libero. Nulla justo
										leo, molestie vel tempor nec, egestas at
										massa. Aenean pulvinar, felis porttitor
										iaculis pulvinar, odio orci sodales odio, ac
										pulvinar felis quam sit.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mb-8"></div>
		</main>
@endsection
@push('scripts')
<script src="{{ asset('js/panel/users/common.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/add_to_cart.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_manager.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_drawer.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/panel/users/cart/cart_list.js') }}?v={{ time() }}"></script>
<script>
    // Set the hasCartList variable
    window.hasCartList = false;
    // Add an event listener to the DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof CartManager !== 'undefined') {
            CartManager.loadCartData();
        }
    });

    // This handles BACK button cache restore
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            CartManager.loadCartData();
        }
    });
</script>
@endpush