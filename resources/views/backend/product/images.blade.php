@extends('backend.layout')
@section('backend_data')
    @push('backend_css')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    @endpush


    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card p-3">
                <h4>Product Images </h4>

                <form action="{{ route('product.images.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <label for="product">Select Product * </label> --}}
                            <select name="product_id" id="" class="form-control p-4">
                                <option value="" disabled selected>-- Select Product --</option>

                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"> {{ $product->title }} </option>
                                @endforeach
                            </select>

                            @error('product')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <input multiple name="images[]" type="file" />
                            @error('images')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary mt-3" type="submit">Upload</button>
                </form>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection


@push('backend_js')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            storeAsFile: true,
        });
    </script>
@endpush
