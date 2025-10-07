@extends('backend.layout')
@section('backend_data')
    @push('backend_css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Category Add </h4>
                    <a href="{{ route('category.show') }}" class="btn btn-primary">Show All</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="title">Category Title : </label>
                                <input type="text" name="title" class="form-control p-2" id="title"
                                    placeholder="Category Title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="category">Select Category : </label>
                                <select id="category" class="js-example-basic-single w-100" name="parent_id">
                                    <option selected disabled>Select Parent Category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="status">Status : </label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Unactive</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="meta_title">Meta Title : </label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control p-2"
                                            placeholder="Meta Title">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="meta_keyword">Meta Keyword : </label>
                                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control p-2"
                                            placeholder="Meta Keyword">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="meta_description">Meta Description : </label>
                                        <textarea name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control p-2"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 text-center">
                                <label style="cursor: pointer" for="image">
                                    <img id="preview" style="width: 180px" class="img-fluid" src="{{ asset('Images/profile.jpg') }}"
                                        alt="">
                                </label>
                                <input hidden type="file" name="image" id="image">
                                <p class="m-0 mb-3">Upload an image for Category</p>

                                <input type="text" name="image_alt" id="image_alt" class="form-control p-2"
                                    placeholder="Image alt text">
                                <br>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection

@push('backend_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });


        // Select elements
        const input = document.getElementById("image");
        const preview = document.getElementById("preview");

        // Add event listener
        input.addEventListener("change", function() {
            const file = this.files[0]; // Get first file
            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function() {
                    preview.setAttribute("src", this.result); // Set new image preview
                });

                reader.readAsDataURL(file); // Convert file → base64
            }
        });
    </script>
@endpush
