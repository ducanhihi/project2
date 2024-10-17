@extends('layout.customerApp')

@section('content')
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{asset('/customer/home')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h1 class="text-center">Cart</h1>
            </div>
            <div class="mb-10 cart-table">
                <form class="mb-4" action="#" method="post">
                    <table class="table" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="product-remove"><input type="checkbox" id="selectAll" class="custom-checkbox"> Chọn tất cả</th>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-name">Product</th>
                            <th class="product-quantity w-lg-15 text-center">Quantity</th>
                            <th class="product-price text-center">Price</th>
                            <th class="product-subtotal text-center">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartDetails as $detail)
                            <tr>
                                <td class="text-center">
                                    @if ($detail->product->quantity > 0)
                                    <input type="checkbox" class="product-checkbox custom-checkbox" data-product-id="{{ $detail->product_id }}" onchange="updateSelectedProducts()">
                                    @else
                                        <input type="checkbox" class="product-checkbox custom-checkbox" disabled data-product-id="{{ $detail->product_id }}" onchange="updateSelectedProducts()">

                                    @endif
                                </td>
                                <td class="text-center">
                                    <a title="Xóa sản phẩm khỏi giỏ hàng" onclick="return confirm('Bạn có chắn chắc muốn xóa không')" href="{{route('cart.delete', $detail->product_id)}}" class="text-gray-32 font-size-26">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset('image/'.$detail->product->image) }}" alt="{{ $detail->product->image }}" style="width: 100px; height: 80px;">
                                    {{ $detail->product->name }}
                                </td>
                                <td data-title="Quantity">
                                    @if ($detail->product->quantity > 0)
                                        <!-- Quantity -->
                                        <form action="{{ route('cart.update', $detail->product_id) }}" method="GET">
                                            <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1 text-center">
                                                <div class="js-quantity row align-items-center">
                                                    <div class="col">
                                                        <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="{{ $detail->quantity }}" name="quantity">
                                                    </div>
                                                    <div class="col-auto pr-1">
                                                        <a href="{{ route('cart.update', [$detail->product_id, 'quantity' => $detail->quantity - 1]) }}" class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                                            <small class="fas fa-minus btn-icon__inner"></small>
                                                        </a>
                                                        <a href="{{ route('cart.update', [$detail->product_id, 'quantity' => $detail->quantity + 1]) }}" class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                                            <small class="fas fa-plus btn-icon__inner"></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Quantity -->
                                    @else
                                        <h4 type="submit" class="btn" style="color: red;" disabled>Hết hàng</h4>
                                    @endif
                                </td>

                                <td class="text-center fw-bold">{{ $detail->product->price }}</td>
                                <td class="text-center fw-bold">{{ $detail->product->price * $detail->quantity }}</td>
                                {{--                <td><a href="{{ route('cart.remove', $detail->id) }}">Xóa</a></td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="mb-8 cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                            <form action="{{route('customer.buy-inCart')}}" method="post" class="container">
                                @csrf
                                <input type="hidden" name="selected_products" value="">
                                <button type="submit" class="btn btn-primary">Đặt hàng</button>
                            </form>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function updateSelectedProducts() {
            var selectedProductIds = [];
            $(".product-checkbox:checked").each(function() {
                selectedProductIds.push($(this).data("product-id"));
            });
            $("input[name='selected_products']").val(selectedProductIds.join(","));
        }
    </script>

    <!-- ========== END MAIN CONTENT ========== -->
@endsection
