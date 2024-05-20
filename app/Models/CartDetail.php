<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cartdetails'; // Tên bảng trong CSDL

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = ['id', 'cart_id', 'product_id', 'quantity']; // Các trường có thể được gán dữ liệu

}
///ddd
