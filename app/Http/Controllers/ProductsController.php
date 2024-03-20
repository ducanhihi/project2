<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ProductsController extends Controller
{
    function viewAdminProducts() {
        $allProducts = DB::table('products')
            ->select(['id','isbn_code', 'name', 'price','quantity','category_id','brand_id','created_at', 'updated_at'])
            ->get();
        return view('admin.products', ['allProducts' => $allProducts]);
    }
    public function createProducts(Request $request) {
        $isbn_code = $request->get('isbn_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');
        //tao products -> chuyen huong ve home
        DB::table('products')->insert([
            'isbn_code' => $isbn_code,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        flash() -> addSuccess('Add product succesfully!');
        return redirect()->back();
    }
    public function deleteProductsById($id){
        DB::table('products') -> delete($id);
        return redirect() -> back();
    }


    public function editProductsById ($id, Request $request) {
        // Bước 1: kiểm tra xem bài viết có tồn tại hay không
        $products = DB::table('products') -> find($id);
        if ($products == null) {
            return redirect('//admin/products');
        }
        //buowc2 capnhat thong tin
        $isbn_code = $request->get('isbn_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');
        // buoc 3: cap nhat
        $productsRS = DB::table('products')->where('id', '=', $id) -> update(
            [
                'isbn_code' => $isbn_code,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]
        );
        //bước 4L thông báo -> chuyen hương ve home
        if ($productsRS == 0) {
            //cap nhat that bai
            flash() -> addError('Cap nhat that bai');
        } else {
            flash() -> addSuccess('Cap nhat thanh cong');
        }
        return redirect()->route('admin.products');
    }
}
