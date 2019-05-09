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
                            <li class="dropdown mega-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Women <i class="fa fa-caret-down"></i></a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row hidden-sm hidden-xs">
                                        <div class="col-md-12">
                                            <hr>
                                            <a class="banner banner-1" href="#">
                                                <img src="./img/banner05.jpg" alt="">
                                                <div class="banner-caption text-center">
                                                    <h2 class="white-color">NEW COLLECTION</h2>
                                                    <h3 class="white-color font-weak">HOT DEAL</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown mega-dropdown full-width"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Men <i class="fa fa-caret-down"></i></a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="hidden-sm hidden-xs">
                                                <a class="banner banner-1" href="#">
                                                    <img src="./img/banner06.jpg" alt="">
                                                    <div class="banner-caption text-center">
                                                        <h3 class="white-color text-uppercase">Women’s</h3>
                                                    </div>
                                                </a>
                                                <hr>
                                            </div>
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="hidden-sm hidden-xs">
                                                <a class="banner banner-1" href="#">
                                                    <img src="./img/banner07.jpg" alt="">
                                                    <div class="banner-caption text-center">
                                                        <h3 class="white-color text-uppercase">Men’s</h3>
                                                    </div>
                                                </a>
                                            </div>
                                            <hr>
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="hidden-sm hidden-xs">
                                                <a class="banner banner-1" href="#">
                                                    <img src="./img/banner08.jpg" alt="">
                                                    <div class="banner-caption text-center">
                                                        <h3 class="white-color text-uppercase">Accessories</h3>
                                                    </div>
                                                </a>
                                            </div>
                                            <hr>
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="hidden-sm hidden-xs">
                                                <a class="banner banner-1" href="#">
                                                    <img src="./img/banner09.jpg" alt="">
                                                    <div class="banner-caption text-center">
                                                        <h3 class="white-color text-uppercase">Bags</h3>
                                                    </div>
                                                </a>
                                            </div>
                                            <hr>
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="#">Women’s Clothing</a></li>
                                                <li><a href="#">Men’s Clothing</a></li>
                                                <li><a href="#">Phones & Accessories</a></li>
                                                <li><a href="#">Jewelry & Watches</a></li>
                                                <li><a href="#">Bags & Shoes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#">Sales</a></li>
                            <li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Pages <i class="fa fa-caret-down"></i></a>
                                <ul class="custom-menu">
                                <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="products">Products</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </li>
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
                    <li><a href="#">Home</a></li>
                    <li class="active">Orders</li>
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
                                    <h3 class="title">Orders</h3>
                                </div>
                                <table class="shopping-cart-table table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Order Id</th>
                                            <th class="text-center">Ordered Products</th>
                                            <th class="text-center">Payment Method</th>
                                            <th class="text-center">Grand Total</th>
                                            <th class="text-center">Created On</th>
                                            <th class="text-center">Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{$order->id}}</td>
                                            <td class="text-center primary-btn" style="width:100%;"><a style="color:white" href="{{url('orders/'.$order->id)}}">@foreach ($order->orders as $product)
                                               {{$product->product_name}}<br>
                                            @endforeach</td></a>
                                            <td class="text-center">{{$order->payment_method}}</td>
                                            <td class="text-center">{{$order->grand_total}}</td>
                                            <td class="text-center">{{$order->created_at}}</td>
                                            <td class="text-center">{{$order->order_status}}</td>

                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
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