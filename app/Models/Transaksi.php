<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
