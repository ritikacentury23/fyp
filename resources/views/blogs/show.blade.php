@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="blog-detail spad">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article class="blog-article">
                        @if($blog->photo)
                        <img src="{{ asset($blog->photo) }}" alt="{{ $blog->title }}"
                             style="width:100%;max-height:450px;object-fit:cover;border-radius:10px;margin-bottom:30px;">
                        @endif

                        @if($blog->tags)
                        <div class="mb-3">
                            @foreach(explode(',', $blog->tags) as $tag)
                            <span style="background:#f0f7e6;color:#6a8e23;padding:3px 12px;border-radius:20px;font-size:12px;margin-right:5px;">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                        @endif

                        <h1 style="font-size:28px;font-weight:700;margin-bottom:15px;color:#222;">{{ $blog->title }}</h1>

                        <div style="display:flex;gap:20px;margin-bottom:25px;color:#999;font-size:14px;border-bottom:1px solid #eee;padding-bottom:20px;">
                            <span><i class="fa fa-user-o me-1"></i> {{ $blog->author }}</span>
                            <span><i class="fa fa-calendar-o me-1"></i> {{ $blog->created_at->format('F d, Y') }}</span>
                        </div>

                        @if($blog->summary)
                        <p style="font-size:16px;color:#555;font-style:italic;border-left:4px solid #7fba00;padding-left:15px;margin-bottom:25px;">{{ $blog->summary }}</p>
                        @endif

                        <div class="blog-content" style="font-size:15px;line-height:1.9;color:#444;">
                            {!! nl2br(e($blog->content)) !!}
                        </div>
                    </article>

                    <div class="mt-4 pt-4" style="border-top:1px solid #eee;">
                        <a href="{{ route('blog.index') }}" class="primary-btn"><i class="fa fa-arrow-left me-2"></i>Back to Blog</a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div style="position:sticky;top:100px;">
                        <!-- Recent Posts -->
                        <div style="background:#f9f9f9;border-radius:10px;padding:25px;margin-bottom:25px;">
                            <h5 style="font-weight:600;margin-bottom:20px;border-bottom:2px solid #7fba00;padding-bottom:10px;">Recent Posts</h5>
                            @foreach($recent_posts as $post)
                            <div style="display:flex;gap:12px;margin-bottom:15px;align-items:flex-start;">
                                <img src="{{ $post->photo ? asset($post->photo) : asset('img/blog/default.jpg') }}"
                                     alt="{{ $post->title }}"
                                     style="width:65px;height:55px;object-fit:cover;border-radius:6px;flex-shrink:0;">
                                <div>
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                       style="font-size:13px;font-weight:600;color:#333;text-decoration:none;display:block;line-height:1.4;">
                                        {{ Str::limit($post->title, 50) }}
                                    </a>
                                    <span style="font-size:12px;color:#999;">{{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Share -->
                        <div style="background:#f9f9f9;border-radius:10px;padding:25px;">
                            <h5 style="font-weight:600;margin-bottom:15px;">Share This Post</h5>
                            <div style="display:flex;gap:10px;">
                                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                   target="_blank" style="background:#3b5998;color:#fff;padding:8px 16px;border-radius:5px;text-decoration:none;font-size:13px;">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                                   target="_blank" style="background:#1da1f2;color:#fff;padding:8px 16px;border-radius:5px;text-decoration:none;font-size:13px;">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
