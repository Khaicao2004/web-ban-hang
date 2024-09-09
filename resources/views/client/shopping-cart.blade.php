@extends('client.layouts.master')

@section('title')
    Giỏ hàng
@endsection

@section('content')
    @include('client.layouts.components.breadcrumb', ['pageName' => 'Giỏ hàng', 'pageTitle' => 'Giỏ hàng'])
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tổng giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('cart'))
                                    @foreach (session('cart') as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['product_name'] }}"
                                                        width="60px" height="60">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item['product_name'] }}</h6>
                                                    <h5 class="mb-2">
                                                        {{ number_format($item['price'], 0, ',', '.') }}₫
                                                    </h5>
                                                    @foreach ($item['attributes'] as $attributeName => $attributeValueId)
                                                    <div class="d-flex">
                                                        <h6 class="mr-2">{{ $attributeName }}:</h6>
                                                        @php
                                                            $attributeValue = \App\Models\AttributeValue::find($attributeValueId);
                                                        @endphp
                                                        <h6> {{ $attributeValue->name }}</h6> 
                                                    </div>
                                                @endforeach
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="{{ $item['quantity'] }}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                @php
                                                    $total = $item['price'] * $item['quantity'];
                                                @endphp
                                                {{ number_format($total, 0, ',', '.') }}₫
                                            </td>
                                            <td class="cart__close"><i class="fa fa-close"></i></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Total <span>{{ number_format($totalAmount) }}₫</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
