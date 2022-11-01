<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Uuid;

class Article extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'content',
        'article_image',
        'article_creator',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'content' => 'string',
        'article_image' => 'string',
        'article_creator' => 'string',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'article_image_url'
    ];

    /**
     * Return article image url.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function articleImageUrl(): Attribute
    {
        return new Attribute(
            get: fn () => Storage::url($this->article_image)
        );
    }
}
