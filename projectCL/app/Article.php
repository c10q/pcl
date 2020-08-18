<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['cat_id', 'user_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cat()
    {
        return $this->belongsTo(Cat::class,'cat_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
