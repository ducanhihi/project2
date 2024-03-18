<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ProductsController extends Controller
{
    function viewAdminProducts() {
        $allProducts = DB::table('products')
            ->select(['isbn_code', 'name', 'price'])
            ->get();
        return view('admin.products', ['allProducts' => $allProducts]);

    }

}
