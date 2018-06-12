<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
    $cateProducts = Cache::get('cateProducts');
    $brands = DB::table('partner')->orderBy('id')->get();
?>
<div class="our-brand-area owl-indicator">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-title">
                   <h3>Đối tác</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="brand-list">
                @foreach($brands as $br)
                <div class="col-md-12">
                    <div class="single-brand">
                        <a href="#"><img src="{{asset('upload/banner/'.$br->photo)}}" alt=""></a>
                    </div>    
                </div> 
                @endforeach  
            </div>
        </div>
    </div>
</div>
<!--our brand end-->
<div class="footer-area">
    <div class="footer-list">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-footer classic">
                        <div class="logo">
                            <a href="#"><img src="{{asset('upload/hinhanh/'.$setting->photo)}}" alt=""></a>
                        </div>
                        <!-- <div class="f-classic-text">
                            <p>Lorem ipsum is simply dummy text of the printing typesetting industry.Lorem ipsum has been the industry standard dummy text ever since the 1500s.</p>
                        </div> -->
                        <div class="classic-adress">
                            <ul>
                                <li><a href="#"><i class="fa fa-phone"></i></a>{{$setting->phone}}</li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a>{{$setting->email}}</li>
                                <li><a href="#"><i class="fa fa-map-marker"></i></a>{{$setting->address}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">

                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-footer information">
                        <h3>Trang chủ</h3>
                        <div class="account-list">
                            <ul>
                                <li><a href="#">Giới thiệu</a></li>
                                <li><a href="#">Tin tức</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Shop</a></li>
                                <!-- <li><a href="#">Tiêu đề mẫu</a></li>
                                <li><a href="#">Tiêu đề mẫu</a></li>
                                <li><a href="#">Tiêu đề mẫu</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-footer conatact-us">
                        <h3>Danh mục</h3>
                        <div class="account-list">
                            <ul>
                                <li><a href="#">Sản phẩm bán chạy</a></li>
                                <li><a href="#">Thẻ quà tặng</a></li>
                                <li><a href="#">Đổi trả</a></li>
                                <li><a href="#">Shipping</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer-copyright">
                        <p>
                            Copyright © 2018
                            <a href="gco.vn" target="_blank">GCO</a>
                            All Rights Reserved
                        </p>
                    </div>    
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer-atm-card">
                        <ul>
                            <li><a href="#"><img src="{{asset('public/img/payment-1.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('public/img/payment-2.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('public/img/payment-3.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('public/img/payment-4.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('public/img/payment-5.png')}}" alt=""></a></li>
                        </ul>    
                    </div>    
                </div>
            </div>    
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=124844007858325";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>