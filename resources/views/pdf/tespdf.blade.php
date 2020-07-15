<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Pembelian Barang</title>
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> -->

</head>
<body>
    testis
    @foreach($faktur as $value)
        {{$value->nama_brg}}
    @endforeach
</body>
</html>