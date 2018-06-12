@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $cateProducts = Cache::get('cateProducts');
    
?>
<div class="grid-menu-area" style="margin-top: 40px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="gird-menu">
                    <ul>
                        <li><a href="{{url('')}}">Trang chủ</a> <i class="fa fa-angle-right"></i></li>
                        <li>{{$product_cate->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--gird men start-->
<!--shop-area start-->
<div class="shop-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <!--widget caetegorie start-->
                <div class="single-widget categories">
                    <div class="sidebar-title">
                       <h3>Danh mục</h3>
                    </div>
                    <div class="categories-list">
                        <ul>
                            @foreach($cate_pro as $cate)
                            <li><a href="{{url('san-pham/'.$cate->alias)}}">{{$cate->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!--widget caetegorie end-->
                <!--widget price start-->
                <!-- <div class="single-widget price">
                    <div class="sidebar-title">
                        <h3>Giá</h3>
                    </div>
                    <div class="info-widget">
                        <div class="price-filter">
                            <div id="slider-range"></div>
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                <input type="submit"  value="Lọc"/>
                            </div>
                        </div>
                    </div>                          
                </div> -->
                <!--widget price end-->


                <!--widget tags start-->
                <div class="single-widget rated">
                    <div class="sidebar-title">
                        <h3>Sản phẩm bán chạy</h3>
                    </div>
                    <div class="rated-list">
                        <ul>
                            @foreach($productSale as $ps)
                            <li>
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{url('san-pham/'.$ps->alias.'.html')}}">
                                            <img alt="" src="{{asset('upload/product/'.$ps->photo)}}" class="primary-image">
                                            <img alt="" src="img/product/bg-an.jpg" class="secondary-image">
                                        </a>                        
                                    </div>
                                    <div class="product-content">
                                        <div class="pro-info">
                                            <h2 class="product-name"><a href="{{url('san-pham/'.$ps->alias.'.html')}}">{{$ps->name}}</a></h2>
                                            <div class="price-box">
                                                <span class="new-price">{{number_format($ps->price)}}</span>
                                                @if($ps->price_old > $ps->price)
                                                <span class="old-price">{{number_format($ps->price_old)}}</span>
                                                @endif
                                            </div>                              
                                        </div>                                  
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>   
                </div>
                <!--widget tags end-->
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="shop-list-toolbar">
                    <div class="shop-toolbar-position">
                        <div class="view-mode">
                            <!-- <a href="shop.html" class="active"><i class="fa fa-th-large"></i></a>
                            <a href="shop-list.html" class="list"><i class="fa fa-th-list"></i></a> -->
                            <h1 class="title-page">{{$product_cate->name}}</h1>
                        </div>
                        <div class="show-result">
                        </div>
                    </div>
                    <div class="toolbar-form">

                        <form action="#">
                            <div class="tolbar-select">
                                <!-- <select>
                                  <option value="volvo">Chọn sắp xếp</option>
                                  <option value="saab">Giá tăng dần</option>
                                  <option value="mercedes">Giá giảm dần</option>
                                </select>  -->
                                <select id="sorter" class="sorter-options sort-by" data-role="sorter">
                                    <option value="">Sắp xếp</option>
                                    @foreach($sortType as $type => $value)
                                    <option value="{{ $type }}" @if($type == $selected) {{"selected"}} @endif >{{ $value['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>                             
                    </div>
                </div>
                <!--shop-gird view-->
                <div class="row">
                    <div class="show-gird-product another">
                        @foreach($products as $product)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="single-product">
                                <div class="product-img img-list">
                                    <a class="b-s-p-img" href="{{url('san-pham/'.$product->alias.'.html')}}">
                                        <img class="primary-img" src="{{asset('upload/product/'.$product->photo)}}" alt="">
                                        <?php @$image = DB::table('images')->where('product_id', $product->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>
                                    <div class="img-block">
                                    </div>
                                </div>
                                <div class="product-block-text">
                                    <h3><a href="{{url('san-pham/'.$product->alias.'.html')}}"  title="{{$product->name}}">{{$product->name}}<span>{{number_format($product->price)}}</span></a></h3>
                                     <a class="p-b-t-a-c btn-addcartx" href="javascript:;" data-id="{{$product->id}}">Thêm vào giỏ</a>
                                </div>
                            </div>    
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--pagination-->
                <div class="paginations">
                    {!! $products->links() !!}                
                </div>
            </div>
        </div>
    </div>
</div>
<!--shop-area end-->
@endsection
