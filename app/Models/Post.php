<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableObserver;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Base\Traits\SluggableEngine;

class Post extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $table = 'posts';
    public $primary_key = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
        'slug',
        'meta_description',
        'cover_image',
        'thumbnail',
        'seo_title',
        'created_at',
    ];


    public function user() {
        return $this->belongsTo('App\Models\User');
        
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'seo_title',
            ]
        ];
    }
}

