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
            {{-- <nav class="cs_nav cs_medium cs_primary_font">
              <ul class="cs_nav_list">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#testimonial">Testimonial</a></li>
                <li><a href="#faq">Faq</a>
                <li><a href="" class="{{ request()->segment(1)== 'blog' ? 'active' : ''}}">Blog</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </nav> --}}
            <nav class="cs_nav cs_medium cs_primary_font">
              <ul class="cs_nav_list">
                  <li><a href="{{ request()->segment(1)=='' ? '#home' : route('index') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                  <li><a href="#features" class="{{ (request()->hash === 'features') ? 'active' : '' }}">Features</a></li>
                  {{-- <li><a href="#pricing" class="{{ (request()->hash === 'pricing') ? 'active' : '' }}">Pricing</a></li> --}}
                  <li><a href="#testimonial" class="{{ (request()->hash === 'testimonial') ? 'active' : '' }}">Testimonial</a></li>
                  <li><a href="#faq" class="{{ (request()->hash === 'faq') ? 'active' : '' }}">Faq</a></li>
                  <li><a href="#blog" class="{{ request()->segment(1) == 'blog' ? 'active' : '' }}">Blog</a></li>
                  <li><a href="#contact" class="{{ (request()->hash === 'contact') ? 'active' : '' }}">Contact</a></li>
              </ul>
          </nav>
          
          </div>
          <div class="cs_main_header_right">
            <div class="cs_header_btns">
              <a href="{{route('login')}}" class="btn btn-primary px-3 py-2 rounded-pill">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>