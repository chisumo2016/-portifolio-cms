@extends('layouts.internal')

@section('content')
    <section class="bg-white shadow-lg rounded px-8  py-6">
        <div class="flex justify-between mb-8">
            <h2 class="text-4xl text-gray-900 font-bold mb-8 mb-0">Edit  Post</h2>
            <button type="submit" class="text-xl bg-red-600 hover:bg-blue-700 transition-sm text-white rounded px-2 py-2 shadow-lg">Delete</button>
        </div>
         <div>
             <form action="{{ route('posts.update', $post) }}" method="POST">
                 @method('patch')
                @csrf
                 <div class="flex flex-col mb-8">
                     <label for=""  class="text-base uppercase text-gray-600 mb-2 font-bold">Title</label>
                     <input type="text" name="title" value="{{ $post->title }}" class="w-full bg-gray-300 p-2 rounded text-lg text-gray-900 font-light">
                 </div>
                 <div class="flex flex-col mb-8">
                     <label for="image"  class="text-base uppercase text-gray-600 mb-2 font-bold">Image</label>
                     <input type="text" name="header_img" value="{{ $post->header_img }}" class="w-full bg-gray-300 p-2 rounded text-lg text-gray-900 font-light">
                 </div>

                 <div class="flex flex-col mb-8">
                     <label for="description"  class="text-base uppercase text-gray-600 mb-2 font-bold">Description</label>
                     <input type="text" name="description" value="{{ $post->description }}" class="w-full bg-gray-300 p-2 rounded text-lg text-gray-900 font-light">
                 </div>

                 <div class="flex flex-col mb-8">
                     <div class="flex justify-between mb-2">
                         <label for="content"  class="text-base uppercase text-gray-600 mb-2 font-bold">Content</label>
                         <small class="capitalize text-gray-600  text-sm">This field support markdown content</small>
                     </div>
                     <textarea  class="h-4" name="content" id="my-text-area" cols="30" rows="10">{{ $post->content }}</textarea>

                 </div>

                 <div class="flex flex-col  text-base uppercase text-gray-600 mb-2 font-bold mb-8">
                     <label for="status">Status</label>
                     <div class="flex">
                         <label class="text-xl flex items-center  mr-4">
                             <input class="-mt-2" type="radio" value="1" name="status" {{ $post->status == 1 ? 'checked' :  '' }}> Active
                         </label>

                         <label class="text-xl flex items-center">
                             <input  class="-mt-2" type="radio" value="0" name="status"  {{ $post->status != 1 ? 'checked' :  '' }}>Inactive
                         </label>
                     </div>
                 </div>

                 <div class="flex justify-between items-center">
                     <button type="submit" class="text-xl bg-blue-600 hover:bg-blue-700 transition-sm text-white rounded px-3 py-3 shadow-lg mr-4">Save</button>
                     <a href="{{ route('posts.index') }}" class="text-xl text-red-400 text-white rounded px-3 py-3 shadow-lg hover:text-gray-700">Cancel</a>
                 </div>
             </form>
         </div>

    </section>
@endsection
