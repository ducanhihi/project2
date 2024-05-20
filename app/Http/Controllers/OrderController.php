<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function viewOrder()
    {
        return view('customer.order-detail');
    }


    public function newOrder(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $address = $request->get('address');
        $landing_code = substr(md5(uniqid()), 0, 10);

        $user_id = auth()->user()->id;

        $cart = DB::table('carts')
            ->where('user_id', auth()->id())
            ->first();

        if ($cart) {
            $cartDetails = DB::table('cartdetails')
                ->leftJoin('products', 'cartdetails.product_id', '=', 'products.id')
                ->where('cartdetails.cart_id', $cart->id)
                ->select('cartdetails.*', 'products.price')
                ->get();

            $totalAmount = 0;
            foreach ($cartDetails as $cartDetail) {
                $totalAmount += $cartDetail->quantity * $cartDetail->price;
            }
        }

        // Tạo đơn hàng mới
        $order = DB::table('orders')->insert([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'order_date' => now(),
            'user_id' => $user_id,
            'landing_code' => $landing_code,
            'total' => $totalAmount,
        ]);

        // Tiếp tục xử lý dữ liệu


        // Lưu chi tiết đơn hàng
        $cart = DB::table('carts')
            ->where('user_id', auth()->id())
            ->first();

        if ($cart) {
            $cartDetails = DB::table('cartdetails')
                ->leftJoin('products', 'cartdetails.product_id', '=', 'products.id')
                ->where('cartdetails.cart_id', $cart->id)
                ->select('cartdetails.*', 'products.price')
                ->get();

            foreach ($cartDetails as $cartDetail) {
                DB::table('orderdetails')->insert([
                    'order_id' => $order,
                    'product_id' => $cartDetail->product_id,
                    'quantity' => $cartDetail->quantity,
                    'price' => $cartDetail->price
                ]);
            }


            // Xóa giỏ hàng
            DB::table('carts')->where('user_id', $user_id)->delete();
            DB::table('cartdetails')->where('cart_id', $cart->id)->delete();

            return redirect()->route('customer.home');
        }

    }
}
