@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if ($posts -> count())
        @foreach ($posts as $post)

        {{-- post component --}}
        <x-post :item="$post" />

        @endforeach

        {{-- pagination --}}
        {{$posts->links()}}

        @else
        {{ $user->name }} does not have any posts
        @endif
    </div>
</div>
@endsection