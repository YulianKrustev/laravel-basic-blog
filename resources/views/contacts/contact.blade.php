@extends('layouts.app')

@section('main')
    <div class="container mx-auto p-6">
        <div class="mx-auto mt-6  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h2 class="text-white font-semibold">Contacts</h2>
                </div>
                <div class="p-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" id="contactUSForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold" for="name">Name:</label>
                                <input type="text" name="name" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-pink-600">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div>
                                <label class="font-semibold" for="email">Email:</label>
                                <input type="text" name="email" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-pink-600">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="font-semibold" for="phone">Phone:</label>
                                <input type="text" name="phone" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-pink-600">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="message">Message:</label>
                            <textarea name="message" rows="3" class="form-textarea mt-2 p-2 w-full border rounded">{{ old('message') }}</textarea>
                            @if ($errors->has('message'))
                                <span class="text-pink-600">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold text-base px-3 py-1 mb-1 rounded inline-block">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
