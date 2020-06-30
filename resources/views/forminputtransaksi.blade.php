@extends('layouts/main')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  <h2 style="margin-left:20px ">Form Input Transaksi</h2>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif

    {!!Form::open(['route'=>['simpantransaksi',$hasil],'enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        {!! Form::hidden('jumlah_brg', $hasil->jumlah_brg) !!}
        {!! Form::hidden('barang_id', $hasil->barang_id) !!}

        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('barang_id',$hasil->barang_id,
                    array('required','disabled',
                    'id'=>'kodebrg',
                    'class'=>'diinput',
                    'placeholder'=>'Kode Barang'
                    ))!!}
                    <i class="fa fa-qrcode fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('namabrg','Nama Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('nama_brg',$hasil->nama_brg,
                    array('required','disabled',
                    'id'=>'namabrg',
                    'class'=>'diinput',
                    'placeholder'=>'Nama Barang'
                    ))!!}
                    <i class="fa fa-film fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('hargabrg','Harga Pokok Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('harga_brg',$hasil->harga_brg,
                    array('required','disabled',
                    'id'=>'hargabrg',
                    'class'=>'diinput',
                    'placeholder'=>'Harga Pokok Barang'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('hargajual','Harga Jual',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('harga_jual',$hasil->harga_jual,
                    array('required','disabled',
                    'id'=>'hargajual',
                    'class'=>'diinput',
                    'placeholder'=>'Harga Jual'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('itemterjual','Jumlah Item Dibeli',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::number('qty',null,
                    array('required',
                    'id'=>'itemterjual',
                    'placeholder'=>'Jumlah Item'
                    ))!!}
                    {{-- <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('disc','Discount',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::number('discount',0,['required'])!!}
                    <span>%</span>
                    {{-- <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('tgltrans','Tanggal Transaksi',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::date('tgl_trans',\Carbon\Carbon::now())!!} 
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
                    {!! Form::submit('Simpan',['class'=>'tbl-simpan']) !!}           
                    <a href="{{route('inputransaksi')}}" class="klastomboledit">Batal</a>
        </div>
    {!!Form::close()!!}

    </div>
      <!-- End page content -->
</div>
@endif
@endsection