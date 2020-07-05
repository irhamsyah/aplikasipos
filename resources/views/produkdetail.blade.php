@extends('layouts/main')
@section('content')
@if(Auth::check())
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-shoping"></i> <a href="{{route('index')}}">My Dashboard</a></b></h5>
    <h5><b><i class="fa fa-shoping"></i> <a href="{{route('index')}}"><span class="icon icon-add_shopping_cart"></span>Keranjang</a></b></h5>
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
<!----isi----->
<div class="site-section">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
        <img src="{{ asset('img/'.$produk->photo) }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6">
        <h2 class="text-black">{{ $produk->nama_brg }}</h2>
        {{-- <p>
            {{ $produk->description }}
        </p> --}}

        <div class="mb-5">
          <!-------FORM------->
            <form action="{{ route('keranjang.simpan',['id'=>$produk->barang_id]) }}" method="post">
                @csrf
                @if(Route::has('login'))
                    @auth
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endauth
                @endif
                <p><strong class="text-primary h4">
        <label for="reseler"> Harga Reseller</label>
      <input type="checkbox" id="hrg" name="hargadijual" value="{{$produk->harga_jual_reseller}}">
       Rp <label for="reseler"> {{$produk->harga_jual_reseller}}</label><br>
      </strong></p>
        <p><strong class="text-primary h4">
        <label for="reseler"> Harga Eceran</label>

        <input type="checkbox" id="hrg" name="hargadijual" value="{{$produk->harga_jual}}">
        Rp <label for="eceran"> {{$produk->harga_jual}}</label>
        </strong></p>

            <input type="hidden" name="barang_id" value="{{ $produk->barang_id }}">
            <small>Sisa Stok {{ $produk->jumlah_brg }}</small>
            <input type="hidden" name="jumlah_brg" value="{{ $produk->jumlah_brg }}" id="sisastok">
            <div class="input-group mb-3" style="max-width: 120px;">
            <div class="input-group-prepend">
            <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="text" name="qty" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
            <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
        </div>

        </div>
        <p><button type="submit" class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>
        </form>
        <!--------------batas form------------>
        </div>
    </div>
    </div>
</div>


  <!-- Footer -->
  <!-- <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer> -->

  <!-- End page content -->
</div>
@endif
@endsection

