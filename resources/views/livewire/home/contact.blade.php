<!--Start contact Section -->
<section class="cs_contact" id="contact">
  <div class="cs_height_143 cs_height_lg_75"></div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-6 wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.2s">
        <div class="cs_contact_thumb text-center">
          <img src="{{asset('storage/'.$content->image)}}" alt="Image">
        </div>
      </div>
      <div class="col-xl-6 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.2s">
        <div class="cs_section_heading cs_style_1">
          <p class="cs_section_subtitle cs_text_accent">{{$content->title}}</p>
          <h2 class="cs_section_title mb-0">
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
        <div class="cs_height_50 cs_height_lg_40"></div>
        <form wire:submit.prevent='send' class="row">
          <div class="col-sm-6">
            <input type="text" wire:model="name" class="cs_form_field" placeholder="Full Name*">
            @error('name')
            <div class="feedback text-danger">
              Please provide a valid name.
            </div>
            @enderror
            <div class="cs_height_30 cs_height_lg_30"></div>
          </div>
          <div class="col-sm-6">
            <input type="email" wire:model="email" class="cs_form_field" placeholder="Email*">
            @error('email')
            <div class="feedback text-danger">
              Please provide a valid email.
            </div>
            @enderror
            <div class="cs_height_30 cs_height_lg_30"></div>
          </div>
          <div class="col-sm-6">
            <input type="text" wire:model="mobile" class="cs_form_field" placeholder="Mobile*">
            @error('mobile')
            <div class="feedback text-danger">
              Please provide a valid mobile number.
            </div>
            @enderror
            <div class="cs_height_30 cs_height_lg_30"></div>
          </div>
          <div class="col-sm-6">
            <input type="text" wire:model="subject" class="cs_form_field" placeholder="Subject*">
            @error('subject')
            <div class="feedback text-danger">
              Please provide a subject.
            </div>
            @enderror
            <div class="cs_height_30 cs_height_lg_30"></div>
          </div>
          <div class="col-lg-12">
            <textarea wire:model="description" rows="7" class="cs_form_field m-0"
              placeholder="Write Project Details*"></textarea>
            @error('description')
            <div class="feedback text-danger">
              Please write a message.
            </div>
            @enderror
            <div class="cs_height_30 cs_height_lg_30"></div>
          </div>
          <div class="col-lg-12">
            <button class="btn btn-primary px-3 py-2 rounded-pill d-flex align-items-center gap-2" type="submit">
              <x-spinner />Send <i class="fa-solid fa-paper-plane"></i>
            </button>
            <div id="cs_result"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="cs_height_150 cs_height_lg_80"></div>
  <x-success />
</section>
<!--End contact Section -->