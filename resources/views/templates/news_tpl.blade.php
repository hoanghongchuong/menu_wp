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
                <div class="a-b-us-name about">
                    <h2>Tin tức</h2>
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
                @foreach($tintuc as $item)
                <div class="col-md-4">
                    <div class="single-blog-from">
                        <div class="blog-from-block">
                            <a href="{{url('tin-tuc/'.$item->alias.'.html')}}"><img src="{{asset('upload/news/'.$item->photo)}}" alt=""></a>
                            <div class="blog-img-block">
                                <h3><a href="{{url('tin-tuc/'.$item->alias.'.html')}}">{{$item->name}}</a></h3>
                                <div class="blog-img-info">
                                    <a href="#"><i class="fa fa-calendar"></i>{{date('d/m/Y', strtotime($item->created_at))}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        <br>
        <br>
        <br>
        <div class="paginations">
            {!! $tintuc->links() !!}
        </div>
        <br>
        <br>
        <br>

    </div>
</div>
<!--about us end-->
@endsection