<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    public function viewRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request) {
        try {
            $existingUser = User::where('email', $request->input('email'))->first();
            if ($existingUser) {
                // Email đã tồn tại trong cơ sở dữ liệu
                sweetalert()->addWarning('Email đã tồn tại');
                // Hiển thị thông báo lỗi trên trang register
                return redirect()->back();
            } else {
                // Email chưa tồn tại, tiến hành tạo người dùng mới
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->address = $request->input('address');
                $user->password = Hash::make($request->input('password'));
                $user->email_verified_at = now();
                $user->role = 'customer';
                $user->remember_token = Str::random(10); // Tạo remember_token ngẫu nhiên
                $user->DOB = $request->input('DOB', '2000-01-01');

                // Cập nhật thời gian tạo và cập nhật
                $user->created_at = now();
                $user->updated_at = now();
                $user->save();

                // Tạo record mới trong bảng carts
                $cart = $user->cart()->create();

                flash() -> addSuccess('Đăng ký thành công');
                return redirect()->route('login');
            }
        } catch (Exception $e) {
            // Xử lý ngoại lệ nếu có
            echo 'Đã xảy ra lỗi: ' . $e->getMessage();
        }
    }

}
