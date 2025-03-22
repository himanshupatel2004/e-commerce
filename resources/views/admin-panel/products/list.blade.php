@extends('admin-panel.layouts.app')
@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Products</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $k => $product)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->subcategory->name }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" height="100px">
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('products.delete', $product->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
