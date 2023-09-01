@extends('layouts.app')

@section('main')
    <div class="flex justify-center w-full mt-8 mb-20">

        <div class="max-w-2xl rounded overflow-hidden shadow-lg">
            <div class="bg-pink-600 p-2 rounded-t-lg">
                <h3 class="text-white font-semibold">About The Project</h3>
            </div>
            <img class="w-full" src="{{ url('images/about.jpg') }}" alt="">
            <div class="px-6 py-4">
                <p class="text-gray-700 text-base mb-4">
                    What is "My Blog"? This platform aims to display my knowledge in web development. Developed as part of
                    my job application, it showcases my technical skills in Laravel and front-end development.
                </p>

                <div class="mb-4">
                    <span class="font-bold">Tech Stack:</span>
                    <ul class="list-disc list-inside">
                        <li>Database: MySql</li>
                        <li>Backend: Laravel</li>
                        <li>Frontend: Tailwind CSS</li>
                    </ul>
                </div>

                <p class="text-gray-700 text-base mb-4">
                    About Me: I am Julian Krustev, the sole developer behind this project. I built this platform to
                    demonstrate my coding skills and problem-solving ability.
                </p>

                <p class="text-gray-700 text-base mb-4">
                    For more details or questions, please Contact Me.
                </p>

                <div class="flex items-center mb-2">
                    <i class="fas fa-envelope mr-2"></i>
                    <p>juliankrustev2018@gmail.com</p>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-phone-alt mr-2"></i>
                    <p>0888951429</p>
                </div>
            </div>
        </div>
    </div>
@endsection
