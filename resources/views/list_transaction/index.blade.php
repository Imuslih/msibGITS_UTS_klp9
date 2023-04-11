@extends('layouts.app')


@section('contents')

@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-heaader">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr >
                                <th>Id</th>
                                <th>User_id</th>
                                <th>Costumer_name</th>
                                <th>Costumer_phone</th>
                                <th>Invoice</th>
                                <th>Total_price</th>
                            </tr>
                                @foreach ($data as $item)
                                <tr class="">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user_id}}</td>
                                    <td>{{$item->costumer_name}}</td>
                                    <td>{{$item->costumer_phone}}</td>
                                    <td>{{$item->invoice}}</td>
                                    <td>Rp. {{$item->total_price}}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

  

@endsection