@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Detail Transaksi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
       <table  id="example1" class="table table-bordered table-striped text-center">
        <thead>
            <tr >
                <th>No</th>
                <th>Nama Customer</th>
                <th>No. Telp Customer</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Uang Pembayaran</th>
                <th>Uang Kembalian</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          @php
            $no=1;
          @endphp
            @foreach ($details as $item)
                <tr class="">
                    <td>{{$no++}}</td>
                    <td>{{$item->customer_name}}</td>
                    <td>{{$item->customer_phone}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->payment}}</td>
                    <td>{{$item->change}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5"></td>
                    <td>{{ $item->total_price }}</td>
                </tr>
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
  

@endsection