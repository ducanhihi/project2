<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function viewAdminUsers() {
        $allUsers = DB::table("users")->get();
        return view('admin.users', ['allUsers' => $allUsers]);
    }
}
