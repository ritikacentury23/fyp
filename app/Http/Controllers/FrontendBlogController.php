<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontendBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::getActivePaginated(6);
        return view('blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::getBySlug($slug);
        $recent_posts = Blog::where('status', 'active')
            ->where('id', '!=', $blog->id)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();
        return view('blogs.show', compact('blog', 'recent_posts'));
    }
}
