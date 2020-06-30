@extends('layouts/mainlistdelete')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- table -->
  <h2 style="margin-left:20px ">List Data Barang</h2>
    <div class="container" style="overflow-x:auto;">
        <table id="customers" class="display" style="width:100%;">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Harag Barang</th>
              <th>Harga Jual Barang</th>
              <th>Harga Reseller</th>
              <th>Persedian Barang</th>
              <th>Opsi</th>
          </tr>

          </thead>
          <tbody>
            @foreach($barang as $value)
            <tr>
            <td>{{$value->barang_id}}</td>
            <td>{{$value->nama_brg}}</td>
            <td>{{$value->harga_brg}}</td>
            <td>{{$value->harga_jual}}</td>
            <td>{{$value->harga_jual_reseller}}</td>
            <td>{{$value->jumlah_brg}}</td>
            <td>
              {!! Form::model($value, ['route' => ['hapusbarang', $value->barang_id], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
              <a href="{{ url('editbarang/'.$value->barang_id)}}" class="urledit">Edit</a> |
              {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger btn-sm js-submit-confirm','onclick'=>'return konfirmasi()']) !!}
              {!! Form::close()!!}

              
            </td>
            </tr>
            @endforeach

          </tbody>
        </table>
          {{-- {{$barang->links()}} --}}
    </div>
      <!-- End page content -->
</div>
@endif
@endsection