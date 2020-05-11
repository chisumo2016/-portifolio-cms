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
    ];

    protected $casts = [
        'published_on'  => 'datetime',
        'status'        => 'boolean',
    ];

    protected $table = 'posts';

    public function  author()
    {
        return $this->hasOne(User::class,'id','author_id');
    }

    public function  tags()
    {
        return $this->belongsToMany(Tag::class,'posts_tags','posts_id','tags_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public  function  adminPath()
    {
        return '/admin/posts/'.  $this->slug;
    }
}
