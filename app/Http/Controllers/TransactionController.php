<?php
 
namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\User;
use App\Models\Products;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

 
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

          $query = DB::table('transaksis')
            ->select('id')
            ->get();
          
          foreach($query as $no){
              $no_urut = $no->id;
          }
          if($no_urut == null){
              $no_urut = 1;
          } else {
              $no_urut = $no_urut+1;
          }

          // dd($no_urut);

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
              'transaksi_id' => $no_urut,
              'product_id' => $value->id,
              'qty' =>  $value->qty,
              'price' => $value->subtotal
            ];
            DetailTransaksi::create($data);
          }

          $phone_no = '6283857959431';
          $message = "Bukti Transaksi dari *Kopi Kita*
          
          Nama    : Imam
          No WA   : 085741573739
          Invoice : 123456
          Tanggal : Rabu, 12 April 2023
          
          Produk :
          - Kopi hitam  2x  @Rp. 5.000
          - Mendoan     1x  @Rp. 10.000
          *SubTotal   : Rp. 20.000*
          Pembayaran  : Rp. 50.000 (Kembali Ro, 30.000)
          
          Terima kasih atas kunjungan anda
          
          _Salam hangat_ *Kopi Kita*";

          Cart::destroy();

          // $url = "https://api.whatsapp.com/send/?phone='.$phone_no.'&text='.urlencode($message)";

          // echo "<script>window.open('".$url."', '_blank')</script>";
          return redirect('transaction')->with('success','Transaksi Berhasil Disimpan');
      }
    }
  }

  public function kirimWA(){
    $phone_no = '6285741573739';
    // $phone_no1 = '6283857959431';
    // $phone_no2 = '6282227007422';
    // $phone_no3 = '62895393355523';
    // $phone_no4 = '6287882914957';
    $message = "Bukti Transaksi dari *Kopi Kita*
    
    Nama    : Imam
    No WA   : 085741573739
    Invoice : 123456
    Tanggal : Rabu, 12 April 2023
    
    Produk :
    - Kopi hitam  2x  @Rp. 5.000
    - Mendoan     1x  @Rp. 10.000
    *SubTotal   : Rp. 20.000*
    Pembayaran  : Rp. 50.000 (Kembali Ro, 30.000)
    
    Terima kasih atas kunjungan anda
    
    _Salam hangat_ *Kopi Kita*";

    // $this->kirimpesan($phone_no1, $message);
    // $this->kirimpesan($phone_no2, $message);
    // $this->kirimpesan($phone_no3, $message);
    // $this->kirimpesan($phone_no4, $message);

    // return view('dashboard');

    return redirect()->to('https://api.whatsapp.com/send/?phone='.$phone_no.'&text='.urlencode($message));
  }

  function kirimpesan( $phone_no, $message){
  
    //$message = "Bismillah";
    //$phone_no = "085647878076";

    $message = preg_replace( "/(\n)/", "<ENTER>", $message );
    $message = preg_replace( "/(\r)/", "<ENTER>", $message );

    $phone_no = preg_replace( "/(\n)/", ",", $phone_no );
    $phone_no = preg_replace( "/(\r)/", "", $phone_no );

    $data = array("phone_no" => $phone_no, "key" => "", "message" => $message);
    $data_string = json_encode($data);
    $ch = curl_init('http://116.203.92.59/api/async_send_message');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
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

}