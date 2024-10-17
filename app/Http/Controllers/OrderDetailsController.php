<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderDetailsController extends Controller
{
    public function viewOrderDetail($id)
    {
        $orders = DB::table('orders')
            ->join('Orderdetails', 'Orders.id', '=', 'Orderdetails.order_id')
            ->join('Products', 'Orderdetails.product_id', '=', 'Products.id')
            ->select(
                'Orders.id AS order_id',
                'Orders.name AS customer_name',
                'Orders.address',
                'Orders.phone',
                'Orders.email',
                'Orders.order_date',
                'Orders.total',
                'Orders.user_id',
                'Orders.landing_code',
                'Orderdetails.price',
                'Orderdetails.quantity',
                'Products.id AS product_id',
                'Products.product_code',
                'Products.name AS product_name',
                'Products.price AS product_price',
                'Products.quantity AS product_quantity',
                'Products.description',
                'Products.image',
                'Products.category_id',
                'Products.brand_id',
                'orders.status'
            )
            ->where('orders.id',$id)
            ->get();
        $categoryOptions = DB::table('categories')->pluck('name','id');
        $brandOptions = DB::table('brands')->pluck('name','id');
        return view('admin.order-detail',['orders' => $orders, 'categoryOptions' => $categoryOptions, 'brandOptions' => $brandOptions]);
    }


    public function viewCustomerOrders()
    {
        $userId = auth()->id();

        $pendingOrders = $this->getPendingOrders1($userId);
        $canceledOrders = $this->getCanceledOrders1($userId);
        $shippingOrders = $this->getShippingOrders1($userId);
        $completedOrders = $this->getCompletedOrders1($userId);
        $confirmedOrders = $this->getConfirmedOrders1($userId);
        $receivedOrders = $this->getReceivedOrders1($userId);

        return view('customer.view-orders', compact(
            'pendingOrders',
            'canceledOrders',
            'shippingOrders',
            'completedOrders',
            'confirmedOrders',
            'receivedOrders'
        ));
    }

    protected function getPendingOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->whereIn('status', ['Chờ xác nhận', 'Đang giao', 'Đã xác nhận'])
            ->get();
    }

    protected function getCanceledOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Đã hủy')
            ->get();
    }

    protected function getShippingOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Đang giao')
            ->get();
    }

    protected function getCompletedOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Đã giao')
            ->get();
    }

    protected function getConfirmedOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Đã xác nhận')
            ->get();
    }

    protected function getReceivedOrders1($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->where('status', 'Đã nhận hàng')
            ->get();
    }

    public function customerOrderDetail($id)
    {
        $orders = DB::table('orders')
            ->join('Orderdetails', 'Orders.id', '=', 'Orderdetails.order_id')
            ->join('Products', 'Orderdetails.product_id', '=', 'Products.id')
            ->select(
                'Orders.id AS order_id',
                'Orders.name AS customer_name',
                'Orders.address',
                'Orders.phone',
                'Orders.email',
                'Orders.order_date',
                'Orders.total',
                'Orders.user_id',
                'Orders.landing_code',
                'Orderdetails.price',
                'Orderdetails.quantity',
                'Products.id AS product_id',
                'Products.product_code',
                'Products.name AS product_name',
                'Products.price AS product_price',
                'Products.quantity AS product_quantity',
                'Products.description',
                'Products.image',
                'Products.category_id',
                'Products.brand_id',
                'orders.status',
                'orders.note'
            )
            ->where('orders.id',$id)
            ->get();
        $categoryOptions = DB::table('categories')->pluck('name','id');
        $brandOptions = DB::table('brands')->pluck('name','id');
        return view('customer.order-detail',['orders' => $orders, 'categoryOptions' => $categoryOptions, 'brandOptions' => $brandOptions]);
    }

}





