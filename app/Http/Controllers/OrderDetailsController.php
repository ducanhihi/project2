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

            )
            ->where('orders.id',$id)
            ->get();
        $categoryOptions = DB::table('categories')->pluck('name','id');
        $brandOptions = DB::table('brands')->pluck('name','id');
        return view('admin.order-detail',['orders' => $orders, 'categoryOptions' => $categoryOptions, 'brandOptions' => $brandOptions]);
    }
}





