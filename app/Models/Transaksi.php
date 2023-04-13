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
        'customer_name',
        'customer_phone',
        'invoice',
        'total_price',
        'payment',
        'change'
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
             ->where('stock','>',0)
             ->get();
    }

    public function allDataTransaksis()
    {
        return DB::table('transaksis')
             ->join('users', 'users.id','=','transaksis.user_id')
             ->select(
                'transaksis.id',
                'name',
                'customer_name',
                'customer_phone',
                'invoice',
                'total_price',
                'payment',
                'change',
               )
             ->get();
    }

    public function alldetailTransaksis($id)
    {
        return DB::table('transaksis')
             ->join('detail_transaksis', 'detail_transaksis.transaksi_id','=','transaksis.id')
             ->join('products', 'detail_transaksis.product_id','=','products.id')
             ->select(
                'customer_name',
                'customer_phone',
                'invoice',
                'total_price',
                'payment',
                'change',
                'product_code',
                'name',
                'qty',
                'price',
               )
             ->where('transaksi_id', $id)
             ->get();
    }

    
    public function payment($id)
    {
        return DB::table('detail_transaksis')
             ->join('transaksis', 'transaksis.id','=','detail_transaksis.transaksi_id')
             ->select(
                'customer_name',
                'customer_phone',
                'invoice',
                'total_price',
                'payment',
                'change',
                'transaksis.id',
               )
             ->where('transaksi_id', $id)
             ->get()
             ->first();
    }


    public function allData2()
    {
        return DB::table('products')
             ->join('categories', 'categories.id','=','products.category_id')
             ->get();
    }

    public function inVoice()
    {
        $no_urut = 0;
        $query = DB::table('transaksis')
            ->select('id')
            ->get();
            
        // $no = $query;
       
        foreach($query as $no){
            $no_urut = $no->id;
        }
        if($no_urut == null){
            $no_urut = 1;
        } else {
            $no_urut = $no_urut+1;
        }
        $invoice = str('gits-').$no_urut;
        return $invoice;
    }

    public function PendapatanHariIni()
    {
        return DB::table('transaksis')
            ->whereDate('transaksis.created_at',date('y-m-d'))
            ->sum('transaksis.total_price');
 
    }

    public function PendapatanBulanIni()
    {
        return DB::table('transaksis')
            ->whereMonth('transaksis.created_at',date('m'))
            ->whereYear('transaksis.created_at',date('Y'))
            ->sum('transaksis.total_price');
           
 
    }


    public function PendapatanTahunIni()
    {
        return DB::table('transaksis')
            ->whereYear('transaksis.created_at',date('Y'))
            ->sum('transaksis.total_price');
 
    }
}
