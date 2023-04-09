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
                    >Admin</label
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
            <div class="row">
              <div class="col-lg-12">
                <div class="row">   
                  <div class="col-3 input-group">
                    <input
                      name=""
                      class="form-control"
                      placeholder="Kode Produk"
                      autocomplete="off"
                      id= ""
                    />
                    <span class="input-group-append">
                      <a class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#">
                        <i style="color: white" class="fas fa-search"></i>
                      </a>
                      <button type="reset" class="btn btn-danger btn-flat">
                        <i class="fas fa-times"></i>
                      </button>
                    </span>
                  </div>

                  <div class="col-3">
                    <input
                      name=""
                      class="form-control"
                      placeholder="Nama Produk"
                      readonly
                    />
                  </div>

                  <div class="col-1">
                    <input
                      name=""
                      class="form-control"
                      placeholder="Kategori"
                      readonly
                    />
                  </div>

                  <div class="col-1">
                    <input
                      name=""
                      class="form-control"
                      placeholder="Harga"
                      readonly
                    />
                  </div>


                  <div class="col-1">
                    <input
                      type="number"
                      min="1"
                      value="1"
                      name=""
                      class="form-control text-center"
                      placeholder="QTY"
                      id=""
                    />
                  </div>

                  <input
                    name=""
                    type="hidden"
                  />
                
                  <div class="col-3">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-cart-plus" ></i> Add
                    </button>
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

  

@endsection