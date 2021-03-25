<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use app\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all activity specific to currently logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function userAct()
    {
        return view(
            'user_activity',
            ['posts' => Post::all()->whereIn('user_id', [Auth::id()])],
            ['comments' => Comment::all()->whereIn('user_id', [Auth::id()])]
        );
    }
}
