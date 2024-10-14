<div class="cs_modal_container cs_white_bg" id="blog">
  <div class="cs_height_143 cs_height_lg_75"></div>
  <div class="cs_post_details cs_style_1">
    <div class="cs_post_meta_wrap">
      <div class="cs_post_meta">
        <div class="cs_post_meta_icon cs_text_accent"><i class="fa-regular fa-user"></i></div>
        <p class="mb-0">{{$details->author}}</p>
      </div>
      <div class="cs_post_meta">
        <div class="cs_post_meta_icon cs_text_accent"><i class="fa-regular fa-calendar"></i></div>
        <p class="mb-0">{{ \Carbon\Carbon::parse( $details->created_at)->format('d.m.Y') }}
        </p>
      </div>
    </div>
    <h2 class="cs_post_title">{{$details->title}}</h2>
    <div class="cs_height_5 cs_height_lg_5"></div>
    <img src="{{asset('storage/'.$details->image)}}" class="w-100" alt="{{$details->image_alt}}">
    <div class="cs_post_text">
      {!! $details->description !!}
    </div>
    <div class="cs_height_35 cs_height_lg_35"></div>
  </div>
</div>
