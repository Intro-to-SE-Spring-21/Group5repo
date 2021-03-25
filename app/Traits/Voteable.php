<?php

namespace App\Traits;

use App\User;
use App\Vote;

trait Voteable
{
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function countVotes()
    {
        $count = 0;
        foreach ($this->votes as $vote) {
            $vote->is_upvote ? $count++ : $count--;
        }
        return $count;
    }

    public function setVote(User $user, $updown)
    {
        $vote = $this->votes()->where('user_id', $user->id)->first();

        if ($vote && $vote->is_upvote == $updown) {
            $vote->delete();
        } elseif ($vote) {
            $vote->update(['is_upvote' => $updown]);
        } else {
            $this->votes()->save(new Vote([
                'user_id' => $user->id,
                'is_upvote' => $updown,
            ]));
        }
    }
}
