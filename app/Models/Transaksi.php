<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'costumer_name',
        'costumer_phone',
        'invoice',
        'total_price'
    ];

    public function detailTransaksi(){
        return $this->hasMany(DetailTransaksi::class);
    }

    public function cek_produk($name)
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
             ->where('name',$name)
             ->get()
             ->first();
    }

    public function allData()
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
             ->get();
    }
}
