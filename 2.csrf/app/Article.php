<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
