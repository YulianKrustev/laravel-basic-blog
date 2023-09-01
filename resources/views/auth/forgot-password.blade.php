@extends('layouts.app')

@section('main')
    <div class="container mx-auto p-6">
        <div class="mx-auto mt-10  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h3 class="text-white font-semibold">Log Into Your Account</h3>
                </div>
                <div class="p-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a
                        password reset link that will allow you to choose a new one.</p><br>
                    <form method="POST" action="{{ route('password.email') }}" >
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


                            <div class="mt-8 text-center">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Email Password Reset Link
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
