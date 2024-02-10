<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equive="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static{
            position: relative;
            border: 1px solid #ffffff;
            margin-top: 3mm;
            font-size: small;
            font-family: Tahoma;
        }
        img{
            margin-top: 2mm;
            margin-bottom: 2mm;
        }
        p.p1{
            margin-top: 5mm;
            font-size: small;
            font-family: Tahoma;
        }
        p{
            margin-top: 1mm;
            margin-bottom: 1mm;
            font-size: small;
            font-family: Tahoma;
        }
        h3{
            margin-top: 1mm;
            margin-bottom: 1mm;
            font-size: small;
            font-family: Tahoma;
        }
        h4.a{
            margin-top: 5%;
            font-size: small;
            font-family: Tahoma;
        }
        h4{
            margin-top: 1mm;
            margin-bottom: 1mm;
            font-size: small;
            font-family: Tahoma;
        }
        table.total{
            position: relative;
            border: 1px solid #ffffff;
            margin-top: 5mm;
            font-weight: bolder;
            font-family: Tahoma;
            font-size: small;
        }
    </style>
    <title>Powered by Nami Laundry</title>
</head>


<body align="center">
    <div class="form-group">
        
        <img src="/img/LogoNami.svg" width="50px">
        <h3 align="center"><b>NAMI LAUNDRY</b></h3>
        <h3><b>WA 082324141494</b></h3>
        <h3 align="center"><b>Nota : {{ $transaksi->no_nota ?? '' }}</b></h3>
        <h3 align="center"><b>Tanggal {{ $transaksi->tanggal ?? '' }}</b></h3>
        <h3 align="center"><b>Pukul {{ $transaksi->time ?? '' }}</b></h3>
        
        <p style="text-align:left" class="p1" >
            <b>Nama : {{ $transaksi->Pelanggan->nama ?? '' }}</b></p>
        
        <p style="text-align:left">
            <b>Telp : {{ $transaksi->Pelanggan->nohp ?? ''  }}</b></p>
        
        <p style="text-align:left">
            <b>Alamat : {{ $transaksi->Pelanggan->alamat ?? ''  }}</b></p>

        <table class="static" align="center" rules="all" style="width: 100%;">
            <thead>
                <tr>
                  <th style="width:50%">Layanan</th>
                  <th>Jumlah</th>
                </tr>
             </thead>
            <tbody>
                @foreach ($transaksirinci as $trans)
                  <tr>
                    <td>- {{ $trans->produk? $trans->produk->nama:'Not Found' }} | {{ $trans->kuantitas }} x {{ format_uang ($trans->produk? $trans->produk->harga:'Not Found') }}</td>
                    <td style="text-align: right">{{ format_uang ($trans->subtotal) }} </td>
                  </tr> 
                @endforeach
            </tbody>
        </table>
        <table class="total" align="center" rules="all" style="width: 100%;">
            <th>TOTAL</th>
            <th style="text-align: right">{{ format_uang ($transaksi->total ?? '') }}</th>
        </table>
        <h4 class="a" align="center">Thanks for Order</h4>
        <h4>v For Transfer v</h4>
        <h4 align="center">BCA 0391408148</h4>
        <h4 align="center">JATIM 0126400314</h4>
        <h4 align="center">a.n Vighar Choirul Iqbal</h4>
        <h4 align="center">by NAMI LAUNDRY</h4>
        <h4>.....</h4>
    </div>
</body>
