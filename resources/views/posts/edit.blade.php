@extends('layouts.app')

@section('main')
    <!-- Toastr -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="container mx-auto pt-2 pb-20">
        <div class="mx-auto mt-10  max-w-2xl">
            <div class="bg-white shadow rounded-lg">
                <div class="bg-pink-600 p-2 rounded-t-lg">
                    <h3 class="text-white font-semibold">Edit Post</h3>
                </div>
                <div class="p-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('update', ['id' => $post->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="font-semibold" for="title">Title:</label>
                                <input type="text" name="title" class="form-input mt-2 p-2 w-full border rounded"
                                    placeholder="Title" value="{{ $post->title }}">
                                @if ($errors->has('title'))
                                    <span class="text-pink-600">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div>
                                <label class="font-semibold" for="image">Image:</label>
                                <input type="file" id="image" name="image"
                                    class="form-input mt-2 p-2 w-full border rounded">
                                <img id="showImage" class="mt-2 w-20 absolute" src="{{ asset($post->image) }}" />
                                @if ($errors->has('image'))
                                    <span class="text-pink-600">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="font-semibold block" for="category">Category:</label>
                                <select name="category" class="form-input mt-2 p-2 w-full border rounded">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}"
                                            {{ $category['id'] == $post->category_id ? 'selected' : '' }}>
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-pink-600">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="review">Review:</label>
                            <textarea name="review" rows="3" class="form-textarea mt-2 p-2 w-full border rounded">{{ $post->content }}</textarea>

                            @if ($errors->has('review'))
                                <span class="text-pink-600">{{ $errors->first('review') }}</span>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Image -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        });
    </script>

    <!-- Tinymce -->
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
