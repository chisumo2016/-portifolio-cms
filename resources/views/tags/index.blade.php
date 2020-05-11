@extends('layouts.internal')

@section('content')
    @foreach( $tags as $tag)
        <h2>{{ $tag->title }}</h2>
    @endforeach
@endsection
