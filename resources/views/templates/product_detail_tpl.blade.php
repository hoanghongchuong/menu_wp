@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
?>
<div class="product-header-area">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="product-menu">
                <ul>
                    <li><a href="{{url('')}}">Home</a> <i class="fa fa-angle-right"></i></li>
                    <li><a href="{{url('san-pham')}}">Shop</a> <i class="fa fa-angle-right"></i></li>
                    <li><a href="{{url('san-pham/'.$cateProduct->alias)}}">{{$cateProduct->name}}</a> <i class="fa fa-angle-right"></i></li>
                    <li>{{$product_detail->name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!--product header area end-->
<!--product-simple area satrt-->
<div class="product-simple-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="single-product-image">
                    <div class="single-product-tab">
                      <!-- Nav tabs -->
                      <ul role="tablist" class="nav nav-tabs">
                        @if(count($album_hinh)>0)
                            @foreach($album_hinh as $key=>$img)
                            <li class="@if($key == 0)active @endif" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home{{$key}}" href="#home{{$key}}"><img src="{{asset('upload/hasp/'.$img->photo)}}" alt=""></a></li>
                            @endforeach
                        @else
                        <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="home" href="#home"><img src="{{asset('upload/product/'.$product_detail->photo)}}" alt=""></a></li>
                        @endif
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        @if(count($album_hinh)>0)
                            @foreach($album_hinh as $key=>$img)
                            <div id="home{{$key}}" class="tab-pane @if($key == 0)active @endif" role="tabpanel">
                                <img src="{{asset('upload/hasp/'.$img->photo)}}" alt="">
                            </div>
                            @endforeach
                        @else
                            <div id="home" class="tab-pane active" role="tabpanel"><img src="{{asset('upload/product/'.$product_detail->photo)}}" alt="">
                            </div>
                        @endif
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="single-product-info">
                    <div class="product-nav">
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </div>
                    <h1 class="product_title">{{$product_detail->name}}</h1>
                    <div class="price-box">
                        <span class="new-price">{{number_format($product_detail->price)}}</span>
                        @if($product_detail->price_old > $product_detail->price)
                        <span class="old-price">{{number_format($product_detail->price_old)}}</span>
                        @endif
                    </div>
                    <div class="pro-rating">
                        @for($i = 0; $i< $product_detail->ratepoint; $i++)
                        <a href="#"><i class="fa fa-star"></i></a>
                        @endfor
                    </div>
                    <div class="short-description">
                        {!! $product_detail->mota !!}                      
                    </div>
                    <div class="stock-status">
                        <label>Tình trạng</label>: <strong>@if($product_detail->tinhtrang ==1) {{"Còn hàng"}} @else {{"Hết hàng"}} @endif</strong>
                    </div>
                    <form action="{{ route('addProductToCart') }}" class="cart p-qty-frm" method="post">
                        {{ csrf_field() }}
                        <div class="quantity">
                            <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                            <input type="number" name="product_numb" cl min="1" class="qty cart-plus-minus-box numb-cart" required="required" value="1" />
                            <button type="submit">Thêm vào giỏ</button>
                        </div>
                    </form>                    
                    <div class="share_buttons">
                        <a href="#"><img alt="" src="{{asset('public/img/share-img.png')}}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-simple area end-->
<!--product-tab area start-->
<div class="product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="product-tabs">
                    <div>
                      <!-- Nav tabs -->
                      <ul role="tablist" class="nav nav-tabs">
                        <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="tab-desc" href="#tab-desc" aria-expanded="true">Mô tả</a></li>
                        <li role="presentation" class=""><a data-toggle="tab" role="tab" aria-controls="page-comments" href="#page-comments" aria-expanded="false">Đánh giá</a></li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div id="tab-desc" class="tab-pane active" role="tabpanel">
                            <div class="product-tab-desc">
                                {!! $product_detail->mota !!}
                            </div>
                        </div>
                        <div id="page-comments" class="tab-pane" role="tabpanel">
                            <div class="product-tab-desc">
                                <div class="product-page-comments">
                                    <div class="fb-comments" data-href="{{url('san-pham/'.$product_detail->alias.'.html')}}" data-numposts="2" width="100%"></div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>                      
                </div>
                <div class="clear"></div>
                <div class="upsells_products_widget">
                    <div class="section-heading">
                        <h3>Sản phẩm liên quan</h3>
                    </div>
                    <div class="row">
                        @foreach($productSameCate as $ps)
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <div class="f-single-product">
                                <div class="f-product-img fix-img">
                                    <a class="f-p-img-p" href="#">
                                        <img class="primary-img" src="{{asset('upload/product/'.$ps->photo)}}" alt="">
                                        <?php @$image = DB::table('images')->where('product_id', $ps->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>
                                    <div class="f-img-block">
                                        <div class="feature-add-icon">
                                        </div>
                                        <div class="feature-add-cart">
                                            <a class="btn-addcartx" href="javascript:;" data-id="{{$ps->id}}">Thêm vào giỏ</a>
                                        </div>    
                                    </div>
                                </div>
                                <div class="feature-product-block">
                                    <h3><a href="{{url('san-pham/'.$ps->alias.'.html')}}">{{$ps->name}}<span>{{number_format($ps->price)}}</span></a></h3>
                                    
                                </div>
                            </div>   
                        </div>
                        @endforeach                     
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <!-- widget-recent start -->
                <aside class="widget top-product-widget">
                    <h3 class="sidebar-title">Sản phẩm bán chạy</h3>
                    <ul>
                        @foreach($productSale as $item)
                        <li>
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{url('san-pham/'.$item->alias.'.html')}}">
                                        <img alt="" src="{{asset('upload/product/'.$item->photo)}}" class="primary-image">
                                        <?php @$image = DB::table('images')->where('product_id', $item->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>                        
                                </div>
                                <div class="product-content">
                                    <div class="pro-info">
                                        <h2 class="product-name"><a href="{{url('san-pham/'.$item->alias.'.html')}}">{{$item->name}}</a></h2>
                                        <div class="price-box">
                                            <span class="new-price">{{number_format($item->price)}}</span>
                                            @if($item->price_old > $item->price)
                                            <span class="old-price">{{number_format($item->price_old)}}</span>
                                            @endif
                                        </div>                              
                                    </div>                                  
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </aside>
                <!-- widget-recent end -->              
            </div>
        </div>
    </div>
</div>

@endsection
