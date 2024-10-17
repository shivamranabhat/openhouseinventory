 <!-- Start Featured section -->
 <section>
  <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
      <div class="row align-items-center cs_gap_y_40">
        <div class="col-xl-6 wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
          <div class="cs_pr_45 text-center">
            <img src="{{asset('storage/'.$content->image)}}" alt="Image">
          </div>
        </div>
        <div class="col-xl-6 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
          <div class="cs_section_heading cs_style_1">
            <p class="cs_section_subtitle cs_text_accent">{{$content->title ?? ''}}</p>
            <h2 class="cs_section_title mb-0">{{$content->subtitle ?? ''}}</h2>
          </div>
          <div class="cs_height_60 cs_height_lg_40"></div>
          <div class="row cs_gap_y_40">
            @forelse($features as $key=>$feature)
            <div class="col-lg-6 h-100">
              <div class="cs_iconbox cs_style_2">
                <div class="cs_number_box cs_bg_accent cs_text_white">0{{$key+1}}</div>
                <h3 class="cs_iconbox_title">{{$feature->title}}</h3>
                <p class="cs_iconbox_subtitle">{{$feature->description}}
                </p>
              </div>
            </div>
            @empty 
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Software features -->