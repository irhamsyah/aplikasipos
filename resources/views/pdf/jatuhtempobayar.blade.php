<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Laporan Jatuh Tempo Bayar</title>
</head>
<style>
.page {
        overflow: hidden;
        page-break-after: auto;
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
    <?php 
    if(isset($cari) && isset($lama) && count($cari)>0 && count($lama)>0){
   ?>
    <div class="container-lg batasatas page">
        <h2 style="text-align: center;margin-bottom:20px ">Data Jatuh Tempo</h2>
        <br>
        <div><span>Dari Tanggal </span><span style="margin-left: 24px; margin-right: 5px">:</span> </span> <span style="margin-left: 5px">{{date('d-m-Y',strtotime($lama['tgl_trans1']))}}</span> 
        <span style="margin-left: 200px;">Hingga Tanggal </span> <span style="margin-left: 5px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{date('d-m-Y',strtotime($lama['tgl_trans2']))}}</span>
        </div>
        <table class="display" style="width:100%;">
            <thead>
                <tr class="tabel-faktur">
                    <th class="tabel-faktur">No</th>
                    <th class="tabel-faktur">Nota Pembelian</th>
                    <th class="tabel-faktur">Nama Pemebeli</th>
                    <th class="tabel-faktur">Alamat</th>
                    <th class="tabel-faktur">Jatuh Tempo</th>
                    <th class="tabel-faktur">Total Item</th>
                    <th class="tabel-faktur">Jumlah Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; $no=1; $item=0; ?>
                @foreach($cari as $value)
                <tr class="tabel-faktur">
                <td class="tabel-faktur">{{$no}}</td>
                <td class="tabel-faktur">{{$value->nota}}</td>
                <td class="tabel-faktur">{{$value->nama}}</td>
                <td class="tabel-faktur">{{$value->alamat}}</td>
                <td class="tabel-faktur">{{date('d-m-Y',strtotime($value->tgl_jt_bayar))}}</td>
                <td class="tabel-faktur">{{$value->jumlah_item_trans}}</td>
                <td class="tabel-faktur">{{number_format($value->jumlah_transaksi,2,',','.')}}</td>

                <?php 
                    $total=$total+$value->jumlah_transaksi;
                    $no++;
                    $item=$item+$value->jumlah_item_trans;
                ?>
                </tr>
                @endforeach
                <td></td>
                <td></td>
                <td>Sub total</td>
                <td></td>
                <td></td>
                <td>{{$item}} </td>

                <td>{{number_format($total,2,',','.')}}</td>
            </tbody>
    
        </table>
    </div>
    <?php
    }
    ?>
</body>
</html>