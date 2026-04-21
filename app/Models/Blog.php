<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'photo', 'summary', 'content', 'author', 'tags', 'status'];

    public static function getActivePaginated($perPage = 6)
    {
        return static::where('status', 'active')->orderBy('id', 'DESC')->paginate($perPage);
    }

    public static function getBySlug($slug)
    {
        return static::where('slug', $slug)->where('status', 'active')->firstOrFail();
    }

    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }
}
