<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => 'Halaman Dashboard',
            'menu'=>'dashboard',
            'sub_menu'=>'',
            'judul'=>'Dashboard',
            'sub_judul'=>'',
            'product' => Products::count(),
            'category' => Categories::count(),
            'user' => User::count()
        );

        return view('dashboard',$data);
     
    }


   

}
