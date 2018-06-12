@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
?>
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="a-b-us-name">
                    <h2>Liên hệ</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contact-title end-->
<!-- map-area start -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="map-area">
                <div id="googleMap" style="width:100%;height:410px;">
                    {!! $setting->iframemap !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- map-area end -->
<!--contact form start-->
<div class="contact-us-form">
    <div class="container">
        <div class="container-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact-form">
                        <div class="contact-form-title">
                            <h2>Nội dung liên hệ</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-details">
                                    <form action="{{route('postContact')}}" method="POST" >
                                        <input name='_token' type='hidden' value="{{csrf_token()}}">
                                        <div class="contact-name">
                                            <input name="name" type="text" placeholder="Họ tên" required>
                                        </div>
                                        <div class="contact-email">
                                            <input name="email" type="text" placeholder="Email" required>
                                        </div>

                                        <div class="contact-textarea">
                                            <textarea name="content"  cols="30" rows="10" placeholder="Nội dung"></textarea>
                                        </div>
                                        <div class="contact-submitt">
                                            <button type="submit" value="submit form">Gửi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contact form end-->
<!--contact adress start-->
<div class="contact-adress">
    <div class="container">
        <div class="container-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="adress">
                        <h3>Địa chỉ</h3>
                        <p>Lorem ipsum dolor, consectetuer adipiscing elit,sed diam nonummy nibh euismod tincidunt ut laoreet scrambled it to make a type unknown printer specimen book.</p>
                    </div>
                    <div class="adress-info">
                        <div class="location">
                            <p>Tầng 8, Tòa nhà TOYOTA Thanh Xuân,315 Trường Chinh, Thanh Xuân, Hà Nội</p>
                        </div>
                        <div class="phone-number">
                            <p>(024)7 309 8885</p>
                        </div>
                        <div class="mail">
                            <a href="mailto:info@gco.vn">info@gco.vn</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
