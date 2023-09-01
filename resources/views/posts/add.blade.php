@extends('layouts.app')

@section('main')
    <div class="container mx-auto p-6 mb-20">
        <div class="mx-auto mt-10  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h3 class="text-white font-semibold">Add New Post</h3>
                </div>
                <div class="p-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('store.post') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold" for="title">Title:</label>
                                <input type="text" name="title" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Title" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="text-pink-600">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div>
                                <label class="font-semibold" for="image">Image:</label>
                                <input type="file" id="image" name="image"
                                    class="form-input mt-2 p-2 w-full border rounded">
                                <img id="preview" class="mt-2 w-20 absolute" />
                                @if ($errors->has('image'))
                                    <span class="text-pink-600">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="font-semibold block" for="category">Category:</label>
                                <select name="category" class="form-input mt-2 p-2 w-full border rounded">
                                    <option>Please select category</option>
                                    @foreach ($categories as $category)
                                        <option value={{ $category['id'] }}>{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-pink-600">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="review">Review:</label>
                            <textarea name="review" rows="3" class="form-textarea mt-2 p-2 w-full border rounded">{{ old('review') }}</textarea>

                            @if ($errors->has('review'))
                                <span class="text-pink-600">{{ $errors->first('review') }}</span>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Add Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const image = document.getElementById('image');
            const preview = document.getElementById('preview');

            image.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        preview.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant"))
        });
    </script>
@endsection
