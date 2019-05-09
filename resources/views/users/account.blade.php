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
                                {{-- @foreach ($categories as $cat)
							
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
                                    
                                @endforeach --}}
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
                    <li class="active">Checkout</li>
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
                    <form id="checkout-form" method="POST" action="{{url('/account')}}">{{ csrf_field() }}
                        <div class="col-md-6">
                                
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Update Account</h3>
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" required id="name" name="name" value="{{$userDetails->name}}" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" required minlength="10" name="address" placeholder="Your Address" value="{{$userDetails->address}}">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" required minlength="3" name="city" placeholder="Your City" value="{{$userDetails->city}}">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" required minlength="3" name="state" placeholder="Your State" value="{{$userDetails->state}}">
                                </div>
                                <div class="form-group">
                                    <div class="input-select">
                                            <select required class="input" name="country" id="country">
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
                                    <input class="input" type="text" required minlength="4" name="zipcode" placeholder="Your Zipcode" value="{{$userDetails->zipcode}}">
                                </div>
                                <div class="form-group">
                                    <input class="input" type="text" required minlength="8" name="mobile" placeholder="Your Mobile Number" value="{{$userDetails->mobile}}">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Save" class="primary-btn">
                                </div>
                            </div>
                        </div>   
                    </form>

                    <form id="checkout-form" class="clearfix" method="POST" action="{{url('update-user-pwd')}}">{{ csrf_field() }}
                            <div class="col-md-6">
                                    
                                <div class="billing-details">\
                                    <div class="section-title">
                                        <h3 class="title">Update Password</h3>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="password" required minlength="6" maxlength="20" name="current_pwd" id="current_pwd" placeholder="Old Password">
                                        <span id="chkPwd"></span>
                                    </div>
                                    <div class="form-group">
                                        <input class="input" required type="password" id="new_pwd" name="new_pwd" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" required type="password" id="confirm_pwd" name="confirm_pwd" placeholder="Confirm New Password">
                                    </div>
                                    <div class="form-group">
                                        <input class="primary-btn" type="submit" value="Update" placeholder="Email">
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