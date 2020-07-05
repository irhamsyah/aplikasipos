<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Faktur Pembelian Barang</title>
</head>
<style>
.page {
        overflow: hidden;
        page-break-after: always;
        /* page-break-after: always; */
        page-break-inside: avoid;

    }
.batasatas{
        margin-left: 50px ;
        padding: 50px;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}
.tabel-faktur{

  border: solid 1px;
}
</style>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<body>
    <div class="container-lg batasatas page">
        <h3 style="text-align: center;margin-bottom:20px ">Faktur Penjualan</h3>
        <br>
        <div><span>No Transaksi</span><span style="margin-left: 24px; margin-right: 5px">:</span> </span> <span style="margin-left: 5px">{{$faktur[0]->nota}}</span> 
        <span style="margin-left: 200px;">Pelanggan  </span> <span style="margin-left: 5px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$faktur[0]->nama}}</span>
        </div>
        <div><span>Tanggal </span> <span style="margin-left: 55px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{date('d-m-Y')}}</span> 
        <span style="margin-left: 250px;">Alamat </span> <span style="margin-left:5px">:</span><span style="margin-left: 12px">{{$faktur[0]->alamat}}</span>
        </div>
        <!-- <div><span>Pelanggan  </span> <span style="margin-left: 5px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$faktur[0]->nama}}</span> </div> -->
        <!-- <div> <span>Alamat </span> <span style="margin-left:58px">:</span><span style="margin-left: 12px">{{$faktur[0]->alamat}}</span> </div> -->
        @if(!is_null($faktur[0]->tgl_jt_bayar))
        <div><span>Tanggal JT</span> <span style="margin-left: 30px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{date('d-m-Y', strtotime($faktur[0]->tgl_jt_bayar))}}</span> </div>
        @endif
        <br>

        <table class="display" style="width:100%;">
            <thead>
                <tr class="tabel-faktur">
                    <th class="tabel-faktur">No</th>
                    <th class="tabel-faktur">Nama Item</th>
                    <th class="tabel-faktur">Pack</th>
                    <th class="tabel-faktur">Harga Barang</th>
                    <th class="tabel-faktur">Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; $no=1; $item=0; ?>
                @foreach($faktur as $value)
                <tr class="tabel-faktur">
                <td class="tabel-faktur">{{$no}}</td>
                <td class="tabel-faktur">{{$value->nama_brg}}</td>
                <td class="tabel-faktur">{{$value->jumlah_item_trans}}</td>
                <?php 
                    $total=$total+$value->jumlah_transaksi;
                    $harga_brg=$value->jumlah_transaksi/$value->jumlah_item_trans;
                    $no++;
                    $item=$item+$value->jumlah_item_trans;
                ?>
                <td class="tabel-faktur">{{number_format($harga_brg,2,',','.')}}</td>
                <td class="tabel-faktur">{{number_format($value->jumlah_transaksi,2,',','.')}}</td>
                </tr>
                @endforeach
                <td></td>
                <td></td>
                <td>{{$item}} </td>

                <td>Sub total</td>
                <td>{{number_format($total,2,',','.')}}</td>

            </tbody>
    
        </table>
    
    </div>
    <!----Halaman report surat jalan----------->
    <div class="container-lg batasatas page">
        <h3 style="text-align: center;margin-bottom:20px ">Surat Jalan</h3>
<br>
    <div><span>Nomor Dokumen</span><span style="margin-left: 24px; margin-right: 5px">:</span> </span> <span style="margin-left: 5px">{{$faktur[0]->nota}}</span> <span style="margin-left:300px">Tanggal </span> <span>:</span>{{date('d-m-Y')}}</div>
        <div><span>Nama Penerima</span> <span style="margin-left: 27px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$faktur[0]->nama}}</span> </div>
        <div><span>Alamat Penerima</span> <span style="margin-left:24px">:</span><span style="margin-left: 12px">{{$faktur[0]->alamat}}</span> </div>
        <br>
        <table class="display" style="width:100%;">
            <thead>
                <tr class="tabel-faktur">
                    <th class="tabel-faktur">Kode Produk</th>
                    <th class="tabel-faktur">Nama Produk</th>
                    <th class="tabel-faktur">Kuantitas</th>
                    <th class="tabel-faktur">Unit</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; ?>
                @foreach($faktur as $value)
                <tr class="tabel-faktur">
                    <td class="tabel-faktur">{{$value->barang_id}}</td>
                    <?php 
                    $total=$total+$value->jumlah_item_trans;
                ?>
                    <td class="tabel-faktur">{{$value->nama_brg}}</td>
                    <td class="tabel-faktur">{{$value->jumlah_item_trans}}</td>
                    <td class="tabel-faktur">{{$value->nama_satuan}}</td>
                </tr>
                @endforeach
                <td></td>
                <td>Total Item</td>
                <td>{{number_format($total,2,',','.')}}</td>
            </tbody>
    
        </table>
    
    </div>

</body>
</html>