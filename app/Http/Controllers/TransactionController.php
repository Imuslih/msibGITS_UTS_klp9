<?php
 
namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
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

    $data = array(
      'title' => 'Halaman Kasir',
      'products' => $this->Transaksi->allData(),
      'invoice' => $this->Transaksi->inVoice(),
      'cart' => Cart::content(),
      'grand_total' => Cart::subtotal()
    );
    return view('transaction.index',$data);
    
    // dd($this->Transaksi->inVoice());
  }

  public function CekProduk(Request $request)
  {
    $name = $request->input('name');
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
       ];
    }
    	echo json_encode($data);
  }

  public function add_cart(Request $request){

    $name = $request->input('name');
    $qty = $request->input('qty');

    $ambilDataProduk = $this->Transaksi->cek_produk($name);

    $stokProduk = $ambilDataProduk->stock;

    if ($qty>intval($stokProduk)) {
        return redirect('transaction')->with('danger','Stok Tidak Mencukupi');
    } else {
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

     return redirect('transaction');
    }
    

   



  }

   public function remove_item($rowId){
    Cart::remove($rowId);
    return redirect('transaction');

  }

  public function reset_cart(){
    Cart::destroy();
    return redirect('transaction');

  }

  public function save_transaction(Request $request){
    $produk = Cart::subtotal();
    $invoice = $this->Transaksi->inVoice();
    $customer_name = $request->input('customer_name');
    $customer_phone = $request->input('customer_phone');
    $payment =  str_replace(",","",$request->input('dibayar'));
    $change =  str_replace(",","",$request->input('kembalian'));
    $user_id = $request->input('user_id');
    $transaksi_id = 1;

    if ( $produk==0 ) {
     return redirect('transaction')->with('danger','Data Keranjang Kosong');
    } else {
        if ($change<0) {
          return redirect('transaction')->with('danger','Data Tidak Benar');
        } else {
          $item = Cart::content();

          $data = [
            'invoice' => $invoice,
            'user_id' => $user_id,
            'customer_name' => $customer_name,
            'customer_phone' => $customer_phone,
            'total_price' => Cart::subtotal(),
            'payment' => $payment,
            'change' => $change,
          ];
          Transaksi::create($data);

          
          foreach ($item as $key => $value) {
            $data = [
              'transaksi_id' => $transaksi_id++,
              'product_id' => $value->id,
              'qty' =>  $value->qty,
              'price' => $value->subtotal
            ];
            DetailTransaksi::create($data);
          }


          Cart::destroy();
          return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');
      }
    }
  }

  

  // --------------------------------------------------

  // public function add($id){
  //       $cart = session('cart');
  //       $products = Products::find($id);
  //       if (empty($cart)){
  //           $cart[$id] = [
  //               'nama_produk' => $products->name,
  //               'harga_produk' => $products->selling_price,
  //               'qty' => 1
  //           ];
  //       } else {
  //           $jml=1;
  //           foreach($cart as $item =>$val){
  //               if($item==$id){
  //                   $jml = $val['qty']+=1;
  //               }
  //           }
  //           $cart[$id] = [
  //               'nama_produk' => $products->name,
  //               'harga_produk' => $products->selling_price,
  //               'qty' => $jml
  //           ];
  //       }

  //       session(['cart' => $cart]);

  //       return redirect('transaction/index2');
  //   }

  //   public function cart(){
  //       $cart = session('cart');
  //       return view('cart')->with('cart', $cart);
  //   }

  //   public function hapus($id){
  //       $cart = session('cart');
  //       unset($cart[$id]);

  //       session(['cart' => $cart]);
  //       return redirect('transaction/index2');
  //   }

  //   public function index2()
  //   {
  //     $cart = session('cart');
  //     // $title = 'Halaman Kasir';
  //     $data['products'] = $this->Transaksi->allData2();

  //     // dd($data);

  //     if(empty($cart)){
  //       return view('transaction/index2', $data);
  //     } else {
  //         return view('transaction/index2', $data, $cart)->with('cart', $cart);
  //     }
        
  //   }
}