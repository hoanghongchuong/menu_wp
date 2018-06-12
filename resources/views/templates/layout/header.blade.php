<?php
    $setting = Cache::get('setting');
?>
<!--header-area start-->
<div class="header-area home1">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="classic-logo">
                    <a href="{{url('')}}">
                        <img src="{{asset('upload/hinhanh/'.$setting->photo)}}" alt="Home">
                    </a>
                </div>
            </div>
            <div class="hidden-xs hidden-sm col-md-6 col-lg-6">
                <div class="header-menu">                                                  
                    <ul id="nav" class="text-center">
                        <li><a href="{{url('')}}">TRANG CHỦ</a>

                        </li>
                        <li><a href="{{url('san-pham')}}">SHOP</a></li>
                        <li><a href="{{url('tin-tuc')}}">TIN TỨC</a></li>
                        <li><a href="{{url('gioi-thieu')}}">GIỚI THIỆU</a></li>
                        <li><a href="{{url('lien-he')}}">LIÊN HỆ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="header-info">
                    <ul>
                        <li class="my-cart cart-quantity" id="count_cart">
                            <a href="{{url('gio-hang')}}">
                                <img src="{{asset('public/img/header-cart.png')}}" alt="">
                                <span>{{Cart::count()}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--mobile menu satrt-->
    <div class="mobile-menu-area home1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="{{url('')}}">Home</a>
                            </li>
                            <li><a href="{{url('san-pham')}}">SHOP</a></li>
                            <li><a href="{{url('tin-tuc')}}">TIN TỨC</a></li>
                            <li><a href="{{url('gioi-thieu')}}">GIỚI THIỆU</a></li>
                            
                            <li><a href="{{url('lien-he')}}">LIÊN HỆ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>    
    </div>
<!--mobile menu end-->     
</div>
<!--header-area start-->