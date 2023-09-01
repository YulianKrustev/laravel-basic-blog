@extends('layouts.app')

@section('main')
    <div class="container mx-auto p-6 -z-50">
        <div class="mx-auto mt-10  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h3 class="text-white font-semibold">My Articles</h3>
                </div>
                <div class="p-4">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Cover
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 cursor-pointer"
                                        onclick="window.location='{{ route('post.details', ['id' => $post->id]) }}';">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-96 h-28">
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $post->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post->category->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $post->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
