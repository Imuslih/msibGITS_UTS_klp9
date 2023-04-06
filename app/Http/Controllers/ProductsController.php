<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

 
class ProductsController extends Controller
{
    public function index()
    {

      $data = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Manajemen Produk',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Produk',
      );

      return view('products.index',$data);
    }
 
   

}