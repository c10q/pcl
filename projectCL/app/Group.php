<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $casts = [
        'options' => 'array',
    ];

    protected $fillable = ['title'];

    public function cats()
    {
        return $this->hasMany(Cat::class)->withCount('articles');
    }
}
