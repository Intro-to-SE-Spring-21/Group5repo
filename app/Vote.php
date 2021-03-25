<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'status',
        'is_upvote',
        'user_id',
    ];

    protected $casts = [
        'is_upvote' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voteable()
    {
        return $this->morphTo();
    }
}
