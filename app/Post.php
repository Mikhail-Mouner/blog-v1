<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\Comment;

class Post extends Model
{
    /*
    protected $table = 'post';

    protected $guarded = [
        '',
    ] ;

    protected $hidden = [
        '',
    ] ;

    protected $timestamps = false ;

    protected $attributes = [
        '' => '',
    ];
    */
    protected $fillable = [
        'title', 'slug', 'body', 'image', 'user_id', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
