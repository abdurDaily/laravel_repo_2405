@extends('backend.layout')
@section('backend_data')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card p-4">
                <h4>Show Product </h4>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>#</th>
                            <th>Tile</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>description</th>
                            <th>Action</th>
                        </tr>

                        @forelse ($products as $key => $product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $product->title }}</td>
                                <td> <span class="badge bg-{{ $product->status == 1 ? 'primary':'danger' }}">{{ $product->status == 0? 'Inactive' : 'Active'  }}</span> </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount_price }}</td>
                                <td>{!! $product->description !!}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-danger">No data found</div>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    <div class="mt-5">
                        {{ $products->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection