@extends('layouts/main')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  <h2 style="margin-left:20px ">Form Edit Data Barang</h2>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif

    {!!Form::open(['route'=>['updatedatabarang',$hasil],'enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        {!! Form::hidden('id', $hasil->barang_id) !!}

        <div class="row">
            <div class="col-25">
                {!!Form::label('kodebrg','Kode Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('barang_id',$hasil->barang_id,
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
                    {!!Form::text('nama_brg',$hasil->nama_brg,
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
                    {!!Form::text('harga_brg',$hasil->harga_brg,
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
                    {!!Form::text('harga_jual',$hasil->harga_jual,
                    array('required',
                    'id'=>'hargajual',
                    'placeholder'=>'Harga Jual'
                    ))!!}
                    <i class="fa fa-inr fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('kodesatuan','Satuan Barang',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                {{--yg dibawah ini merupakan teknik menampilkan record dari DB pada Selectbox
                dengan teknik laravel 5.3 keatas --}}
                {{-- [''=>'']+App\Models\Satuan::pluck('nama_satuan','id')->all() --}}
                    {!! Form::select('satuan',[''=>'']+App\Models\Satuan::pluck('nama_satuan','id')->all(),$hasil->satuan) !!}
                    {{-- <i aria-hidden="true"></i> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('isipersatuan','Jumlah Isi per Sataun',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('isi_persatuan',$hasil->isi_persatuan,
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
                    {!!Form::text('jumlah_brg',$hasil->jumlah_brg,
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
                        <p></p>
                        File sebelumnya:
                        {{$hasil->photo}}
                </div>
            </div>
        </div>
        <div class="row">
                    {!! Form::submit('Simpan',['class'=>'tbl-simpan']) !!}       
                    {{-- <input type="reset" class="tbl-simpan" value="Reset"> --}}
                    <a href="{{route('editdatabarang')}}" class="klastomboledit">Batal</a>
        </div>

    {!!Form::close()!!}

    </div>
      <!-- End page content -->
</div>
@endif
@endsection