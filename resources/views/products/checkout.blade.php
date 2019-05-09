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
                    <form id="checkout-form" class="clearfix" action="{{url('checkout')}}" method="POST">{{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Billing Details</h3>
                                </div>
                                <div class="form-group">
                                        <input class="input" type="text" required name="billing_name" id="billing_name" value="{{$userDetails->name}}" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="10" name="billing_address" id="billing_address" placeholder="Your Address" value="{{$userDetails->address}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="3" name="billing_city" placeholder="Your City" id="billing_city" value="{{$userDetails->city}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" id="billing_state" type="text" required minlength="3" name="billing_state" placeholder="Your State" value="{{$userDetails->state}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-select">
                                                <select required class="input" id="billing_country" name="billing_country">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->country_name}}" @if ($country->country_name==$userDetails->country)
                                                            selected
                                                        @endif >{{$country->country_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="4" id="billing_zipcode" name="billing_zipcode" placeholder="Your Zipcode" value="{{$userDetails->zipcode}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="8" name="billing_mobile" id="billing_mobile" placeholder="Your Mobile Number" value="{{$userDetails->mobile}}">
                                    </div>
                                <div class="form-group">
                                        <div class="input-checkbox">
                                            <input type="checkbox" id="samewbill">
                                            <label class="font-weak" for="samewbill">Shipping Address Same With Billing Address</label>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Shipping Details</h3>
                                </div>
                                <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->name}}" required name="shipping_name" id="shipping_name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->address}}" required minlength="10" id="shipping_address" name="shipping_address" placeholder="Your Address" >
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="3" value="{{$shippingDetails->city}}" id="shipping_city" name="shipping_city" placeholder="Your City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="3" id="shipping_state" value="{{$shippingDetails->state}}" name="shipping_state" placeholder="Your State">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-select">
                                                <select required class="input" id="shipping_country" name="shipping_country">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{$country->country_name}}" @if ($country->country_name==$shippingDetails->country)
                                                                selected
                                                            @endif>{{$country->country_name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" value="{{$shippingDetails->zipcode}}" required minlength="4" id="shipping_zipcode" name="shipping_zipcode" placeholder="Your Zipcode" >
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" required minlength="8"  value="{{$shippingDetails->mobile}}"id="shipping_mobile" name="shipping_mobile" placeholder="Your Mobile Number">
                                    </div>
                                    <div class="form-group pull-right">
                                            <button type="submit" class="primary-btn">Place Order</button>
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