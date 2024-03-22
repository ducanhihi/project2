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

    public function createCategory(Request $request) {
        $name = $request->get('name');
        //tao products -> chuyen huong ve home
        DB::table('categories')->insert([
            'name' => $name,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        flash() -> addSuccess('Add category succesfully!');
        return redirect()->back();
    }
    public function deleteCategoryById($id){
        DB::table('categories') -> delete($id);
        return redirect() -> back();
    }


    public function editCategoryById ($id, Request $request) {
        // Bước 1: kiểm tra xem bài viết có tồn tại hay không
        $category = DB::table('categories') -> find($id);
        if ($category == null) {
            return redirect('/admin/products');
        }
        //buowc2 capnhat thong tin
        $name = $request->get('name');
        // buoc 3: cap nhat
        $category = DB::table('categories')->where('id', '=', $id) -> update(
            [
                'name' => $name,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]
        );
        //bước 4L thông báo -> chuyen hương ve home
        if ($category == 0) {
            //cap nhat that bai
            flash() -> addError('Cap nhat that bai');
        } else {
            flash() -> addSuccess('Cap nhat thanh cong');
        }
        return redirect()->back();
    }
}
