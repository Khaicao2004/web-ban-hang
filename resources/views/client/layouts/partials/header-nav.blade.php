<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="header__logo">
                <a href="./index.html"><img src="/client/img/logo.png" alt=""></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <nav class="header__menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
                    {{-- <li><a href="">Shop</a></li> --}}
                    <li><a href="#">Danh muc</a>
                        <ul class="dropdown">
                            @foreach ($catalogues as $catalogue)
                            <li><a href="{{ route('shop',$catalogue->slug) }}">{{$catalogue->name}}</a></li>    
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Contacts</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="header__nav__option">
                <button class="search-switch btn btn-secondery"><img src="/client/img/icon/search.png"
                        alt=""></button>
                <a href="#"><img src="/client/img/icon/heart.png" alt=""></a>
                <a href="{{ route('cart.list') }}"><img src="/client/img/icon/cart.png" alt=""> <span>{{count(session('cart', []))}}</span></a>
                <div class="price">{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</div>
            </div>
        </div>
    </div>
    <div class="canvas__open"><i class="fa fa-bars"></i></div>
</div>