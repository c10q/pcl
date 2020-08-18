<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $casts = [
        'options' => 'array',
    ];

    protected $fillable = [
        'group_id',
        'title',
        'updated_at'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'cat_id');
    }

}
