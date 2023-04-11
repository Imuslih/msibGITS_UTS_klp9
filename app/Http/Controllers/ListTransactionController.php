<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaksi;

class ListTransactionController extends Controller
{

    public function index()
    {
      $data1 = array(
        'menu' => 'list_transaction',
        'sub_menu' => '',
        'title' => 'Halaman Riwayat Transaksi',
        'judul' => 'Riwayat Transaksi',
        'sub_judul' => ''
  
        );
      $data_listtransaction=Transaksi::all();
      //return $data_listtransaction; 
      return view('list_transaction.index',['data'=>$data_listtransaction],$data1);
    }


   

}
