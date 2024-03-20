<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function viewAdminBrands() {
        $allBrands = DB::table('brands')
            ->select(['id', 'name','created_at', 'updated_at' ])
            ->get();
        return view('admin.brands', ['allBrands' => $allBrands]);
    }
}
