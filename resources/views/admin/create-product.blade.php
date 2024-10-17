@extends('layout.app')

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <main id="main"  class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="ecommerce-products.html">Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add product</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Add product</h1>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            <form method="POST" action="/admin/create/product" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Tên sản phẩm</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="productCodeLabel" class="input-label">Mã sản phẩm <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="Products are the goods or services you sell."></i></label>
                                            <input type="text" class="form-control" name="product_code" id="productCodeLabel" placeholder="Shirt, t-shirts, etc." aria-label="Shirt, t-shirts, etc.">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="productNameLabel" class="input-label">Tên sản phẩm <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="Products are the goods or services you sell."></i></label>
                                            <input type="text" class="form-control" name="name" id="productNameLabel" placeholder="Shirt, t-shirts, etc." aria-label="Shirt, t-shirts, etc.">
                                        </div>
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <!-- End Form Group -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label class="input-label">Thể loại<i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="Products are the goods or services you sell."></i></label>
                                            <select class="form-control" id="categorySelect" name="category_id">
                                                @foreach ($categoryOptions as $categoryId => $categoryName)
                                                    <option
                                                        value="{{ $categoryId }}">{{ $categoryName }}</option>
                                                @endforeach
                                            </select>                                </div>
                                    </div>
                                    <!-- End Form Group -->

                                    <div class="col-sm-6">
                                        <!-- Form Group -->
                                        <label  class="input-label">Hãng<i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="Products are the goods or services you sell."></i></label>
                                        <select class="form-control" id="brandSelect" name="brand_id">
                                            @foreach ($brandOptions as $brandId => $brandName)
                                                <option value="{{ $brandId }}">{{ $brandName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- End Form Group -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="SKULabel" class="input-label">Số lượng</label>
                                            <input type="text" class="form-control" name="quantity" id="SKULabel" placeholder="eg. 348121032" aria-label="eg. 348121032">
                                        </div>
                                        <!-- End Form Group -->
                                    </div>

                                    <!-- Form Group -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productPriceLabel" class="input-label">Giá <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="Products are the goods or services you sell."></i></label>
                                            <input type="text" class="form-control" name="price" id="productPriceLabel" placeholder="Shirt, t-shirts, etc." aria-label="Shirt, t-shirts, etc.">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Row -->

                                <label class="input-label">Description <span class="input-label-secondary">(Optional)</span></label>
                                <textarea id="editor" type="text" class="form-control mt-3" name="description" placeholder=" Noi dung"></textarea>
                                <!-- Quill -->
                                {{--                        <div class="quill-custom">--}}
                                {{--                            <div class="js-quill" style="min-height: 15rem;" data-hs-quill-options='{--}}
                                {{--                          "placeholder": "Type your description..."--}}
                                {{--                         }'>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                <!-- End Quill -->
                            </div>
                            <!-- Body -->
                        </div>
                        <!-- End Card -->

                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Media</h4>
                            </div>
                            <!-- Body -->
                            <div class="card-body">
                                <!-- Dropzone -->
                                <div id="attachFilesNewProjectLabel" class="js-dropzone dropzone-custom custom-file-boxed">
                                    <label>Ảnh</label>
                                    <input type="file" name="image" class="form-control" required="">
                                </div>
                                <!-- End Dropzone -->
                            </div>

                            <div class="card-body">
                                <!-- Dropzone -->
                                <div id="attachFilesNewProjectLabel" class="js-dropzone dropzone-custom custom-file-boxed">
                                    <label>Ảnh chi tiết</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple required>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                                </div>
                                <!-- End Dropzone -->
                            </div>
                            <!-- Body -->
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
            <!-- End Row -->
        </div>
        <!-- End Content -->
    </main>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
