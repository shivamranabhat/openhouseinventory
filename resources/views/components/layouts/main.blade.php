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


  <!-- Back to top btn -->
  <div id="cs_backtotop"><i class="fas fa-angle-up"></i></div>

  <!-- All Scripts Files -->
  <script src="{{asset('main/js/jquery.min.js')}}"></script>
  <script src="{{asset('main/js/jquery.slick.min.js')}}"></script>
  <script src="{{asset('main/js/wow.min.js')}}"></script>
  <script src="{{asset('main/js/main.js')}}"></script>
</body>

</html>