<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Route::currentRouteName());
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'content'       => 'required',
            'header_img'    => 'required',
            'status'        => 'required',
        ]);
        $validatedData['slug'] = Str::slug($validatedData['title']);

        $post = Auth::user()->posts()->create($validatedData);
        //$media = Post::create( $validatedData);
        return  redirect($post->adminPath())->with('successd','Post Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return  view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       $post->load('tags');
        $tags = Tag::get();

        //dd($post->toArray(), $tags->toArray());
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $validatedData = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'content'       => 'required',
            'header_img'    => 'required',
            'status'        => 'required',
            'tags'         =>   'array',
        ]);

        $post->update($validatedData);
        // Add the tags
       if (isset($validatedData['tags'])){
           $post->tags()->sync($validatedData['tags']);
       }else{
           $post->tags()->detach();
       }
        return  redirect($post->adminPath(). '/edit')->with('success','Post Update');

       //dd($post->fresh()->load('tags')->toArray());
       // $post = Auth::user()->posts()->create($validatedData);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return  redirect('/admin/posts')->with('successd','Post Deleted');
    }
}
