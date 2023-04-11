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
            ->select(
            'products.id as id_product',
            'product_code',
            'name',
            'category_name',
            'purchase_price',
            'selling_price',
            'stock',
            'image',)
             ->where('name',$name)
             ->get()
             ->first();
    }

    public function allData()
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
             ->select(
                'products.id as id_product',
                'product_code',
                'name',
                'category_name',
                'purchase_price',
                'selling_price',
                'stock',
                'image',)
             ->get();
    }

    public function allData2()
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
             ->get();
    }

    public function inVoice()
    {
        $kode_transaksi = "gits-";
        // $query = \DB::table('transaksis')
        //         ->select(\DB::raw('max(RIGHT(invoice,4)) as no_urut'));

        $query = DB::table('transaksis')
            ->select('id')
            ->get();
        // $no = $query->id;
        foreach($query as $no){
            $no_urut = $no->id;
        }
        if($no_urut == null){
            $no_urut=1;
        } else {
            $no_urut = $no_urut+1;
        }
        $invoice = str(date("mHis")).$no_urut;
        return $invoice;
        }
}
