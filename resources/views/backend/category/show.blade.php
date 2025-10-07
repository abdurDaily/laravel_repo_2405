@extends('backend.layout')
@section('backend_data')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Category Show </h4>
                    <a href="{{ route('category.index') }}" class="btn btn-primary"> Add New +</a>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Img Alt</th>
                            <th>Parent</th>
                            <th>M.Tiile</th>
                            <th>M.Kays</th>
                            <th>M.Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>


                        @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $category->category_title }}</td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('category/' . $category->image) }}"
                                            alt="{{ $category->category_title }}" width="50">
                                    @else
                                        <img src="{{ asset('Images/profile.jpg') }}" alt="" width="50">
                                    @endif
                                </td>
                                <td>{{ $category->image_alt }}</td>
                                <td>
                                    @if ($category->parent)
                                        {{ $category->parent->category_title }}

                                    @else
                                        No Parent
                                    @endif
                                </td>
                                <td>{{ $category->meta_title }}</td>
                                <td>{{ $category->meta_keywords }}</td>
                                <td>{{ Str::limit($category->meta_description, 10, '...') }}</td>
                                <td class="{{ $category->status ==1 ? 'text-success' : 'text-danger' }}">{{ $category->status ==1 ? 'Active' : 'Unactive' }}</td>
                                <td>
                                    <a href="{{ route('category.edit',  $category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class=" text-center alert alert-danger" colspan="10">No data found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
@endsection
