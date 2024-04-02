<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // Tên bảng trong CSDL

    protected $fillable = ['isbn_code', 'name', 'quantity','image', 'price', 'description','category_id', 'brand_id']; // Các trường có thể được gán dữ liệu
}
