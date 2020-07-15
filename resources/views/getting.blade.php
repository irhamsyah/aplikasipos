@extends('layouts/main')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-shoping"></i> <a href="{{route('index')}}">My Dashboard</a></b></h5>
    <h5><b><i class="fa fa-shoping"></i> <a href="{{route('keranjang.checkout')}}"><span class="icon icon-add_shopping_cart"></span>Keranjang</a></b></h5>
  </header>
  @include('layouts.dashboard')
<div class="w3-row-padding w3-margin-bottom">

      @foreach($produks as $produk)

      <div class="w3-quarter pisah">
        <div class="w3-container w3-red w3-padding-16">
        <a href="{{route('detailproduk',['id'=>$produk->barang_id])}}">
          <div class="w3-center"><img src="{{asset('img/'.$produk->photo)}}" alt=""></i></div>
        </a>
          <div class="w3-right">
            <h3>Rp {{ $produk->harga_jual }}</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>{{$produk->nama_brg}}</h4>
        </div>
        <div class="w3-left">
          <h5>Sisa stok: {{ $produk->jumlah_brg }}</h6>
        </div>


      </div>
      
        @endforeach

</div>
{{ $produks->links() }}

  <!-- Footer -->
  <!-- <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer> -->

  <!-- End page content -->
</div>
@endif
@endsection