@extends('template.main')

@push('css')
    <style>
      .tampil-bayar{
        font-size: large;
        text-align: center;
        height: 100px;
      }
      .tampil-terbilang{
        padding: 10px;
        background: #f0f0f0;
      }
    </style>
@endpush

@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
  <h1 class="h4">Transaksi Baru</h1>
</div>

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible col-lg-3" role="alert" id="myAlert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<head>
  <div class="klik fs-6 mb-2">
    <a href="/order" class="btn" type="button" style="width: 90px; height: 40px">
      <span data-feather="arrow-left-circle" class="text-primary" style="width: 25px; height: 25px">
      </span> Back
    </a>
  </div>
    
  <div class="form-group row mt-2 ml-4">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <table>
            <tr>
              <th style="width: 25%">Pelanggan : {{ $pelanggan->nama }}</th>
            </tr>
            <tr>
              <th style="width: 45%">Alamat : {{ $pelanggan->alamat }}</th>
            </tr>
            <tr>
              <th style="width: 30%">No. Telp : {{ $pelanggan->nohp }}</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- <form class="form-produk">
    @csrf
    <div class="form-group row mt-2">
      <label for="produk_id" class="col-auto ml-5 mt-2">Tambah Produk</label>
      <div class="col-lg-2">
        <div class="input-group">
          <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi_id }}">
          <input type="text" class="form-control" name="nama" id="produk_id">
            <span class="input-group-btn ml-3 mt-2">
              <button onclick="tampilProduk()" data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px"></button>
            </span>
        </div>
      </div>
    </div>
  </form> --}}
  <div class="klik fs-6 mt-3 ml-3" href="/order/create" >
    <a class="btn ml-4" data-bs-toggle="modal" data-bs-target="#modalProduk" data-bs-whatever="@post" style="background: rgb(255, 217, 0)" type="button">Tambah Layanan
      <span data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px">
      </span>
    </a>
  </div>

  <form class="form-produk" action="{{ route('orderrinci.store') }}">
    @csrf
    <div class="container justify-content-center ml-2">
      <div class="form-group row ml-1 mt-3">
        <div class="col-auto">
          <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi_id }}">
          <input type="hidden" name="id" id="produk_id">
          <input type="text" name="nama" class="form-control" id="nama_produk" placeholder="Layanan" readonly>
        </div>
        <div class="col-auto">
          <input type="text" name="kuantitas" class="form-control"  placeholder="Kuantitas" required>
        </div>
        <div class="col-auto">
          <input type="number" name="harga" id="harga_produk" class="form-control" placeholder="Harga" readonly>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary" onclick="tambahProduk()" >Submit</button>
        </div>
      </div>
    </div>
  </form>
<div class="table ">
  {{-- Tabel Transaksi --}}
  <table id="myTable" class="table-rinci">
    <thead>
      <tr>
        <th style="width:5%">No</th>
        <th >Layanan</th>
        <th style="width:10%">Kuantitas</th>
        <th >Harga</th>
        <th >Jumlah</th>
        <th style="width:15%">Aksi</th>
      </tr>
      {{-- <tr class="space" style="height:0.2px" ><th style="background-color:white" > </th></tr> --}}
    </thead>
    {{-- <tbody>
      @foreach ($transaksirinci as $trans)
      <tr>
        <td style="text-align: center">{{ $loop->iteration }}</td>
        <td>{{ ($trans->produk? $trans->produk->nama:'Not Found') }}</td>
        <td style="text-align: right">{{ $trans->kuantitas }}</td>
        <td style="text-align: right">{{ format_uang($trans->produk? $trans->produk->harga:'Not Found') }}</td>
        <td style="text-align: right">{{ format_uang($trans->subtotal) }} </td>
        <td>
          <form action="/order/{{ $trans->id }}" method="post" class="d-inline">
            @csrf
            @method('delete')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Anda ingin Menghapus Data?')"> <span data-feather="trash-2"></span></button>
          </form>
        </td>
      </tr> 
      @endforeach
    </tbody> --}}
  </table>
</div>
  <div class="form-group row">
    <div class="col-lg-8">
      <div class="tampil-bayar bg-primary" style="color: #f0f0f0">
        {{ format_uang ($trans = ['total'])  }}
      </div>
      <div class="tampil-terbilang"></div>
    </div>
    
      <a target="_blank" href="{{ route('orderrinci.cetak', $transaksi_id) }}" class="btn" type="button" style="width: 200px; height: 40px">
        <span data-feather="printer" class="text-primary mr-3" style="width: 25px; height: 25px">
        </span>CETAK NOTA
      </a>
  </div>
  



  {{-- tampilkan Modal Produk --}}
  <div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="xmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="xmodalLabel">Pilih Rincian</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-2">
                    <input id="cariModal" type="text" class="form-control" placeholder="Cari disini.." name="search">
                    <button class="btn btn-warning" type="submit">Cari</button>
                </div>
            </div>
        </div>

            <table class="table table-striped table-bordered table-produk" id="cari">
              <thead>
                <th>No</th>
                <th>Layanan</th>
                <th>Harga</th>
                {{-- <th>Kuantitas</th> --}}
                <th>Aksi</th>
              </thead>
              <tbody id="bodyModal">
                @foreach ($produks as $key => $item) 
                <form class="form-produk" action="/orderrinci" method="post">
                  @csrf
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ format_uang($item->harga) }}</td>
                    {{-- <td>
                      <input type="number" name="kuantitas{{ $item->id }}" class="form-control"  placeholder="Kuantitas" id="{{ $item->id }}" >
                    </td> --}}
                    <td>
                      <a class="btn btn-primary btn-xs btn-flat" id="select" onclick="pilihProduk('{{ $item->id }}','{{ $item->nama }}','{{ $item->harga }}')">
                        <i class="fa fa-check-circle"></i>
                        Pilih
                      </a>
                    </td>
                  </tr>
                </form>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</head>



@endsection

@push('scripts')

<script>
  $(document).ready(function(){
    $("#cariModal").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#bodyModal tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


  let table1;
  $(function(){
    table = $('.table-rinci').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      autoWidth: false,
      ajax: {
        url: '{{ route('orderrinci.data', $transaksi_id) }}',
      },
      columns: [
        {data: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'nama'},
        {data: 'kuantitas'},
        {data: 'harga'},
        {data: 'subtotal'},
        {data: 'aksi', searchable: false, sortable: false},
      ],
      dom: 'Brt',
      bSort: false,
    });
  });

  function tampilProduk() {
    $('#modalProduk').modal('show')
  }

  function hideProduk() {
    $('#modalProduk').modal('hide')
  }

  function pilihProduk(id, nama, harga) {
    $('#produk_id').val(id);
    $('#nama_produk').val(nama);
    $('#harga_produk').val(harga);
    
    hideProduk();
    // tambahProduk();
  }

  function tambahProduk(){
    
    $.post('{{ route('orderrinci.store') }}', $('.form-produk').serialize())
      .done(response => {
        $('#nama_produk').focus();
        table.ajax.reload();
      })
      .fail(errors =>{
        alert('Tidak dapat Menyimpan Data');
        return;
      });
  }

  function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    // '_token': $('[name=csrf_token]').attr('content'),
                    '_token': '{{csrf_token()}}',
                  
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
  
</script>
@endpush
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
