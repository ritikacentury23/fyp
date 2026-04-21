@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2 class="section-title">Our Blog</h2>
                    <p class="text-muted">Stay updated with the latest news, tips, and stories from our team.</p>
                </div>
            </div>
            <div class="row">
                @forelse($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card" style="border-radius:10px;overflow:hidden;box-shadow:0 2px 15px rgba(0,0,0,0.08);height:100%;display:flex;flex-direction:column;">
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            <img src="{{ $blog->photo ? asset($blog->photo) : asset('img/blog/default.jpg') }}"
                                 alt="{{ $blog->title }}"
                                 style="width:100%;height:220px;object-fit:cover;">
                        </a>
                        <div style="padding:20px;flex:1;display:flex;flex-direction:column;">
                            @if($blog->tags)
                            <div class="mb-2">
                                @foreach(explode(',', $blog->tags) as $tag)
                                <span style="background:#f0f7e6;color:#6a8e23;padding:2px 10px;border-radius:20px;font-size:11px;margin-right:4px;">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                            @endif
                            <h5 style="font-size:17px;font-weight:600;margin-bottom:10px;">
                                <a href="{{ route('blog.show', $blog->slug) }}" style="color:#222;text-decoration:none;">{{ $blog->title }}</a>
                            </h5>
                            <p style="color:#777;font-size:14px;flex:1;">{{ Str::limit($blog->summary, 100) }}</p>
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:15px;">
                                <span style="font-size:13px;color:#999;"><i class="fa fa-user-o"></i> {{ $blog->author }}</span>
                                <span style="font-size:13px;color:#999;"><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="primary-btn mt-3" style="text-align:center;display:block;padding:8px;">Read More</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fa fa-newspaper-o fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No blog posts yet. Check back soon!</h5>
                </div>
                @endforelse
            </div>
            @if($blogs->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection
