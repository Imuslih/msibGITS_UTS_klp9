@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kategori</h3>
        <div class="card-tools">
          <button type="button" data-target="" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-plus"></i>Add</button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">   
      <table id="example1" class="table table-bordered table-striped text-center">
        <thead>
          <tr >
            <th width="50px">No</th>
            <th>Kategori</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
       
        <tbody>
          <tr class="">
            <td>Coba</td>
            <td>Coba</td>
            <td>
            <button data-toggle="modal" data-target="" class="btn btn-sm btn-warning">Edit</button>
            <button data-toggle="modal" data-target="" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
       
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
@endsection