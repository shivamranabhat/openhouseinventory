<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Varosa - Point of Sale Landing Page HTML Template</title>
  <!-- Favicon Icon -->
  <link rel="icon" href="assets/img/favicon.svg">
  <!-- CSS plugins files -->
  <link rel="stylesheet" href="{{asset('main/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('main/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('main/css/slick.css')}}">
  <link rel="stylesheet" href="{{asset('main/css/animate.css')}}">
  <!-- Custome CSS -->
  <link rel="stylesheet" href="{{asset('main/css/style.css')}}">
</head>

<body>
  <!-- Start Preloader -->
  <div class="cs_perloader">
    <div class="cs_perloader_in">
      <div class="cs_perloader_dots_wrap">
        <div class="cs_perloader_dots"><i></i><i></i><i></i><i></i></div>
      </div>
    </div>
    <span class="cs_perloader_text">Loading...</span>
  </div>
  <!-- End Preloader -->
  <!-- Start Header section -->
  <header class="cs_site_header cs_style_1 cs_text_white cs_fixed_header cs_medium">
    <div class="cs_main_header">
      <div class="container">
        <div class="cs_main_header_in">
          <div class="cs_main_header_left">
            <a class="cs_site_branding" href="index.html">
              <img src="assets/img/logo.svg" alt="Logo">
            </a>
          </div>
          <div class="cs_main_header_center">
            <nav class="cs_nav cs_medium cs_primary_font">
              <ul class="cs_nav_list cs_onepage_nav">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#testimonial">Testimonial</a></li>
                <li><a href="#faq">Faq</a>
                <li><a href="#blog">Blog</a></li>
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
  {{$slot}}
  <!--Start Footer Section -->
  <footer class="cs_site_footer cs_color_1 cs_sticky_footer">
    <div class="cs_footer_shape1">
      <img src="assets/img/Vector1.svg" alt="Vector-Icon">
    </div>
    <div class="cs_height_140 cs_height_lg_70"></div>
    <div class="cs_main_footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-xl-4">
            <div class="cs_footer_widget">
              <div class="cs_text_field">
                <img src="assets/img/logo.svg" alt="Logo" class="cs_footer_logo">
                <p class="cs_text_white mb-0">
                  Ours Pos Software is the ultimate solution designed to transform your business operations into a
                  streamlined and
                  efficient powerhouse. With a focus on simplicity, versatility, and cutting-edge technology.
                </p>
              </div>
            </div>
            <div class="cs_footer_widget">
              <div class="cs_social_btn cs_style_1 d-flex">
                <a href="https://www.facebook.com/" target="_blank">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank">
                  <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="https://www.facebook.com/" target="_blank">
                  <i class="fa-brands fa-instagram"></i>
                </a>
              </div>
            </div>
            <div class="cs_height_0 cs_height_lg_30"></div>
          </div>
          <!-- .col -->
          <div class="col-lg-2 col-xl-2 offset-lg-1">
            <div class="cs_footer_widget">
              <h2 class="cs_footer_widget_title">Quick Links</h2>
              <ul class="cs_footer_widget_nav cs_mp0">
                <li>
                  <a href="/">Home</a>
                </li>
                <li>
                  <a href="/#about">Features</a>
                </li>
                <li>
                  <a href="/#pricing">Pricing</a>
                </li>
                <li>
                  <a href="/#blog">Blog</a>
                </li>
                <li>
                  <a href="/#contact">Contact</a>
                </li>
              </ul>
            </div>
            <div class="cs_height_0 cs_height_lg_30"></div>
          </div>
          <!-- .col -->
          <div class="col-xl-1 col-lg-2">
            <div class="cs_footer_widget">
              <h2 class="cs_footer_widget_title">Supports</h2>
              <ul class="cs_footer_widget_nav cs_mp0">
                <li>
                  <a href="/#faq">Faq’s</a>
                </li>
                <li>
                  <a href="#">Articles</a>
                </li>
                <li>
                  <a href="#">Live Chat</a>
                </li>
              </ul>
            </div>
            <div class="cs_height_0 cs_height_lg_30"></div>
          </div>
          <!-- .col -->
          <div class="col-lg-4 col-xl-3 offset-xl-1">
            <div class="cs_footer_widget">
              <h2 class="cs_footer_widget_title">Subscribe Newsletter</h2>
              <div class="cs_newsletter position-relative">
                <input type="text" placeholder="Your email address" class="cs_form_field">
                <a href="/#contact" class="cs_btn cs_bg_accent cs_send">
                  Send
                  <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M10.147 1.75739C10.147 1.28795 9.76649 0.907395 9.29705 0.907394L1.64705 0.907394C1.17761 0.907395 0.797048 1.28795 0.797048 1.75739C0.797048 2.22684 1.17761 2.60739 1.64705 2.60739H8.44705V9.4074C8.44705 9.87684 8.82761 10.2574 9.29705 10.2574C9.76649 10.2574 10.147 9.87684 10.147 9.4074L10.147 1.75739ZM1.41281 10.8437L9.89809 2.35844L8.69601 1.15635L0.210727 9.64163L1.41281 10.8437Z"
                      fill="currentColor"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          <!-- .col -->
        </div>
        <div class="cs_height_110 cs_height_lg_50"></div>
      </div>
      <div class="container cs_copyright_text cs_text_white text-center">
        Copyright 2024. Design by<a href="https://themeforest.net/user/awesomethemez/portfolio" target="_blank"
          class="cs_site_link cs_text_accent"> AwesomeThemez</a>
      </div>
    </div>
  </footer>
  <!--End Footer Section -->

  <!-- Back to top btn -->
  <div id="cs_backtotop"><i class="fas fa-angle-up"></i></div>

  <!-- All Scripts Files -->
  <script src="{{asset('main/js/jquery.min.js')}}"></script>
  <script src="{{asset('main/js/jquery.slick.min.js')}}"></script>
  <script src="{{asset('main/js/wow.min.js')}}"></script>
  <script src="{{asset('main/js/main.js')}}"></script>
</body>

</html>