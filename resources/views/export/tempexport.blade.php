<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Sales Total</title>
    </head>
    <body>
    <table>
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Transaksi</th>
        <th>Kuantitas</th>
        <th>Tanggal Transaksi</th>
        <th>Nota</th>


    </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
    @foreach($transaksi as $value)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $value->barang_id }}</td>
            <td>{{ $value->nama_brg }}</td>
            <td>{{ $value->jumlah_transaksi }}</td>
            <td>{{ $value->jumlah_item_trans }}</td>
            <td>{{ $value->tgl_trans }}</td>
            <td>{{ $value->nota }}</td>
            <?php $no++; ?>
        </tr>
    @endforeach
    </tbody>
</table>

    </body>
</html>