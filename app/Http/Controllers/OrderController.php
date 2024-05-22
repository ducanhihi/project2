<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function buyNow(Request $request, $product_id)
    {
        $product = DB::table('products')
            ->select('products.*')
            ->where('products.id', $product_id)
            ->first();

        // Xử lý logic mua hàng tại đây
        return view('customer.buy-now', ['product' => $product]);
    }

    public function buySave(Request $request, $product_id)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $address = $request->get('address');
        $landing_code = substr(md5(uniqid()), 0, 10);

        $user_id = auth()->user()->id;

// Tạo đơn hàng mới
        $orderId = DB::table('orders')->insertGetId([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'order_date' => now(),
            'user_id' => $user_id,
            'landing_code' => $landing_code,
            'total' => 0, // Đặt tổng giá trị đơn hàng là 0 trước
        ]);

        $product = DB::table('products')
            ->select('products.*')
            ->where('products.id', $product_id)
            ->first();

        $totalAmount = $product->price;

// Cập nhật tổng giá trị đơn hàng
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['total' => $totalAmount]);

        DB::table('orderdetails')->insert([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'quantity' => 1, // Bạn có thể lấy số lượng từ request nếu cần
            'price' => $product->price
        ]);

// Xử lý logic mua hàng tại đây
        return view('customer.buy-now', ['product' => $product]);
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
        $order = DB::table('orders')->insertGetId([
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
            DB::table('cartdetails')->where('cart_id', $cart->id)->delete();

            return redirect()->route('customer.home');
        }

    }

    public function chooseBuyOne(Request $request) {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $address = $request->get('address');
        $landing_code = substr(md5(uniqid()), 0, 10);

        $user_id = auth()->user()->id;

        $allProducts = DB::table('products')
            ->select(['id','product_code', 'name', 'price','quantity','description','image','category_id','brand_id','created_at', 'updated_at'])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        // Lấy danh sách các cặp category_id và category_name từ $allProducts
        $categoryOptions = DB::table('categories')->pluck('name','id');
        $brandOptions = DB::table('brands')->pluck('name','id');

        $totalAmount = 0;
        foreach ($allProducts as $product) {
            $totalAmount += $product->quantity * $product->price;
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
        }

    }
}
