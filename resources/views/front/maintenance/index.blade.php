<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- Required meta tags -->
    <title> {{ $settings['seoTitle']?$settings['seoTitle']:"" }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $settings['seoMeta']?$settings['seoMeta']:"" }}">
    <meta name="description" content="{{ $settings['seoDescription']?$settings['seoDescription']:"" }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/animate.css">

    <link rel="stylesheet" href="{{url('/')}}/public/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/all.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/smart_wizard.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/front/css/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" media="all" />
    <link href="{{url('/')}}/public/front/css/nouislider.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel='shortcut icon' type='image/x-icon' href='{{url('/')}}/public/front/imgs/01.ico' />
    
    
    <style>
      .min-height-footer{
        min-height: 425px !important;
      }
      .sw-theme-default .toolbar>.sw-btn-prev {
        float: left;
      }
      .sw-theme-default .toolbar>.sw-btn-next {
        height: 45px;
        min-width: 150px;
      }
      #ApproveRequest
      {
        background: #FFC3C3;
        width: 10%;
        float: left;
      }
      #RejectRequest
      {
        background: #ff0018;
        width: 10%;
        float: left;
        margin-left: 15px;
        margin-top: 0px;
      }
    </style>
    <style>
      .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        margin: 0 auto;
      }
      
      /* Safari */
      @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
      }
      
      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
      </style>
  </head>
  <body>
   

    {{-- <div class="wrapper">
            <h1 style="text-align: center;margin-top: 25px;color: #c61b1b;"> {{ $settings['websiteOffMessage']?$settings['websiteOffMessage']:"" }}</h1>        
    </div> --}}
    <div class="wrapper">
       
        <img src="{{url('/')}}/front/imgs/maintainance.png" style="width: 100%;height: 100%"/>
    </div>
  </body>
</html>
