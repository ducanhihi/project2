@extends('layout.customerApp')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">


            <div class="content container">
                <!-- ... -->

                <div class="row">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header card-header-content-between">
                                <h4 class="card-header-title">Đơn Hàng {{ $orders->first()->order_id }}

                                </h4>
                            </div>


                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                @foreach ($orders as $item)
                                    <!-- Media -->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <td class="text-center">
                                                <img src="{{ asset('image/'.$item->image) }}"
                                                     alt="{{ $item->image }}"
                                                     style="width: 100px; height: 80px;">
                                            </td>
                                        </div>

                                        <div class="flex-grow-1 ms-3">
                                            <div class="row">
                                                <div class="col-md-5 mb-3 mb-md-0">
                                                    <a class="h5 d-block" href="">{{ $item->product_name }}</a>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col col-md-2 align-self-center">
                                                    <p class="fw-bold">{{ number_format($item->price, 0, ',', '.')}}
                                                        VNĐ</p>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col col-md-2 align-self-center">
                                                    <p class="">x {{ $item->quantity }}</p>
                                                </div>
                                                <!-- End Col -->
                                                <div class="col col-md-3 align-self-center text-end">
                                                    <p class="fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                        VNĐ</p>
                                                </div>

                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                    <!-- End Media -->
                                    <hr>
                                @endforeach
                                @php
                                    $totalPrice = 0;
                                    foreach ($orders as $item) {
                                        $totalPrice += $item->price * $item->quantity;
                                    }
                                @endphp
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <h5>
                                        <dl class="row text-sm-end">
                                            <dt class="col-sm-6">Tổng giá:</dt>
                                            <dd class="col-sm-5 fw-bold">{{ number_format($totalPrice, 0, ',', '.') }}
                                                VNĐ
                                            </dd>
                                        </dl>
                                    </h5>
                                </div>
                            </div>


                            <!-- End Body -->
                        </div>
                        <!-- End Card -->
                    </div>


                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card">
                            <!-- Header -->
                            <div class="card-header">
                                <h4 class="card-header-title">Thông tin cá nhân</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            <div class="card-body">
                                @php
                                    $customerInfo = [];
                                @endphp

                                @foreach ($orders as $order)
                                    @php
                                        if (!isset($customerInfo[$order->customer_name])) {
                                            $customerInfo[$order->customer_name] = [
                                                'name' => $order->customer_name,
                                                'phone' => $order->phone,
                                                'email' => $order->email,
                                                'address' => $order->address
                                            ];
                                        }
                                    @endphp
                                @endforeach

                                <!-- List Group -->
                                <ul class="list-group list-group-flush list-group-no-gutters">
                                    @foreach ($customerInfo as $customer)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5>Tên của bạn</h5>
                                            </div>

                                            <ul class="list-unstyled list-py-2 text-body">
                                                <li><i class=""></i>{{ $customer['name'] }}</li>
                                            </ul>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5>Thông tin liên hệ</h5>
                                            </div>

                                            <ul class="list-unstyled list-py-2 text-body">
                                                <li><i class="bi-at me-2"></i>{{ $customer['email'] }}</li>
                                                <li><i class="bi-phone me-2"></i>{{ $customer['phone'] }}</li>
                                            </ul>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5>Địa chỉ giao hàng</h5>
                                            </div>

                                            <span class="d-block text-body">
                            {{ $customer['address'] }}
                        </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- End List Group -->
                            </div>
                            <!-- End Body -->
                        </div>
                        <!-- End Card -->
                    </div>

                    <!-- End Body -->
                    <!-- End Card -->

                </div>

                <!-- ... -->


                <!-- Body -->
                <div class="card-body">
                    <div style="margin-right: 30px" class="row">
                        <h5>Trạng thái đơn hàng: </h5>
                        <h4>
                            @php
                                $stt = [];
                                foreach ($orders as $order) {
                                    if (!isset($stt[$order->status])) {
                                        $stt[$order->status] = [
                                            'status' => $order->status,
                                        ];
                                    }
                                }
                            @endphp
                            @foreach ($stt as $item)
                                <div class="">
                                    <p style="margin-left: 5px"
                                       class="badge bg {{ app('App\Http\Controllers\OrderController')->getOrderStatusClass($item['status']) }}">{{ $item['status'] }}</p>
                                </div>

                            @endforeach
                        </h4>

                    </div>
                    @if ($order->status == 'Đang giao' || $order->status == 'Đã giao')

                        <form action="{{ route('customer.done', ['order_id' => $order->order_id]) }}" method="POST">

                            @csrf
                            <div class="row justify-content-end">
                                <button style="margin-right: 30px" type="submit"
                                        class="btn btn-primary-dark-w btn-pill font-size-30 mb-3 py-3">Đã nhận hàng
                                </button>
                            </div>
                            <p style="margin-right: 30px" class="fw-bold row justify-content-end">Chỉ xác nhận đơn
                                hàng đã giao khi bạn đã nhận được hàng</p>
                        </form>
                    @elseif ($order->status == 'Chờ xác nhận' || $order->status == 'Đã xác nhận')
                        <form action="{{ route('customer.cancel', ['order_id' => $order->order_id]) }}" method="POST">
                            @csrf
                            <div class="row justify-content-end">
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#cancelOrderModal">
                                    Hủy đơn hàng
                                </button>
                            </div>
                        </form>
                    @endif
                    <div>
                        <h5>
                            @if ($order->status == 'Đã hủy')
                                <p style="color: black">Lý do hủy - {{ $order->note }}</p>
                            @endif
                        </h5>
                    </div>


                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

        </div>
        <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog"
             aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.cancel-order', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="note">Lý do hủy đơn hàng</label>
                                <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
