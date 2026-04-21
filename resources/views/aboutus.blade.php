@extends('layouts.app')

@section('content')

<!-- ==================== BREADCRUMB SECTION ==================== -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}"
    style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>About Us</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}">Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== ABOUT HERO SECTION ==================== -->
<section class="about-hero spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="about-hero__img">
                    @if($aboutus && $aboutus->image)
                        <img src="{{asset($aboutus->image)}}" alt="About Us" class="about-image">
                    @else
                        <img src="{{asset('frontend/img/about/about-1.jpg')}}" alt="About Us" class="about-image">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="about-hero__text">
                    <h2>Who We Are</h2>
                    @if($aboutus && $aboutus->description)
                        <p>{!! nl2br(e($aboutus->description)) !!}</p>
                    @else
                        <p>Welcome to Organi Shop, your trusted destination for premium organic products. Since our founding, we have been committed to providing the highest quality organic fruits, vegetables, and groceries to families across the country.</p>
                        
                        <p>Our mission is simple: to make organic, healthy living accessible to everyone. We believe that everyone deserves access to fresh, pesticide-free products that are good for their health and the environment.</p>
                    @endif

                    <div class="about-hero__features">
                        <div class="feature-item">
                            <i class="fa fa-check-circle"></i>
                            <h4>100% Organic Products</h4>
                            <p>All our products are certified organic and pesticide-free</p>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check-circle"></i>
                            <h4>Farm Fresh Quality</h4>
                            <p>Sourced directly from trusted farms</p>
                        </div>
                        <div class="feature-item">
                            <i class="fa fa-check-circle"></i>
                            <h4>Fast Delivery</h4>
                            <p>Get fresh products delivered to your door within 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- ==================== COMPLETE CSS STYLING ==================== -->
<style>
    /* ========== BREADCRUMB SECTION ========== */
    .breadcrumb-section {
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        position: relative;
    }

    .breadcrumb-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }

    .breadcrumb__text {
        position: relative;
        z-index: 1;
    }

    .breadcrumb__text h2 {
        color: white;
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .breadcrumb__option {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        color: white;
        font-size: 14px;
    }

    .breadcrumb__option a {
        color: white;
        transition: color 0.3s;
    }

    .breadcrumb__option a:hover {
        color: #7fad39;
    }

    /* ========== ABOUT HERO SECTION ========== */
    .about-hero {
        padding: 60px 0;
    }

    .about-hero .row {
        align-items: center;
    }

    .about-hero__img {
        margin-bottom: 30px;
    }

    .about-image {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .about-hero__text h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1c1c1c;
        margin-bottom: 20px;
    }

    .about-hero__text p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .about-hero__features {
        margin-top: 30px;
    }

    .feature-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 6px;
        transition: all 0.3s;
    }

    .feature-item:hover {
        background: #f0f8ff;
        border-left: 4px solid #7fad39;
    }

    .feature-item i {
        font-size: 24px;
        color: #7fad39;
        flex-shrink: 0;
    }

    .feature-item h4 {
        font-size: 15px;
        font-weight: 600;
        color: #1c1c1c;
        margin: 0;
    }

    .feature-item p {
        font-size: 13px;
        color: #666;
        margin: 0;
    }

    /* ========== SECTION TITLE ========== */
    .section-title {
        margin-bottom: 40px;
    }

    .section-title h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1c1c1c;
        margin-bottom: 10px;
    }

    .section-title p {
        font-size: 15px;
        color: #999;
    }

    /* ========== OUR VALUES SECTION ========== */
    .our-values {
        padding: 60px 0;
        background: #f9f9f9;
    }

    .values-card {
        background: white;
        padding: 30px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        height: 100%;
    }

    .values-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .values-card__icon {
        font-size: 48px;
        color: #7fad39;
        margin-bottom: 15px;
    }

    .values-card h4 {
        font-size: 18px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 12px;
    }

    .values-card p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    /* ========== OUR STORY SECTION ========== */
    .our-story {
        padding: 60px 0;
    }

    .story-timeline {
        position: relative;
        padding: 20px 0;
    }

    .story-timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #7fad39;
        transform: translateX(-1px);
    }

    .timeline-item {
        margin-bottom: 40px;
        position: relative;
    }

    .timeline-item:nth-child(odd) {
        margin-left: 0;
        padding-right: 52%;
    }

    .timeline-item:nth-child(even) {
        margin-left: 52%;
        padding-left: 40px;
    }

    .timeline-year {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: #7fad39;
        color: white;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        z-index: 2;
    }

    .timeline-content {
        background: white;
        padding: 25px;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .timeline-content h4 {
        font-size: 18px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 10px;
    }

    .timeline-content p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 768px) {
        .story-timeline::before {
            left: 0;
        }

        .timeline-item:nth-child(odd),
        .timeline-item:nth-child(even) {
            margin-left: 0;
            padding-right: 0;
            padding-left: 100px;
        }

        .timeline-year {
            left: 0;
            width: 70px;
            height: 70px;
            font-size: 16px;
            transform: translateX(-35px);
        }
    }

    /* ========== STATISTICS SECTION ========== */
    .statistics {
        padding: 80px 0;
        background: linear-gradient(135deg, #7fad39 0%, #6b9030 100%);
    }

    .stat-item {
        margin-bottom: 30px;
    }

    .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: white;
        display: block;
    }

    .stat-item p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    /* ========== OUR TEAM SECTION ========== */
    .our-team {
        padding: 60px 0;
        background: #f9f9f9;
    }

    .team-member {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .team-member:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .team-member__img {
        width: 100%;
        height: 250px;
        overflow: hidden;
    }

    .team-member__img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .team-member:hover .team-member__img img {
        transform: scale(1.1);
    }

    .team-member__text {
        padding: 20px;
        text-align: center;
    }

    .team-member__text h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 5px;
    }

    .team-member__text p {
        font-size: 13px;
        color: #7fad39;
        margin-bottom: 12px;
    }

    .team-member__social {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .team-member__social a {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #f0f0f0;
        color: #7fad39;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .team-member__social a:hover {
        background: #7fad39;
        color: white;
    }

    /* ========== WHY CHOOSE SECTION ========== */
    .why-choose {
        padding: 60px 0;
    }

    .why-choose-item {
        background: white;
        padding: 30px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }

    .why-choose-item:hover {
        border-top-color: #7fad39;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .why-choose-item__icon {
        font-size: 42px;
        color: #7fad39;
        margin-bottom: 15px;
    }

    .why-choose-item h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1c1c1c;
        margin-bottom: 12px;
    }

    .why-choose-item p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    /* ========== CTA SECTION ========== */
    .about-cta {
        padding: 80px 0;
        background: linear-gradient(135deg, #f9f9f9 0%, #f0f8ff 100%);
        text-align: center;
    }

    .about-cta h2 {
        font-size: 42px;
        font-weight: 700;
        color: #1c1c1c;
        margin-bottom: 20px;
    }

    .about-cta p {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.8;
    }

    .site-btn {
        display: inline-block;
        padding: 12px 30px;
        background: #7fad39;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .site-btn:hover {
        background: #6b9030;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 173, 57, 0.4);
    }

    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 768px) {
        .breadcrumb__text h2 {
            font-size: 32px;
        }

        .about-hero__text h2 {
            font-size: 28px;
        }

        .section-title h2 {
            font-size: 28px;
        }

        .feature-item {
            margin-bottom: 15px;
        }

        .values-card,
        .why-choose-item {
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 36px;
        }

        .team-member__img {
            height: 200px;
        }

        .about-cta h2 {
            font-size: 32px;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb__text h2 {
            font-size: 24px;
        }

        .breadcrumb__option {
            flex-direction: column;
            gap: 10px;
        }

        .about-hero__text h2 {
            font-size: 22px;
        }

        .section-title h2 {
            font-size: 22px;
        }

        .stat-number {
            font-size: 28px;
        }

        .team-member__img {
            height: 180px;
        }

        .about-cta h2 {
            font-size: 24px;
        }

        .about-cta p {
            font-size: 14px;
        }
    }

    /* ========== ANIMATIONS ========== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .about-hero,
    .our-values,
    .our-story,
    .statistics,
    .our-team,
    .why-choose,
    .about-cta {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

@endsection