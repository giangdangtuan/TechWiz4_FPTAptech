@extends('clients.layouts.app')
@section('content')

<div class="ltn__breadcrumb-area ltn__breadcrumb-area-4 ltn__breadcrumb-color-white---">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner text-center">
                    <h1 class="ltn__page-title">Cart</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- SHOPING CART AREA START -->
<div class="liton__shoping-cart-area mb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        @if (session()->has('success'))
                        <div>
                            {{session()->get('success')}}
                        </div>
                        @endif
                        <form style="display:flex;" action="{{URL::to('updateCart')}}" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                    <th class="cart-product-remove">Remove</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Product</th>
                                    <th class="cart-product-price" style="text-align: right">Price</th>
                                    <th class="cart-product-quantity" style="display: flex;justify-content: center">Quantity</th>
                                    <th class="cart-product-subtotal" style="text-align: center">Subtotal</th>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    $total=0;
                                    @endphp
                                    @foreach ($cartItems as $cartItem)
                                    <tr class="row">
                                        <td class="col-2 "><a href="{{URL::to('deleteCartItem/'.$cartItem->id)}}">x</a></td>
                                        <td class="col-2 " >
                                            <a href="{{URL::to('single/accessory/'.$cartItem->accessory_id)}}">
                                                @php
                                                        $images = \App\Models\Images::all()->where('product_id','=',$cartItem->accessory_id)->toArray();
                                                        $images= array_values($images);
                                                    @endphp
                                                <img src="{{ asset('images/product/' .  $images[0]['name']) }}" style="width: 100px; height: 66px; object-fit: cover" alt="#">

                                            </a>
                                        </td>
                                        <td class="col-2 ">
                                            <h4><a href="{{URL::to('single/accessory/'.$cartItem->accessory_id)}}" style="width= 50px">{{substr($cartItem->name,0,30)}}</a></h4>
                                        </td>
                                        <td class="col-2 " style="text-align:right">${{$cartItem->price}}</td>
                                        <td class="col-2 ">
                                                <div class="cart-plus-minus">
                                                    <input type="number" value="{{$cartItem->quanity}}" name="quantity[]" class="cart-plus-minus-box">
                                                </div>
                                                <input class="display: none" type="hidden" name="id[]" value="{{$cartItem->id}}">
                                        </td>
                                        <td class="col-2" style="text-align:right">${{$cartItem->price*$cartItem->quanity}}</td>
                                    </tr>
                                    @php
                                    $total+=($cartItem->price*$cartItem->quanity);
                                    $i++;
                                    @endphp
                                    @endforeach
                                    <tr class="cart-coupon-row" style="display: flex;justify-content: end">
                                        <td>
                                            <button type="submit" class="btn theme-btn-2 btn-effect-2--">Update Cart</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cart Subtotal</td>
                                    <td>${{$total}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping and Handing</td>
                                    <td>$15.00</td>
                                </tr>
                                <tr>
                                    <td>Vat</td>
                                    <td>$00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>${{$total + 15}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right">
                            <a href="/checkout" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SHOPING CART AREA END -->
@endsection
