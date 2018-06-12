    @extends('index')
@section('content')

<?php
$setting = Cache::get('setting');
$cateProducts = Cache::get('cateProducts');
$banner = DB::table('banner_content')->where('position',1)->get();
?>
@include('templates.layout.slider')
<!--slider area end-->
<!--banner area satrt-->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-9 col-lg-9">
                <div class="banner-image-area">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="litele-img">
                                <a href="{{$slogans[0]->link}}"><img src="{{asset('upload/hinhanh/'.$slogans[0]->photo)}}" alt=""></a>
                                <div class="li-banner-new">
                                    <span>new</span>
                                </div>
                            </div>                                      
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="large-img">
                                <a href="{{$slogans[1]->link}}"><img src="{{asset('upload/hinhanh/'.$slogans[1]->photo)}}" alt=""></a>
                            </div>   
                       </div>
                    </div>
                    <div class="row banner-bottom">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="large-img">
                                <a href="{{$slogans[2]->link}}"><img src="{{asset('upload/hinhanh/'.$slogans[2]->photo)}}" alt=""></a>
                                <div class="lr-banner-new">
                                    <span>new</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">       
                            <div class="litele-img">
                                <a href="{{$slogans[3]->link}}"><img src="{{asset('upload/hinhanh/'.$slogans[3]->photo)}}" alt=""></a>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="col-xs-12 hidden-sm col-md-3">
                <div class="banner-another-img">
                    <a href="{{$slogans[4]->link}}"><img src="{{asset('upload/hinhanh/'.$slogans[4]->photo)}}" alt=""></a>
                    <div class="banner-a-img-block">
                        <h2>{{$slogans[4]->name}}</h2>
                        <a href="{{$slogans[4]->link}}">SHOP NOW</a>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner area send-->
<!--t seller area start-->
<div class="best-seller-area another owl-indicator">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul class="my-nav" role="tablist">
                    <li role="presentation" class="active"><a href="#best-seller" aria-controls="best-seller" role="tab" data-toggle="tab">Sản phẩm bán chạy</a></li>
                    <li role="presentation"><a href="#add-cart" aria-controls="add-cart" role="tab" data-toggle="tab">Sản phẩm mới</a></li>
                    <li role="presentation"><a href="#most-wanted" aria-controls="most-wanted" role="tab" data-toggle="tab">Sản phẩm hot</a></li>
                </ul>    
            </div>
        </div>
        <div class="row">
           <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="best-seller">
                    <!--Sản phẩm bán chạy product-->
                    <div class="best-seller-product">
                    	<?php 
                    		$productSale = DB::table('products')->where('spbc',1)->where('status',1)->orderBy('id','desc')->take(8)->get();
                    		$productNew = DB::table('products')->where('status',1)->orderBy('id','desc')->take(8)->get();
                    		$productHot = DB::table('products')->where('noibat',1)->where('status',1)->orderBy('id','desc')->take(8)->get();
                    	?>
                       <!--single product start-->
                       	@foreach($productSale as $ps)
                        <div class="col-md-3">
                            <div class="single-product">
                                <div class="product-img">
                                   <a class="b-s-p-img" href="{{url('san-pham/'.$ps->alias.'.html')}}">
                                        <img class="primary-img" src="{{asset('upload/product/'.$ps->photo)}}" alt="{{$ps->name}}">
                                        <?php @$image = DB::table('images')->where('product_id', $ps->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>
                                    <div class="img-block">

                                    </div>
                                </div>
                                <div class="product-block-text">
                                    <h3><a href="{{url('san-pham/'.$ps->alias.'.html')}}">{{$ps->name}}<span>{{number_format($ps->price)}}</span></a></h3>
                                    <a class="p-b-t-a-c btn-addcartx" href="javascript:;" data-id="{{$ps->id}}">Thêm vào giỏ</a>
                                </div>
                            </div>   
                        </div>
                        @endforeach
                        <!--single product start-->    
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="add-cart">
                    <!--Sản phẩm bán chạy product-->
                    <div class="best-seller-product">
                       <!--single product start-->
                       	@foreach($productNew as $pn)
                        <div class="col-md-3">
                            <div class="single-product">
                                <div class="product-img">
                                   <a class="b-s-p-img" href="{{url('san-pham/'.$pn->alias.'.html')}}">
                                        <img class="primary-img" src="{{asset('upload/product/'.$pn->photo)}}" alt="">
                                        <?php @$image = DB::table('images')->where('product_id', $pn->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>
                                    <div class="img-block">


                                    </div>
                                </div>
                                <div class="product-block-text">
                                    <h3><a href="{{url('san-pham/'.$pn->alias.'.html')}}">{{$pn->name}}<span>{{number_format($pn->price)}}</span></a></h3>
                                    <a class="p-b-t-a-c btn-addcartx" href="javascript:;" data-id="{{$ps->id}}">Thêm vào giỏ</a>
                                </div>
                            </div>   
                        </div>
                        @endforeach
                        <!--single product start-->    
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="most-wanted">
                    <!--Sản phẩm bán chạy product-->
                    <div class="best-seller-product">
                       <!--single product start-->
                       @foreach($productHot as $item)
                        <div class="col-md-3">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{url('san-pham/'.$pn->alias.'.html')}}">
                                        <img class="primary-img" src="{{asset('upload/product/'.$item->photo)}}" alt="">
                                        <?php @$image = DB::table('images')->where('product_id', $pn->id)->orderBy('id','asc')->first(); ?>  
                                        <img class="hover-img" src="{{asset('upload/hasp/'.@$image->photo)}}" alt="">
                                    </a>
                                    <div class="img-block">
                                    </div>
                                </div>
                                <div class="product-block-text">
                                    <h3><a href="{{url('san-pham/'.$pn->alias.'.html')}}">{{$item->name}}<span>{{number_format($item->price)}}</span></a></h3>
                                    <a class="p-b-t-a-c btn-addcartx" href="javascript:;" data-id="{{$ps->id}}">Thêm vào giỏ</a>
                                </div>
                            </div>   
                        </div>
                        @endforeach
                        <!--single product start-->    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!--Sản phẩm bán chạy area end-->
<!--mens collection area start-->
<div class="mens-collection-area">
    <div class="container">
        <div class="row">

            <div class="hidden-xs col-sm-6 col-md-6 col-lg-6">
                <div class="collection-dress">
                    <a href="{{$lienkets->link}}"><img src="{{asset('upload/hinhanh/'.$lienkets->photo)}}" alt=""></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="mens-collection-text">
                    <div class="collection-tablecell">
                        <h1 class="title2"><strong>{{$lienkets->name}} </strong></h1>
                        <!-- <h1 class="title2">THỜI TRANG NAM</h1> -->
                        <p>{!! $lienkets->mota !!}</p>
                        <a href="{{$lienkets->link}}">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--mens collection area end-->
<!--The blog from start-->
<div class="the-blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="the-blog-title">
                   <h3>TIN TỨC</h3>
                </div>
            </div>
        </div>
        <!--single blog-from sart-->
        <div class="row">
            <div class="blog-from-list">
            	@foreach($tintuc_moinhat as $news)
                <div class="col-md-4">
                    <div class="single-blog-from">
                        <div class="blog-from-block">
                            <a href="{{url('tin-tuc/'.$news->alias.'.html')}}"><img src="{{asset('upload/news/'.$news->photo)}}" alt=""></a>
                            <div class="blog-img-block">
                                <h3><a href="{{url('tin-tuc/'.$news->alias.'.html')}}">{{$news->name}}</a></h3>
                               <div class="blog-img-info">
                                  <a href="#"><i class="fa fa-calendar"></i>{{date('d/m/Y', strtotime($news->created_at))}}</a>
                               </div>
                            </div>
                        </div>    
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--single blog-from end-->
    </div>
</div>
@endsection
