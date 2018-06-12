@extends('index')
@section('content')
<section class="news news-detail">
    @if(!empty($banner_danhmuc))
    <section class="banner">
        <img src="{!! asset('upload/hinhanh/'.$banner_danhmuc->photo) !!}" alt="{{ $banner_danhmuc->name }}" class="img-fluid">
    </section>
    @endif
    <div class="container">

        <div class="news-item">

            <h1>{!! $news_detail->name !!}</h1>

            {!! $news_detail->content !!}

            <p>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style" style="margin-top:10px;">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
                <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52843d4e1ff0313a"></script>
            </p>

        </div>

    </div>

</section>
@endsection
