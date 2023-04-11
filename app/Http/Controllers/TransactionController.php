<?php
 
namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
use Cart;
use Illuminate\Http\Request;

 
class TransactionController extends Controller
{

  public function __construct()
  {
    $this->Transaksi = new Transaksi();
  }

  public function index()
  {

    // $cart = session()->get('cart', []);
    // $json = json_decode(file_get_contents($cart),true);
    // $json = json_decode($cart)
    $data = array(
      'title' => 'Halaman Kasir',
      'products' => $this->Transaksi->allData(),
      // 'invoice' => $this->Transaksi->inVoice(),
      'cart' => Cart::content(),
      'grand_total' => Cart::subtotal()
    );
    // dd($this->Transaksi->allData());
    return view('transaction.index',$data);
    // dd($cart);
  }

  public function CekProduk(Request $request)
  {
    $name = $request->input('name');
    // $name = 'Kopi Kapal Api';
    $product =$this->Transaksi->cek_produk($name);
    if ($product==null) {
      $data = [
        'id_product' => '',
        'product_code' => '',
        'name' => '',
        'purchase_price' => '',
        'selling_price' => '',
        'category_id' => '',
      ];
    }else {
       $data = [
        'id_product' => $product->id_product,
        'product_code' => $product->product_code,
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

    $cart =  Cart::add([
      'id' => $request->id_product,
      'name' => $request->name, 
      'price' => $request->selling_price, 
      'weight' => 0, 
      'qty' =>  $request->qty, 
      'options' => [
        'product_code' => $request->product_code,
        'category_name' => $request->category_name,
        'selling_price' => $request->purchase_price,
      ]
    ]);

    //  $json['json'] = json_decode($cart,true);

    // $cart = array(
    //     'id' => $request->id,
    //     'name' => $request->name,
    //     'purchase_price' => $request->purchase_price,
    //     'selling_price' => $request->selling_price,
    //     'category_name' => $request->category_name,
    // );

    //  session()->put('cart', $cart);
     return redirect('transaction');
    //  dd($cart);


  }

   public function remove_item($rowId){
    Cart::remove($rowId);
    return redirect('transaction');

  }

  public function reset_cart(){
    Cart::destroy();
    return redirect('transaction');

  }
 
   

}