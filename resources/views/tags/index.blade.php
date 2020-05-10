@extends('layouts.external')

@section('content')
    @foreach( $tags as $tag)
        <h2>{{ $tag->title }}</h2>
    @endforeach
@endsection
