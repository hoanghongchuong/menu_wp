@extends('index')
@section('content')
 <section class="vk-content">

        <div class="vk-breadcrumb">
            <nav class="container">
                <ul class="vk-list vk-list--inline vk-list__breadcrumb">
                    <li class="vk-list__item"><a href="index.html">Trang chủ</a></li>

                    <li class="vk-list__item"> <a href="#">Thương hiệu</a></li>

                    <li class="vk-list__item">{{$thuonghieu->name}}</li>
                </ul>
            </nav>
        </div>
        <!--./vk-breadcrumb-->

        <div class="vk-banner">
            <div class="container">
                <div class="vk-banner__content">
                    <div class="vk-img vk-img--cover">
                        <img src= "{{asset('public/images/banner/banner-1.jpg')}}" alt="">
                    </div>
                </div> <!--./vk-banner__content-->
            </div> <!--./container-->
        </div><!--./vk-banner-->

        <div class="vk-page vk-page--shop">
            <div class="container">
                <div class="vk-shop">
                    <div class="vk-shop__box">
                        <div class="vk-shop__left">
                            <div class="vk-shop__left-inner">
                                <div class="vk-shop__heading-box">
                                    <h1 class="vk-shop__heading text-uppercase">Thương hiệu: {{$thuonghieu->name}}</h1>
                                    <!-- <div class="vk-shop__sort">
                                        <label for="" class="vk-shop__sort-label">Sắp xếp theo</label>
                                        <select name="" id="" class="form-control">
                                            <option value="">Mới đến cữ</option>
                                            <option value="">Cũ đến mới</option>
                                        </select>
                                    </div> -->
                                </div>  <!--./vk-shop__heading-box-->

                                <div class="row vk-shop-item__list">

                                @foreach($products as $key=>$p)    
                                    <div class="col-sm-6 col-md-4 col-lg-3 _item">
                                        <div class="vk-shop-item__wrapper">
                                            <div class="vk-shop-item">
                                                <div class="vk-img vk-img--mw100">
                                                    <a href="#item{{$key}}" title="Gift Set Gucci Bamboo Pour Femme" class="vk-img__link" data-toggle="modal" data-target="#item{{$key}}">
                                                        <img src="{{asset('upload/product/'.$p->photo)}}" alt="Gift Set Gucci Bamboo Pour Femme" class="vk-img__img">
                                                    </a>
                                                </div>

                                                <div class="vk-shop-item__brief">
                                                    <h3 class="vk-shop-item__title"><a href="{{url('san-pham/'.$p->alias.'.html')}}" title="Gift Set Gucci Bamboo Pour Femme">{{$p->name}}</a></h3>
                                                    <p class="vk-shop-item__price vk-text--red-1">{{ number_format($p->price)}} ₫</p>
                                                </div>

                                            </div> <!--./vk-shop-item-->
                                        </div>
                                        <!-- /.vk-shop-item__wrapper -->
                                    </div>
                                @endforeach

                                </div> <!--./row-->

                                <div class="vk-shop-modal__list">

                                    @foreach($products as $k=>$pro)
                                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="item{{$k}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <button type="button" class="close vk-btn vk-btn--close" data-dismiss="modal" aria-label="Close">X</button>

                                                <div class="vk-shop-detail vk-shop-detail--quickview">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="vk-shop-detail__left col-lg-6">
                                                                <div class="vk-shop-detail__thumbnail-wrapper">
                                                                    <div class="vk-shop-detail__thumbnail">
                                                                    <?php $product_detail = DB::table('products')->select()->where('status',1)->where('alias',$pro->alias)->get()->first();
                                                                        $album_hinh = DB::table('images')->select()->where('product_id',$product_detail->id)->orderby('id','asc')->get();
                                                                    ?>
                                                                        
                                                                        <div class="vk-slider__for" data-slider="slider-for">
                                                                            @foreach($album_hinh as $album)
                                                                            <div class="vk-img vk-img--mw100">
                                                                                <img src="{{asset('upload/hasp/'.$album->photo)}}" alt="">
                                                                            </div>
                                                                            @endforeach                

                                                                        </div>

                                                                    </div> <!--./slider-for-->

                                                                    <div class="vk-shop-detail__thumbnail-list vk-slider" >

                                                                        <div class="vk-slider__nav" data-slider="slider-nav">
                                                                            
                                                                            @foreach($album_hinh as $album)
                                                                            <div class="vk-img vk-img--mw100">
                                                                                <img src="{{asset('upload/hasp/'.$album->photo)}}" alt="">
                                                                            </div>
                                                                            @endforeach 
                                                                        </div>


                                                                    </div> <!--./slider-for-->
                                                                </div> <!--./vk-shop-detail__thumbnail-wrapper-->

                                                            </div> <!--./vk-shop-detail__left-->

                                                            <div class="vk-shop-detail__right col-lg-6">

                                                                <div class="vk-shop-detail__brief">
                                                                    <h1 class="vk-shop-detail__title">{{$pro->name}}  </h1>

                                                                    <div class="vk-shop-detail__box">

                                                                        <p class="vk-shop-detail__price vk-text--red-1">{{number_format($pro->price)}} đ</p>

                                                                        <div class="vk-shop-detail__brief-short">
                                                                            <?php $thuonghieu = DB::table('thuonghieu')->select('name')->where('id',$pro->thuonghieu_id)->first(); ?>
                                                                            <p>Thương hiệu: {{$thuonghieu->name}}</p>
                                                                            <p>Mã sản phẩm: {{$pro->code}}</p>
                                                                            <p>Tình trạng: Còn hàng</p>
                                                                        </div>

                                                                        <div class="vk-shop-detail__des">
                                                                            <p><strong>Mô tả:</strong></p>
                                                                            <p>{!!$pro->mota!!}</p>
                                                                        </div>

                                                                        <div class="vk-button">
                                                                            <form action="{{ route('addProductToCart') }}" method="post">
                                                                                {!! csrf_field() !!}
                                                                                <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                                                                                <div class="vk-calculator" data-calculator="true">
                                                                                    <input type="number" name="product_numb" id="soluong" value="1" min="1" class="form-control order-2">
                                                                                    <button class="vk-calculator__button vk-btn vk-btn--minus order-1"
                                                                                            data-index="minus">
                                                                                        <i class="_icon fa fa-minus"></i>
                                                                                    </button>
                                                                                    <button class="vk-calculator__button vk-btn vk-btn--plus order-3" data-index="plus">
                                                                                        <i class="_icon fa fa-plus"></i>
                                                                                    </button>
                                                                                </div> <!--./calculator-->

                                                                               <!--  <a href="shopcart.html" title="" class="vk-btn vk-btn--now text-uppercase _inverse">Mua ngay</a> -->
                                                                                <button type="submit" style="margin-top: 4px;" class="vk-btn vk-btn--now text-uppercase _inverse">Mua ngay</button>
                                                                            </form>
                                                                            <a href="{{url('san-pham/'.$pro->alias.'.html')}}" title="" class="vk-btn vk-btn--now text-uppercase _inverse">Chi tiết</a>
                                                                        </div>

                                                                    </div> <!--./vk-shop-detail__box-->

                                                                </div> <!--./vk-shop-detail__brief-->


                                                            </div><!-- /.vk-shop-detail__right -->

                                                        </div>
                                                    </div>
                                                    <!-- /.container -->
                                                </div> <!--./vk-shop-detail-->

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                   
                                </div> <!--./vk-shop-modal__list-->

                            </div> <!--./vk-shop__left-inner-->
                            <div class="paginations">
                                {!! $products->links() !!}
                            </div>
                            <!--./vk-breadcrumb-->
                        </div>
                        <!-- /.vk-page__left -->

                        <div class="vk-shop__right">
                            <div class="vk-sidebar">
                                <div class="vk-sidebar__box">
                                    <h3 class="vk-sidebar__heading text-uppercase">Danh mục sản phẩm</h3>

                                    <ul class="vk-list vk-list--mod-1">
                                         @foreach($cate_pro as $catePro)
                                        <li class="vk-list__item"><a href="{{url('san-pham/'.$catePro->alias)}}" title="">{{$catePro->name}}</a></li>
                                        @endforeach
                                </div> <!--./vk-sidebar__box-->
                                <!-- <div class="vk-sidebar__box">
                                    <h3 class="vk-sidebar__heading text-uppercase">Giá</h3>
                                    <div id="slider-range-min"></div>

                                    <p id="amount-label" class="vk-text--yellow-1 text-center mb-0"></p>

                                    <input type="text" id="amount" hidden >


                                </div> -->

                                <div class="vk-sidebar__box">
                                    <h3 class="vk-sidebar__heading text-uppercase">Thương hiệu</h3>
                                    <ul class="vk-list vk-list--mod-1 text-capitalize">
                                        @foreach($thuonghieus as $thuonghieu)
                                        <li class="vk-list__item"><a href="{{url('thuong-hieu/'.$thuonghieu->alias)}}" title="">{{$thuonghieu->name}}</a></li>
                                        @endforeach
                                    </ul>

                                </div> <!-- /.vk-sidebar__box -->
                            </div> <!--./vk-sidebar-->
                        </div>
                        <!-- /.vk-page__right -->

                    </div> <!--./vk-shop__box-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div> <!--./vk-page-->

    </section>

@endsection
