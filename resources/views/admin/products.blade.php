@extends('layout.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Quản Lí Sản Phẩm</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Sản Phẩm</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-lg-12">
            <div class="card card-table">
                <div class="card-header">
                    <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a class="dropdown-toggle"
                                                                                              href="#" role="button"
                                                                                              data-toggle="dropdown"
                                                                                              aria-expanded="false"><span
                                class="icon mdi mdi-more-vert"></span></a>
                        <div class="dropdown-menu" role="menu" x-placement="bottom-start"
                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(20px, 25px, 0px);">
                            <a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another
                                action</a><a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>
                    <div>
                        <a href="#addProductModal" class="btn" style="background-color: gainsboro"
                           data-toggle="modal" data-bs-target=""><i
                                class="material-icons"></i>
                            <span>Thêm sản phẩm</span></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="products_table" data-page-length='5'
                           class="table table-sm">
                        <thead>
                        <tr>
                            <th class="text-center fw-bold">Mã sản phẩm</th>
                            <th class="text-center fw-bold">Tên sản phẩm</th>
                            <th class="text-center fw-bold">Ảnh</th>
                            <th class="text-center fw-bold">Giá</th>
                            <th class="text-center fw-bold">Số lượng</th>
                            <th class="text-center fw-bold">Thể loại</th>
                            <th class="text-center fw-bold">Thương hiệu</th>
                            <th class="text-center fw-bold">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($allProducts as $product)
                            <tr>
                                <td class="text-center">{{$product-> product_code}}</td>
                                <td class="text-center">{{$product-> name}}</td>
                                <td class="text-center">
                                    <img src="{{ asset('image/'.$product->image) }}"
                                         alt="{{ $product->image }}"
                                         style="width: 100px; height: 80px;">
                                </td>
                                <td class="text-center">{{$product-> price}}</td>
                                <td class="text-center">{{$product-> quantity}}</td>
                                <td class="text-center">{{$product-> category_name}}</td>
                                <td class="text-center">{{$product-> brand_name}}</td>
                                <td class="text-center">
                                    <a href="#editProductModal" style="color: gray" data-id="{{$product -> id}}"
                                       data-product_code="{{$product->product_code}}"
                                       data-name="{{$product->name}}"
                                       data-quantity="{{$product->quantity}}"
                                       data-price="{{$product->price}}"
                                       data-category_id="{{$product->category_id}}"
                                       data-brand_id="{{$product->brand_id}}"
                                       data-image="{{$product->image}}"
                                       data-description="{{$product->description}}" class="edit"
                                       data-toggle="modal"><i class="material-icons"
                                                              data-toggle="tooltip" title=""
                                                              data-original-title="Edit"></i></a>
                                    <a href="#deleteProductModal" data-id="{{$product -> id}}"
                                       class="delete" data-toggle="modal"><i
                                            class="material-icons" data-toggle="tooltip"
                                            style="color: gray;" data-original-title="Delete"></i></a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Add Modal HTML -->
        <div id="addProductModal" class="modal fade" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/admin/create/product" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm sản phẩm</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">×
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input type="text" name="product_code" class="form-control"
                                       required="">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control" required
                                       min="0">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" required
                                       min="0">
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>CategoryId</label>
                                <select id="categorySelect" name="category_id">
                                    @foreach ($categoryOptions as $categoryId => $categoryName)
                                        <option
                                            value="{{ $categoryId }}">{{ $categoryName }}</option>
                                    @endforeach
                                </select>
                                <label style="margin-left: 20px">BrandId</label>
                                <select id="brandSelect" name="brand_id">
                                    @foreach ($brandOptions as $brandId => $brandName)
                                        <option value="{{ $brandId }}">{{ $brandName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control"
                                       required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal"
                                   value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editProductModal" class="modal fade" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    @if(isset($product) && $product)
                        <form method="POST" action="/admin/edit/product/{{$product -> id}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Product</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Mã sản phẩm</label>
                                    <input type="text" name="product_code" class="form-control"
                                           required="" value="{{$product -> product_code}}">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required=""
                                           value="{{$product -> name}}">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control"
                                           required="" value="{{$product -> quantity}}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" class="form-control" required=""
                                           value="{{$product -> price}}">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" name="image" id="" class="form-control">
                                    <img src="{{ asset('image/'.$product->image) }}"
                                         alt="{{$product->image}}"
                                         style="width: 100px; height: 80px;">
                                </div>
                                <div class="form-group">
                                    <label>CategoryId</label>
                                    <select id="categorySelect" name="category_id">
                                        @foreach ($categoryOptions as $categoryId => $categoryName)
                                            <option
                                                value="{{ $categoryId }}">{{ $categoryName }}</option>
                                        @endforeach
                                    </select>
                                    <label style="margin-left: 20px">BrandId</label>
                                    <select id="brandSelect" name="brand_id">
                                        @foreach ($brandOptions as $brandId => $brandName)
                                            <option value="{{ $brandId }}">{{ $brandName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" placeholder="Description"
                                           class="form-control" required=""
                                           value="{{$product -> description}}">
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default"
                                           data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-info" value="Save">
                                </div>
                            </div>
                        </form>
                    @else
                        <p>dfđff</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteProductModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    @if(isset($product) && $product)
                        <form action="/home/products/{{$product-> id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Employee</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">×
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete these Records?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal"
                                       value="Cancel">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    @else
                        <p>nbnbnb</p>
                    @endif
                </div>
            </div>
        </div>
        <div id="eJOY__extension_root" class="eJOY__extension_root_class" style="all: unset;"></div>
        </div>
        </div>
        </div><!-- End Website Traffic -->

        </div><!-- End Right side columns -->

        </div>
        </section>

    </main><!-- End #main -->
    <script>
        $(document).on("click", ".delete", function () {
            var productId = $(this).data('id');
            $("#deleteProductModal form").attr('action', '/home/product/' + productId);
        });
        $(document).on("click", ".edit", function () {
            var editID = $(this).data('id');
            $("#editProductModal form").attr('action', '/admin/edit/product/' + editID);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.edit').on('click', function () {
                var id = $(this).data('id');
                var product_code = $(this).data('product_code');
                var name = $(this).data('name');
                var quantity = $(this).data('quantity');
                var image = $(this).data('image');
                var price = $(this).data('price');
                var category_id = $(this).data('category_id');
                var brand_id = $(this).data('brand_id');
                var description = $(this).data('description');

                $('#editProductModal input[name="id"]').val(id);
                $('#editProductModal input[name="product_code"]').val(product_code);
                $('#editProductModal input[name="name"]').val(name);
                $('#editProductModal input[name="quantity"]').val(quantity);
                $('#editProductModal input[name="price"]').val(price);
                $('#editProductModal input[name="category_id"]').val(category_id);
                $('#editProductModal img').attr('src', "{{ asset('image/') }}" + '/' + image);
                $('#editProductModal input[name="brand_id"]').val(brand_id);
                $('#editProductModal input[name="description"]').val(description);
                // Đặt giá trị cho dropdown category_id
                $('#editProductModal select[name="category_id"]').val(category_id);
                // Đặt giá trị cho dropdown brand_id
                $('#editProductModal select[name="brand_id"]').val(brand_id);
            });
        });
    </script>
    <script>
        var categoryOptions = @json($categoryOptions);
        var brandOptions = @json($brandOptions);

        var categorySelect = document.querySelector('select[name="category_id"]');
        var brandSelect = document.querySelector('select[name="brand_id"]');

        var categorySettings = {}; // Bổ sung các tùy chọn cấu hình nếu cần
        var brandSettings = {}; // Bổ sung các tùy chọn cấu hình nếu cần

        var categoryTomSelect = new TomSelect(categorySelect, {options: categoryOptions, ...categorySettings});
        var brandTomSelect = new TomSelect(brandSelect, {options: brandOptions, ...brandSettings});
    </script>
    <script>
        let table = new DataTable('#products_table');
    </script>
@endsection
