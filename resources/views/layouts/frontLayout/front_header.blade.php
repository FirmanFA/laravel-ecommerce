@php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
$allCategories = Controller::allCategories();
$userCart = Controller::userCart();
$cartCount = Controller::cartCount();
@endphp

<!-- HEADER -->
<header>

    <!-- header -->
    <div id="header">
        <div class="container">
            <div class="pull-left">
                <!-- Logo -->
                <div class="header-logo">
                    <a class="logo" href="{{url('./')}}">
                        <img src="{{ asset('images/frontend_images/logo.png') }}" alt="">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Search -->
                <div class="header-search">
                    <form method="POST" action="{{url('search')}}">{{ csrf_field() }}
                        <input class="input" type="search" name="keyword" placeholder="Enter your keyword">
                        <button class="search-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- /Search -->
            </div>
            <div class="pull-right">
                <ul class="header-btns">
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-user-o"></i>
                            </div>
                            <strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
                        </div>
                       @if (empty(Auth::check()))
                       <a href="{{url('/login-register')}}" class="text-uppercase">Login / Join</a>
                       @else
                       <a href="{{url('/user-logout')}}" class="text-uppercase">Logout</a> 
                       @endif
                        <ul class="custom-menu">
                            <li><a href="{{url('/account')}}"><i class="fa fa-user-o"></i> My Account</a></li>
                            <li><a href="{{url('/orders')}}"><i class="fa fa-shopping-cart"></i> My order</a></li>
                            <li>
                                    @if (empty(Auth::check()))
                                    <a href="{{url('/login-register')}}"><i class="fa fa-unlock-alt"></i> Sign In / Sign Up </a>
                                    @else
                                    <a href="{{url('/user-logout')}}"><i class="fa fa-unlock-alt"></i>        Logout </a> 
                                    @endif
                                </li>
                        </ul>
                    </li>
                    <!-- /Account -->

                    <!-- Cart -->
                    <li class="header-cart dropdown default-dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <div class="header-btns-icon">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="qty">{{$cartCount}}</span>
                            </div>
                            <strong class="text-uppercase">My Cart:</strong>
                            <br>
                            <span>@php
                                $total_amount = 0;
                                foreach($userCart as $item){
                                    $total_amount = $total_amount + ($item->price * $item->quantity);
                                }
                                echo "Rp "; echo $total_amount;
                            @endphp</span>
                        </a>
                        <div class="custom-menu">
                            <div id="shopping-cart">
                                <div class="shopping-cart-list">
                                    @foreach ($userCart as $cart)
                                    <div class="product product-widget">
                                            <div class="product-thumb">
                                                <img src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price">Rp {{$cart->price}}<span class="qty"> x{{$cart->quantity}}</span></h3>
                                                <h2 class="product-name"><a href="{{url('product/'.$cart->product_id)}}">{{$cart->product_name}}</a></h2>
                                            </div>
                                            <a href="{{ url('/cart/delete-product/'.$cart->id) }}" class="cancel-btn"><i class="fa fa-trash"></i></a>
                                        </div>    
                                    @endforeach
                                    
                                </div>
                                <div class="shopping-cart-btns">
                                    <a href="{{url('cart')}}" class="main-btn">View Cart</a>
                                    <a href="{{url('checkout')}}" class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /Cart -->

                    <!-- Mobile nav toggle-->
                    <li class="nav-toggle"> 
                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                    </li>
                    <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
    </div>
    <!-- container -->
</header>
<!-- /HEADER -->