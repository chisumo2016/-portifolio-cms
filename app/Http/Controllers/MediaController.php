<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
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
        $media = Media::get();
        return view('media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
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
            'link'          => 'required',
            'header_image'  => 'required',
            'status'        => 'required',
        ]);
        $validatedData['slug'] = Str::slug($validatedData['title']);

        $media = Media::create( $validatedData);

        return  redirect($media->adminPath())->with('successd','Media Create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function show(Media $medium)
    {
        return  view('media.show',compact('medium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $medium)
    {
        return view('media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $medium)
    {
        $validatedData = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'link'          => 'required',
            'header_image'  => 'required',
            'status'        => 'required',
        ]);

        $medium->update($validatedData);
        return  redirect($medium->adminPath())->with('successd','Media Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $medium)
    {
        $medium->delete();
        return  redirect('/admin/media')->with('successd','Media Deleted');
    }

}
