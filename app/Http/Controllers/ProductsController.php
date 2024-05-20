<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ProductsController extends Controller
{
    function viewAdminProducts() {
        $allProducts = DB::table('products')
            ->select(['id','product_code', 'name', 'price','quantity','description','image','category_id','brand_id','created_at', 'updated_at'])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        // Lấy danh sách các cặp category_id và category_name từ $allProducts
        $categoryOptions = DB::table('categories')->pluck('name','id');
        $brandOptions = DB::table('brands')->pluck('name','id');
        return view('admin.products', ['allProducts' => $allProducts, 'categoryOptions' => $categoryOptions, 'brandOptions' => $brandOptions]);
    }

    public function showProducts()
    {
        $allProducts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        $allCategories = DB::table('categories')->select('name')->get(); // Lấy danh sách tên category
        return view('customer.home', ['allProducts' => $allProducts, 'allCategories' => $allCategories]);// Trả về view 'products' với biến 'products' chứa danh sách sản phẩm

    }
    public function viewDetailProduct($id)
    {
        $product = DB::table('products')
            ->select('products.id', 'products.product_code', 'products.name', 'products.price', 'products.quantity', 'products.description', 'products.image', 'products.category_id', 'products.brand_id', 'products.created_at', 'products.updated_at', 'categories.name as category_name', 'brands.name as brand_name')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.id', $id)
            ->first();

        if ($product) {
            $categoryOptions = DB::table('categories')->pluck('name', 'id');
            $brandOptions = DB::table('brands')->pluck('name', 'id');
            return view('customer.view-detail', ['product' => $product, 'categoryOptions' => $categoryOptions, 'brandOptions' => $brandOptions]);
        } else {
            return "Product not found";
        }
    }
    public function createProduct(Request $request) {
        $product_code = $request->get('product_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $description = $request->get('description');
        $image = "";
        if ($request->image != null) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path("image"), $image);
        }
        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');
        //tao products -> chuyen huong ve home
        DB::table('products')->insert([
            'product_code' => $product_code,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description,
            'image' => $image,
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        flash() -> addSuccess('Add product succesfully!');
        return redirect()->back();
    }
    public function deleteProductById($id){
        DB::table('products') -> delete($id);
        return redirect() -> back();
    }


    public function editProductById ($id, Request $request) {
        // Bước 1: kiểm tra xem bài viết có tồn tại hay không
        $product = DB::table('products') -> find($id);
        if ($product == null) {
            return redirect('/admin/products');
        }
        //buowc2 capnhat thong tin
        $product_code = $request->get('product_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $description = $request->get('description');
        $image = $product->image; // Giữ nguyên tên ảnh hiện tại mặc định
        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path("image"), $image);
        }
        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');
        // buoc 3: cap nhat
        $productsRS = DB::table('products')->where('id', '=', $id) -> update(
            [
                'product_code' => $product_code,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'description' => $description,
                'image' => $image,
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
