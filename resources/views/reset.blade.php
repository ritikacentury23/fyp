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

<!-- ==================== RESET PASSWORD WITH TOKEN SECTION BEGIN ==================== -->
<section class="reset-password spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                
                <!-- RESET PASSWORD FORM -->
                <div class="reset-password__form">
                    <div class="reset-password__icon">
                        <i class="fa fa-key"></i>
                    </div>
                    
                    <h3>Create New Password</h3>
                    <p class="reset-password__subtitle">Enter your email and set a new password to regain access to your account.</p>

                    <!-- SUCCESS MESSAGE -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i>
                            <div class="alert-content">
                                <strong>Success!</strong>
                                <p>{{ session('status') }}</p>
                                <p style="margin-top: 10px;">
                                    <a href="{{ route('login') }}" class="btn-link">Login with your new password</a>
                                </p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- ERROR MESSAGE -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle"></i>
                            <div class="alert-content">
                                <strong>Error!</strong>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- RESET PASSWORD FORM WITH TOKEN -->
                    <form action="{{ route('password.update') }}" method="POST" class="reset-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">
                        
                        <!-- EMAIL FIELD -->
                        <div class="input__item">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <input 
                                    type="email" 
                                    id="email"
                                    name="email" 
                                    placeholder="Enter your email address" 
                                    required 
                                    value="{{ old('email') }}"
                                    class="@error('email') is-invalid @enderror">
                                <span class="icon_mail"></span>
                            </div>
                            @error('email')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NEW PASSWORD FIELD -->
                        <div class="input__item">
                            <label for="password">New Password</label>
                            <div class="input-wrapper">
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    placeholder="Enter your new password" 
                                    required
                                    minlength="6"
                                    class="@error('password') is-invalid @enderror">
                                <span class="icon_lock"></span>
                                <button type="button" class="password-toggle" data-target="password" title="Show/Hide Password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <small class="password-hint">Minimum 6 characters</small>
                            @error('password')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <!-- CONFIRM PASSWORD FIELD -->
                        <div class="input__item">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="input-wrapper">
                                <input 
                                    type="password" 
                                    id="password_confirmation"
                                    name="password_confirmation" 
                                    placeholder="Confirm your new password" 
                                    required
                                    minlength="6"
                                    class="@error('password_confirmation') is-invalid @enderror">
                                <span class="icon_lock"></span>
                                <button type="button" class="password-toggle" data-target="password_confirmation" title="Show/Hide Password">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger"><i class="fa fa-times-circle"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        
                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="site-btn">Reset Password</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== RESET PASSWORD SECTION END ==================== -->

<!-- ==================== COMPLETE CSS STYLING ==================== -->
<style>
    /* ========== RESET PASSWORD SECTION ========== */
    .reset-password.spad {
        padding: 80px 0;
        background: #f9f9f9;
    }

    /* ========== RESET PASSWORD FORM ========== */
    .reset-password__form {
        background: #fff;
        padding: 50px;
        border-radius: 5px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .reset-password__icon {
        text-align: center;
        margin-bottom: 20px;
    }

    .reset-password__icon i {
        font-size: 48px;
        color: #7fad39;
    }

    .reset-password__form h3 {
        color: #1c1c1c;
        font-weight: 700;
        text-align: center;
        margin-bottom: 12px;
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

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input__item input {
        width: 100%;
        height: 50px;
        border: 1px solid #ebebeb;
        padding-left: 50px;
        padding-right: 50px;
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

    .input__item span.icon_mail,
    .input__item span.icon_lock {
        position: absolute;
        left: 20px;
        font-size: 16px;
        color: #b2b2b2;
        pointer-events: none;
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

    /* ========== PASSWORD TOGGLE BUTTON ========== */
    .password-toggle {
        position: absolute;
        right: 15px;
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
        z-index: 1;
    }

    .password-toggle:hover {
        color: #7fad39;
    }

    /* ========== PASSWORD STRENGTH ========== */
    .password-strength {
        margin-bottom: 25px;
    }

    .strength-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .strength-label span:first-child {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 13px;
    }

    .strength-text {
        font-size: 12px;
        color: #999;
        font-weight: 600;
    }

    .strength-text.weak {
        color: #dc3545;
    }

    .strength-text.fair {
        color: #ffc107;
    }

    .strength-text.good {
        color: #17a2b8;
    }

    .strength-text.strong {
        color: #28a745;
    }

    .strength-bar {
        width: 100%;
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }

    .strength-progress {
        height: 100%;
        width: 0%;
        background: #999;
        transition: all 0.3s;
        border-radius: 3px;
    }

    .strength-progress.weak {
        width: 25%;
        background: #dc3545;
    }

    .strength-progress.fair {
        width: 50%;
        background: #ffc107;
    }

    .strength-progress.good {
        width: 75%;
        background: #17a2b8;
    }

    .strength-progress.strong {
        width: 100%;
        background: #28a745;
    }

    /* ========== PASSWORD REQUIREMENTS ========== */
    .password-requirements {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 4px;
        margin-bottom: 25px;
        border-left: 4px solid #7fad39;
    }

    .password-requirements h5 {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 12px;
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
        margin-bottom: 10px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .password-requirements li:last-child {
        margin-bottom: 0;
    }

    .password-requirements li i {
        color: #7fad39;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .password-requirements li.optional i {
        color: #ffc107;
    }

    .req-text {
        display: block;
        line-height: 1.5;
    }

    /* ========== SUBMIT BUTTON ========== */
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
        margin-bottom: 25px;
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

    /* ========== INFO BOX ========== */
    .reset-password__info {
        background: #f0f8ff;
        padding: 20px;
        border-radius: 4px;
        margin-bottom: 20px;
        border-left: 4px solid #17a2b8;
    }

    .reset-password__info h4 {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .reset-password__info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .reset-password__info li {
        color: #666;
        font-size: 13px;
        margin-bottom: 8px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        line-height: 1.5;
    }

    .reset-password__info li:last-child {
        margin-bottom: 0;
    }

    .reset-password__info i {
        color: #17a2b8;
        flex-shrink: 0;
        font-size: 14px;
        margin-top: 2px;
    }

    /* ========== HELP SECTION ========== */
    .reset-password__help {
        padding-top: 20px;
        border-top: 1px solid #ebebeb;
    }

    .reset-password__help h4 {
        color: #1c1c1c;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .reset-password__help p {
        color: #666;
        font-size: 13px;
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .btn-help {
        display: inline-block;
        padding: 10px 20px;
        background: #f0f0f0;
        color: #1c1c1c;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #ebebeb;
        transition: all 0.3s;
    }

    .btn-help:hover {
        background: #e0e0e0;
        border-color: #d0d0d0;
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

    .btn-link {
        color: #7fad39;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .btn-link:hover {
        color: #5d8129;
        text-decoration: underline;
    }

    /* ========== ALERTS ========== */
    .alert {
        padding: 15px 20px;
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

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        margin-bottom: 6px;
    }

    .alert-content p {
        margin: 0;
        font-size: 13px;
        line-height: 1.5;
    }

    .alert-content div {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .alert-content div:last-child {
        margin-bottom: 0;
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

    .alert .close {
        background: none;
        border: none;
        color: inherit;
        font-size: 20px;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s;
        padding: 0;
        flex-shrink: 0;
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

        .password-requirements {
            padding: 15px;
        }

        .reset-password__info {
            padding: 15px;
        }
    }

    @media (max-width: 576px) {
        .reset-password.spad {
            padding: 50px 0;
        }

        .reset-password__form {
            padding: 25px;
            border-radius: 0;
        }

        .reset-password__form h3 {
            font-size: 20px;
            margin-bottom: 10px;
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
            padding-right: 45px;
        }

        .input__item span.icon_mail,
        .input__item span.icon_lock {
            left: 15px;
            font-size: 14px;
        }

        .password-toggle {
            right: 12px;
        }

        .password-requirements {
            padding: 12px;
            margin-bottom: 20px;
        }

        .password-requirements h5 {
            font-size: 11px;
        }

        .password-requirements li {
            font-size: 12px;
        }

        .site-btn {
            padding: 11px 20px;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .reset-password__back {
            padding-top: 15px;
            font-size: 13px;
        }

        .reset-password__info {
            padding: 12px;
            margin-bottom: 15px;
        }

        .reset-password__info h4 {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .reset-password__info li {
            font-size: 12px;
        }

        .reset-password__help {
            padding-top: 15px;
        }

        .reset-password__help h4 {
            font-size: 13px;
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

    .btn-help:focus-visible,
    .btn-link:focus-visible {
        outline: 2px solid #7fad39;
        outline-offset: 2px;
    }

    .password-toggle:focus-visible {
        outline: 2px solid #7fad39;
        outline-offset: 2px;
        border-radius: 3px;
    }
</style>

<!-- ==================== JAVASCRIPT FOR FUNCTIONALITY ==================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ==================== PASSWORD VISIBILITY TOGGLE ====================
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="fa fa-eye"></i>';
                }
            }
        });
    });

    // ==================== PASSWORD STRENGTH INDICATOR ====================
    const passwordInput = document.getElementById('password');
    const strengthProgress = document.getElementById('passwordStrength');
    const strengthText = document.querySelector('.strength-text');

    if (passwordInput && strengthProgress) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            // Length checks
            if (password.length >= 6) strength += 25;
            if (password.length >= 10) strength += 25;

            // Character variety checks
            if (/[a-z]/.test(password)) strength += 12.5;
            if (/[A-Z]/.test(password)) strength += 12.5;
            if (/[0-9]/.test(password)) strength += 12.5;
            if (/[^a-zA-Z0-9]/.test(password)) strength += 12.5;

            // Update progress bar
            strengthProgress.style.width = strength + '%';
            strengthProgress.className = 'strength-progress';

            // Update text
            if (strength < 25) {
                strengthText.textContent = '-';
                strengthText.className = 'strength-text';
            } else if (strength < 50) {
                strengthText.textContent = 'Weak';
                strengthText.className = 'strength-text weak';
                strengthProgress.classList.add('weak');
            } else if (strength < 75) {
                strengthText.textContent = 'Fair';
                strengthText.className = 'strength-text fair';
                strengthProgress.classList.add('fair');
            } else if (strength < 100) {
                strengthText.textContent = 'Good';
                strengthText.className = 'strength-text good';
                strengthProgress.classList.add('good');
            } else {
                strengthText.textContent = 'Strong';
                strengthText.className = 'strength-text strong';
                strengthProgress.classList.add('strong');
            }
        });
    }

    // ==================== FORM VALIDATION ====================
    const resetForm = document.querySelector('.reset-form');
    if (resetForm) {
        resetForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            // Check if passwords match
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            // Check password length
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
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

    // ==================== KEYBOARD SHORTCUTS ====================
    document.addEventListener('keydown', function(e) {
        // Ctrl+Enter to submit form
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            const form = document.querySelector('.reset-form');
            if (form) {
                form.submit();
            }
        }
    });
});
</script>

@endsection