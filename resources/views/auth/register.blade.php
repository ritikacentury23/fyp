@extends('layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg')}}" style="padding: 50px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Register</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url('/') }}">Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Register Section Begin -->
<section class="register spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-8 mx-auto">
                <div class="register__form">
                    <h3>Create Account</h3>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input__item">
                                    <input type="text" name="first_name" placeholder="First Name" required value="{{ old('first_name') }}">
                                    <span class="icon_profile"></span>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input__item">
                                    <input type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name') }}">
                                    <span class="icon_profile"></span>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input__item">
                            <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}">
                            <span class="icon_mail"></span>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                            <span class="icon_phone"></span>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input type="password" name="password" placeholder="Password" required>
                            <span class="icon_lock"></span>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <small class="form-text">Must be at least 8 characters</small>
                        </div>
                        <div class="input__item">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <span class="icon_lock"></span>
                        </div>
                       
                        <button type="submit" class="site-btn">CREATE ACCOUNT</button>
                    </form>
                    <div class="register__login">
                        <p>Already have an account? <a href="{{ route('login') }}">Login Here</a></p>
                    </div>
                    <div class="register__social">
                        <div class="register__social__title">
                            <span>Or register with</span>
                        </div>
                        <div class="register__social__links">
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="#" class="google"><i class="fa fa-google"></i> Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Register Section End -->

<style>
.register.spad {
    padding: 80px 0;
}

.register__form {
    background: #fff;
    padding: 50px;
    border-radius: 5px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
}

.register__form h3 {
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

.input__item small {
    display: block;
    margin-top: 5px;
    color: #999;
    font-size: 12px;
}

.register__form__checkbox {
    margin-bottom: 15px;
}

.register__form__checkbox label {
    font-size: 14px;
    color: #6f6f6f;
    cursor: pointer;
    margin: 0;
    display: flex;
    align-items: flex-start;
}

.register__form__checkbox input {
    margin-right: 8px;
    margin-top: 3px;
    flex-shrink: 0;
}

.register__form__checkbox a {
    color: #7fad39;
    text-decoration: none;
}

.register__form__checkbox a:hover {
    color: #5d8129;
    text-decoration: underline;
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
    margin-top: 10px;
}

.site-btn:hover {
    background: #5d8129;
}

.register__login {
    text-align: center;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #ebebeb;
}

.register__login p {
    color: #6f6f6f;
    margin: 0;
}

.register__login a {
    color: #7fad39;
    font-weight: 600;
    text-decoration: none;
}

.register__login a:hover {
    color: #5d8129;
}

.register__social {
    margin-top: 30px;
}

.register__social__title {
    text-align: center;
    margin-bottom: 20px;
    position: relative;
}

.register__social__title span {
    background: #fff;
    padding: 0 15px;
    color: #b2b2b2;
    font-size: 14px;
    position: relative;
    z-index: 1;
}

.register__social__title::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    background: #ebebeb;
}

.register__social__links {
    display: flex;
    gap: 15px;
}

.register__social__links a {
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

.register__social__links a.facebook {
    background: #3b5998;
}

.register__social__links a.facebook:hover {
    background: #2d4373;
}

.register__social__links a.google {
    background: #dd4b39;
}

.register__social__links a.google:hover {
    background: #c23321;
}

.register__social__links a i {
    margin-right: 8px;
}

.text-danger {
    color: #dc3545;
    font-size: 13px;
    display: block;
    margin-top: 5px;
}

@media (max-width: 767px) {
    .register__form {
        padding: 30px 20px;
    }
    
    .register__form h3 {
        font-size: 24px;
        margin-bottom: 30px;
    }
}
</style>
@endsection