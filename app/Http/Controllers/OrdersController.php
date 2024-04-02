<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function viewAdminOrders() {
        $allOrders = DB::table('orders')->get();
        return view('admin.orders', ['allOrders' => $allOrders]);
    }
}
