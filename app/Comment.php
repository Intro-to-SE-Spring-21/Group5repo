<?php

namespace App;

use App\Traits\Voteable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Voteable;

    protected $primaryKey = 'id';
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
