<header class="cs_site_header cs_style_1 cs_text_white cs_fixed_header cs_medium" style="background-color: #0d0c17">
    <div class="cs_main_header">
      <div class="container">
        <div class="cs_main_header_in">
          <div class="cs_main_header_left">
            <a class="cs_site_branding" href="{{route('index')}}">
              <img src="assets/img/logo.svg" alt="Logo">
            </a>
          </div>
          <div class="cs_main_header_center">
            <nav class="cs_nav cs_medium cs_primary_font">
              <ul class="cs_nav_list">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#testimonial">Testimonial</a></li>
                <li><a href="#faq">Faq</a>
                <li><a href="#blog" class="{{ request()->segment(1)== 'blog' ? 'active' : ''}}">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="cs_main_header_right">
            <div class="cs_header_btns">
              <a href="{{route('login')}}" class="cs_btn cs_bg_accent cs_modal_btn">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>