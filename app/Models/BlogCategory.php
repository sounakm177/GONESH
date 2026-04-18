<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'color',
        'sort_order',
    ];
  
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
 
    public function publishedPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class)
                    ->published()
                    ->orderByDesc('published_at');
    }
  
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
