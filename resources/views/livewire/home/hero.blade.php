 <!-- Start Hero section -->
 <section class="cs_hero cs_style_1 position-relative" id="home">
    <div class="container">
      <div class="cs_hero_text text-center">
        <h1 class="cs_hero_title cs_text_white wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
         {{$content->title ?? ''}}
        </h1>
        <p class="cs_hero_subtitle wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">
          {{$content->subtitle ?? ''}}
        </p>
      </div>
      {{-- <div class="cs_btn_group text-center wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">
        <a href="#" class="cs_btn cs_bg_white">Product Demo</a>
        <a href="#" class="cs_btn cs_bg_accent">Start Free Trial</a>
      </div> --}}
      <div class="cs_height_100 cs_height_lg_60"></div>
      <div class="cs_hero_img wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.25s">
        <img src="{{asset('storage/'.$content->image)}}" alt="Thumbnail">
      </div>
    </div>
    <div class="cs_hero_shape1"></div>
    <div class="cs_hero_shape2"><img src="{{asset('main/img/Polygon.svg')}}" alt="Polygon Icon"></div>
    <div class="cs_hero_shape3"></div>
  </section>
  <!-- End Hero section -->