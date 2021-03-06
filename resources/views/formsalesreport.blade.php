<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Repor Sales!</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5 class="mt-3">All Transaction</h5>
            </div>
        </div>
        {!!Form::open(['route'=>'cari.sales.report','method'=>'post','files'=>true,'enctype'=>'multipart/form-data']) !!}

        <div class="row">
          <input type="date" name="tgl1">
          <input type="date" name="tgl2">
        </div>
        <br>
        <div class="row">

          <div class="com">
            <button type="submit" class="btn btn-primary btn-sm">Export Excel</button>
          </div>
      </div>

        {!!Form::close()!!}
        <div class="row">
            <div class="col">
                <table class="table table-bordered mt-3">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga Pokok Pokok</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Kuantitas</th>
                        <th scope="col">Transaksi </th>
                        <th scope="col">Tgl Transaksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; ?>
                    @if(isset($transaksi))
                    @foreach($transaksi as $value)
                      <tr>
                      <th scope="row">{{$no}}</th>
                      <td>{{$value->barang_id}}</td>
                      <td>{{$value->nama_brg}}</td>
                      <td>{{$value->harga_brg}}</td>
                      <td>{{$value->harga_jual}}</td>
                      <td>{{$value->discount}}</td>
                      <td>{{$value->jumlah_item_trans}}</td>
                      <td>{{$value->jumlah_transaksi}}</td>
                      <td>{{$value->tgl_trans}}</td>
                      </tr>
                      <?php $no++; ?>
                    @endforeach
                    @endif
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>