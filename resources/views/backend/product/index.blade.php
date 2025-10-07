@extends('backend.layout')
@section('backend_data')
@push('backend_css')
<link rel="stylesheet" href="{{ asset('assets/css/rte_theme_default.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container {
        height: 55px;
    }

    .select2-container--default .select2-selection--single {
        height: 100%;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 15px;
        right: 9px;
        width: 20px;
    }
</style>
@endpush

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card p-5">
            <h4>Product Store</h4>

            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6">
                        <label for="title">Product Title :</label>
                        <input class="form-control p-3 mb-2" type="text" name="title" id="title"
                            placeholder="Product Title">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="col-lg-6">
                        <label for="category_id">Select Category :</label>
                        <select name="category_id" id="category_id" class="form-control p-3 mb-2">
                            <option value="" selected disabled>
                                --Select a Category-- </option>
                        </select>
                    </div> --}}
                    <div class="col-lg-6">
                        <label for="category_id">Select Category :</label>
                        <select class="js-example-basic-single form-control" name="state">
                            <option value="AL" disabled selected>Alabama</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                            @endforeach
                        </select>
                        @error('state')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="price">Product Price :</label>
                        <input class="form-control p-3 mb-2" type="number" name="price" id="price"
                            placeholder="Product price">
                    </div>
                    <div class="col-lg-4">
                        <label for="discount_price">Product Discount Price :</label>
                        <input class="form-control p-3 mb-2" type="number" name="discount_price" id="discount_price"
                            placeholder="Product Discount price">
                    </div>
                    <div class="col-lg-4">
                        <label for="discount_price">Status:</label>
                        <select name="status" id="" class="form-control p-3">
                            <option value="" selected disabled> -- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>
                    </div>

                    <div class="col-lg-12">
                        <label for="descriptions">descriptions</label>
                        <div id="div_editor1"></div>
                        <textarea name="descriptions" id="descriptions" hidden></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 p-2 w-100">Submit</button>

                </div>
            </form>
        </div>
    </div>
    <!-- / Content -->
</div>
@endsection

@push('backend_js')
<script src="{{ asset('assets/js/rte.js') }}"></script>
<script src="{{ asset('assets/js/all_plugins.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    var editor1 = new RichTextEditor("#div_editor1");

    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    
        $('form').on('submit', function(){
            $html = editor1.getHTMLCode();
            $('#descriptions').val($html);
        })

    });
</script>
@endpush