@extends('template.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Transaksi</h1>
</div>
<div class="klik fs-6">
    <a href="/order" class="btn" type="button" style="width: 90px; height: 40px">
      <span data-feather="arrow-left-circle" class="text-primary" style="width: 25px; height: 25px">
      </span> Back
    </a>
</div>

<header>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="h5" style="font-weight: bold">Transaksi Laundry</h1>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="h6">No : {{ $transaksi->no_nota }}</h1>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="h6">{{ $transaksi->tanggal }}</h1> <h1 class="h6 ml-2">{{ $transaksi->time }}</h1>
    </div>
    <a target="_blank" href="/order/cetak/{{ $transaksi->id }}" class="btn" type="button" style="width: 200px; height: 40px">
      <span data-feather="printer" class="text-primary mr-3" style="width: 25px; height: 25px">
      </span>CETAK NOTA
    </a>
    <div class="d-flex justify-content-between align-items-center mt-2">
        <h1 class="h6">Nama : {{ $transaksi->pelanggan? $transaksi->pelanggan->nama:'Not Found' }}</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h6">Telp : {{ $transaksi->pelanggan? $transaksi->pelanggan->nohp:'Not Found' }}</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h6">Alamat : {{ $transaksi->pelanggan? $transaksi->pelanggan->alamat:'Not Found' }}</h1>
    </div>
</header>



<table id="myTable" class="mt-3">
    <thead>
        <tr>
          <th style="width:5%">No</th>
          <th style="width:15%">Layanan</th>
          <th style="width:7%">Kuantitas</th>
          <th style="width:15%">Harga</th>
          <th style="width:15%">Jumlah</th>
        </tr>
        <tr class="space" style="height:0.1px" ><th style="background-color:white" > </th></tr>
      </thead>
      <tbody id="body">
        @foreach ($transaksirinci as $trans)
          <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $trans->produk? $trans->produk->nama:'Not Found' }}</td>
            <td>{{ $trans->kuantitas }}</td>
            <td style="text-align: right">{{ format_uang ($trans->produk? $trans->produk->harga:'Not Found') }}</td>
            <td style="text-align: right">{{ format_uang ($trans->subtotal) }} </td>
          </tr> 
        @endforeach
        </tbody>
</table>
<table id="myTable" class="mb-5">
  <tr class="space" style="height:0.1px" ><th style="background-color:white" > </th></tr>
  <tr>
    <th style="width: 75%">TOTAL</th>
    <th style="text-align: right">{{ format_uang ($trans->transaksi? $trans->transaksi->total:'Not Found') }}</th>
  </tr>
</table>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#body tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>