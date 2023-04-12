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

  public function __construct()
  {
    $this->Transaksi = new Transaksi();
  }

  public function index()
  {
    $data1 = array(
      'menu' => 'list_transaction',
      'sub_menu' => '',
      'title' => 'Halaman Riwayat Transaksi',
      'judul' => 'Riwayat Transaksi',
      'sub_judul' => '',
      'data_listtransaction' => $this->Transaksi->allDataTransaksis(),

      );
    return view('list_transaction.index',$data1);
  }

  public function detail($id){
    $data = array(
      'menu' => 'list_transaction',
      'sub_menu' => '',
      'title' => 'Halaman Detail Transaksi',
      'judul' => 'Detail Transaksi',
      'sub_judul' => '',
      );
    $data2['details'] = $this->Transaksi->alldetailTransaksis($id);

      // dd($data);

    return view('list_transaction.list_detail', $data, $data2);
  }


   

}
