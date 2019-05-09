@extends('layouts.frontLayout.front_design')
@section('content')
    <!-- NAVIGATION -->
	<div id="navigation">
            <!-- container -->
            <div class="container">
                <div id="responsive-nav">
                    <!-- category nav -->
                    <div class="category-nav show-on-click">
                        <span class="category-header">Categories <i class="fa fa-list"></i></span>
                        <ul class="category-list">
                                @foreach ($categories as $cat)
							
                                @if ($cat->status=="1")
                                <li class="dropdown side-dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> {{$cat->name}} <i class="fa fa-angle-right"></i></a>
                                        <div class="custom-menu" style="width:70%;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <ul class="list-links">
                                                        <li>
                                                            <h3 class="list-links-title">Categories</h3></li>
                                                        <li><a href="{{ url('products/'.$cat->url)}}">All</a></li>
                                                        @foreach ($cat->categories as $sub_cat)
                                                            @if ($sub_cat->status=="1")
                                                            <li><a href="{{ url('products/'.$sub_cat->url)}}">{{$sub_cat->name}}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <hr class="hidden-md hidden-lg">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                    
                                @endforeach
                                <li><a href="{{url('products')}}">View All</a></li>
                        </ul>
                    </div>
                    <!-- /category nav -->
    
                    <!-- menu nav -->
                    <div class="menu-nav">
                        <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                        <ul class="menu-list">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                    <!-- menu nav -->
                </div>
            </div>
            <!-- /container -->
        </div>
        <!-- /NAVIGATION -->
    
        <!-- BREADCRUMB -->
        <div id="breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- /BREADCRUMB -->
    
        <!-- section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                        @if (Session::has('flash_message_error'))
                        <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif  
                    @if (Session::has('flash_message_success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                    <form id="checkout-form" class="clearfix">
    
                        <div class="col-md-12">
                            <div class="order-summary clearfix">
                                <div class="section-title">
                                    <h3 class="title">Cart</h3>
                                </div>
                                <table class="shopping-cart-table table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th></th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total_amount=0;?>
                                        @foreach ($userCart as $cart)
                                            <tr>
                                                <td class="thumb"><img src="{{asset('images/backend_images/products/small/'.$cart->image)}}" alt=""></td>
                                                <td class="details">
                                                    <a href="#">{{ $cart->product_name }}</a>
                                                    <ul>
                                                        <li><span>Size: {{$cart->size}}</span></li>
                                                        <li><span>Color: {{$cart->product_color}}</span></li>
                                                    </ul>
                                                </td>
                                                <td class="price text-center"><strong>RP. {{$cart->price}}</strong>
                                                <td class="qty text-center"><a class="btn btn-mini btn-warning" href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}">+</a><input id="quantity" class="input" type="number" value="{{$cart->quantity}}"><a class="btn btn-mini btn-warning" href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}">-</a></td>
                                                <td class="total text-center"><strong class="primary-color">RP. {{$cart->price*$cart->quantity}}</strong></td>
                                                <td class="text-right"><a href="{{ url('/cart/delete-product/'.$cart->id) }}" class="main-btn icon-btn"><i class="fa fa-close"></i></a></td>
                                            </tr>
                                            <?php $total_amount=$total_amount+($cart->price*$cart->quantity);?>
                                        @endforeach 
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" rowspan="2"> <div class="coupon-apply">
                                                    <div class="section-title">
                                                        <h4 class="title">coupons</h4>
                                                    </div>
                                                </form>
                                                    <div class="input-text">
                                                        <form action="{{ url('/cart/apply-coupon')}}" method="post">{{ csrf_field() }}
                                                            <input type="text" name="coupon_code" value="{{Session::get('CouponCode')}}" id="coupon_code">
                                                            <input type="submit" value="APPLY" class="primary-btn">
                                                        </form>
                                                        <form>
                                                    </div>
                                                    
                                                </div></th>
                                            <th>SUBTOTAL</th>
                                            <th colspan="2" class="sub-total">RP. <?php echo $total_amount; ?></th>
                                        </tr>
                                        @if (!empty(Session::get('CouponAmount')))
                                            <tr>
                                                <th>COUPON</th>
                                                <th colspan="2" class="sub-total" >
                                                    {{Session::get('CouponAmount')}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="empty"></th>
                                                <th>TOTAL</th>
                                                <th colspan="2" class="total">RP. {{$total_amount-Session::get('CouponAmount')}}<br><del class="font-weak"><small>RP. {{$total_amount}}</small></del></th>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>TOTAL</th>
                                                <th colspan="2" class="total">RP. <?php echo $total_amount; ?></th>
                                            </tr>
                                        @endif
                                        
                                        
                                    </tfoot>
                                </table>
                                <div class="pull-right">
                                    <a href="{{ url('/checkout')}}" class="primary-btn">Checkout</a>
                                </div>
                            </div>
    
                        </div>
                    </form>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /section -->
@endsection