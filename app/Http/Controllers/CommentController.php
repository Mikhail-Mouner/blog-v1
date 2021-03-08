<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\NewComment;
use App\Notifications\NotifyOwner;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'body'    => $request->body,
            'user_id' => Auth::id() ,
            'post_id' => $request->post_id,
        ]);

        //event(new NewComment($comment->user,$comment));
        broadcast(new NewComment($comment->user,$comment));

        $post = Post::with('user')->find($comment->post_id);

        $user = $post->user;
        $user->notify(new NotifyOwner($comment,$post));


        return response()->json([
            'id'       => $comment->id,
            'body'     => $comment->body,
            'user_id'  => $comment->user ,
            'added_at' => $comment->created_at->diffForHumans() ,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
