@extends('layouts.app')

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}"
    style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contact Us</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Phone</h4>
                    <p>977 9805116274</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Address</h4>
                    <p>Pokhara, Chipledhunga</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Open time</h4>
                    <p>10:00 am to 23:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>ebasket2@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7030.949973451022!2d83.98275909244781!3d28.22325945356273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995944f019fb07f%3A0x1cd9511d39c8dfc9!2sChipledhunga%2C%20Pokhara%2033700!5e0!3m2!1sen!2snp!4v1776689923800!5m2!1sen!2snp"
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Pokhara, Chipledhunga</h4>
            <ul>
                <li>Phone: 977 9805116274</li>
               
            </ul>
        </div>
    </div>
</div>



<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Leave Message</h2>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if($message = session('success'))
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if($message = session('error'))
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Your name" 
                        value="{{ old('name') }}"
                        class="@error('name') is-invalid @enderror"
                        required>
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-md-6">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Your Email" 
                        value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror"
                        required>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-12 text-center">
                    <textarea 
                        name="message" 
                        placeholder="Your message" 
                        class="@error('message') is-invalid @enderror"
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-danger small d-block mt-2">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="site-btn">SEND MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .contact__widget {
        padding: 20px;
        margin-bottom: 30px;
    }

    .contact__widget span {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .contact__widget h4 {
        font-size: 18px;
        font-weight: 600;
        margin: 15px 0;
    }

    .contact__widget p {
        font-size: 14px;
        color: #666;
    }

    .map {
        position: relative;
        margin-bottom: 30px;
    }

    .map iframe {
        width: 100%;
        display: block;
    }

    .map-inside {
        position: absolute;
        bottom: 30px;
        left: 30px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .map-inside i {
        color: #7fad39;
        font-size: 24px;
        margin-right: 10px;
    }

    .map-inside h4 {
        margin: 10px 0;
        font-size: 16px;
        font-weight: 600;
    }

    .map-inside ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .map-inside li {
        font-size: 13px;
        color: #666;
        margin: 5px 0;
    }

    .contact-form {
        padding: 60px 0;
        background: #f9f9f9;
    }

    .contact__form__title h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1c1c1c;
        margin-bottom: 40px;
    }

    .contact-form form {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
        outline: none;
        border-color: #7fad39;
        box-shadow: 0 0 5px rgba(127, 173, 57, 0.3);
    }

    .contact-form textarea {
        resize: vertical;
        min-height: 150px;
    }

    .contact-form .is-invalid {
        border-color: #dc3545 !important;
    }

    .contact-form .text-danger {
        display: block;
        margin-top: -15px;
        margin-bottom: 10px;
    }

    .site-btn {
        display: inline-block;
        padding: 12px 30px;
        background: #7fad39;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .site-btn:hover {
        background: #6b9030;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 173, 57, 0.4);
    }

    .alert {
        border-radius: 4px;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .contact__form__title h2 {
            font-size: 28px;
        }

        .contact-form form {
            padding: 20px;
        }

        .map-inside {
            bottom: 15px;
            left: 15px;
            padding: 15px;
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 15px;
        }
    }
</style>

@endsection