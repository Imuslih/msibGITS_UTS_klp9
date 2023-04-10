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
    $name = $request->input('name');
    // $name = 'Kopi Kapal Api';
    $product =$this->Transaksi->cek_produk($name);
    if ($product==null) {
      $data = [
        'name' => '',
        'purchase_price' => '',
        'selling_price' => '',
        'category_id' => '',
      ];
    }else {
       $data = [
        'id' => $product->id,
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

  public function add_cart(Request $request){
    $cart = session('cart');
    $id = $request->id;
    if (empty($cart)){
        $cart[$id] = [
          'id' => $request->id,
          'name' => $request->name,
          'purchase_price' => $request->purchase_price,
          'selling_price' => $request->selling_price,
          'category_name' => $request->category_name,
        ];
    }
  }

  public function add($id){
        $cart = session('cart');
        $products = Products::find($id);
        if (empty($cart)){
            $cart[$id] = [
                'nama_produk' => $products->name,
                'harga_produk' => $products->selling_price,
                'qty' => 1
            ];
        } else {
            $jml=1;
            foreach($cart as $item =>$val){
                if($item==$id){
                    $jml = $val['qty']+=1;
                }
            }
            $cart[$id] = [
                'nama_produk' => $products->name,
                'harga_produk' => $products->selling_price,
                'qty' => $jml
            ];
        }

        session(['cart' => $cart]);

        return redirect('transaction/index2');
    }

    public function cart(){
        $cart = session('cart');
        return view('cart')->with('cart', $cart);
    }

    public function hapus($id){
        $cart = session('cart');
        unset($cart[$id]);

        session(['cart' => $cart]);
        return redirect('transaction/index2');
    }

    public function index2()
    {
      $cart = session('cart');
      // $title = 'Halaman Kasir';
      $data['products'] = $this->Transaksi->allData();

      // dd($data);

      if(empty($cart)){
        return view('transaction/index2', $data);
      } else {
          return view('transaction/index2', $data, $cart)->with('cart', $cart);
      }
        
    }
}