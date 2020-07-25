<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Faktur Pembelian Barang</title>
</head>
<style>
body{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 500;
    font-size: 25px;
    }
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
<body>
    <?php 
        $nota="";
        $nama="";
        $alamat="";
        if(count($faktur)>0){
            $nota=$faktur[0]->nota;
            $nama=$faktur[0]->nama;
            $alamat=$faktur[0]->alamat;
            $discount=$faktur[0]->discount;
    ?>
    <?php 

	// FUNGSI TERBILANG OLEH : MALASNGODING.COM
	// WEBSITE : WWW.MALASNGODING.COM
	// AUTHOR : https://www.malasngoding.com/author/admin


    function penyebut($nilai) 
    {

		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

    ?>
    <div class="container-lg batasatas page">
        <span>
            <img src="{{asset('img/logofaktur.jpg')}}" alt="">   
        <br> Mojo Frozen Food
        </span>

        <h3 style="text-align: center;margin-bottom:20px ">Faktur Penjualan</h3>
        <br>
        <div><span>No Transaksi</span><span style="margin-left: 24px; margin-right: 5px">:</span> </span> <span style="margin-left: 5px">{{$nota}}</span> 
        <span style="margin-left: 100px;">Pelanggan  </span> <span style="margin-left: 5px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$nama}}</span>
        </div>
        <div><span>Tanggal </span> <span style="margin-left: 55px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{date('d-m-Y')}}</span> <br>
        <span>Alamat </span> <span style="margin-left:60px">:</span><span style="margin-left: 12px">{{$alamat}}</span>
            <br>
        <span>Discount </span> <span style="margin-left:50px">:</span><span style="margin-left: 12px">{{$discount}}</span><span>%</span>

        </div>
        {{$nama}}{{$alamat}}
        @if(!is_null($faktur[0]->tgl_jt_bayar))
        <div><span>Tanggal JT</span> <span style="margin-left: 38px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{date('d-m-Y', strtotime($faktur[0]->tgl_jt_bayar))}}</span> </div>
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
                <td class="tabel-faktur">{{$value->qty}}</td>
                <?php 
                    $total=$total+$value->jumlah_transaksi;
                    $no++;
                    $item=$item+$value->qty;
                ?>
                <td class="tabel-faktur">{{number_format($value->harga_jual,2,',','.')}}</td>
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
            <h6>
                <span>Terbilang : </span>
        <?php 
            echo terbilang($total)." rupiah";
        ?>
        </h6>
        <br>
            <span>BCA :</span> <span style="margin-left: 600px"> Hormat Kami</span>  <br>
            <br><span>IFANI PURWANDARI</span>  <br>
            <span>0501815101</span> 
    
    </div>
    <!----Halaman report SURAT JALAN----------->
    <div class="container-lg batasatas page">
        <span>
            <img src="{{asset('img/logofaktur.jpg')}}" alt="">   
        <br> Mojo Frozen Food
        </span>

        <h3 style="text-align: center;margin-bottom:20px ">Surat Jalan</h3>
<br>
    <div><span>Nomor Dokumen</span><span style="margin-left: 24px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$nota}}</span> <span style="margin-left:130px">Tanggal </span> <span>:</span><span>{{date('d-m-Y')}}</span></div>
        <div><span>Nama Penerima</span> <span style="margin-left: 27px; margin-right: 5px">:</span> <span style="margin-left: 5px">{{$nama}}</span> </div>
        <div><span>Alamat Penerima</span> <span style="margin-left:24px">:</span><span style="margin-left: 12px">{{$alamat}}</span> </div>
        <br>
        <table class="display" style="width:100%;">
            <thead>
                <tr class="tabel-faktur">
                    <th class="tabel-faktur">Kode Produk</th>
                    <th class="tabel-faktur">Nama Produk</th>
                    <th class="tabel-faktur">Jumlah Isi</th>
                    <th class="tabel-faktur">Package (pack/karton)</th>
                    <th class="tabel-faktur">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0;$totalqty=0; ?>
                @foreach($suratjalan as $value)
                <tr class="tabel-faktur">
                    <td class="tabel-faktur">{{$value->barang_id}}</td>
                    <?php 
                    $totalisisatuan=$value->qty*$value->isi_persatuan;
                    $total=$total+$totalisisatuan;
                    $totalqty=$totalqty+$value->qty
                    ?>
                    <td class="tabel-faktur">{{$value->nama_brg}}</td>
                    <td class="tabel-faktur">{{$totalisisatuan}}</td>
                    <td class="tabel-faktur">{{$value->qty}}</td>
                    <td class="tabel-faktur"></td>

                </tr>
                @endforeach
                <td></td>
                <td>Total Item</td>
                <td>{{number_format($total,2,',','.')}}</td>
                <td>{{number_format($totalqty,2,',','.')}}</td>

            </tbody>
    
        </table>
        <div>
            Perhatian <br>
            <span>1.</span><span>Surat Jalan ini merupakan bukti resmi penerimaan barang</span><br>
            <span>2.</span><span>Surat Jalan ini bukan pelunasan</span><br>
            <span>3.</span><span>Surat Jalan ini akan dilengkapi invoice sebagai bukti penjualan</span><br><br>
            <span>BARANG SUDAH DITERIMA DALAM KEADAAN BAIK DAN CUKUP, OELH :</span><br>
            {{date('d-m-Y')}} <br><br>
            <span>Peneriman / Pembeli</span> <span style="margin-left:200px;">Bagian Pengiriman</span>


        </div>
    </div>
    <?php
    }
    ?>
</body>
</html>