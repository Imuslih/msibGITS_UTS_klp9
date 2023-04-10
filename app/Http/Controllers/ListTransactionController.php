<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListTransactionController extends Controller
{

    public function index()
    {
      $data = array(
      'menu' => 'list_transaction',
			'sub_menu' => '',
			'title' => 'Halaman Riwayat Transaksi',
			'judul' => 'Riwayat Transaksi',
			'sub_judul' => '',
      
      );
      return view('list_transaction.index',$data);
    }


   

}
