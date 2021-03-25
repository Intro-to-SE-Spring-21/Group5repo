<?php

namespace App;

use App\Traits\Voteable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Voteable;
    /**
     * Fillable attributes
     */
    protected $fillable = [
        'title', 'body',
    ];

    protected $with = [
        'user',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function content()
    {
        return $this->body;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
