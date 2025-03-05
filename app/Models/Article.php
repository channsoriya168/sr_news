<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'content',
        'img_upload',
        'published_date',
        'status',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
}
