<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'summary',
        'content',
        'featured_image',
        'author_name',
        'author_title',
        'read_time_minutes',
        'tags',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getExcerptAttribute()
    {
        return $this->summary;
    }

    public function getReadingTimeAttribute()
    {
        return $this->read_time_minutes;
    }
}
