<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {

      $data1 = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Manajemen Produk',
			'judul' => 'Master Data',
			'sub_judul' => 'Manajemen Produk'

      );
        $products = Products::all();
      return view('products.index',['data'=>$products],$data1);
    }

    public function create()
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Tambah Produk',
			'judul' => 'Manajemen Produk',
			'sub_judul' => 'Tambah Produk',
            'categories' => Categories::all()
      );
        return view('products.add',$data);
    }

    public function store(Request $request)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'numeric' => ':attribute Harus Diisi Angka !!',
            'image' => ':attribute Harus Gambar !!',
            'mimes' => ':attribute Harus Beformat jpeg,png,jpg !!',
            'max' => 'Ukuran :attribute Max 5mb !!'
        ];
        
         $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5047',
            'category_id' => 'required'
        ],$pesan);
        
      
        $imageName = date('YmdHis').".".$request->image->getClientOriginalExtension();
        $uploadedImage = $request->image->move(public_path('img_products'),$imageName);
        $imagePath = 'img_products/'. $imageName;

       
        $data = array(
            'product_code'=>$request->input('product_code'),
            'name'=>$request->input('name'),
            'purchase_price' => str_replace(",","", $request->input('purchase_price')),
            'selling_price' =>  str_replace(",","", $request->input('selling_price')),
            'stock' => str_replace(",","", $request->input('stock')),
            'category_id'=>$request->input('category_id'),
            'image' => $imageName
        );
        Products::create($data);

    
        return redirect()->route('products')->with('success','Data Produk Berhasil Ditambahkan');
    }


    public function edit($id)
    {
        $data = array(
			'menu' => 'master',
			'sub_menu' => 'produk',
			'title' => 'Edit Produk',
			'judul' => 'Manajemen Produk',
			'sub_judul' => 'Edit Produk'

      );
        $products['products'] = Products::where('id',$id)->first();
        $data['categories'] = Categories::all();
        return view('products.edit',$products,$data);
    }

    public function update(Request $request, $id)
    {
        $pesan = [
            'required' => ':attribute Tidak Boleh Kosong !!',
            'numeric' => ':attribute Harus Diisi Angka !!'
        ];
        
         $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            'category_id' => 'required'
        ],$pesan);

        $imageInput = $request->image;
        
        if ($imageInput=='') {
            $data = array(
            'product_price'=>$request->product_price,
            'name'=>$request->name,
            'purchase_price'=> str_replace(",", "", $request->purchase_price),
            'selling_price'=> str_replace(",", "", $request->selling_price),
            'stock'=>str_replace(",", "", $request->stock),
            'category_id'=>$request->category_id,
            );
       
            Products::find($id)->update($data);
        }else {
            $imageName = date('YmdHis').".".$request->image->getClientOriginalExtension();
            $uploadedImage = $request->image->move(public_path('img_products'),$imageName);
            $data = array(
            'product_price'=>$request->product_price,
            'name'=>$request->name,
            'purchase_price'=> str_replace(",", "", $request->purchase_price),
            'selling_price'=> str_replace(",", "", $request->selling_price),
            'stock'=>str_replace(",", "", $request->stock),
            'category_id'=>$request->category_id,
            'image' => $imageName
        );
       
        Products::find($id)->update($data);
           
        }
      
       
      
        return redirect()->route('products')->with('success','Data Produk Berhasil Diubah');
    }

   
    public function destroy($id)
    {

        Products::find($id)->delete();

        return redirect()->route('products')->with('success','Data Produk Berhasil Dihapus');
    }

}
