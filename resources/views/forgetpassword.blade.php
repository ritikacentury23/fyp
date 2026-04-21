@extends('layouts.app')

@section('content')

<!-- ==================== BREADCRUMB SECTION ==================== -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg')}}" style="padding: 50px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Reset Password</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ url('/') }}">Home</a>
                        <span>Reset Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== BREADCRUMB SECTION END ==================== -->

<!-- ==================== RESET PASSWORD SECTION BEGIN ==================== -->
<section class="reset-password spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                
                <!-- RESET PASSWORD FORM -->
                <div class="reset-password__form">
                    <h3>Reset Your Password</h3>
                    <p class="reset-password__subtitle">Enter your email address and we'll send you a link to reset your password.</p>

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i>
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- ERROR MESSAGE -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle"></i>
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- RESET FORM -->
                    <form action="{{ route('password.email') }}" method="POST" class="reset-form">
                        @csrf
                        
                        <div class="input__item">
                            <label for="email">Email Address</label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                placeholder="Enter your email address" 
                                required 
                                value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror">
                            <span class="icon_mail"></span>
                            @error('email')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="reset-password__info">
                            <i class="fa fa-info-circle"></i>
                            <p>We'll send you an email with a link to reset your password. Please check your inbox and spam folder.</p>
                        </div>

                        <button type="submit" class="site-btn">Send Reset Link</button>
                    </form>

                    <!-- BACK TO LOGIN -->
                    <div class="reset-password__back">
                        <p>Remember your password? <a href="{{ route('login') }}">Login Now</a></p>
                    </div>

                    <!-- HELP SECTION -->
                    <div class="reset-password__help">
                        <h4>Need Help?</h4>
                        <p>If you don't receive an email within a few minutes:</p>
                        <ul>
                            <li>Check your spam or junk folder</li>
                            <li>Make sure you entered the correct email address</li>
                            <li>Try resetting your password again</li>
                        </ul>
                        <p class="contact-support">
                            Still having trouble? <a href="{{ route('contact') }}">Contact our support team</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== RESET PASSWORD SECTION END ==================== -->

<!-- ==================== ALTERNATIVE - PASSWORD RESET WITH TOKEN ==================== -->
<!-- Use this section if you have a reset token and want to show the password change form -->

@if(isset($token))
<section class="reset-password-with-token spad" style="background: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                
                <div class="reset-password__form">
                    <h3>Create New Password</h3>
                    <p class="reset-password__subtitle">Enter your new password below to reset your account.</p>

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i>
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- ERROR MESSAGE -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle"></i>
                            <strong>Error!</strong>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- RESET WITH TOKEN FORM -->
                    <form action="{{ route('password.update') }}" method="POST" class="reset-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="input__item">
                            <label for="email">Email Address</label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                placeholder="Enter your email address" 
                                required 
                                value="{{ old('email') }}"
                                class="@error('email') is-invalid @enderror">
                            <span class="icon_mail"></span>
                            @error('email')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input__item">
                            <label for="password">New Password</label>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                placeholder="Enter your new password" 
                                required
                                minlength="6"
                                class="@error('password') is-invalid @enderror">
                            <span class="icon_lock"></span>
                            <small class="password-hint">Minimum 6 characters</small>
                            @error('password')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input__item">
                            <label for="password_confirmation">Confirm Password</label>
                            <input 
                                type="password" 
                                id="password_confirmation"
                                name="password_confirmation" 
                                placeholder="Confirm your new password" 
                                required
                                minlength="6"
                                class="@error('password_confirmation') is-invalid @enderror">
                            <span class="icon_lock"></span>
                            @error('password_confirmation')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="password-requirements">
                            <h5>Password Requirements:</h5>
                            <ul>
                                <li><i class="fa fa-check"></i> At least 6 characters</li>
                                <li><i class="fa fa-check"></i> Both passwords must match</li>
                            </ul>
                        </div>

                        <button type="submit" class="site-btn">Reset Password</button>
                    </form>

                    <!-- BACK TO LOGIN -->
                    <div class="reset-password__back">
                        <p>Remember your password? <a href="{{ route('login') }}">Login Now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ==================== COMPLETE CSS STYLING ==================== -->
<style>
    /* ========== RESET PASSWORD SECTION ========== */
    .reset-password.spad {
        padding: 80px 0;
    }

    .reset-password-with-token.spad {
        padding: 80px 0;
    }

    /* ========== RESET PASSWORD FORM ========== */
    .reset-password__form {
        background: #fff;
        padding: 50px;
        border-radius: 5px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .reset-password__form h3 {
        color: #1c1c1c;
        font-weight: 700;
        text-align: center;
        margin-bottom: 15px;
        font-size: 28px;
    }

    .reset-password__subtitle {
        text-align: center;
        color: #666;
        font-size: 14px;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    /* ========== INPUT ITEMS ========== */
    .input__item {
        position: relative;
        margin-bottom: 25px;
    }

    .input__item label {
        display: block;
        color: #1c1c1c;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
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
        box-shadow: 0 0 0 3px rgba(127, 173, 57, 0.1);
    }

    .input__item input.is-invalid {
        border-color: #dc3545;
    }

    .input__item input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .input__item span {
        position: absolute;
        left: 20px;
        top: 38px;
        font-size: 16px;
        color: #b2b2b2;
    }

    .input__item .text-danger {
        color: #dc3545;
        font-size: 13px;
        display: block;
        margin-top: 5px;
    }

    .input__item .text-danger i {
        margin-right: 5px;
    }

    .password-hint {
        display: block;
        color: #999;
        font-size: 12px;
        margin-top: 5px;
    }

    /* ========== INFO BOX ========== */
    .reset-password__info {
        background: #f0f8ff;
        border-left: 4px solid #7fad39;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 30px;
        display: flex;
        gap: 12px;
    }

    .reset-password__info i {
        color: #7fad39;
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .reset-password__info p {
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        margin: 0;
    }

    /* ========== BUTTON ========== */
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
        margin-bottom: 20px;
    }

    .site-btn:hover {
        background: #5d8129;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 173, 57, 0.3);
    }

    .site-btn:active {
        transform: translateY(0);
    }

    /* ========== BACK TO LOGIN ========== */
    .reset-password__back {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #ebebeb;
    }

    .reset-password__back p {
        color: #6f6f6f;
        margin: 0;
        font-size: 14px;
    }

    .reset-password__back a {
        color: #7fad39;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .reset-password__back a:hover {
        color: #5d8129;
    }

    /* ========== HELP SECTION ========== */
    .reset-password__help {
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #ebebeb;
    }

    .reset-password__help h4 {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 12px;
    }

    .reset-password__help p {
        color: #666;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    .reset-password__help ul {
        list-style: none;
        padding: 0;
        margin: 10px 0 15px 0;
    }

    .reset-password__help li {
        color: #666;
        font-size: 13px;
        margin-bottom: 8px;
        display: flex;
        gap: 10px;
    }

    .reset-password__help li i {
        color: #7fad39;
        flex-shrink: 0;
    }

    .contact-support {
        margin: 0 !important;
    }

    .contact-support a {
        color: #7fad39;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .contact-support a:hover {
        color: #5d8129;
    }

    /* ========== PASSWORD REQUIREMENTS ========== */
    .password-requirements {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 25px;
    }

    .password-requirements h5 {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .password-requirements ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .password-requirements li {
        color: #666;
        font-size: 13px;
        margin-bottom: 6px;
        display: flex;
        gap: 10px;
    }

    .password-requirements li:last-child {
        margin-bottom: 0;
    }

    .password-requirements i {
        color: #7fad39;
        flex-shrink: 0;
    }

    /* ========== ALERTS ========== */
    .alert {
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .alert i {
        flex-shrink: 0;
        font-size: 18px;
        margin-top: 2px;
    }

    .alert-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-success i {
        color: #155724;
    }

    .alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-danger i {
        color: #721c24;
    }

    .alert-danger strong {
        display: block;
        margin-bottom: 8px;
    }

    .alert-danger div {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .alert-danger div:last-child {
        margin-bottom: 0;
    }

    .alert .close {
        background: none;
        border: none;
        color: inherit;
        font-size: 20px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s;
    }

    .alert .close:hover {
        opacity: 1;
    }

    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 768px) {
        .reset-password__form {
            padding: 35px;
        }

        .reset-password__form h3 {
            font-size: 24px;
        }

        .reset-password__subtitle {
            font-size: 13px;
        }

        .input__item {
            margin-bottom: 20px;
        }

        .input__item input {
            height: 45px;
        }

        .input__item span {
            top: 33px;
        }

        .site-btn {
            padding: 12px 25px;
            font-size: 13px;
        }

        .reset-password__help h4 {
            font-size: 14px;
        }

        .reset-password__help p,
        .reset-password__help li {
            font-size: 12px;
        }
    }

    @media (max-width: 576px) {
        .reset-password.spad,
        .reset-password-with-token.spad {
            padding: 50px 0;
        }

        .reset-password__form {
            padding: 25px;
            border-radius: 0;
        }

        .reset-password__form h3 {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .reset-password__subtitle {
            font-size: 12px;
            margin-bottom: 20px;
        }

        .input__item {
            margin-bottom: 18px;
        }

        .input__item label {
            font-size: 13px;
            margin-bottom: 6px;
        }

        .input__item input {
            height: 42px;
            font-size: 14px;
            padding-left: 45px;
        }

        .input__item span {
            left: 15px;
            top: 30px;
            font-size: 14px;
        }

        .reset-password__info {
            margin-bottom: 20px;
            padding: 12px;
            font-size: 12px;
        }

        .reset-password__info i {
            font-size: 16px;
        }

        .site-btn {
            padding: 11px 20px;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .reset-password__back {
            padding-top: 15px;
            font-size: 13px;
        }

        .reset-password__help {
            margin-top: 20px;
            padding-top: 20px;
        }

        .password-requirements {
            padding: 12px;
        }

        .password-requirements h5 {
            font-size: 12px;
            margin-bottom: 8px;
        }
    }

    /* ========== ANIMATIONS ========== */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reset-password__form {
        animation: slideIn 0.5s ease-out;
    }

    .alert {
        animation: slideIn 0.3s ease-out;
    }

    /* ========== ACCESSIBILITY ========== */
    .input__item input:focus-visible {
        outline: 2px solid #7fad39;
        outline-offset: 2px;
    }

    .site-btn:focus-visible {
        outline: 2px solid #7fad39;
        outline-offset: 2px;
    }

    .reset-password__back a:focus-visible,
    .contact-support a:focus-visible {
        outline: 2px solid #7fad39;
        outline-offset: 2px;
    }
</style>

<!-- ==================== JAVASCRIPT FOR PASSWORD VISIBILITY ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ==================== PASSWORD VISIBILITY TOGGLE ====================
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    passwordInputs.forEach(input => {
        // Create toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle';
        toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
        toggleBtn.title = 'Show/Hide Password';
        
        // Insert button after input
        input.parentNode.appendChild(toggleBtn);
        
        // Toggle password visibility
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (input.type === 'password') {
                input.type = 'text';
                toggleBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                toggleBtn.innerHTML = '<i class="fa fa-eye"></i>';
            }
        });
    });

    // ==================== FORM VALIDATION ====================
    const resetForm = document.querySelector('.reset-form');
    if (resetForm) {
        resetForm.addEventListener('submit', function(e) {
            const passwordInputs = this.querySelectorAll('input[type="password"], input[type="text"][name="password"]');
            
            if (passwordInputs.length >= 2) {
                const password = passwordInputs[0].value;
                const confirmPassword = passwordInputs[1].value;
                
                if (password && confirmPassword && password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                    return false;
                }
                
                if (password && password.length < 6) {
                    e.preventDefault();
                    alert('Password must be at least 6 characters long!');
                    return false;
                }
            }
        });
    }

    // ==================== AUTO-DISMISS ALERTS ====================
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const closeBtn = alert.querySelector('.close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                alert.remove();
            });
        }
    });
});
</script>

<style>
    /* ========== PASSWORD TOGGLE BUTTON ========== */
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 38px;
        background: none;
        border: none;
        color: #b2b2b2;
        font-size: 16px;
        cursor: pointer;
        transition: color 0.3s;
        padding: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: #7fad39;
    }
</style>

@endsection