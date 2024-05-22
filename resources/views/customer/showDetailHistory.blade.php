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
                <h1 class="text-center">Chi tiết đơn hàng</h1>
            </div>
            <div class="mb-10 cart-table">
                <form class="mb-4" action="#" method="post">
                    <table class="table" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Order ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orderDetails as $orderDetail)
                            <tr>
                                <td>
                                    <img class="img-fluid max-width-100 p-1 border border-color-1" src="{{ asset('image/'.$orderDetail->product->image) }}" alt="{{ $orderDetail->product->image }}" style="width: 100px; height: 80px;">
                                    {{ $orderDetail->product->name }}
                                </td>
                                <td>{{ $orderDetail->price }}</td>
                                <td>{{ $orderDetail->quantity }}</td>
                                <td>{{ $orderDetail->order_id}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </main>
@endsection
