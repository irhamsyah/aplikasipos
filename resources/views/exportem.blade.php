<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Transaksi</title>
    </head>
    <body>
    <table>
    <thead>
    <tr>
        <th>Nama Barang</th>
        <th>Jumlah Transaksi</th>
        <th>Tanggal Transaksi</th>

    </tr>
    </thead>
    <tbody>
    @foreach($transaksi as $value)
        <tr>
            <td>{{ $value->nama_brg }}</td>
            <td>{{ $value->jumlah_trannsaksi }}</td>
            <td>{{ $value->tgl_trans }}</td>
        </tr>
    @endforeach
    </tbody>
</table

>


    </body>
</html>