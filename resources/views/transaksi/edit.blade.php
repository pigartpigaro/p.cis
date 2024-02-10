@extends('template.main')
@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Transaksi Baru</h1>
</div>


<head>
    <div class="klik fs-6 mb-2">
      <a href="/order" class="btn" type="button" style="width: 90px; height: 40px">
        <span data-feather="arrow-left-circle" class="text-primary" style="width: 25px; height: 25px">
        </span> Back
      </a>
    </div>
    
<div class="row mt-2 ml-4">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <table>
          <tr>
            <td>Pelanggan</td>
            <td>: {{ $pelanggan->nama }}</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>: {{ $pelanggan->alamat }}</td>
          </tr>
          <tr>
            <td>No. Telp</td>
            <td>: {{ $pelanggan->nohp }}</td>
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
<div class="klik fs-6 mt-3 mb-2 ml-2" href="/order/create" >
  <a class="btn" data-bs-toggle="modal" data-bs-target="#modalProduk" data-bs-whatever="@post" style="width: 190px; height: 40px" type="button">Tambah Rincian
    <span data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px">
    </span>
  </a>
</div>

{{-- Border --}}
{{-- <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
</div> --}}

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
    <tr class="space" style="height:0.2px" ><th style="background-color:white" > </th></tr>
  </thead>
  <tbody>
    @foreach ($transaksirinci as $trans)
    <tr>
      <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $trans->produk? $trans->produk->nama:'Not Found' }}</td>
            <td>{{ $trans->kuantitas }}</td>
            <td style="text-align: right">{{ format_uang ($trans->produk? $trans->produk->harga:'Not Found') }}</td>
            <td style="text-align: right">{{ format_uang ($trans->subtotal) }} </td>
      <td>
        <form action="/orderrinci/{{ $trans->id }}/delete" method="post" class="d-inline">
          @csrf
          @method('delete')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Anda ingin Menghapus Data?')"> <span data-feather="trash-2"></span></button>
         </form>
      </td>
    </tr> 
    @endforeach
  </tbody>
</table>


{{-- tampilkan Modal Produk --}}
<div class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="xmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="xmodalLabel">Pilih Rincian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input" style="width: 205%">
          <i class="bi" data-feather="search"></i>
          <input type="text" id="myInput" placeholder="Cari Layanan Disini.." title="Type in a name" onkeyup="myFunction()">
        </div>

        {{-- Tabel Submit --}}
       
        
        {{-- <form class="form-produk" method="POST" action="/orderrinci">
          @csrf
          <div class="container justify-content-center ml-1">
            <div class="form-group row mt-2">
              <div class="col-auto">
                <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi_id }}">
                <input type="hidden" name="id" id="produk_id">
                <input type="text" name="nama" class="form-control" id="nama_produk" placeholder="Layanan" readonly>
              </div>
              <div class="col-3">
                <input type="number" name="kuantitas" class="form-control"  placeholder="Kuantitas" required>
              </div>
              <div class="col-3">
                <input type="number" name="harga" id="harga_produk" class="form-control" placeholder="Harga" readonly>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary" onclick="tambahProduk()" >Submit</button>
              </div>
            </div>
          </div>
        </form> --}}

        <table class="table table-striped table-bordered table-produk" id="cari">
          <thead>
            <th>No</th>
            <th>Layanan</th>
            <th>Harga</th>
            {{-- <th>Kuantitas</th> --}}
            <th>Aksi</th>
          </thead>
          <tbody>
            @foreach ($produk as $key => $item) 
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
{{-- gak muncul --}}
{{-- <div class="d-flex justify-content-center mt-3">
    {{ $produks->links() }}
</div> --}}
  

</div>
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible col-lg-3" role="alert" id="myAlert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    @endif
{{-- <div class="d-flex justify-content-center mt-3">
  {{ $produks->links() }}
</div> --}}

</head>

@endsection


@push('scripts')
    


<script>
  // let table;
  // $(function(){
  //   table = $('.table-rinci').DataTable({
  //     responsive: true,
  //     processing: true,
  //     serverSide: true,
  //     autoWidth: false,
  //     ajax: {
  //       ,
  //     },
  //     columns: [
  //       {data: 'DT_RowIndex', searchable: false, sortable: false},
  //       {data: 'nama'},
  //       {data: 'kuantitas'},
  //       {data: 'harga'},
  //       {data: 'subtotal'},
  //       {data: 'aksi', searchable: false, sortable: false},
  //     ]
  //   });
  // });

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
    
    
    // tambahProduk();
  }

  function tambahProduk(){
    
    $.post('{{ route('orderrinci.store') }}', $('.form-produk').serialize())
      .done(response => {
        $('#nama_produk').focus();
      })
      .fail(errors =>{
        alert('Tidak dapat Menyimpan Data');
        return;
      });
      hideProduk();
  }
</script>

@endpush