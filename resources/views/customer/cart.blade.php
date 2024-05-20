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
                                    <a title="Xóa sản phẩm khỏi giỏ hàng" onclick="return confirm('Bạn có chắn chắc muốn xóa không')" href="{{route('cart.delete', $detail->product_id)}}" class="text-gray-32 font-size-26">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset('image/'.$detail->product->image) }}" alt="{{ $detail->product->image }}" style="width: 100px; height: 80px;">
                                    {{ $detail->product->name }}
                                </td>
                                <td data-title="Quantity">
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
                        <div class="border-bottom border-color-1 mb-3">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                        </div>
                        <table class="table mb-3 mb-md-0">
                            <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal"><span class="amount">{{$totalAmount}}</span></td>
                            </tr>
                            <tr class="shipping">
                                <th>Shipping</th>
                                <td data-title="Shipping">
                                    Flat Rate: <span class="amount">$300.00</span>
                                    <div class="mt-1">
                                        <a class="font-size-12 text-gray-90 text-decoration-on underline-on-hover font-weight-bold mb-3 d-inline-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Calculate Shipping
                                        </a>
                                        <div class="collapse mb-3" id="collapseExample">
                                            <div class="form-group mb-4">
                                                <select class="js-select selectpicker dropdown-select right-dropdown-0-all w-100"
                                                        data-style="bg-white font-weight-normal border border-color-1 text-gray-20">
                                                    <option value="">Select a country…</option>
                                                    <option value="AX">Åland Islands</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4">
                                                <select class="js-select selectpicker dropdown-select right-dropdown-0-all w-100"
                                                        data-style="bg-white font-weight-normal border border-color-1 text-gray-20">
                                                    <option value="">Select an option…</option>
                                                    <option value="AP">Andhra Pradesh</option>
                                                    <option value="AR">Arunachal Pradesh</option>
                                                </select>
                                            </div>
                                            <input class="form-control mb-4" type="text" placeholder="Postcode / ZIP">
                                            <button type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Update Totals</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total"><strong><span class="amount">$2,085.00</span></strong></td>
                            </tr>
                            <form action="{{route('customer.order-save')}}" method="post" class="container">
                                <div class="mt-3 mb-3" >
                                    <label for="name">Họ và tên</label>
                                    <input type="text" required style="width: 500px" name="name" id="name" class="form-control form-control-sm">
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" required style="width: 500px" name="phone" id="phone" class="form-control form-control-sm">
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="phone">Email</label>
                                    <input type="text" required style="width: 500px" name="email" id="email" class="form-control form-control-sm">
                                </div>

                                <div class="mt-3 mb-3">
                                    <label for="address">Địa chỉ </label>
                                    <input type="text" required style="width: 500px" name="address" id="address" class="form-control form-control-sm">
                                </div>
                                <form action="{{route('customer.order-save')}}" method="post" class="container">
                                    @csrf
                                    <!-- các trường input -->
                                    <button type="submit" class="btn btn-primary">Đặt hàng</button>
                                </form>
                            </form>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary-dark-w ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed to checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
