<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(MediaTableSeeder::class);

         //TODO join tags and posts

        $posts = Post::all();

        Tag::take(3)->get()->each(function ($tag)  use ($posts){
            $tag->posts()->attach($posts->pluck('id'));
          });
    }

}

//dd($posts->pluck('id'));
