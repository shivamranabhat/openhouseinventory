<section class="cs_business_feature position-relative" id="features">
    <div class="cs_height_143 cs_height_lg_75"></div>
    <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
        <p class="cs_section_subtitle cs_text_accent wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s" style="visibility: visible;">{{$content->title ?? ''}}</p>
        <h2 class="cs_section_title mb-0 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s" style="visibility: visible;">
          @php
              $words = explode(' ', $content->subtitle ?? '');
              $chunkedWords = array_chunk($words, 4);
          @endphp

          @foreach($chunkedWords as $index => $chunk)
              @if ($index > 0)
                  <br>
              @endif
              {{ implode(' ', $chunk) }}
          @endforeach
        </h2>
      </div>
      <div class="cs_height_85 cs_height_lg_60"></div>
      <div class="row cs_gap_y_30 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s" style="visibility: visible;">
        @forelse($features as $feature)
        <div class="col-lg-6 col-xl-3 d-flex">
            <div class="cs_iconbox cs_style_1 h-100">
                <div class="cs_iconbox_icon">
                    <img src="{{ asset('storage/' . $feature->icon) }}" alt="Icon">
                </div>
                <h3 class="cs_iconbox_title mt-auto">{{$feature->title}}</h3>
                <p class="cs_iconbox_subtitle">{{$feature->description}}</p>
            </div>
        </div>
        @empty
        @endforelse
    </div>
    
      <div class="cs_featured_shape">
        <img src="{{asset('main/img/Vector.svg')}}" alt="Image">
      </div>
    </div>
  </section>