<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function viewAdminOrders()
    {
        $pendingOrders = $this->getPendingOrders();
        $canceledOrders = $this->getCanceledOrders();
        $shippingOrders = $this->getShippingOrders();
        $completedOrders = $this->getCompletedOrders();
        $confirmedOrders = $this->getConfirmedOrders();
        $receivedOrders = $this->getReceivedOrders();

        return view('admin.orders', compact(
            'pendingOrders',
            'canceledOrders',
            'shippingOrders',
            'completedOrders',
            'confirmedOrders',
            'receivedOrders',

        ));
    }

    protected function getPendingOrders()
    {
        return DB::table('orders')
            ->whereIn('status', ['Chờ xác nhận'])
            ->get();
    }

    protected function getCanceledOrders()
    {
        return DB::table('orders')
            ->where('status', 'Đã hủy')
            ->get();
    }

    protected function getShippingOrders()
    {
        return DB::table('orders')
            ->where('status', 'Đang giao')
            ->get();
    }

    protected function getCompletedOrders()
    {
        return DB::table('orders')
            ->where('status', 'Đã giao')
            ->get();
    }

    protected function getConfirmedOrders()
    {
        return DB::table('orders')
            ->where('status', 'Đã xác nhận')
            ->get();
    }
    protected function getReceivedOrders()
    {
        return DB::table('orders')
            ->where('status', 'Đã nhận hàng')
            ->get();
    }


    public function getOrderStatusClass($status)
    {
        $classMap = [
            'Chờ xác nhận' => 'btn-warning',
            'Đã xác nhận' => 'btn-primary',
            'Đang giao' => 'btn-info',
            'Đã giao' => 'btn-success',
            'Xác nhận hủy' => 'btn-secondary',
            'Đã hủy' => 'btn-danger',
            'Đã nhận hàng' => 'btn-purple' // tạo class CSS btn-purple
        ];

        return $classMap[$status] ?? 'btn-default';
    }



    public function buyNow(Request $request, $product_id)
    {
        $product = DB::table('products')
            ->select('products.*')
            ->where('products.id', $product_id)
            ->first();

        $quantity = $request->input('quantity', 1);
        // Xử lý logic mua hàng tại đây

        return view('customer.buy-now', ['product' => $product, 'quantity' => $quantity]);
    }


    public function buySave(Request $request, $product_id)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $address = $request->get('address');
        $quantity = $request->input('quantity', 1);
        $payment = $request->input('payment');

        $user_id = auth()->user()->id;

        // Tạo đơn hàng mới
        $orderId = DB::table('orders')->insertGetId([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'order_date' => now(),
            'user_id' => $user_id,
            'payment' => $payment,
            'total' => 0, // Đặt tổng giá trị đơn hàng là 0 trước
        ]);

        $product = DB::table('products')
            ->select('products.*')
            ->where('products.id', $product_id)
            ->first();
        $totalAmount = $product->price * $quantity;

        // Cập nhật tổng giá trị đơn hàng
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['total' => $totalAmount]);

        DB::table('orderdetails')->insert([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price
        ]);
        $product = DB::table('products')
            ->select('products.*')
            ->where('products.id', $product_id)
            ->first();
        DB::table('products')
            ->where('id', $product->id)
            ->update(['quantity' => $product->quantity - $quantity]);


        // Xử lý logic mua hàng tại đây
        return view('customer.buy-now', ['product' => $product, 'quantity' => $quantity]);
    }







    public function newOrder(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');
        $address = $request->get('address');
        $payment = $request->get('payment');
        $user_id = auth()->user()->id;
        $selectedProductIds = explode(',', $request->input('selected_products'));

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
            'total' => $totalAmount,
            'payment' => $payment
        ]);

        // Lưu chi tiết đơn hàng
        $cart = DB::table('carts')
            ->where('user_id', auth()->id())
            ->first();

        if ($cart) {
            $cartDetails = DB::table('cartdetails')
                ->leftJoin('products', 'cartdetails.product_id', '=', 'products.id')
                ->whereIn('cartdetails.product_id', $selectedProductIds)
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

            // Cập nhật số lượng trong kho
            foreach ($cartDetails as $cartDetail) {
                $product = DB::table('products')
                    ->where('id', $cartDetail->product_id)
                    ->first();
                $newQuantity = $product->quantity - $cartDetail->quantity;
                DB::table('products')
                    ->where('id', $cartDetail->product_id)
                    ->update(['quantity' => $newQuantity]);
            }

            // Xóa giỏ hàng
            DB::table('cartdetails')
                ->whereIn('product_id', $selectedProductIds)
                ->where('cart_id', $cart->id)
                ->delete();
            flasher('Đặt hàng thành công');
            return redirect()->route('customer.home');
        }
    }



    public function acceptOrder($id)
    {
        $order = Order::find($id);
        if ($order->status == 'Chờ xác nhận') {
            $order->status = 'Đã xác nhận';
            $order->save();
            return redirect()->back()->with('success', 'Đã xác nhận đơn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể xác nhận đơn hàng này!');
        }
    }

    public function cancelOrder(Request $request , $id)
    {
        $order = Order::find($id);

        if ($order->status == 'Chờ xác nhận' || $order->status == 'Đã xác nhận') {
            $orderDetails = $order->orderDetails;
            foreach ($orderDetails as $orderDetail) {
                $product = Product::find($orderDetail->product_id);
                $product->quantity += $orderDetail->quantity;
                $product->save();
            }

            $order->status = 'Đã hủy';
            $order->note = 'Khách hàng: ' . $request->input('note');
            $order->save();

            return redirect()->back()->with('success', 'Đã hủy đơn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này!');
        }
    }




    public function updateOrder($order_id)
    {
        $order = DB::table('orders')
            ->where('id', $order_id)
            ->first();

        return view('admin.update-order', ['order' => $order, 'order_id' => $order_id]);
    }



    public function updateSave(Request $request, $order_id)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $status = $request->input('status');
        $landing_code = $request->input('landing_code');
        $note = $request->input('note');
        // Cập nhật đơn hàng
        DB::table('orders')
            ->where('id', $order_id)
            ->update([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'status' => $status,
                'landing_code' => $landing_code,
                'note' => $note,
            ]);

        return redirect()->route('admin.orders')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    public function buyInCart(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart;
        $allBrands = Brand::pluck('name', 'id')->toArray();

        $selectedProductIds = explode(',', $request->input('selected_products'));

        // Kiểm tra nếu không có sản phẩm nào được chọn
        if (empty($selectedProductIds[0])) {
            // Chuyển hướng về trang giỏ hàng với thông báo lỗi
            return redirect()->route('customer.cart')->with('error', 'Bạn chưa chọn sản phẩm nào!');
        }

        $selectedCartDetails = $cart->cartDetails()->whereIn('product_id', $selectedProductIds)->with('product')->get();
        $totalAmount = 0;
        $hasInvalidQuantity = false;
        foreach ($selectedCartDetails as $cartDetail) {
            $quantity = $cartDetail->quantity;
            if ($quantity > $cartDetail->product->quantity) {
                $hasInvalidQuantity = true;
                break;
            }
            $totalAmount += $quantity * $cartDetail->product->price;
        }

        if ($hasInvalidQuantity) {
            // Chuyển hướng về trang giỏ hàng với thông báo lỗi
            return redirect()->route('customer.cart')
                ->with('error', 'Số lượng sản phẩm chỉ còn ' . $cartDetail->product->quantity . ' sản phẩm.');

        }

        return view('customer.buy-inCart', compact('selectedCartDetails',
            'totalAmount',
            'selectedProductIds',
            'allBrands'));
    }


    public function cancelOrder2(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order->status == 'Chờ xác nhận' || $order->status == 'Đã xác nhận') {
            $orderDetails = $order->orderDetails;
            foreach ($orderDetails as $orderDetail) {
                $product = Product::find($orderDetail->product_id);
                $product->quantity += $orderDetail->quantity;
                $product->save();
            }

            $order->status = 'Đã hủy';
            $order->note = 'Khách hàng: ' . $request->input('note');
            $order->save();

            return redirect()->back()->with('success', 'Đã hủy đơn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể hủy đơn hàng này!');
        }
    }


    public function doneOrder($id)
    {
        $order = Order::find($id);

        if ($order->status == 'Đang giao' || $order->status == 'Đã giao') {
            $order->status = 'Đã nhận hàng';
            $order->save();
            return redirect()->back()->with('success', 'Đã nhận đơn hàng thành công!');
        } else {
            return redirect()->back()->with('error', 'Không nhận đơn hàng này!');
        }
    }

}
