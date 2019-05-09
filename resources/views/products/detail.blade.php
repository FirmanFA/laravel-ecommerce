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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Category</a></li>
                    <li class="active">{{ $productDetails->product_name }}</li>
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
                    <!--  Product Details -->
                    <div class="product product-details clearfix">
                        <div class="col-md-6">
                            <div id="product-main-view">
                                <div class="product-view" style="cursor:zoom-out;">
                                    <img src="{{asset('images/backend_images/products/large/'.$productDetails->image)}}" alt="">
                                </div>
                                @foreach ($productAltImages as $altImage)
                                <div class="product-view" style="cursor:zoom-out;">
                                        <img src="{{asset('images/backend_images/products/large/'.$altImage->image)}}" alt="">
                                </div>
                                @endforeach
                            </div>
                            <div id="product-view">
                                <div class="product-view">
                                    <img src="{{asset('images/backend_images/products/medium/'.$productDetails->image)}}" alt="">
                                </div>
                                @foreach ($productAltImages as $altImage)
                                <div class="product-view">
                                        <img src="{{asset('images/backend_images/products/medium/'.$altImage->image)}}" alt="">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ url('add-cart') }}" name="addtoCartForm" id="addtoCartForm" method="POST" >{{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
                                <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
                                <input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
                                <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
                                <div class="product-body">
                                    <div class="product-label">
                                    </div>
                                    <h2 class="product-name">{{$productDetails->product_name}}</h2>
                                    <h3 id="getPrice" class="product-price">RP. {{$productDetails->price}}</h3>
                                    <div>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <a href="#">3 Review(s) / Add Review</a>
                                    </div>
                                    <p> <strong id="productStock">Availability : Choose Size</strong> </p>
                                    <p>{{$productDetails->description}}</p>
                                    <div class="product-options">
                                        <ul class="size-option">
                                            <select name="size" id="selSize" required>
                                                    <option value="">Select Size</option>
                                                    @foreach ($productDetails->attributes as $sizes)
                                                    <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                                    @endforeach
                                            </select>
                                            
                                        </ul>
                                        
                                    </div>
        
                                    <div class="product-btns">
                                        <div class="qty-input">
                                            <span class="text-uppercase">QTY: </span>
                                            <input class="input" id="productqty" name="quantity" value="1" type="number" min="1" >
                                        </div>
                                        <button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                        <div class="pull-right">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="product-tab">
                                <ul class="tab-nav">
                                    <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                                    <li><a data-toggle="tab" href="#care">Material & Care</a></li>
                                    <li><a data-toggle="tab" href="#tab2">Reviews (3)</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="description" class="tab-pane fade in active">
                                        <p>{{$productDetails->description}}</p>
                                    </div>
                                    <div id="care" class="tab-pane fade in active">
                                        <p>{{$productDetails->care}}</p>
                                    </div>
                                    <div id="tab2" class="tab-pane fade in">
    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="product-reviews">
                                                    <div class="single-review">
                                                        <div class="review-heading">
                                                            <div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
                                                            <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                            <div class="review-rating pull-right">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o empty"></i>
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                        </div>
                                                    </div>
    
                                                    <div class="single-review">
                                                        <div class="review-heading">
                                                            <div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
                                                            <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                            <div class="review-rating pull-right">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o empty"></i>
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                        </div>
                                                    </div>
    
                                                    <div class="single-review">
                                                        <div class="review-heading">
                                                            <div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
                                                            <div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
                                                            <div class="review-rating pull-right">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o empty"></i>
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
                                                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                                        </div>
                                                    </div>
    
                                                    <ul class="reviews-pages">
                                                        <li class="active">1</li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="text-uppercase">Write Your Review</h4>
                                                <p>Your email address will not be published.</p>
                                                <form class="review-form">
                                                    <div class="form-group">
                                                        <input class="input" type="text" placeholder="Your Name" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="input" type="email" placeholder="Email Address" />
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="input" placeholder="Your review"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-rating">
                                                            <strong class="text-uppercase">Your Rating: </strong>
                                                            <div class="stars">
                                                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                                                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                                                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                                                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                                                                <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="primary-btn">Submit</button>
                                                </form>
                                            </div>
                                        </div>
    
    
    
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <!-- /Product Details -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /section -->
    
        <!-- section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="title">Picked For You</h2>
                        </div>
                    </div>
                    <!-- section title -->

                    @foreach ($relatedProducts as $product)
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
                                <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
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
	
@endsection