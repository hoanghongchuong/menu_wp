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
                <div class="a-b-us-name about" >
                    <h2 style="text-transform: none;">{{$news_detail->name}}</h2>
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
            {!! $news_detail->content !!}
        </div>

        
        <div class="comment">
            <h3>Bình luận</h3>
            <div class="fb-comments" data-href="{{url('tin-tuc/'.$news_detail->alias.'.html')}}" data-numposts="2" width="100%"></div>
        </div>
    </div>


</div>
@endsection
