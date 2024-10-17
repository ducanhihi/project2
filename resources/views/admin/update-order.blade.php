@extends('layout.app')

@section('content')
    <div class="container col-xl-8">
        <h1>Chỉnh sửa đơn hàng</h1>

        <form action="{{ route('admin.update-save', ['order_id' => $order->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $order->name }}">
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $order->email }}">
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $order->address }}">
            </div>

            <div class="form-group">
                <label for="landing_code">Mã vận đơn</label>
                <input type="text" class="form-control" id="landing_code" name="landing_code" value="{{ $order->landing_code }}">
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select class="form-control" id="status" name="status">
                    <option value="Chờ xác nhận" {{ $order->status == 'Chờ xác nhận' ? 'selected' : '' }}>Đang chờ xử lý</option>
                    <option value="Đã xác nhận" {{ $order->status == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                    <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                    <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                    <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    <option value="Đã nhận hàng" {{ $order->status == 'Đã xác nhận' ? 'selected' : '' }}>Đã nhận hàng</option>
                </select>

                <div class="form-group">
                    <label for="note">Ghi chú</label>
                    <input type="text" class="form-control" id="note" name="note" value="{{ $order->landing_code }}">
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
        </form>
    </div>
@endsection
