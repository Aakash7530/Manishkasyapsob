<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image', 'image_url',
        'category_id', 'category_name', 'tags', 'author_id', 'author_name',
        'status', 'is_featured', 'view_count', 'reading_time',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_image', 'schema_markup', 'canonical_url',
        'published_at', 'comments_enabled',
    ];

    protected $casts = [
        'tags'             => 'array',
        'is_featured'      => 'boolean',
        'comments_enabled' => 'boolean',
        'view_count'       => 'integer',
        'reading_time'     => 'integer',
        'published_at'     => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    public static function generateSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content ?? ''));
        return max(1, (int) ceil($wordCount / 200));
    }
}
