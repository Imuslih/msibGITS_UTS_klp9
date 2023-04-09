<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

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
        // dd($products);
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
            'max' => 'Ukuran :attribute Max 5mb !!',
            'unique' => 'Data Produk sudah ada'
        ];
        
         $request->validate([
            'product_code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:5047',
            'category_id' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);
        
      
        // $imageName = date('YmdHis').".".$request->image->getClientOriginalExtension();
        // $uploadedImage = $request->image->move(public_path('img_products'),$imageName);
        // $imagePath = 'img_products/'. $imageName;

       
        // $data = array(
        //     'product_code'=>$request->input('product_code'),
        //     'name'=>$request->input('name'),
        //     'purchase_price' => str_replace(",","", $request->input('purchase_price')),
        //     'selling_price' =>  str_replace(",","", $request->input('selling_price')),
        //     'stock' => str_replace(",","", $request->input('stock')),
        //     'category_id'=>$request->input('category_id'),
        //     'image' => $imageName
        // );
        // Products::create($data);
        
        Products::create([
            'product_code'=>$request->input('product_code'),
            'name'=>$request->input('name'),
            'purchase_price' => str_replace(",","", $request->input('purchase_price')),
            'selling_price' =>  str_replace(",","", $request->input('selling_price')),
            'stock' => str_replace(",","", $request->input('stock')),
            'category_id'=>$request->input('category_id'),
            'image' => Storage::putFile('products', $request['image'])
        ]);
    
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
            'numeric' => ':attribute Harus Diisi Angka !!',
            // 'unique' => ':attribute Data Produk sudah ada'
        ];
        
         $validated = $request->validate([
            'product_code' => 'required',
            'name' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'image' => [File::types(['jpeg', 'jpg', 'png'])->max(2 * 1024),]
        ],$pesan);

        // $imageInput = $request->image;
        
        // if ($imageInput=='') {
        //     $data = array(
        //     'product_code'=>$request->product_code,
        //     'name'=>$request->name,
        //     'purchase_price'=> str_replace(",", "", $request->purchase_price),
        //     'selling_price'=> str_replace(",", "", $request->selling_price),
        //     'stock'=>str_replace(",", "", $request->stock),
        //     'category_id'=>$request->category_id,
        //     );
       
        //     Products::find($id)->update($data);
        // }else {
        //     $gambar = Products::where('id',$id)->first();
        //     File::delete('data_file/'.$gambar->file);
            
        //     $imageName = date('YmdHis').".".$request->image->getClientOriginalExtension();
        //     $uploadedImage = $request->image->move(public_path('img_products'),$imageName);
        //     $data = array(
        //     'product_code'=>$request->product_code,
        //     'name'=>$request->name,
        //     'purchase_price'=> str_replace(",", "", $request->purchase_price),
        //     'selling_price'=> str_replace(",", "", $request->selling_price),
        //     'stock'=>str_replace(",", "", $request->stock),
        //     'category_id'=>$request->category_id,
        //     'image' => $imageName
        // );
       
        // Products::find($id)->update($data);
           
        // }

        $produk = Products::find($id);
        $produk->product_code = $validated['product_code'];
        $produk->name = $validated['name'];
        $produk->purchase_price = str_replace(",", "", $validated['purchase_price']);
        $produk->selling_price = str_replace(",", "", $validated['selling_price']);
        $produk->stock = str_replace(",", "", $validated['stock']);
        $produk->category_id = $validated['category_id'];

        if($request->file('image')){
                if($produk->image && Storage::exists($produk->image)){
                    Storage::delete($produk->image);
                }
            $produk->image = Storage::putFile('products', $validated['image']);
        }
        $produk->save();

        return redirect()->route('products')->with('success','Data Produk Berhasil Diubah');
    }

   
    public function destroy($id)
    {
        $produk = Products::find($id);
        Storage::delete($produk->image);
        $produk->delete();

        return redirect()->route('products')->with('success','Data Produk Berhasil Dihapus');
    }

}
