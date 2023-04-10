@extends('layouts_transaction.app')


@section('contents_transaction')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <div class="content">
    <div class="row">

      <div class="col-lg-7">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>No Faktur</label>
                  <label
                    class="form-control form-control-lg text-center text-danger"
                    >030402</label
                  >
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Tanggal</label>
                  <label class="form-control form-control-lg text-center"
                    >{{ date('d M Y') }}</label
                  >
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Jam</label>
                  <label id="jam"  class="form-control form-control-lg text-center"></label>
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Kasir</label>
                  <label
                    class="form-control form-control-lg text-center text-primary"
                    >{{ Auth::user()->name }}</label
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title m-0"></h5>
          </div>
          <div class="card-body bg-black color-palette text-right">
            <label class="display-4 text-green">Rp. 10,000</label>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <form action="{{ route('transaction.add_cart')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">   
                    <div class="col-3 input-group">
                      <input
                        name="name"
                        class="form-control"
                        placeholder="Nama Produk"
                        autocomplete="off"
                        id= "name"
                      />
                      <span class="input-group-append">
                        <a class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#find-product">
                          <i style="color: white" class="fas fa-search"></i>
                        </a>
                        <button type="reset" class="btn btn-danger btn-flat">
                          <i class="fas fa-times"></i>
                        </button>
                      </span>
                    </div>

                    <div class="col-3">
                      <input
                        name="name"
                        class="form-control"
                        placeholder="Nama Produk"
                        readonly
                      />
                    </div>
                    
                    <div class="col-1">
                      <input
                        name="id"
                        class="form-control"
                        placeholder="ID"
                        readonly
                      />
                    </div>

                     
                   
                    <div class="col-1">
                      <input
                        name="category_name"
                        class="form-control"
                        placeholder="Kategori"
                        readonly
                      />
                    </div>

                    <div class="col-1">
                      <input
                        name="selling_price"
                        class="form-control"
                        placeholder="Harga"
                        readonly
                      />
                    </div>

                      <input
                      name="purchase_price"
                      type="hidden"
                    />
                  


                    <div class="col-1">
                      <input
                        type="number"
                        min="1"
                        value="1"
                        name="qty"
                        class="form-control text-center"
                        placeholder="QTY"
                        id="qty"
                      />
                    </div>

                  
                    <div class="col-3">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-cart-plus" ></i> Add
                      </button >
                      <a href="" class="btn btn-warning">
                        <i class="fas fa-sync"></i> Reset
                      </a>
                      <a style="color:white" data-toggle="modal" onclick=""  class="btn btn-success">
                        <i  class="fas fa-cash-register"></i> Pembayaran
                      </a>
                    </div>
                  </div>
                </div>
                
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>Kode/Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th width="100px">QTY</th>
                        <th>Total Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0"></h5>
            </div>
            <div class="card-body bg-black color-palette text-center">
              <h2 class="text-yellow" id="terbilang">SEPULUH RIBU RUPIAH</h2>
            </div>
        </div>
      </div>

      
    </div>
  </div>
</div>

<!-- Modal Pencarian Produk -->
<div class="modal fade " id="find-product">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pencarian Data Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped text-sm text-center">
          <thead>
            <tr >
              <th width="50px">No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Stok</th>
              <th>Gambar</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @php
                $no=1;
              @endphp
            @foreach ($products  as $item)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$item->product_code}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->category_name}}</td>
              <td>Rp. {{ number_format($item->purchase_price,0)}}</td>
              <td>Rp. {{ number_format($item->selling_price,0)}}</td>
              <td>{{number_format($item->stock,0)}}</td>
              <td> <img src="{{ asset('storage/'.$item->image) }}" style="width:100px" alt="image"> </td>
              <td style=" width:30px"><button onclick="PilihProduk('{{$item->name}}')" class="btn btn-success btn-xs">Piih</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /Modal Pencarian Produk -->

<script>
   $(document).ready(function() {
    $('#name').focus();

    $('#name').keydown(function (e) {
        let name = $('#name').val();
        if (e.keyCode == 13) {
          e.preventDefault();
          if (name == '') {
            Swal.fire({
              title: "Maaf !!",
              text: 'Kode Produk Kosong',
              icon: 'error'
            })
          } else {
            CekProduk();
          }
        }
      });

    });

    
  function PilihProduk(name) {
    $('#name').val(name);
    $('#find-product').modal('hide');
     CekProduk();
   
  }

   function CekProduk() {
    $.ajax({
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/transaction/cek_produk",
      data: {
        name: $('#name').val(),
      },
      dataType: "JSON",
      success: function(response) {
        if (response.name == '') {
          Swal.fire({
            title: "Maaf !!",
            text: 'Nama Produk Tidak Terdaftar',
            icon: 'error'
          })
        }else{
          $('[name="id"]').val(response.id);
          $('[name="name"]').val(response.name);
          $('[name="purchase_price"]').val(response.purchase_price);
          $('[name="selling_price"]').val(response.selling_price);
          $('[name="category_name"]').val(response.category_name);
          $('#qty').focus();
        }
      }

    });
  }
  
</script>

<script>
  window.onload = function() {
    startTime();
  }
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m= checkTime(m);
    s= checkTime(s);
    document.getElementById('jam').innerHTML = h + ':' + m + ':' + s;
    var t = setTimeout(function(){
      startTime();
    },500);
   
  }
   
  function checkTime(i) {
    if (i<10) {
      i = '0' + i;
    }
    return i;
  }
  
</script>

   
  

@endsection

