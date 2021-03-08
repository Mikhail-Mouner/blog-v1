<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    static public $PAGINATION = 1;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('user')->with('category')->paginate(static::$PAGINATION);

        foreach ($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans())  ;
            $post->setAttribute('image_url',asset('img/'.$post->image))  ;
            $post->setAttribute('comment_count',$post->comments->count())  ;
        }

        return response()->json($posts);
    }
    /**
     * Display a listing of the resource.
     *
     * @param mixed $search
     * @return \Illuminate\Http\Response
     */
    public function searchPosts($search)
    {
        $posts = Post::latest()->when($search,function ($query,$search){
            $query->where('title','like','%'.$search.'%')
            ->orWhere('body','like','%'.$search.'%');
        })->with('user')->with('category')->paginate(static::$PAGINATION);

        foreach ($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans())  ;
            $post->setAttribute('image_url',asset('img/'.$post->image))  ;
            $post->setAttribute('comment_count',$post->comments->count())  ;
        }

        return response()->json($posts);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'id' => $post->id ,
            'slug' => $post->slug ,
            'title' => $post->title ,
            'body' => $post->body ,
            'comments_count' => $post->comments->count() ,
            'user' => $post->user ,
            'category' => $post->category ,
            'comments' => $this->commentsFormatted($post->comments) ,
            'created_at' => $post->created_at ,
            'added_at' => $post->created_at->diffForHumans() ,
            'image_url' => asset('img/'.$post->image) ,
        ]);
    }
    public function commentsFormatted($comments)
    {
        $new_commets = [] ;
        foreach ($comments as $comment){
            array_push($new_commets,[
               'id' => $comment->id ,
               'body' => $comment->body ,
               'user' => $comment->user ,
                'user_photo' => asset('img/'.$comment->user->photo) ,
               'added_at' => $comment->created_at->diffForHumans() ,
            ]);
        }
        return $new_commets;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function categoryPosts($category_slug){
        $category = Category::whereSlug($category_slug)->first();
        $posts = Post::whereCategoryId($category->id)->with('user')->get();

        foreach ($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans())  ;
            $post->setAttribute('image_url',asset('img/'.$post->image))  ;
            $post->setAttribute('comment_count',$post->comments->count())  ;
        }

        return response()->json($posts);
    }

}
