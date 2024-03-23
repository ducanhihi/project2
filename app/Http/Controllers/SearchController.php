<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchByName(Request $request) {
        $kw = $request->input('keyword');

        if ($kw) {
            $products = DB::table('products')->where('name', 'like', '%'.$kw.'%')->get();
        } else {
            $products = DB::table('products')->get();
        }

        return view('admin/products', ['allProducts' => $products]);
    }


}
