<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;

class ProductsController extends Controller
{
    function viewAdminProducts()
    {
        $allProducts = DB::table('products')
            ->select(['id', 'product_code', 'name', 'price', 'quantity', 'description', 'image', 'category_id', 'brand_id', 'created_at', 'updated_at'])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->get();

        // Lấy danh sách các cặp category_id và category_name từ $allProducts
        $categoryOptions = DB::table('categories')->pluck('name', 'id');
        $brandOptions = DB::table('brands')->pluck('name', 'id');
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
        $product = Product::with('images', 'category', 'brand')->findOrFail($id);
        $images = Image::where('product_id', $product->id)->get();
        $categoryOptions = Category::pluck('name', 'id');
        $brandOptions = Brand::pluck('name', 'id');
        return view('customer.view-detail', [
            'product' => $product,
            'categoryOptions' => $categoryOptions,
            'brandOptions' => $brandOptions,
            'images' => $images
        ]);
    }
    public function viewCreateProduct()
    {

        // Lấy danh sách các cặp category_id và category_name từ $allProducts
        $categoryOptions = DB::table('categories')->pluck('name', 'id');
        $brandOptions = DB::table('brands')->pluck('name', 'id');

        return view('admin.create-product', compact('categoryOptions', 'brandOptions'));
    }

    public function createProduct(Request $request)
    {
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
        $productId = DB::table('products')->insertGetId([
            'product_code' => $product_code,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description,
            'image' => $image,
            'category_id' => $categoryId,
            'brand_id' => $brandId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Xử lý ảnh phụ
        $images = $request->file('images');
        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('image'), $imageName);

            DB::table('images')->insert([
                'url' => $imageName,
                'product_id' => $productId,
            ]);
        }
        flash()->addSuccess('Add product succesfully!');
        return redirect()->route('admin.products');
    }

    public function deleteProductById($id)
    {
        $product = Product::findOrFail($id);
        $product->images()->delete();
        $product->delete();

        return redirect()->back();
    }

    function viewEditProduct($id)
    {
        $product = Product::findOrFail($id);


        // Lấy danh sách các cặp category_id và category_name từ $allProducts
        $categoryOptions = DB::table('categories')->pluck('name', 'id');
        $brandOptions = DB::table('brands')->pluck('name', 'id');

        return view('admin.edit-product', compact('product', 'categoryOptions', 'brandOptions'));

    }

    public function editProductById($id, Request $request)
    {
        // Bước 1: kiểm tra xem sản phẩm có tồn tại hay không
        $product = DB::table('products')->find($id);
        if ($product == null) {
            return redirect('/admin/products');
        }

        // Bước 2: cập nhật thông tin
        $product_code = $request->get('product_code');
        $name = $request->get('name');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $description = $request->get('description');

        // Cập nhật ảnh chính của sản phẩm
        $image = $product->image; // Giữ nguyên tên ảnh hiện tại mặc định
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ trước khi cập nhật
            $oldImagePath = public_path('image') . '/' . $product->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Lưu ảnh mới
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path("image"), $image);
        }

        $categoryId = $request->get('category_id');
        $brandId = $request->get('brand_id');

        // Bước 3: cập nhật thông tin sản phẩm
        $productsRS = DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'product_code' => $product_code,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'description' => $description,
                'image' => $image,
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'updated_at' => now(),
            ]);

        // Cập nhật ảnh phụ
        $images = $request->file('images');
        if ($images) {
            // Xóa ảnh phụ cũ trước khi cập nhật
            DB::table('images')->where('product_id', $id)->delete();

            // Lưu ảnh phụ mới
            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('image'), $imageName);

                DB::table('images')->insert([
                    'url' => $imageName,
                    'product_id' => $id,
                ]);
            }
        }

        // Bước 4: thông báo và chuyển hướng
        if ($productsRS == 0) {
            flash()->addError('Cập nhật thất bại');
        } else {
            flash()->addSuccess('Cập nhật thành công');
        }
        return redirect()->route('admin.products');
    }
    public function getDashboardData()
    {
        $todaySales = Order::where('order_date', '>=', today())
            ->where('status', '!=', 'Đã hủy')
            ->count();

        $currentMonthSales = Order::whereMonth('order_date', date('m'))
            ->whereYear('order_date', date('Y'))
            ->where('status', '!=', 'Đã hủy')
            ->sum('total');

        $previousMonthSales = Order::whereMonth('order_date', date('m', strtotime('-1 month')))
            ->whereYear('order_date', date('Y', strtotime('-1 month')))
            ->where('status', '!=', 'Đã hủy')
            ->sum('total');

        $yesterdaySales = Order::where('order_date', '>=', today()->subDay(1))
            ->where('order_date', '<', today())
            ->where('status', '!=', 'Đã hủy')
            ->count();

        $salesPercentageChange = $previousMonthSales > 0 ? round(($currentMonthSales - $previousMonthSales) / $previousMonthSales * 100, 2) : 0;

        $salesChangeCount = $todaySales - $yesterdaySales;

        $salesChangePercentage = $yesterdaySales > 0 ? round(($salesChangeCount) / $yesterdaySales * 100, 2) : 0;

        $currentYearCustomers = User::whereYear('created_at', date('Y'))->count();
        $previousYearCustomers = User::whereYear('created_at', date('Y') - 1)->count();
        $twoPreviousYearCustomers = User::whereYear('created_at', date('Y') - 2)->count();

        $customerChangePercentage = $previousYearCustomers > 0 ? round(($currentYearCustomers - $previousYearCustomers) / $previousYearCustomers * 100, 2) : 0;
        $customerTwoYearChangePercentage = $twoPreviousYearCustomers > 0 ? round(($currentYearCustomers - $twoPreviousYearCustomers) / $twoPreviousYearCustomers * 100, 2) : 0;

        $recentOrders = Order::orderBy('order_date', 'desc')
            ->limit(5)
            ->get();


        $allProducts = DB::table('products')
            ->joinSub(
                DB::table('orderdetails')
                    ->join('orders', 'orderdetails.order_id', '=', 'orders.id')
                    ->whereMonth('orders.order_date', date('m'))
                    ->whereYear('orders.order_date', date('Y'))
                    ->where('orders.status', '!=', 'Đã hủy')
                    ->selectRaw('product_id, SUM(orderdetails.quantity) as total_sold, SUM(orderdetails.quantity * orderdetails.price) as total_revenue')
                    ->groupBy('product_id'),
                'order_totals',
                'products.id', '=', 'order_totals.product_id'
            )
            ->selectRaw('products.id, products.name, products.image, products.price, order_totals.total_sold, order_totals.total_revenue')
            ->where('order_totals.total_sold', '>', 0)
            ->orderByDesc('order_totals.total_sold')
            ->limit(5)
            ->get();


        $trafficData = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
            ->join('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->selectRaw('categories.name, COUNT(orderdetails.id) as value')
            ->where('orders.status', '!=', 'Đã hủy')
            ->groupBy('categories.name')
            ->orderByDesc('value')
            ->limit(5)
            ->get();




        return [
            'todaySales' => $todaySales,
            'monthSales' => $currentMonthSales,
            'salesPercentageChange' => $salesPercentageChange,
            'salesChangeCount' => $salesChangeCount,
            'salesChangePercentage' => $salesChangePercentage,
            'yesterdaySales' => $yesterdaySales,
            'currentYearCustomers' => $currentYearCustomers,
            'customerChangePercentage' => $customerChangePercentage,
            'customerTwoYearChangePercentage' => $customerTwoYearChangePercentage,
            'recentOrders' => $recentOrders,
            'allProducts' => $allProducts,
            'trafficData' => $trafficData
        ];

    }










}
