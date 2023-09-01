@extends('layouts.app')

@section('main')
    <div class="container mx-auto p-6">
        <div class="mx-auto mt-10  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h3 class="text-white font-semibold">Log In</h3>
                </div>
                <div class="p-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold" for="email">Email:</label>
                                <input type="email" name="email" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-pink-600">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div>
                                <label class="font-semibold" for="password">Password:</label>
                                <input type="password" name="password" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="text-pink-600">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2 mt-2"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <div class="mt-4 text-center">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Log In
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection