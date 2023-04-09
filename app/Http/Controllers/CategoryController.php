<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

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
            'categories' => Categories::all()
      );

      return view('category.index',$data);
    }

    public function create()
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'kategori',
			'title' => 'Manajemen Kategori',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Kategori',
      );
        return view('category.add',$data);
    }

    public function store(Request $request)
    {

        $pesan = [
            'required' => 'Data Kategori Tidak Boleh Kosong !!',
            'unique' => 'Data Kategori sudah ada'
        ];

        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ],$pesan);



        Categories::create([
            'name'=>$validated['name']
        ]);
        return redirect()->route('category')->with('success','Data Kategori Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'kategori',
			'title' => 'Manajemen Kategori',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Kategori',
      );
        $category = Categories::where('id',$id)->first();

        return view('category.edit',['category'=>$category],$data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        Categories::find($id)->update([
            'name'=>$request->name
        ]);
        return redirect()->route('category')->with('success','Data Kategori Berhasil Diubah');
    }
    
    public function destroy($id)
    {

        Categories::find($id)->delete();

        return redirect()->route('category')->with('success','Data Kategori Berhasil Dihapus');
    }

}
