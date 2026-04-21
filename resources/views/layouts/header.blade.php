<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="/"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>{{ Helper::wishlistCount() }}</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>{{ Helper::cartCount() }}</span></a></li>
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @auth
                <div class="user__dropdown">
                    <a href="#" class="user__dropdown__toggle">
                        <i class="fa fa-user"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="user__dropdown__menu">
                        <li><a href="/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
            @endauth
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="{{route('product-grids')}}">Shop</a></li>
            <li><a href="{{route('blog.index')}}">Blog</a></li>
            <li><a href="{{route('about-us')}}">About Us</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> ebasket2@gmail.com</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> ebasket2@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            @auth
                                <div class="user__dropdown">
                                    <a href="#" class="user__dropdown__toggle">
                                        <i class="fa fa-user"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="user__dropdown__menu">
                                        <li><a href="/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="{{route('product-grids')}}">Shop</a></li>
                        <li><a href="{{route('blog.index')}}">Blog</a></li>
                        <li><a href="{{route('about-us')}}">About Us</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{route('wishlist')}}"><i class="fa fa-heart"></i> <span>{{ Helper::wishlistCount() }}</span></a></li>
                        <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>{{ Helper::cartCount() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Dropdown CSS -->
<style>
    .user__dropdown {
        position: relative;
        display: inline-block;
    }

    .user__dropdown__toggle {
        color: #fff;
        text-decoration: none;
        cursor: pointer;
    }

    .user__dropdown__toggle:hover {
        color: #7fba00;
    }

    .user__dropdown__menu {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background: #fff;
        min-width: 160px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        list-style: none;
        padding: 8px 0;
        margin: 0;
        z-index: 9999;
    }

    .user__dropdown__menu li a {
        display: block;
        padding: 10px 20px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s;
    }

    .user__dropdown__menu li a:hover {
        background: #f5f5f5;
        color: #7fba00;
        padding-left: 25px;
    }

    .user__dropdown__menu li a i {
        margin-right: 8px;
        width: 15px;
    }

    .user__dropdown__menu li:not(:last-child) {
        border-bottom: 1px solid #f0f0f0;
    }

    .user__dropdown:hover .user__dropdown__menu {
        display: block;
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>