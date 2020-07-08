@extends('layouts/main')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  <h2 style="margin-left:20px ">Input Data Barang</h2>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif

    {!!Form::open(['route'=>'simpaninputbarang','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
        <div class="row">
    
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('barang_id',old('barang_id'),
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
                {!!Form::label('namabrg','Nama Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('nama_brg',old('nama_brg'),
                    array('required',
                    'id'=>'namabrg',
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
                    {!!Form::text('harga_brg',old('harga_brg'),
                    array('required',
                    'id'=>'hargabrg',
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
                    {!!Form::text('harga_jual',old('harga_jual'),
                    array('required',
                    'id'=>'hargajual',
                    'placeholder'=>'Harga Jual'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-25">
                {!!Form::label('hargareseller','Harga Reseller',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('harga_jual_reseller',old('harga_jual_reseller'),
                    array('required',
                    'id'=>'hargareseller',
                    'placeholder'=>'Harga Reseller'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodesatuan','Satuan Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                {{--yg dibawah ini merupakan teknik menampilkan record dari DB pada Selectbox
                dengan teknik laravel 5.3 keatas --}}
                {{-- [''=>'']+App\Models\Satuan::pluck('nama_satuan','id')->all() --}}
                    {!! Form::select('satuan',[''=>'']+App\Models\Satuan::pluck('nama_satuan','id')->all(),'MONCROT') !!}
                    <i aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('isipersatuan','Jumlah Isi per Sataun',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('isi_persatuan',old('isi_persatuan'),
                    array('required',
                    'id'=>'isipersatuan',
                    'placeholder'=>'Isi persatuan barang'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('jmlbrg','Jumlah Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('jumlah_brg',old('jumlah_brg'),
                    array('required',
                    'id'=>'jmlbrg',
                    'placeholder'=>'Jumlah Barang'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('imgbrg','Image Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::file('photo',['class'=>'ambilfile'])!!}
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
                    {{ csrf_field() }}
                    {!! Form::submit('Simpan',['class'=>'tbl-simpan']) !!} 
                    <input type="reset" class="tbl-simpan" value="Reset">
               
        </div>

    {!!Form::close()!!}

    </div>
      <!-- End page content -->
</div>
@endif
@endsection