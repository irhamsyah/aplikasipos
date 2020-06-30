@extends('layouts/main')
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
        <h3 style="text-align: center">Faktur Pembelian</h3>
        <div><span>Nomor Nota<span style="margin-left: 24px; margin-right: 5px">:</span> </span> <span>{{$faktur[0]->nota}}</span> </div>
        <div><span>Nama Pembeli : </span> <span style="margin-left: 5px">{{$faktur[0]->nama}}</span> </div>
        <div><span>Alamat </span> <span style="margin-left:58px">:</span><span style="margin-left: 10px">{{$faktur[0]->alamat}}</span> </div>
        <br>

    {{-- <div>Nama : {{$faktur['nota']}}</div> --}}
        <table class="display" style="width:100%;">
            <thead>
                <tr class="tabel-faktur">
                    <th class="tabel-faktur">Nama Barang</th>
                    <th class="tabel-faktur">Harga Barang</th>
                    <th class="tabel-faktur">Item</th>
                    <th class="tabel-faktur">Nilai Transaksi</th>
                </tr>
            </thead>
    
            <tbody>
                <?php $total=0; ?>
                @foreach($faktur as $value)
                <tr class="tabel-faktur">
                <td class="tabel-faktur">{{$value->nama_brg}}</td>
                <?php 
                    $total=$total+$value->jumlah_transaksi;
                    $harga_brg=$value->jumlah_transaksi/$value->jumlah_item_trans;
                ?>
                <td class="tabel-faktur">{{number_format($harga_brg,2,',','.')}}</td>
                <td class="tabel-faktur">{{$value->jumlah_item_trans}}</td>
                <td class="tabel-faktur">{{number_format($value->jumlah_transaksi,2,',','.')}}</td>
                </tr>
                @endforeach

                <td></td>
                <td></td>
                <td>Grand total</td>
                <td>{{number_format($total,2,',','.')}}</td>

            </tbody>
    
        </table>
    </div>
      <!-- End page content -->
</div>
@endif
@endsection