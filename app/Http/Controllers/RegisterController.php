<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                // Hiển thị thông báo lỗi trên trang register
                return redirect()->back()->withErrors(['error' => 'Email đã tồn tại trong hệ thống!']);
            } else {
                // Email chưa tồn tại, tiến hành tạo người dùng mới
                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->phone = $request->input('phone');
                $user->password = Hash::make($request->input('password'));
                $user->address = $request->input('address');
                $user->role = 'customer';
                $user->save();

                return redirect()->route('login')->with('success', 'Người dùng đã được tạo thành công.');
            }
        } catch (Exception $e) {
            // Xử lý ngoại lệ nếu có
            echo 'Đã xảy ra lỗi: ' . $e->getMessage();
        }
    }

}
