<!--Start Testimonial Section -->
<section id="testimonial">
    <div class="cs_height_143 cs_height_lg_75"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_1 text-center">
            <p class="cs_section_subtitle cs_text_accent wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                {{$content->title}}</p>
            <h2 class="cs_section_title mb-0 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">@php
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
    </div>
    <div class="cs_slider wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
        @forelse($testimonials as $testimonial)
        <div class="cs_testimonial cs_style_1 h-100">
            <div class="cs_client_info">
                <div class="cs_client_img">
                    <img src="{{asset('storage/'.$testimonial->image)}}" alt="avatar1">
                </div>
                <div class="cs_client_meta">
                    <h4 class="cs_client_name">{{$testimonial->name}}</h4>
                    <p class="mb-0">{{$testimonial->role}}</p>
                </div>
            </div>
            <p class="cs_client_review">
                {{$testimonial->description}}
            </p>
            <div class="cs_rating" data-rating="{{$testimonial->rating}}">
                <div class="cs_rating_percentage"></div>
            </div>
        </div>
        @empty
        @endforelse

    </div>

    <div class="cs_height_143 cs_height_lg_75"></div>
</section>
<!--End Testimonial Section -->