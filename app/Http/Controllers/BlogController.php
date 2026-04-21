<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'   => 'required|string|max:200',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'author'  => 'nullable|string|max:100',
            'tags'    => 'nullable|string|max:200',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status'  => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'summary', 'content', 'author', 'tags', 'status']);
        $data['slug'] = Blog::generateSlug($request->title);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $uploadDir = public_path('uploads/blogs');
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
            $photo->move($uploadDir, $photo->getClientOriginalName());
            $data['photo'] = 'uploads/blogs/' . $photo->getClientOriginalName();
        }

        $status = Blog::create($data);

        if ($status) {
            request()->session()->flash('success', 'Blog post successfully created');
        } else {
            request()->session()->flash('error', 'Error creating blog post');
        }

        return redirect()->route('admin.blog.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $this->validate($request, [
            'title'   => 'required|string|max:200',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'author'  => 'nullable|string|max:100',
            'tags'    => 'nullable|string|max:200',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status'  => 'required|in:active,inactive',
        ]);

        $data = $request->only(['title', 'summary', 'content', 'author', 'tags', 'status']);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $uploadDir = public_path('uploads/blogs');
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
            if ($blog->photo && file_exists(public_path($blog->photo))) {
                unlink(public_path($blog->photo));
            }
            $photo->move($uploadDir, $photo->getClientOriginalName());
            $data['photo'] = 'uploads/blogs/' . $photo->getClientOriginalName();
        }

        $status = $blog->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Blog post successfully updated');
        } else {
            request()->session()->flash('error', 'Error updating blog post');
        }

        return redirect()->route('admin.blog.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->photo && file_exists(public_path($blog->photo))) {
            unlink(public_path($blog->photo));
        }
        $status = $blog->delete();

        if ($status) {
            request()->session()->flash('success', 'Blog post successfully deleted');
        } else {
            request()->session()->flash('error', 'Error deleting blog post');
        }

        return redirect()->route('admin.blog.index');
    }
}
