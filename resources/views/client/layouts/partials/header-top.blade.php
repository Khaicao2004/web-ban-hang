<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7">
                <div class="header__top__left">
                    <p>Free shipping, 30-day return or refund guarantee.</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="header__top__right">
                    <div class="header__top__links">
                        @if (Auth::user())
                        {{-- <span>Xin chào: {{Auth::user()->name}} </span> --}}
                        <form action="{{ route('auth.logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary"><a>Logout</a></button>
                        </form>
                        @else
                        <a href="{{ route('auth.login') }}">Sign in</a>           
                        @endif
                    </div>
                    <div class="header__top__hover">
                        <span>Usd <i class="arrow_carrot-down"></i></span>
                        <ul>
                            <li>USD</li>
                            <li>EUR</li>
                            <li>USD</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>