@extends('layouts.app')
@section('main')
    <div class="container mx-auto p-6">
        @if ($posts->isEmpty())
            <h1 class="text-xl font-semibold text-white mt-4 text-center  rounded-md m-auto p-1 bg-pink-600">
                We're sorry. We weren't able to find a match.
            </h1>
        @endif

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-3/5 m-auto pb-20 text-base font-medium">
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <a href="{{ route('post.details', ['id' => $post->id]) }}">
                    <h2 class="text-lg font-medium py-1 ml-4">{{ $post->title }}</h2>
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="object-cover mx-auto block">
                    <div class="p-4">
                        <hr>
                        <div class="mb-2">
                            {{ Str::limit(strip_tags($post->content), 50) }}
                        </div>
                        <hr>
                        <div class="mt-2 flex justify-between">
                            <div class="bg-green-500 hover:bg-green-700 text-white font-bold text-xs py-1 px-2 rounded ">
                                {{ $post->user->name }}
                            </div>
                            <a href="{{ route('search.by.category', ['category_id' => $post->category_id]) }}"
                                class="p-1 border-2 rounded-md bg-gray-200 text-xs ">{{ $post->category->name }}</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
