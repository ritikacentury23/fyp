<style>
.account-nav {
    width: 100%;
    background: #fff;
    padding: 10px 0;
    border-radius: 10px;
    list-style: none;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    margin: 0;
}
.account-nav li {
    margin-bottom: 2px;
}
.account-nav .menu-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 20px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
    border-left: 3px solid transparent;
    transition: 0.2s;
}
.account-nav .menu-link i {
    width: 16px;
    text-align: center;
    font-size: 15px;
}
.account-nav .menu-link:hover {
    background: #f5f5f5;
    color: #333;
    border-left-color: #ccc;
}
.account-nav .menu-link_active {
    background: #f0f7e6;
    color: #4a8f00;
    font-weight: 600;
    border-left-color: #7fba00;
}
.account-nav .nav-section {
    padding: 10px 20px 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #bbb;
    margin-top: 6px;
}
.account-nav .menu-link.logout-link {
    color: #dc3545;
}
.account-nav .menu-link.logout-link:hover {
    background: #fce4ec;
    border-left-color: #dc3545;
}
.user-avatar {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 6px;
}
.user-avatar-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7fba00, #4a8f00);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 700;
    flex-shrink: 0;
}
</style>

<ul class="account-nav">
    {{-- User Info --}}
    <li>
        <div class="user-avatar">
            <div class="user-avatar-circle">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:14px;color:#333;">{{ Auth::user()->name }}</div>
                <div style="font-size:12px;color:#aaa;">{{ Auth::user()->email }}</div>
            </div>
        </div>
    </li>

    {{-- Overview --}}
    <li class="nav-section">Overview</li>

    <li>
        <a href="{{ route('dashboard') }}"
           class="menu-link {{ request()->routeIs('dashboard') ? 'menu-link_active' : '' }}">
            <i class="fa fa-tachometer"></i> Dashboard
        </a>
    </li>

    {{-- Shopping --}}
    <li class="nav-section">Shopping</li>

    <li>
        <a href="{{ route('user.order.index') }}"
           class="menu-link {{ request()->routeIs('user.order.*') ? 'menu-link_active' : '' }}">
            <i class="fa fa-shopping-bag"></i> My Orders
        </a>
    </li>

    <li>
        <a href="{{ route('wishlist') }}"
           class="menu-link {{ request()->routeIs('wishlist') ? 'menu-link_active' : '' }}">
            <i class="fa fa-heart"></i> My Wishlist
        </a>
    </li>

    <li>
        <a href="{{ route('user.productreview.index') }}"
           class="menu-link {{ request()->routeIs('user.productreview.*') ? 'menu-link_active' : '' }}">
            <i class="fa fa-star"></i> My Reviews
        </a>
    </li>

    {{-- Account --}}
    <li class="nav-section">Account</li>

    <li>
        <a href="{{ route('user-profile') }}"
           class="menu-link {{ request()->routeIs('user-profile') ? 'menu-link_active' : '' }}">
            <i class="fa fa-user"></i> Profile Settings
        </a>
    </li>

    <li>
        <a href="{{ route('user.change.password.form') }}"
           class="menu-link {{ request()->routeIs('user.change.password.form') ? 'menu-link_active' : '' }}">
            <i class="fa fa-lock"></i> Change Password
        </a>
    </li>

    <li style="border-top:1px solid #f0f0f0;margin-top:6px;padding-top:4px;">
        <a href="{{ route('user.logout') }}" class="menu-link logout-link">
            <i class="fa fa-sign-out"></i> Logout
        </a>
    </li>
</ul>
