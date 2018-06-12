@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $members =  DB::table('feedback')->orderBy('id', 'desc')->get();
?>
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="a-b-us-name about">
                    <h2>Giới thiệu</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contact-title end-->
<!--about us start-->
<div class="about-area">
    <div class="container">
        <div class="row">
            {!! @$about->content !!}
        </div>
    </div>

    <!--creative member area start-->
    <div class="crative-member-area">
        <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="crative-member text-center">
                       <h2>Nhóm thiết kế</h2>
                       <P>Our skill is really high quality and standard for build your project.</P>
                   </div>
               </div>
           </div>
            <div class="row">
                @foreach($members as $member)
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="single-crative-member-info">
                        <div class="member-image">
                            <img src="{{asset('upload/hinhanh/'.$member->photo)}}" alt="">
                            <div class="member-title">
                                <h1>{{$member->name}}</h1>
                                <p>{{$member->position}}</p>
                            </div>
                        </div>
                        <div class="member-info">
                            <div class="member-text">
                                <p>{!! $member->content !!}</p>
                            </div>
                            <!-- <div class="member-icon">
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--creative member area end-->
</div>
@endsection
