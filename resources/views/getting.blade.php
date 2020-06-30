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

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>52</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Messages</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>99</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
  </div>
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
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
</div>
@endif
@endsection