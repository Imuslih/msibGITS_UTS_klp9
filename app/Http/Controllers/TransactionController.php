<?php
 
namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
 
use Illuminate\Http\Request;

 
class TransactionController extends Controller
{

  public function __construct()
  {
    $this->Transaksi = new Transaksi();
  }

  public function index()
  {
    $data = array(
      'title' => 'Halaman Kasir',
      'products' => $this->Transaksi->allData()
    );
    return view('transaction.index',$data);
  }

  public function CekProduk(Request $request)
  {
    $product_code = $request->input('product_code');
    // $product_code = 'ads';
    $product =$this->Transaksi->cek_produk($product_code);
    if ($product==null) {
      $data = [
        'name' => '',
        'purchase_price' => '',
        'selling_price' => '',
        'category_name' => '',
      ];
    }else {
       $data = [
        'name' => $product->name,
        'purchase_price' => $product->purchase_price,
        'selling_price' => $product->selling_price,
        'category_name' => $product->category_name,
        // 'name' => $product['name'],
        // 'purchase_price' => $product['purchase_price'],
        // 'selling_price' => $product['selling_price'],
        // 'category_name' => $product['category_name'],
       ];
    }
    	echo json_encode($data);
  }
 
   

}