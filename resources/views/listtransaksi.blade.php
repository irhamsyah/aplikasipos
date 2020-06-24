@extends('layouts/mainlistdelete')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  {{-- <h2 align="center" style="margin-left:20px ">Input Transaksi</h2> --}}
    <div class="container" style="overflow-x:auto;">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        <h1 style="text-align: center">List Transaksi</h1>

        <table id="example" class="display" style="width:100%;">
    
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Item</th>
                    <th>Jumlah Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Discount</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach($transaksi as $value)
                <tr>
                <td>{{$value->barang_id}}</td>
                <td>{{$value->nama_brg}}</td>
                <td>{{$value->jumlah_item_trans}}</td>
                <td>{{$value->jumlah_transaksi}}</td>
                <td>{{$value->tgl_trans}}</td>
                <td>{{$value->discount}}</td>
                <td>
                  {!! Form::model($value, ['route' => ['hapustransaksi', $value->id], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                  <a href="{{ url('edittransaksi/'.$value->id)}}" class="urledit"> Edit</a>|
                  {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger btn-sm js-submit-confirm','onclick'=>'return konfirmasi()']) !!}
                  {!! Form::close()!!}
                </td>
                </tr>
                @endforeach
    
            </tbody>
    
        </table>
    </div>
      <!-- End page content -->
</div>
@endif
@endsection