<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    public function viewCart()
    {
//        $cart = Cart::with('cartDetails.product')->where('user_id', auth()->id())->first();
//        $total = $cart ? $cart->total : 0;
//
        return view('customer.cart');
    }

}
