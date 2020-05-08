@extends('layouts.external')

@section('content')
    @foreach( $posts as $post)
        <h2>{{ $post->title }}</h2>
    @endforeach
@endsection
