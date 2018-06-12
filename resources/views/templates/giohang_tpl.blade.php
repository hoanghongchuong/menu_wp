@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
?>
<div class="my-a-w-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="a-w-title">
                    <h1>Giỏ hàng</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area start -->
<div class="cart-main-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="{{route('updateCart')}}" method="post" id="cartformpage">   
                    <input type="hidden" name="_token" value="{{csrf_token()}}" >            
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình ảnh</th>
                                    <th class="product-name">Tên</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product_cart as $key=>$product)
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="{{asset('upload/product/'.$product->options->photo)}}" alt="{{$product->name}}" /></a></td>
                                    <td class="product-name"><a href="#">{{$product->name}}</a></td>
                                    <td class="product-price"><span class="amount">{{number_format($product->price)}}</span></td>
                                    <td class="product-quantity">
                                        <input type="number" class="tc item-quantity" min="0" value="{{$product->qty}}" id="{{ $product->rowId }}"  name="numb[{{$key}}]">
                                    </td>
                                    <td class="product-subtotal">{{number_format($product->price * $product->qty)}}</td>
                                    <td class="product-remove">
                                        <a id="{{$product->rowId}}" href="{{url('xoa-gio-hang/'.$product->rowId)}}"><i class="fa fa-times"></i></a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="buttons-cart">
                                <input type="submit" value="Cập nhật" />
                                <a href="{{url('san-pham')}}">Tiếp tục mua hàng</a>
                            </div>

                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <h2>Đơn hàng</h2>
                                <div class="clearfix"></div>
                                <table>
                                    <tbody>
                                        <tr class="order-total">
                                            <th>Tổng</th>
                                            <td>
                                                <strong><span class="amount">{{number_format($total)}}</span></strong>
                                            </td>
                                        </tr>                                           
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{url('thanh-toan')}}">Thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection
