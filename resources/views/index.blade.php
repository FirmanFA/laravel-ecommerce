@extends('layouts.frontLayout.front_design')
@section('content')
    <!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav">
					<span class="category-header">Categories <i class="fa fa-list"></i></span>
					<ul class="category-list">

                        @foreach ($categories as $cat)
						
						@if ($cat->status=="1")
						<li class="dropdown side-dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> {{$cat->name}} <i class="fa fa-angle-right"></i></a>
                                <div class="custom-menu" style="width:100%;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-links">
                                                <li>
                                                    <h3 class="list-links-title">Categories</h3></li>
                                                <li><a href="{{ asset('/products/'.$cat->url)}}">All</a></li>
                                                @foreach ($cat->categories as $sub_cat)
                                                    @if ($sub_cat->status == "1")
													<li><a href="{{asset('/products/'.$sub_cat->url)}}">{{$sub_cat->name}}</a></li>
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

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					@foreach ($banners as $banner)
						<!-- banner -->
						<div class="banner banner-1">
							<img src="{{ asset('images/frontend_images/'.$banner->image) }}" alt="">
							<div class="banner-caption text-center">
								<h1>{{$banner->title}}</h1>
								<a href="{{url('products')}}" class="btn primary-btn">Shop Now</a>
							</div>
						</div>
					@endforeach
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->


    <!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
                @foreach ($productsAll as $product)
                <!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                            <img src="{{ asset('images/backend_images/products/small/'.$product->image) }}" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">RP. {{ $product->price }}</h3>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                            </div>
						<h2 class="product-name"><a href="{{url('product/'.$product->id)}}">{{$product->product_name}}</a></h2>
                            <div class="product-btns">
									<a href="{{url('product/'.$product->id)}}" class="primary-btn add-to-cart" style="width:100%;text-align:center;"><i class="fa fa-shopping-cart"></i> View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->    
                @endforeach 
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<img src="{{ asset('images/frontend_images/banner13.jpg') }}" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="{{ asset('images/frontend_images/banner11.jpg') }}" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="{{ asset('images/frontend_images/banner12.jpg') }}" alt="">
						<div class="banner-caption text-center">
							<h2 class="white-color">NEW COLLECTION</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	
@endsection