<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'detailTransaksi_id'.
        'invoice',
        'total_price'
    ];

    public function detailTransaksi(){
        return $this->belongsTo(DetailTransaksi::class);
    }
}
