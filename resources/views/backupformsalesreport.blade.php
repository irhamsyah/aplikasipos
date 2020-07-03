@extends('layouts/main')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  <h2 style="margin-left:20px "> Form Sales Report </h2>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
        {{-- @if(isset($lama))
                {{dd($lama)}};
        @endif --}}
    {!!Form::open(['route'=>'cari.sales.report','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
    <div class="row">
        <div style="margin-left: 15px">
            {!!Form::label('tgltrans','Tanggal Awal',['class'=>'awesome'])!!}
        </div>
        <div class="col-75">
            <div>
                @if(isset($lama))
                {!!Form::date('tgl_trans1',$lama['tgl_trans1'])!!}
                @else 
                {!!Form::date('tgl_trans1',\Carbon\Carbon::now())!!}
                @endif
                {{-- <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div style="margin-left: 15px">
            {!!Form::label('tgltrans','Tanggal Akhir',['class'=>'awesome'])!!}
        </div>
        <div class="col-75">
            <div>
                @if(isset($lama))
                {!!Form::date('tgl_trans2',$lama['tgl_trans2'])!!}
                @else 
                {!!Form::date('tgl_trans2',\Carbon\Carbon::now())!!}
                @endif
                {{-- <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i> --}}
            </div>
        </div>
    </div>
    <div class="row" style="margin-left: 2px">
        {{ csrf_field() }}
            {!! Form::submit('Cari',['class'=>'tbl-simpan']) !!} 
            <input type="reset" class="tbl-simpan" value="Reset" >
    </div>

    {!!Form::close()!!}
        <!----Table------>
        {{-- <h2 style="margin-left:20px ">List Data Barang</h2> --}}
        <div class="container" style="overflow-x:auto;">
            <table id="customers">
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kuantitas</th>
                    <th>Jumlah Transaksi</th>
                </tr>
                <?php $no=1; ?>
                @if(isset($cari))
                @foreach($cari as $value)
                <tr>
                <td>{{$no}}</td>
                <td>{{$value->barang_id}}</td>
                <td>{{$value->nama_brg}}</td>
                <td>{{$value->tgl_trans}}</td>
                <td>{{$value->jumlah_item_trans}}</td>
                <td>{{number_format($value->jumlah_transaksi,2,',','.')}}</td>
                </tr>
                <?php 
                    $no++;
                ?>
                @endforeach
                @endif
            </table>
            {{-- @if(isset($cari))

              {{$cari->links()}}
            @endif --}}
    </div>
      <!-- End page content -->
</div>
@endif
@endsection