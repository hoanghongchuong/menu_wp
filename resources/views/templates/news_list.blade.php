@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
?>
<section class="vk-content">
    <div class="vk-breadcrumb">
        <div class="vk-breadcrumb__banner">
            <div class="vk-img vk-img--cover">
                <img src="{{asset('public/images/banner/banner-1.jpg')}}" alt="" class="">
            </div>
        </div>
        <div class="vk-breadcrumb__content">
            <nav class="container">
                <ul class="vk-list vk-list--inline vk-list--breadcrumb">
                    <li class="vk-list__item"><a href="{{url('')}}">Trang chủ</a></li>
                    <li class="vk-list__item active">Tin tức</li>
                    <li class="vk-list__item active">{{$tintuc_cate->name}}</li>
                </ul>
            </nav>
        </div>

    </div>
    <!--./vk-breadcrumb-->   
    <div class="vk-page vk-page--news">
        <div class="container">
            <h1 class="vk-page__heading">TIN TỨC</h1>

            <div class="row">
                <div class="col-lg-9">
                    <div class="vk-news__list row">
                        @foreach($tintuc as $item)
                        <div class="col-lg-12 _item">
                            <div class="vk-news-item">
                                <div class="vk-img vk-img--mw100">
                                    <a href="{{url('tin-tuc/'.$item->alias.'.html')}}" title="{{$item->name}}" class="vk-img__link">
                                        <img src="{{asset('upload/news/'.$item->photo)}}" alt="{{$item->name}}" class="vk-img__img">
                                    </a>
                                </div>

                                <div class="vk-news-item__brief">
                                    <h3 class="vk-news-item__title"><a href="{{url('tin-tuc/'.$item->alias.'.html')}}" title="{{$item->name}}">{{$item->name}}</a></h3>
                                    <p class="vk-news-item__published">Upload: {{date('d/m/Y', strtotime($item->created_at))}}</p>
                                    <p class="vk-news-item__text">{{$item->mota}}</p>
                                </div>
                            </div> <!--./vk-news-item-->
                        </div>
                        @endforeach
                    </div> <!--./list-->

                    <div class="vk-pagination">{!! $tintuc -> links() !!}</div>
                    <!-- <nav class="vk-pagination">
                        <ul class="vk-list vk-list--inline vk-pagination__list">
                            <li class="vk-list__item active"><a href="#" title="">1</a></li>
                            <li class="vk-list__item"><a href="#" title="">2</a></li>
                            <li class="vk-list__item"><a href="#" title="">3</a></li>
                            <li class="vk-list__item"><a href="#" title="">4</a></li>
                        </ul>
                    </nav> -->
                    <!--./vk-breadcrumb-->
                </div><!--./col-->

                <div class="col-lg-3">
                    <aside class="vk-sidebar">
                        <div class="vk-sidebar__box">
                            <h3 class="vk-heading vk-heading--style-1">TIN TỨC MỚI NHẤT</h3>

                            <div class="vk-news__list">
                                <div class="vk-news-item vk-news-item--grid">
                                    <div class="vk-img vk-img--cover">
                                        <a href="{{url('tin-tuc/'.$tintuc_moinhat_detail[0]->alias.'.html')}}" title="">
                                            <img src="{{asset('upload/news/'.$tintuc_moinhat_detail[0]->photo)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="vk-news-item__brief">
                                        <h3 class="vk-news-item__title"><a href="{{url('tin-tuc/'.$tintuc_moinhat_detail[0]->alias.'.html')}}" title="">{{$tintuc_moinhat_detail[0]->name}}</a></h3>
                                        <p class="vk-news-item__published">Upload: {{date('d/m/Y', strtotime($tintuc_moinhat_detail[0]->created_at))}}</p>
                                    </div>

                                </div> <!--./item-->

                                <ul class="vk-list vk-list--style-3">
                                    @for($i=1; $i< count($tintuc_moinhat_detail); $i++)
                                    <li class="vk-list__item"><a href="{{url('tin-tuc/'.$tintuc_moinhat_detail[$i]->alias.'.html')}}" title="">{{$tintuc_moinhat_detail[$i]->name}}</a></li>
                                    @endfor
                                </ul>

                            </div>
                        </div>  <!--./box-->


                        <div class="vk-sidebar__box d-none d-lg-block">
                            <div class="vk-ads vk-img">
                                 <?php $banner = DB::table('banner_content')->where('position', 4)->first(); ?>
                                <a href="{{$banner->link}}" title="">
                                    <img src="{{asset('upload/banner/'.$banner->image)}}" alt="" >
                                </a>
                            </div>
                        </div><!--./box-->


                    </aside>
                </div><!--./col-->

            </div> <!--./row-->


        </div><!-- /.container -->
    </div> <!--./page-->

    <div class="vk-partner animation fadeIn">

        <div class="container">
            <div class="vk-partner__list row vk-slider" data-slider="partner">
                <?php $partners = DB::table('partner')->where('status',1)->get(); ?>
                @foreach($partners as $partner)
                <div class="col-lg-2 _item">
                    <div class="vk-partner__item">
                        <div class="vk-img--mw100">
                            <img src="{{asset('upload/banner/'.$partner->photo)}}" alt="">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.container -->
    </div> <!--./partner-->

    <div class="vk-map">
         {!! $setting->iframemap !!}
    </div>
</section>
<script>
    $('[data-slider="partner"]').slick({
            nextArrow: '<button  class="vk-btn vk-slider__arrow vk-slider__arrow--next"><img src="{{asset('public/images/icon/arrow-right-3.png')}}"></button>',
            prevArrow: '<button  class="vk-btn vk-slider__arrow vk-slider__arrow--prev"><img src="{{asset('public/images/icon/arrow-left-3.png')}}"></button>',
            slidesToShow: 5,
            swipeToSlide:true,
            autoplay:true,

            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        arrows: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        arrows: false
                    }
                },
                {
                    breakpoint: 567,
                    settings: {
                        slidesToShow: 1,
                        arrows: false

                    }
                }
            ],
        })
</script>
@endsection