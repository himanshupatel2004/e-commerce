@extends('admin-panel.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Deleted</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('products.delete'.$products->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="discount_price" name="discount_price"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description<span class="required">*</span></label>
                                    <textarea name="description" class="form-control" cols="30" rows="10"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category<span class="required">*</span></label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Sub Category<span class="required">*</span></label>
                                    <select name="sub_category_id" class="form-control" required>
                                        <option value="">Select Sub Category</option>
                                        @foreach ($sub_categories as $sub_cat)
                                        <option value="{{ $sub_cat->id }}" class="sub_cat_options"
                                            data-category_id="{{ $sub_cat->category_id }}">{{ $sub_cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image:<span class="required">*</span></label>
                                    <input type="file" class="form-control" name="image">
                                    {{-- <input type="file" class="form-control" name="images[]" id="images" multiple> --}}
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

