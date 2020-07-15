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
    {!!Form::open(['route'=>'simpan.checkout','method'=>'POST','enctype'=>'multipart/form-data'])!!}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-25">
            {!!Form::label('nonota','Nomor Nota',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('nota',$carinota['nota'],
                    array('required',
                    'id'=>'nonota',
                    'class'=>'diinput',
                    'placeholder'=>'Nota Barang'
                    ))!!}
                    <i class="fa fa-film fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('nama','Nama Pembeli',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('nama',null,
                    array('required',
                    'id'=>'nama',
                    'class'=>'diinput',
                    'placeholder'=>'Nama Pembeli'
                    ))!!}
                    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('alamat','Alamat Pembeli',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('alamat',null,
                    array('required',
                    'id'=>'alamat',
                    'class'=>'diinput',
                    'placeholder'=>'Alamat Pembeli'
                    ))!!}
                    <i class="fa fa-film fa-lg fa-fw" aria-hidden="true"></i>
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
                    <input type="number" value=0 min=0 step=0.01 name="discount">                    
                    <span> %</span>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('interval','Jangka Waktu',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::number('jangkawaktu',null,
                    array(
                    'id'=>'interval',
                    'placeholder'=>'Jangka Waktu'
                    ))!!}
                    {{-- <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i> --}}
                </div> Kalo Cash dikosongkan aja
            </div>
        </div>

        <!----Table------>
        <h2 style="margin-left:20px ">List Barang Dibeli</h2>
        <div class="container" style="overflow-x:auto;">
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual Barang</th>
                    <th>Qty</th>
                    <th>Total</th>

                </tr>
                <?php $subtotal=0; ?>
                @foreach($keranjang as $value)
                <tr>
                    <input type="hidden" name="id" value="{{ $value->id }}">
                    <input type="hidden" name="barang_id" value="{{ $value->barang_id }}">
                    <input type="hidden" name="qty" value="{{ $value->qty }}">
<<<<<<< HEAD
                    <input type="hidden" name="harga_jual" value="{{ $value->harga_jual }}">

                <td>{{$value->id}}</td>
=======
                    <input type="hidden" name="hargadijual" value="{{ $value->hargadijual }}">

                    <td>{{$value->id}}</td>
>>>>>>> 0b86b91c7985603597d3c07406e6b0dd92b2c71a
                <td>{{$value->barang_id}}</td>
                <td>{{$value->nama_brg}}</td>
                <td>{{$value->hargadijual}}</td>
                <td>{{$value->qty}}</td>
                <?php 
                $total = $value->hargadijual * $value->qty;
                $subtotal = $subtotal + $total;
                ?>

                <td>Rp. {{ number_format($total,2,',','.') }}</td>

                </tr>
                @endforeach
            </table>
              {{$keranjang->links()}}
              @foreach($simpandata as $value)
              <input type="hidden" name="id[]" value="{{ $value->id }}">
              <input type="hidden" name="barang_id[]" value="{{ $value->barang_id }}">
              <input type="hidden" name="qty[]" value="{{ $value->qty }}">
<<<<<<< HEAD
              <input type="hidden" name="harga_jual[]" value="{{ $value->harga_jual }}">
=======
              <input type="hidden" name="hargadijual[]" value="{{ $value->hargadijual }}">
>>>>>>> 0b86b91c7985603597d3c07406e6b0dd92b2c71a

              @endforeach
        </div>
        <div class="col-md-11 text-right">
            <strong class="text-black">Rp. {{ number_format($subtotal,2,',','.') }}</strong>
        </div>


        <!--------------->
        
        <div class="row">
                    {!! Form::submit('Simpan',['class'=>'tbl-simpan']) !!}           
                    <a href="{{route('index')}}" class="klastomboledit">Belanja Lagi</a>
                    <a href="{{route('keranjang')}}" class="klastomboledit">Update Keranjang</a>

        </div>
    {!!Form::close()!!}

    </div>
      <!-- End page content -->
</div>
@endif
@endsection