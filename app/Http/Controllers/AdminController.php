<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    static public $PAGINATION = 2;

    public function getPosts()
    {
        $posts = Post::latest()->with('user')->with('category')->paginate(static::$PAGINATION);

        foreach ($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans())  ;
            $post->setAttribute('image_url',asset('img/'.$post->image))  ;
            $post->setAttribute('comment_count',$post->comments->count())  ;
        }

        return response()->json($posts);
    }
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }
    public function addPost(Request $request)
    {

        $filename = '';
        if ($request->hasFile('img')){
            $filename = time().'.'.$request->img->getClientOriginalExtension();
            $request->img->move(public_path('img'),$filename);
        }
        $post = Post::create([
           "title" => $request->title ,
           "slug" => Str::slug($request->title) ,
           "body" => $request->body ,
           "user_id" => Auth::id() ,
           "category_id" => $request->category ,
           "image" => $filename ,
        ]);
        return response()->json($post);
    }
    public function editPost(Request $request){
        $post = Post::find($request->id);

        $filename = $post->image;
        if ($request->hasFile('img')){
            $filename = time().'.'.$request->img->getClientOriginalExtension();
            $request->img->move(public_path('img'),$filename);
        }

        $post->update([
            "title" => $request->title ,
            "slug" => Str::slug($request->title) ,
            "body" => $request->body ,
            "user_id" => Auth::id() ,
            "category_id" => $request->category ,
            "image" => $filename ,
        ]);

        $post->setAttribute('image_url',asset('img/'.$post->image))  ;

        return response()->json($post);
    }
    public function deletePost($id){
        $post = Post::find($id);
        Storage::delete($post->image);
        $post->delete();
        return response()->json(['error'=>false,'message'=>'success']);
    }

}
