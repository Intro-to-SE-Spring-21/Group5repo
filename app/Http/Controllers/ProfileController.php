<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{

    public function profile(User $profile)
    {

        if ($profile->id != Auth::user()->id) {
            $profile->increment('view_count');
        }

        $posts = Post::where('user_id', $profile->id)->get();
        $comments = Comment::where([['user_id', $profile->id], ['best_answer', '1']])->get();

        $count = 0;

        foreach ($comments as $comment) {
            $post = Post::where('id', $comment->post_id)->get();
            $postss = $post{0};

            if ($postss->user_id == $comment->user_id) {
                $comments->forget($count);
            }

            $count++;
        }

        $clientCreation = $profile->created_at;
        $time = Carbon::createFromTimeStamp(strtotime($clientCreation))->diffForHumans();
        return view('profile.profile')->with('time', $time)
            ->with('user', $profile)
            ->with('posts', $posts)
            ->with('comments', $comments);
    }

    public function editProfile()
    {

        $user = Auth::user();
        return view('profile.profile_edit')->with('user', $user);
    }

    public function addProfile(Request $request)
    {

        $this->validate($request, [
            'user_name' => 'required',
            'title' => 'required',
        ]);

        $profiles = User::find(Auth::user()->id);

        $profiles->user_name = $request->input('user_name');

        $profiles->title = $request->input('title');

        $profiles->about_me = $request->input('about_me');
        if (Input::hasFile('profile_pic')) {
            $file = Input::file('profile_pic');
            $file->move(public_path() . '/uploads/', $profiles->id . '.' . $file->
                    getClientOriginalExtension());
            $url = URL::to("/") . '/uploads/' . $profiles->id . '.' . $file->
                getClientOriginalExtension();
            $profiles->profile_pic = $url;
        }

        $profiles->save();
        $userName = DB::table('users')->where('id', Auth::user()->id)->first();
        $comments = DB::table('comment')
            ->where('user_id', Auth::user()->id)->update(['user_name' => $userName->user_name]);

        if ($profiles->user_name != null) {
            return redirect('/home')->with('response', 'profile was succesfully updated');
        } else {
            return redirect('/home')->with('response', 'Profile Added Successfully');
        }
    }
}
