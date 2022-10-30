@include('user.header')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('Assets/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartProduct as $cartsProduct)
                                <tr class="cartPage">
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('upload/'.$cartsProduct->products->product_future_image)}}" alt="">
                                        <h5>{{$cartsProduct->products->product_name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$cartsProduct->product_price}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <input type="hidden" name="CartID" class="productID" value="{{$cartsProduct->id}}">
                                            <div class="pro-qty">
                                                <input type="text" class="productQty" name="CartQuantity" value="{{$cartsProduct->product_quantity}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{$cartsProduct->product_quantity * $cartsProduct->product_price}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{url('cart-product-delete', $cartsProduct->id)}}"><span class="icon_close"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn cart-btn-right">CONTINUE SHOPPING</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="shoping__continue">
                    @if (Session::has('couponDiscount'))
                    @else
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            @if (session()->has('couponInvalid'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span> </button>
                                    {{session()->get('couponInvalid')}}
                                </div>
                            @endif
                            <form action="{{url('apply-coupon')}}" method="POST">
                                @csrf
                                <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @if (Session::has('couponDiscount'))
                            <li>Subtotal <span>${{$total}}</span></li>
                            <li>Discount <span>{{session()->get('couponDiscount')['coupon_discount']}}%</span></li>
                            @php
                               $totalPrice = $total-$total*session()->get('couponDiscount')['coupon_discount']/100;
                            @endphp
                            <li>Total <span>${{sprintf('%d', $totalPrice)}}</span></li>
                        @else
                            <li>Subtotal <span>${{$total}}</span></li>
                            <li>Total <span>${{$total}}</span></li>
                        @endif
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->

@include('user.footer')