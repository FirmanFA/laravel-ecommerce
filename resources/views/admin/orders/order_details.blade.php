@extends('layouts.adminLayout.admin_design')
@section('content')

    <!--main-container-part-->
<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Order</a> </div>
          <h1>Order Number {{$orderDetails->id}}</h1>
        </div>
        <div class="container-fluid">
          <hr>
          <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Order Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td class="taskDesc"><i class="icon-info-sign"></i> Order Date</td>
                            <td class="taskStatus"><span class="in-progress">{{$orderDetails->created_at}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Order Status</td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->order_status}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Order Total</td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->grand_total}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Shipping Charges</td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->shipping_charges}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Coupon Code </td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->coupon_code}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Coupon Amount</td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->coupon_amount}}</span></td>
                            </tr>
                            <tr>
                            <td class="taskDesc"><i class="icon-plus-sign"></i>Payment Method</td>
                            <td class="taskStatus"><span class="pending">{{$orderDetails->payment_method}}</span></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                
              <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                  <div class="accordion-heading">
                    <div class="widget-title"> 
                      <h5>Billing Address</h5>
                     </div>
                  </div>
                  <div class="collapse in accordion-body" id="collapseGOne">
                    <div class="widget-content"> {{$userDetails->name}}<br>
                        {{$userDetails->address}}<br>
                        {{$userDetails->city}}<br>
                        {{$userDetails->state}}<br>
                        {{$userDetails->country}}<br>
                        {{$userDetails->zipcode}}<br>
                        {{$userDetails->mobile}}<br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="span6">
                    <div class="widget-box">
                            <div class="widget-title">
                                <h5>Customer Details</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th></th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="taskDesc"><i class="icon-info-sign"></i>Customer Name</td>
                                    <td class="taskStatus"><span class="in-progress">{{$orderDetails->name}}</span></td>
                                    </tr>
                                    <tr>
                                    <td class="taskDesc"><i class="icon-plus-sign"></i>Customer Email</td>
                                    <td class="taskStatus"><span class="pending">{{$orderDetails->user_email}}</span></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="accordion" id="collapse-group">
                                <div class="accordion-group widget-box">
                                  <div class="accordion-heading">
                                    <div class="widget-title"> 
                                      <h5>Update Order Status</h5>
                                     </div>
                                  </div>
                                  <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content">
                                        <form action="{{url('admin/update-order-status')}}" method="POST">{{ csrf_field() }}
                                            <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                                            <select name="order_status" id="order_status" required style="width:100px;">
                                                <option value="new" @if ($orderDetails->order_status=="new")
                                                    selected
                                                @endif>New</option>
                                                <option value="pending" @if ($orderDetails->order_status=="pending")
                                                        selected
                                                    @endif >Pending</option>
                                                <option value="cancelled" @if ($orderDetails->order_status=="cancelled")
                                                        selected
                                                    @endif >Cancelled</option>
                                                <option value="proses" @if ($orderDetails->order_status=="proses")
                                                        selected
                                                    @endif >Proses</option>
                                                <option value="dikirim" @if ($orderDetails->order_status=="dikirm")
                                                        selected
                                                    @endif >diKirim</option>
                                                <option value="dibayar" @if ($orderDetails->order_status=="dibayar")
                                                        selected
                                                    @endif >diBayar</option>
                                                <option value="diterima" @if ($orderDetails->order_status=="diterima")
                                                        selected
                                                    @endif >diTerima</option>
                                                <option value="sampai" @if ($orderDetails->order_status=="sampai")
                                                        selected
                                                    @endif >Sampai</option>
                                            </select>
                                            <input type="submit" value="Update Status" class="btn primary-btn">
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <div class="accordion" id="collapse-group">
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                <div class="widget-title"> 
                                    <h5>Shipping Details</h5>
                                    </div>
                                </div>
                                <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">{{$orderDetails->name}}<br>
                                    {{$orderDetails->address}}<br>
                                    {{$orderDetails->city}}<br>
                                    {{$orderDetails->state}}<br>
                                    {{$orderDetails->country}}<br>
                                    {{$orderDetails->zipcode}}<br>
                                    {{$orderDetails->mobile}}<br> </div>
                                </div>
                            </div>
                        </div>
            </div>
          </div>
          <div class="row-fluid">
                <table class="shopping-cart-table table">
                        <thead>
                            <tr>
                                <th class="text-center">Product Code</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Product Size</th>
                                <th class="text-center">Product Color</th>
                                <th class="text-center">Product Price</th>
                                <th class="text-center">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($orderDetails->orders as $product)
                            <tr>
                                <td class="text-center">{{$product->product_code}}</td>
                                <td class="text-center">{{$product->product_name}}</td>
                                <td class="text-center">{{$product->product_size}}</td>
                                <td class="text-center">{{$product->product_color}}</td>
                                <td class="text-center">{{$product->product_price}}</td>
                                <td class="text-center">{{$product->product_qty}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
          </div>
        </div>
      </div>
      <!--main-container-part-->

@endsection