<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    use HasFactory;
    protected $table = 'carts'; // Tên bảng trong CSDL

    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }

        protected $fillable = ['id', 'user_id']; // Các trường có thể được gán dữ liệu
}
