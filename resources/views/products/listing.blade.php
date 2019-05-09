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
													<li><a href="{{$cat->url}}">All</a></li>
													@foreach ($cat->categories as $sub_cat)
														@if ($sub_cat->status=="1")
														<li><a href="{{$sub_cat->url}}">{{$sub_cat->name}}</a></li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Shop by:</h3>
							<ul class="filter-list">
								<li><span class="text-uppercase">color:</span></li>
								<li><a href="#" style="color:#FFF; background-color:#8A2454;">Camelot</a></li>
								<li><a href="#" style="color:#FFF; background-color:#475984;">East Bay</a></li>
								<li><a href="#" style="color:#FFF; background-color:#BF6989;">Tapestry</a></li>
								<li><a href="#" style="color:#FFF; background-color:#9A54D8;">Medium Purple</a></li>
							</ul>
	
							<ul class="filter-list">
								<li><span class="text-uppercase">Size:</span></li>
								<li><a href="#">X</a></li>
								<li><a href="#">XL</a></li>
							</ul>
	
							<ul class="filter-list">
								<li><span class="text-uppercase">Price:</span></li>
								<li><a href="#">MIN: $20.00</a></li>
								<li><a href="#">MAX: $120.00</a></li>
							</ul>
	
							<ul class="filter-list">
								<li><span class="text-uppercase">Gender:</span></li>
								<li><a href="#">Men</a></li>
							</ul>
	
							<button class="primary-btn">Clear All</button> --}}
						</div>
						<!-- /aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Filter by Price</h3>
							<div id="price-slider"></div> --}}
						</div>
						<!-- aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Filter By Color:</h3>
							<ul class="color-option">
								<li><a href="#" style="background-color:#475984;"></a></li>
								<li><a href="#" style="background-color:#8A2454;"></a></li>
								<li class="active"><a href="#" style="background-color:#BF6989;"></a></li>
								<li><a href="#" style="background-color:#9A54D8;"></a></li>
								<li><a href="#" style="background-color:#675F52;"></a></li>
								<li><a href="#" style="background-color:#050505;"></a></li>
								<li><a href="#" style="background-color:#D5B47B;"></a></li>
							</ul> --}}
						</div>
						<!-- /aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Filter By Size:</h3>
							<ul class="size-option">
								<li class="active"><a href="#">S</a></li>
								<li class="active"><a href="#">XL</a></li>
								<li><a href="#">SL</a></li>
							</ul> --}}
						</div>
						<!-- /aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Filter by Brand</h3>
							<ul class="list-links">
								<li><a href="#">Nike</a></li>
								<li><a href="#">Adidas</a></li>
								<li><a href="#">Polo</a></li>
								<li><a href="#">Lacost</a></li>
							</ul> --}}
						</div>
						<!-- /aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Filter by Gender</h3>
							<ul class="list-links">
								<li class="active"><a href="#">Men</a></li>
								<li><a href="#">Women</a></li>
							</ul> --}}
						</div>
						<!-- /aside widget -->
	
						<!-- aside widget -->
						<div class="aside">
							{{-- <h3 class="aside-title">Top Rated Product</h3>
							<!-- widget product -->
							<div class="product product-widget">
								<div class="product-thumb">
									<img src="./img/thumb-product01.jpg" alt="">
								</div>
								<div class="product-body">
									<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
									<h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
								</div>
							</div>
							<!-- /widget product -->
	
							<!-- widget product -->
							<div class="product product-widget">
								<div class="product-thumb">
									<img src="./img/thumb-product01.jpg" alt="">
								</div>
								<div class="product-body">
									<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
									<h3 class="product-price">$32.50</h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
								</div>
							</div> --}}
							<!-- /widget product -->
						</div>
						<!-- /aside widget -->
					</div>
					<!-- /ASIDE -->
	
					<!-- MAIN -->
					<div id="main" class="col-md-9">
	
						<!-- STORE -->
						<div id="store">
							<!-- row -->
							<div class="row">
								<!-- Product Single -->
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
						<!-- /STORE -->
	
						
					</div>
					<!-- /MAIN -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

	
@endsection