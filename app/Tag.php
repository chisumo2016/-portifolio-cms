<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected  $fillable = [
        'title','slug','status'
    ];

    protected  $casts = [
        'status' => 'boolean'
    ];

    protected $table = 'tags';

    public function  posts()
    {
        return $this->belongsToMany(Post::class,'posts_tags','posts_id','tags_id');
    }
}
