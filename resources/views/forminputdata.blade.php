@extends('layouts/main')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  {{-- <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header> --}}
  <h2 style="margin-left:20px ">Input Data Barang</h2>
{{-- <p>Resize the browser window to see the effect. When the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other.</p> --}}

<div class="container">

    {!!Form::open(['url'=>'foor']) !!}
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang')!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('barang_id',null,
                    array('required',
                    'id'=>'kodebrg',
                    'placeholder'=>'Kode Barang'
                    ))!!}
                    <i class="fa fa-qrcode fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('namabrg','Nama Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('nama_brg',null,
                    array('required',
                    'id'=>'namabrg',
                    'placeholder'=>'Nama Barang'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('hargabrg','Harga Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('harga_brg',null,
                    array('required',
                    'id'=>'hargabrg',
                    'placeholder'=>'Harga Barang'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('hargajual','Harga Jual')!!}
            </div>
            <div class="col-75">
                {!!Form::text('harga_jual',null,
                    array('required',
                    'id'=>'hargajual',
                    'placeholder'=>'Harga Jual'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('barang_id',null,
                    array('required',
                    'id'=>'kodebrg',
                    'placeholder'=>'Kode Barang'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('barang_id',null,
                    array('required',
                    'id'=>'kodebrg',
                    'placeholder'=>'Kode Barang'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('barang_id',null,
                    array('required',
                    'id'=>'kodebrg',
                    'placeholder'=>'Kode Barang'
                    ))!!}
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang')!!}
            </div>
            <div class="col-75">
                {!!Form::text('barang_id',null,
                    array('required',
                    'id'=>'kodebrg',
                    'placeholder'=>'Kode Barang'
                    ))!!}
            </div>
        </div>
    {!!Form::close()!!}

</div>
@endif
@endsection