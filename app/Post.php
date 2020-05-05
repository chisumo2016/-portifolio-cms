<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable =[
        'author_id',
        'title',
        'content',
        'description',
        'slug',
        'header_img',
        'status',
        'published_on',
        'publish_at',
    ];

    protected $casts = [
        'published_on' => 'datetime',
        'publish_at' => 'datetime',
    ];

    public function  author()
    {

        return $this->hasOne(User::class,'id','author_id');
    }
}
