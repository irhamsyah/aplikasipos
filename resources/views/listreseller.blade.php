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
        <h1 style="text-align: center">List Reseller</h1>

        <table id="example" class="display" style="width:100%;">
    
            <thead>
                <tr>
                    <th>Nomor KTO</th>
                    <th>Nama Reseller</th>
                    <th>Alamat Reseller</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
    
            <tbody>
                @foreach($reseller as $value)
                <tr>
                <td>{{$value->no_ktp}}</td>
                <td>{{$value->nama_reseller}}</td>
                <td>{{$value->alamat}}</td>
                <td>{{$value->email}}</td>
                <td>
                  {!! Form::model($value, ['route' => ['hapusreseller', $value->no_ktp], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                  <a href="{{ url('editreseller/'.$value->no_ktp)}}" class="urledit"> Edit</a>|
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