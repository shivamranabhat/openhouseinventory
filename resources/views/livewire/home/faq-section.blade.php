<!--Start FAQ's section -->
<section class="cs_faq_wrap position-relative" id="faq">
  <div class="cs_height_143 cs_height_lg_75"></div>
  <div class="container">
    <div class="cs_section_heading cs_style_1 text-center">
      <p class="cs_section_subtitle cs_text_accent wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">Have
        Any Question?
      </p>
      <h2 class="cs_section_title mb-0 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">Here Some
        Questions Answer</h2>
    </div>
    <div class="cs_height_85 cs_height_lg_60"></div>
    <div class="row wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
      <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
        <div class="cs_accordian_wrap">
          @forelse($faqs as $faq)
          <div class="cs_accordian">
            <h2 class="cs_accordian_title">
              {{$faq->title}}
              <span class="cs_accordian_toggle">
                <span></span>
              </span>
            </h2>
            <div class="cs_accordian_body">
              {{$faq->description}}
            </div>
          </div>
          @empty
          @endforelse
        </div>
      </div>
    </div>
  </div>
  <div class="cs_faq_shape1"></div>
  <div class="cs_faq_shape2"></div>
  <div class="cs_height_150 cs_height_lg_75"></div>
</section>
<!--End FAQ's section -->