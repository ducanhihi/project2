<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function viewAdminCategories() {
        $allCategories = DB::table('categories')
            ->select(['id', 'name','created_at', 'updated_at' ])
            ->get();
        return view('admin.categories', ['allCategories' => $allCategories]);
    }
}
