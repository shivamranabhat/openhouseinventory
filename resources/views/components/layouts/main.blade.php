<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{$headerSeo}}
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
  </div>
  <!-- End Preloader -->
  <!-- Start Header section -->
  {{$slot}}


  <!-- Back to top btn -->
  <div id="cs_backtotop"><i class="fas fa-angle-up"></i></div>
  {{$footerSeo}}
  <!-- All Scripts Files -->

  <script src="{{asset('main/js/jquery.min.js')}}"></script>
  <script src="{{asset('main/js/jquery.slick.min.js')}}"></script>
  <script src="{{asset('main/js/wow.min.js')}}"></script>
  <script src="{{asset('main/js/main.js')}}"></script>
  <script src="{{asset('main/js/navbar.js')}}"></script>
</body>

</html>