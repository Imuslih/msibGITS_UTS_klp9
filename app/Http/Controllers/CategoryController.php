<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

 
class CategoryController extends Controller
{
    public function index()
    {

      $data = array(
			'menu' => 'master',
			'sub_menu' => 'kategori',
			'title' => 'Manajemen Kategori',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Kategori',
      );

      return view('category.index',$data);
    }
 
   

}