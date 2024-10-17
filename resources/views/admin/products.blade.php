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
                        <a href="{{route('admin.create-product')}}" class="btn" style="background-color: gainsboro"><i class="material-icons"></i>
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
                                    <a  href="{{ route('admin.edit-product', ['id' => $product->id]) }}" style="color: gray" ><i class="material-icons"></i></a>
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

    </main><!-- End #main -->
    <script>
        $(document).on("click", ".delete", function () {
            var productId = $(this).data('id');
            $("#deleteProductModal form").attr('action', '/home/product/' + productId);
        });
    </script>
    <script>
        let table = new DataTable('#products_table');
    </script>
@endsection
