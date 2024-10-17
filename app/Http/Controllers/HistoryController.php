<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function viewOrderHistory()
    {
        $user = Auth::user();
        $orders = $user->orders;
        return view('customer.view-order-history', compact('orders'));
    }

    public function showDetailHistory($orderId)
    {
        $user = Auth::user();
        $order = $user->orders()->where('id', $orderId)->with('orderDetails.product')->first();
        if ($order) {
            $orderDetails = $order->orderDetails;
            return view('customer.showDetailHistory', compact('orderDetails'));
        } else {
            // Xử lý trường hợp không tìm thấy đơn hàng
            return redirect()->route('customer.view-order-history')->with('error', 'Không tìm thấy đơn hàng!');
        }
    }
}
//lich su do hag
