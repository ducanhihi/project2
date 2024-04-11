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
        $allProducts = DB::table('products') // Lấy danh sách sản phẩm từ cơ sở dữ liệu bằng model Product
        ->select(['id','product_code', 'name', 'price','quantity','description','image','category_id','brand_id','created_at', 'updated_at'])
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
        ->get();
        return view('customer.home', ['allProducts' => $allProducts]); // Trả về view 'products' với biến 'products' chứa danh sách sản phẩm

    }
    public function viewDetailProduct()
    {
        $allProducts = DB::table('products') // Lấy danh sách sản phẩm từ cơ sở dữ liệu bằng model Product
        ->select(['id','product_code', 'name', 'price','quantity','description','image','category_id','brand_id','created_at', 'updated_at'])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();
        return view('customer.view-detail', ['allProducts' => $allProducts]); // Trả về view 'products' với biến 'products' chứa danh sách sản phẩm

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
        $product = DB::table('products')->find($id);
        $imageToDelete = $product->image;
        DB::table('products') -> delete($id);

        $imagePath = public_path("image") . '/' . $imageToDelete;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
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
//        $image = $product->image; // Giữ nguyên tên ảnh hiện tại mặc định
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ từ thư mục public/image
            $oldImagePath = public_path("image") . '/' . $product->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Lưu ảnh mới vào thư mục public
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path("image"), $image);

            // Cập nhật trường image trong cơ sở dữ liệu với tên ảnh mới
            // ...
        } else {
            // Tiếp tục sử dụng ảnh cũ mà bạn đã giữ nguyên từ bước trước
            $image = $product->image;
            // ...
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
