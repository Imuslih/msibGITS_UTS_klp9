<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'purchase_price',
        'selling_price',
        'stock',
        'category_id',
        'image'
    ];

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }
}
