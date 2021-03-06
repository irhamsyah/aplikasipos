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
  <div class="site-section">
    <div class="container">
        <div class="row mb-5">
        <!-------------MULAI FORM------------------>
        <form class="col-md-12" method="post" action="{{ route('keranjang.update') }}">
                    @csrf
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="product-thumbnail">Gambar</th>
                        <th class="product-name">Produk</th>
                        <th class="product-price">Harga</th>
                        <th class="product-quantity">Jumlah</th>
                        <th class="product-total">Total</th>
                        <th class="product-remove">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        <?php $subtotal=0; foreach($keranjangs as $keranjangs): ?>
                        <td class="product-thumbnail">
                            <img src="{{ asset('img/'.$keranjangs->photo) }}" alt="Image" class="img-fluid" width="150">
                        </td>
                        <td class="product-name">
                        <h2 class="h5 text-black">{{$keranjangs->barang_id}} <br> {{ $keranjangs->nama_brg }}</h2>
                        </td>
                        <td>Rp. {{ number_format($keranjangs->harga_jual,2,',','.') }} </td>
                        <td>
                            <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="hidden" name="id[]" value="{{ $keranjangs->id }}">
                            <input type="text" name="qty[]" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{ $keranjangs->qty }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                            </div>

                        </td>
                        <?php
                            $total = $keranjangs->harga_jual * $keranjangs->qty;
                            $subtotal = $subtotal + $total;
                        ?>
                        <td>Rp. {{ number_format($total,2,',','.') }}</td>
                        <td><a href="{{ route('keranjang.delete',['id' => $keranjangs->id]) }}" class="btn btn-primary btn-sm">X</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
                
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">Update belanjaan
                    </button>
                <a href="{{ route('index') }}" class="btn btn-primary btn-sm py-3 btn-block" >Belanja Lagi</a>

              </div>
        </form>       
        </div>
    </div>
        <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
            <div class="col-md-7">
            <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Total Belanja</h3>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                <strong class="text-black">Rp. {{ number_format($subtotal,2,',','.') }}</strong>
                </div>
            </div>

              <div class="col-md-12">
                <a href="{{ route('keranjang.checkout') }}" class="btn btn-primary btn-lg py-3 btn-block" >Checkout</a>
                <small>Jika Merubah Quantity Pada Keranjang Maka Klik Update Keranjang Dulu Sebelum Melakukan Checkout</small>
              </div>
          </div>
            </div>
        </div>
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