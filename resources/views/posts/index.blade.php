@extends('layouts.app')

@section('content')
<div class="flex justify-center">
   <div class="w-8/12 bg-white p-6 rounded-lg">
      <form action="{{ route('posts') }}" method="post" class="mb-4">
         @csrf
         <div class="mb-4">
            <label for="body" id="body" cols="30" rows="4" class="sr-only">Body</label>
            <textarea class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
               name="body"></textarea>

            @error('body')
            <div class="text-red-500 mt-2 text-sm">
               {{ $message }}
            </div>
            @enderror
         </div>
         <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium ">Post</button>
         </div>
      </form>

      @if ($posts -> count())
      @foreach ($posts as $post)

      {{-- post component --}}
      <x-post :item="$post" />

      @endforeach

      {{-- pagination --}}
      {{$posts->links()}}

      @else
      <p>There no posts</p>
      @endif

   </div>
</div>
@endsection