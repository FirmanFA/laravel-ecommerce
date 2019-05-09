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
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Billing Details</h3>
                                </div>
                                <div class="form-group">
                                        <input class="input" type="text" required readonly name="billing_name" id="billing_name" value="{{$userDetails->name}}" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="10" name="billing_address" id="billing_address" placeholder="Your Address" value="{{$userDetails->address}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="3" name="billing_city" placeholder="Your City" id="billing_city" value="{{$userDetails->city}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" id="billing_state" type="text" required readonly minlength="3" name="billing_state" placeholder="Your State" value="{{$userDetails->state}}">
                                    </div>
                                    <div class="form-group">
                                            <input class="input" type="text" required readonly minlength="3" id="billing_country" value="{{$shippingDetails->country}}" name="billing_country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="4" id="billing_zipcode" name="billing_zipcode" placeholder="Your Zipcode" value="{{$userDetails->zipcode}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="8" name="billing_mobile" id="billing_mobile" placeholder="Your Mobile Number" value="{{$userDetails->mobile}}">
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Shipping Details</h3>
                                </div>
                                <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->name}}" required readonly name="shipping_name" id="shipping_name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->address}}" required readonly minlength="10" id="shipping_address" name="shipping_address" placeholder="Your Address" >
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="3" value="{{$shippingDetails->city}}" id="shipping_city" name="shipping_city" placeholder="Your City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="3" id="shipping_state" value="{{$shippingDetails->state}}" name="shipping_state" placeholder="Your State">
                                    </div>
                                    <div class="form-group">
                                            <input class="input" type="text" required readonly minlength="3" id="shipping_country" value="{{$shippingDetails->country}}" name="shipping_country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->zipcode}}" required readonly minlength="4" id="shipping_zipcode" name="shipping_zipcode" placeholder="Your Zipcode" >
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required readonly minlength="8"  value="{{$shippingDetails->mobile}}"id="shipping_mobile" name="shipping_mobile" placeholder="Your Mobile Number">
                                    </div>
                                
                            </div>
                        </div>
                        <form id="checkout-form" class="clearfix">
    
                                <div class="col-md-12">
                                    <div class="order-summary clearfix">
                                        <div class="section-title">
                                            <h3 class="title">Order Review</h3>
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
                                                        <td class="qty text-center"><input id="quantity" class="input" type="number" readonly value="{{$cart->quantity}}"></td>
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
                                                                    <input disabled style="border:0;text-align:center" readonly width="100%" type="text" name="coupon_code" @if (Session::has('CouponCode'))
                                                                        value="{{Session::get('CouponCode')}}"
                                                                    @else
                                                                        value="NOTSET"
                                                                    @endif id="coupon_code">
                                                                </form>
                                                                <form>
                                                            </div>
                                                            
                                                        </div></th>
                                                    <th>SUBTOTAL</th>
                                                    <th colspan="2" class="sub-total">RP. <?php echo $total_amount; ?></th>
                                                </tr>
                                                <tr>
                                                        <th>Shipping</th>
                                                        <th colspan="2">Free</th>
                                                </tr>
                                                </form>
                                                <form action="{{url('/place-order')}}" method="post" name="paymentForm" id="paymentForm">{{ csrf_field() }}
                                                @if (!empty(Session::get('CouponAmount')))
                                                    <tr>
                                                        <th colspan="3" rowspan="2">
                                                            <div class="payments-methods">
                                                                <div class="section-title">
                                                                    <h4 class="title">Payments Methods</h4>
                                                                </div>
                                                                <div class="input-checkbox">
                                                                    <input type="radio" name="payments" value="direct bank" id="payments-1" checked>
                                                                    <label for="payments-1">Direct Bank Transfer</label>
                                                                </div>
                                                                <div class="input-checkbox">
                                                                    <input type="radio" name="payments" value="cod" id="payments-2">
                                                                    <label for="payments-2">Cash On Delivery</label>
                                                                </div>
                                                                <div class="input-checkbox">
                                                                    <input type="radio" name="payments" value="indomart" id="payments-3">
                                                                    <label for="payments-3">indomart</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </th>
                                                        <th>COUPON</th>
                                                        <th colspan="2" class="sub-total" >
                                                            {{Session::get('CouponAmount')}}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>TOTAL</th>
                                                        <th colspan="2" class="total">RP. {{$total_amount-Session::get('CouponAmount')}}<br><del class="font-weak"><small>RP. {{$total_amount}}</small></del></th>
                                                        <input type="hidden" name="grand_total" value="{{$total_amount-Session::get('CouponAmount')}}}">
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3"></th>
                                                            <th colspan="3" style="padding-top:10px;padding-bottom:10px;">
                                                                    <button style="width:100%;height:50px;" type="submit" class="primary-btn pull-right">Checkout</a>
                                                            </th>
                                                        </tr>
                                                @else
                                                    <tr>
                                                            <th colspan="3" rowspan="2">
                                                                    <div class="payments-methods">
                                                                            <div class="section-title">
                                                                                <h4 class="title">Payments Methods</h4>
                                                                            </div>
                                                                            <div class="input-checkbox">
                                                                                <input type="radio" name="payments" value="direct bank" id="payments-1" checked>
                                                                                <label for="payments-1">Direct Bank Transfer</label>
                                                                            </div>
                                                                            <div class="input-checkbox">
                                                                                <input type="radio" name="payments" value="cod" id="payments-2">
                                                                                <label for="payments-2">Cash On Delivery</label>
                                                                            </div>
                                                                            <div class="input-checkbox">
                                                                                <input type="radio" name="payments" value="paypal" id="payments-3">
                                                                                <label for="payments-3">Paypal System</label>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                </th>
                                                        <th>TOTAL</th>
                                                        <th colspan="2" class="total">RP. <?php echo $total_amount; ?></th>
                                                        <input type="hidden" name="grand_total" value="{{$total_amount}}">
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3" style="padding-top:0px;padding-bottom:0px;">
                                                                <button style="width:100%;height:50px" type="submit" class="primary-btn">Checkout</button>
                                                        </th>
                                                    </tr>
                                                @endif
                                                
                                                </form>
                                                
                                            </tfoot>
                                        </table>
                                        {{-- <div class="pull-right">
                                            
                                        </div> --}}
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