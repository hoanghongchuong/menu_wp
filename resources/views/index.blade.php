<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php 
        $setting = Cache::get('setting'); 
        $product_list = Cache::get('product_list');
    ?>
    <meta http-equiv="content-language" content="vi" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name='revisit-after' content='1 days' /> 
    <title><?php if(!empty($title)) echo $title; else echo $setting->title; ?></title>
    <meta name="author" content="{!! $setting->website !!}" />
    <meta name="copyright" content="GCO" />
    <meta name="keywords" content="<?php if(!empty($keyword)) echo $keyword; else echo $setting->keyword; ?>" />
    <meta name="description" content="<?php if(!empty($description)) echo $description; else echo $setting->description; ?>" />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:title" content="<?php if(!empty($title)) echo $title; else echo $setting->title; ?>" />
    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:url" content="{!! $setting->website !!}" />
    <meta property="og:site_name" content="<?php if(!empty($title)) echo $title; else echo $setting->title; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php if(!empty($img_share)) echo $img_share; else echo asset('upload/hinhanh/'.$setting->photo) ?>" />
    <meta property="og:description" content="<?php if(!empty($description)) echo $description; else echo $setting->description; ?>" />

    <meta name="googlebot" content="all, index, follow" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.position" content="10.764338, 106.69208" />
    <meta name="geo.placename" content="Hà Nội" />
    <meta name="Area" content="HoChiMinh, Saigon, Hanoi, Danang, Vietnam" />
    <link rel="shortcut icon" href="{!! asset('upload/hinhanh/'.$setting->favico) !!}" type="image/png" />

     <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        
        <!-- Bootstrap CSS
        ============================================ -->        
        <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
        
        <!-- fontwesome CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
        
        <!-- owl.carousel CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/owl.theme.css')}}">
        <link rel="stylesheet" href="{{asset('public/css/owl.transitions.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
        <!-- nivo slider CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/lib/css/nivo-slider.css')}}" type="text/css" />
        <link rel="stylesheet" href="{{asset('public/lib/css/preview.css')}}" type="text/css" media="screen" />
        
        <!-- animate CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/animate.css')}}">
        
        <!-- meanmenu.min CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/meanmenu.min.css')}}">
        
        <!-- jQuery-ui CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/jQuery-ui.css')}}">
        
        <!-- normalize CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/normalize.css')}}">
        
        <!-- main CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/main.css')}}">
        
        <!-- style CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
        
        <!-- responsive CSS
        ============================================ -->
        <link rel="stylesheet" href="{{asset('public/css/responsive.css')}}">
        
        <!-- modernizr JS
        ============================================ -->        
        <script src="{{asset('public/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <script type="text/javascript">
            function baseUrl(){
                return '<?php echo url('/'); ?>';
            }
            window.token = '{{ csrf_token() }}';
            window.urlAddCart = '{{ route("addProductToCartAjax") }}';
            window.createMenu = '{{ route("menu.create") }}';
            window.postEditMenu = '{{ route("menu.postEdit") }}';
            
            
       </script>
</head>
<body>
    
   
            @include('templates.layout.header')
            @yield('content')
            @include('templates.layout.footer')
     
   
    {!! $setting->codechat !!}
    {{ $setting->analytics }}
    @yield('script')
    <!-- BEGIN: SCRIPT -->
    <!-- jquery
        ============================================ -->        
        <script src="{{asset('public/js/vendor/jquery-1.11.3.min.js')}}"></script>
        
        <!-- price-slider JS
        ============================================ -->        
        <script src="{{asset('public/js/jquery-price-slider.js')}}"></script>
        
        <!-- bootstrap JS
        ============================================ -->        
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
        <!-- wow JS
        ============================================ -->        
        <script src="{{asset('public/js/wow.min.js')}}"></script>
        
        <!-- Nivo slider js
        ============================================ -->        
        <script src="{{asset('public/lib/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/lib/home.js')}}" type="text/javascript"></script>  
            
        <!-- meanmenu JS
        ============================================ -->        
        <script src="{{asset('public/js/jquery.meanmenu.js')}}"></script>
        
        <!-- owl.carousel JS
        ============================================ -->        
        <script src="{{asset('public/js/owl.carousel.min.js')}}"></script>
        
        <!-- mixitup js -->
        <script src="{{asset('public/js/jquery.mixitup.min.js')}}"></script>
        
        <!-- jquery.collapse js -->
        <script src="{{asset('public/js/jquery.collapse.js')}}"></script>
        
        <!-- scrollUp JS
        ============================================ -->        
        <script src="{{asset('public/js/jquery.scrollUp.min.js')}}"></script>
        
        <!-- plugins JS
        ============================================ -->        
        <script src="{{asset('public/js/plugins.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- main JS
        ============================================ -->        
        <script src="{{asset('public/js/main.js')}}"></script>
        <script src="{{asset('public/js/custom.js')}}"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
        <script src="{{asset('public/js/jquery.nestable.js')}}"></script>

        

<!-- END: SCRIPT -->
</body>
</html>