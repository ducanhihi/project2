<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ProductsController extends Controller
{
    function viewAdminProducts() {
        $allProducts = DB::table('products')
            ->select(['id','product_code', 'name', 'price','quantity','category_id','brand_id','created_at', 'updated_at','image'])
            ->get();
        return view('admin.products', ['allProducts' => $allProducts]);
    }
    public function createProduct(Request $request) {
        $productCode = $request->get('product_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $categoryId = $request->get('category_id');
        $image = $request->get('image');
        $brandId = $request->get('brand_id');
        //tao products -> chuyen huong ve home
        DB::table('products')->insert([
            'product_code' => $productCode,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'category_id' => $categoryId,
            'image' => $image,
            'brand_id' => $brandId,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        flash() -> addSuccess('Add product succesfully!');
        return redirect()->back();
    }
    public function deleteProductById($id){
        DB::table('products') -> delete($id);
        if ($id == 0) {
            //cap nhat that bai
            flash() -> addError('Delete failed!');
        } else {
            flash() -> addSuccess('Delete successfully!');
        }
        return redirect() -> back();
    }


    public function editProductById ($id, Request $request) {
        // Bước 1: kiểm tra xem bài viết có tồn tại hay không
        $products = DB::table('products') -> find($id);
        if ($products == null) {
            return redirect('/admin/products');
        }
        //buowc2 capnhat thong tin
        $productCode = $request->get('product_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $categoryId = $request->get('category_id');
        $image = $request->get('image');

        $brandId = $request->get('brand_id');
        // buoc 3: cap nhat
        $productsRS = DB::table('products')->where('id', '=', $id) -> update(
            [
                'product_code' => $productCode,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'category_id' => $categoryId,
                'image' => $image,

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
