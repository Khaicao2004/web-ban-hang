@extends('client.layouts.master')

@section('title')
    Thanh toán
@endsection

@section('content')
    @include('client.layouts.components.breadcrumb', [
        'pageName' => 'Thanh toán',
        'pageTitle' => 'Thanh toán',
    ])
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('order.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="checkout__input">
                                        <p>Họ và tên<span>*</span></p>
                                        <input type="text" name="user_name" id="user_name" class="form-control"
                                            placeholder="Cao Quốc Khải" value="{{ auth()->user()?->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name="user_address" id="user_address" class="form-control"
                                    placeholder="Số nhà 1, phố Nhổn, Bắc Từ Liêm, Hà Nội"
                                    value="{{ auth()->user()?->address }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="user_phone" id="user_phone" class="form-control"
                                            placeholder="0899354031" value="{{ auth()->user()?->phone }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="user_email" id="user_email" class="form-control"
                                            placeholder="khaicao2004@gmail.com" value="{{ auth()->user()?->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Ghi chú đơn hàng<span>*</span></p>
                                <input type="text" name="user_note" id="user_note" class="form-control"
                                    placeholder="Áo thun size M">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng giá</span></div>
                                <ul class="checkout__total__products">
                                    @if (session()->has('cart'))
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @foreach (session('cart') as $item)
                                            @php
                                                $total = $item['price'] * $item['quantity'];
                                            @endphp
                                            <li>{{ $stt += 1 }}. {{ $item['product_name'] }}
                                                <span>
                                                    {{ number_format($total, 0, ',', '.') }}₫
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$750.99</span></li>
                                    <li>Tổng giá đơn hàng <span>{{ number_format($totalAmount, 0, ',', '.') }}₫</span></li>
                                </ul>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
