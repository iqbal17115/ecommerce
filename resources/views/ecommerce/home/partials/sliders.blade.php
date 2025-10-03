<div class="slide-animate slider-image-header owl-carousel owl-theme nav-circle mb-2"
     data-owl-options='{
         "loop": true,
         "autoplay": true,
         "autoplayTimeout": 5000,
         "items": 1
     }'>
    @foreach ($sliders as $slider)
    <div class="home-slide home-slide1 banner">
        <img class="slider_image slide-bg lazy-load" 
             data-src="{{ asset('storage/' . $slider->image) }}" 
             alt="slider image">
        <div class="container d-flex align-items-sm-center justify-content-sm-between justify-content-center flex-column flex-sm-row">
            <div class="banner-content content-left text-sm-right mb-sm-0 mb-2"></div>
        </div>
    </div>
    @endforeach
</div>
