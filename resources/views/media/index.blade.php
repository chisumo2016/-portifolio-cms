@extends('layouts.external')

@section('content')
    @foreach( $media as $m)
        <h2>{{ $m->title }}</h2>
    @endforeach
@endsection
