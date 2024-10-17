<!--Start Blog Section -->
<section class="cs_blog cs_gradient_bg_2" id="blog">
  <div class="cs_height_143 cs_height_lg_75"></div>
  <div class="container">
    <div class="cs_section_heading cs_style_1 text-center">
      <p class="cs_section_subtitle cs_text_accent wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
        {{$content->title}}
      </p>
      <h2 class="cs_section_title mb-0 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
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
    <div class="row wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
      @forelse($blogs as $blog)
      <div class="col-lg-4 d-flex">
        <div class="cs_post cs_style_1 h-100">
          <div class="cs_post_thumb cs_modal_btn" data-modal="details">
            <img src="{{asset('storage/'.$blog->image)}}" alt="Image">
            <div class="cs_posted_by">{{\Carbon\Carbon::parse($blog->created_at)->format('d M')}}</div>
          </div>
          <div class="cs_post_content">
            <div class="cs_post_content_in">
              <div class="cs_post_meta_wrap">
                <div class="cs_post_meta">
                  <div class="cs_post_meta_icon"><img src="{{asset('main/img/user.svg')}}" alt="Author"></div>
                  <p class="mb-0">{{$blog->author}}</p>
                </div>

              </div>
              <h2 class="cs_post_title cs_modal_btn mb-0">
                {{$blog->title}}
              </h2>
            </div>
            <div class="cs_post_user">
              <a href="{{route('blog.details',$blog->slug)}}" class="cs_text_btn cs_modal_btn">
                Read More
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M10.147 1.75739C10.147 1.28795 9.76649 0.907395 9.29705 0.907394L1.64705 0.907394C1.17761 0.907395 0.797048 1.28795 0.797048 1.75739C0.797048 2.22684 1.17761 2.60739 1.64705 2.60739H8.44705V9.4074C8.44705 9.87684 8.82761 10.2574 9.29705 10.2574C9.76649 10.2574 10.147 9.87684 10.147 9.4074L10.147 1.75739ZM1.41281 10.8437L9.89809 2.35844L8.69601 1.15635L0.210727 9.64163L1.41281 10.8437Z"
                    fill="currentColor"></path>
                </svg>
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M10.147 1.75739C10.147 1.28795 9.76649 0.907395 9.29705 0.907394L1.64705 0.907394C1.17761 0.907395 0.797048 1.28795 0.797048 1.75739C0.797048 2.22684 1.17761 2.60739 1.64705 2.60739H8.44705V9.4074C8.44705 9.87684 8.82761 10.2574 9.29705 10.2574C9.76649 10.2574 10.147 9.87684 10.147 9.4074L10.147 1.75739ZM1.41281 10.8437L9.89809 2.35844L8.69601 1.15635L0.210727 9.64163L1.41281 10.8437Z"
                    fill="currentColor"></path>
                </svg>
              </a>

            </div>
          </div>
        </div>
        <div class="cs_height_lg_30"></div>
      </div>
      @empty
      @endforelse
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
</section>

<!--End Blog Section -->