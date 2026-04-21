@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg')}}" style="padding: 50px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Login</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url('/') }}">Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Login Section Begin -->
<section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 mx-auto">
                <div class="login__form">
                    <h3>Login</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input__item">
                            <input type="email" name="email" placeholder="Email address" required value="{{ old('email') }}">
                            <span class="icon_mail"></span>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input type="password" name="password" placeholder="Password" required>
                            <span class="icon_lock"></span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="login__form__options">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <button type="submit" class="site-btn">LOGIN</button>
                    </form>
                    <div class="login__register">
                        <p>Don't have an account? <a href="{{ route('register') }}">Register Now</a></p>
                    </div>
                    <div class="login__social">
                        <div class="login__social__title">
                            <span>Or login with</span>
                        </div>
                        <div class="login__social__links">
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="#" class="google"><i class="fa fa-google"></i> Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

<style>
.login.spad {
    padding: 80px 0;
}

.login__form {
    background: #fff;
    padding: 50px;
    border-radius: 5px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
}

.login__form h3 {
    color: #1c1c1c;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    font-size: 28px;
}

.input__item {
    position: relative;
    margin-bottom: 20px;
}

.input__item input {
    width: 100%;
    height: 50px;
    border: 1px solid #ebebeb;
    padding-left: 50px;
    padding-right: 20px;
    font-size: 15px;
    color: #6f6f6f;
    border-radius: 4px;
    transition: all 0.3s;
}

.input__item input:focus {
    border-color: #7fad39;
    outline: none;
}

.input__item span {
    position: absolute;
    left: 20px;
    top: 17px;
    font-size: 16px;
    color: #b2b2b2;
}

.login__form__options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.login__form__options .checkbox label {
    font-size: 14px;
    color: #6f6f6f;
    cursor: pointer;
    margin: 0;
}

.login__form__options .checkbox input {
    margin-right: 5px;
}

.login__form__options a {
    font-size: 14px;
    color: #7fad39;
    text-decoration: none;
}

.login__form__options a:hover {
    color: #5d8129;
}

.site-btn {
    display: block;
    width: 100%;
    background: #7fad39;
    color: #fff;
    border: none;
    padding: 14px 30px;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}

.site-btn:hover {
    background: #5d8129;
}

.login__register {
    text-align: center;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #ebebeb;
}

.login__register p {
    color: #6f6f6f;
    margin: 0;
}

.login__register a {
    color: #7fad39;
    font-weight: 600;
    text-decoration: none;
}

.login__register a:hover {
    color: #5d8129;
}

.login__social {
    margin-top: 30px;
}

.login__social__title {
    text-align: center;
    margin-bottom: 20px;
    position: relative;
}

.login__social__title span {
    background: #fff;
    padding: 0 15px;
    color: #b2b2b2;
    font-size: 14px;
    position: relative;
    z-index: 1;
}

.login__social__title::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    background: #ebebeb;
}

.login__social__links {
    display: flex;
    gap: 15px;
}

.login__social__links a {
    flex: 1;
    padding: 12px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s;
}

.login__social__links a.facebook {
    background: #3b5998;
}

.login__social__links a.facebook:hover {
    background: #2d4373;
}

.login__social__links a.google {
    background: #dd4b39;
}

.login__social__links a.google:hover {
    background: #c23321;
}

.login__social__links a i {
    margin-right: 8px;
}

.text-danger {
    color: #dc3545;
    font-size: 13px;
    display: block;
    margin-top: 5px;
}
</style>
@endsection