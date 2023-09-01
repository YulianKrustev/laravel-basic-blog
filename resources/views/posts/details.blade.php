@extends('layouts.app')

@section('main')
    <div class="flex justify-center w-full mt-8 pt-4 pb-20 ">
        <div class="max-w-xl rounded overflow-hidden shadow-lg">
            <div class="bg-pink-600 p-2 rounded-t-lg">
                <div class="flex justify-between">
                    <div class="font-semibold text-white text-xl mb-2 ml-4">{{ $post->title }}</div>
                    <div class="mt-2 text-xs mb-2 text-white">{{ $post->created_at }}</div>
                </div>
            </div>
            <img class="w-full border-2" src="{{ url($post->image) }}" alt="">
            <div class="px-6 py-4">
                <p class="text-gray-700 text-base mb-4">
                    {{ strip_tags($post->content) }}
                </p>
                <hr><br>
                <div class="flex justify-between ">
                    <div>
                        <div class="inline-block">
                            @if (Auth::check())
                                @if ($post->isLikedBy(Auth::user()))
                                    <form action="{{ route('post.unlike', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-pink-600">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('post.like', $post) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-pink-600">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}"><i class="far fa-heart text-pink-600"></i></a>
                                   
                               
                            @endif
                        </div>
                        <a href="{{ route('search.by.category', ['category_id' => $post->category_id]) }}"
                            class="p-1 border-2 rounded-md bg-gray-200 text-xs">{{ $post->category->name }}</a>
                    </div>
                    @if (Auth::check() && $post->user_id == Auth::user()->id)
                        <div>
                            <a href="{{ route('edit.post', ['id' => $post->id]) }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 mb-1 rounded inline-block">
                                Edit
                            </a>
                            <a href="javascript:void(0);"
                                onclick="if (window.confirm('Are you sure you want to delete this post?')) { window.location.href='{{ route('delete.post', ['id' => $post->id]) }}' }"
                                class="bg-pink-600 hover:bg-red-700 text-white font-bold text-sm py-1 px-2 mb-1 rounded inline-block">
                                Delete
                            </a>
                        </div>
                    @else
                        <div class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 mb-1 rounded">
                            Created by {{ $post->user->name }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full mt-8 px-4 py-2">
                <h2 class="text-xl font-semibold">Comments</h2>
                @auth
                    <form action="{{ route('post.addComment', $post->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="4" class="w-full p-1 rounded"></textarea>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold text-sm py-1 px-2 mb-1 rounded inline-block">Send</button>
                    </form>
                @else
                    <p class="">Please <a href="{{ route('login') }}"><strong class="text-pink-600">login</strong></a> to add a comment.</p>
                @endauth
                <!-- List comments -->
                @foreach ($post->comments as $comment)
                    <div class="mt-4 ">
                        <strong>{{ $comment->user->name }}:</strong>
                        <p class="border-2 bg-slate-50 rounded-md py-1">{{ $comment->content }}</p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
