@extends('layouts/main')
@include('partials/flash')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Form -->
  <h2 style="margin-left:20px ">Edit Data Reseller</h2>
    <div class="container">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
        @endif
    {!!Form::open(['route'=>['simpaninputreseller',$hasil],'method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}
        <div class="row">
    
            <div class="col-25">
                {!!Form::label('noktp','Nomor KTP',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('no_ktp',$hasil->no_ktp,
                    array('required',
                    'id'=>'noktp',
                    'placeholder'=>'Nomor KTP'
                    ))!!}
                    <i class="fa fa-qrcode fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('namareseller','Nama Reseller',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('nama_reseller',$hasil->nama_reseller,
                    array('required',
                    'id'=>'namareseller',
                    'placeholder'=>'Nama Reseller'
                    ))!!}
                    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('alamatreseller','Alamat',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('alamat',$hasil->alamat,
                    array('required',
                    'id'=>'alamatreseller',
                    'placeholder'=>'Alamat'
                    ))!!}
                    <i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                {!!Form::label('email','Email',['class'=>'awesome'])!!}
            </div>
            <div class="col-75">
                <div class="inputWithIcon">
                    {!!Form::text('email',$hasil->email,
                    array('required',
                    'id'=>'email',
                    'placeholder'=>'Email'
                    ))!!}
                    <i class="fa fa-envelope-o fa-lg fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="row">
                    {{ csrf_field() }}
                    {!! Form::submit('Update',['class'=>'tbl-simpan']) !!} 
                    <a href="{{route('listreseller')}}" class="klastomboledit">Batal</a>
                </div>

    {!!Form::close()!!}

    </div>
      <!-- End page content -->
</div>
@endif
@endsection