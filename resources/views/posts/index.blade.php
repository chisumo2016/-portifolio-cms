@extends('layouts.internal')

@section('content')
    <section class="bg-white shadow-lg rounded px-8  py-6">
        <h2 class="text-4xl text-gray-900 font-bold mb-8">Blog Post</h2>
        <div class="overflow-x-auto">
            <table class="w-full min-w-lg">
                <thead >
                <tr class="text-left text-md uppercase text-gray-600">
                    <th class="pb-3">Title</th>
                    <th class="pb-3">Status</th>
                    <th class="pb-3">Published On</th>
                    <th class="text-right pb-3">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $posts as $post)
                    <tr class="text-2xl text-gray-900 font-light">
                        <td class="py-1">
                            {{ \Str::limit($post->title,  40, '....') }}
                        </td>
                        <td class="py-1">
                            {{ $post->status == 1 ? 'Active'  : 'Inactive' }}
                        </td>
                        <td class="py-1">
                            {{ \Carbon\Carbon::parse($post->published_on)->toFormattedDateString() }}
                        </td>
                        <td class="text-right py-2">
                            <a href="/blog/post/{{ $post->slug }}" class="text-blue-600   hover:text-blue-800 transition-sm  mr-2 ">View</a>
                            <a href="{{ $post->adminPath() }}/edit"      class="text-blue-600  hover:text-blue-800 transition-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </section>

@endsection
