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
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
        $user->role = 'customer';
        $user->save();
        return redirect() ->route('login');

        // Redirect to a success page
//        return redirect()->route('registration.success');
    }

}
