<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;

//use App\User;

use App\Tag;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of specified posts (solved/unsolved).
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $selectStatus = $request->get('Status');
        $selectCateg = $request->get('Category');

        if ($selectStatus == 'All' || $selectStatus == null) {
            if ($selectCateg == 'All' || $selectCateg == null) {
                return view('posts.list_posts', ['posts' => Post::orderBy('created_at', 'DESC')->get(),
                    'categories' => Category::all()]);
            } else {
                return view('posts.list_posts', ['posts' => Post::orderBy('created_at', 'DESC')
                        ->where('category_id', $selectCateg)
                        ->get(),
                    'categories' => Category::all()]);
            }
        }
        if ($selectCateg == 'All') {
            return view('posts.list_posts', ['posts' => Post::orderBy('created_at', 'DESC')
                    ->where('solved', $selectStatus)
                    ->get(),
                'categories' => Category::all()]);
        } else {
            return view('posts.list_posts', ['posts' => Post::orderBy('created_at', 'DESC')
                    ->where('solved', $selectStatus)
                    ->where('category_id', $selectCateg)
                    ->get(),
                'categories' => Category::all()]);
        }
        //$posts = Post::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', ['categories' => Category::all(), 'tags' => Tag::All()]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post($request->all());
        $post->category_id = $request->get('Category');
        $post->solved = false;
        $tags = Tag::All()->pluck('name')->toArray();
        $tagList = $request->get('tags');
        $newTagAdded = [];
        Auth::user()->posts()->save($post);
        if (count($tagList) > 0) {
            foreach ($tagList as $tag) {
                if (!(in_array($tag, $tags))) {
                    $newTag = new Tag();
                    $newTag->name = $tag;
                    $newTag->save();
                }
                array_push($newTagAdded, Tag::where('name', '=', $tag)->first()->id);
            }
        }

        $post->tags()->sync($newTagAdded, false);
        $request->session()->flash('success', 'Post creation was successful!');

        return redirect(route('post.show', ['post' => $post->id]));
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $id = $post->increment('view_count');

        $initialRelated = Post::all()->whereIn('category_id', $post->category_id)
            ->whereNotIn('id', $post->id);

        if (count($initialRelated) != 0) {
            /**
             * Count the number of matches per tag related to the showing post
             * against all posts in the same category
             */

            $matches = array();
            foreach ($post->tags as $tag) {
                foreach ($initialRelated as $querriedPost) {
                    $querTags = $querriedPost->tags->pluck('id')->toArray();
                    if (in_array($tag->id, $querTags)) {
                        array_push($matches, $querriedPost->id);
                    }
                }
            }

            /**
             * Create a 2-D array and sort it in terms
             * of which post had the most amount of common posts
             * as well as views/20
             */
            $twoDRelevance = array();

            foreach ($initialRelated as $relatedPost) {
                array_push($twoDRelevance, array($relatedPost->id, count(array_keys($matches, $relatedPost->id))
                     + ($relatedPost->view_count / 20)));
            }

            usort($twoDRelevance, function ($a, $b) {
                return $retval = $b[1] <=> $a[1];
            });

            /**
             * Transfer the 2-D array into 1-D array containing
             * the post id's in order of relevance
             */
            $orderedPostIds = array();

            if (count($initialRelated) < 3) {
                $count = count($initialRelated);
            } else {
                $count = 3;
            }

            for ($x = 0; $x < $count; $x++) {
                array_push($orderedPostIds, $twoDRelevance[$x][0]);
            }

            $sortedPosts = Post::whereIn('id', $orderedPostIds)
                ->orderBy(DB::raw('FIELD(`id`, ' . implode(',', $orderedPostIds) . ')'))
                ->get();

            return view('posts.show', ['post' => $post, 'related' => $sortedPosts]);
        } else {
            return view('posts.show', ['post' => $post, 'related' => null]);
        }
    }

    /**
     * Display the posts with the search query in the body text.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->get('search');
        $results = Post::where('body', 'like', '%' . $request->get('search') . '%')->get();

        return view('posts.posts_search', ['posts' => $results]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Reopens the specified post from solved to unsolved.
     * @param  \App\Post  $post
     */
    public function reopen(Post $post)
    {
        $post->solved = false;
        $post->title = str_replace("[SOLVED]", "", $post->title);
        $post->save();

        Comment::where('post_id', $post->id)
            ->where('best_answer', true)
            ->update(['best_answer' => false]);

        return redirect()->route('post.show', $post->id);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return redirect(route('post.show', ['post' => $post->id]));
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();
        return redirect(route('posts.list'));
        //return view('posts.list_posts', ['posts' => Post::all()]);
    }

    /**
     * Delete the specified post from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        return view('posts.delete', ['post' => $post]);
    }

    /**
     * Allows the user to vote on a post once.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function vote(Post $post, $updown)
    {

        $post->setVote(Auth::user(), $updown === 'up');

        return back();
    }
}
