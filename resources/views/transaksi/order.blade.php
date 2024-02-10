@extends('template.main')
@section('container')


<body>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Transaksi</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/order">
            <div class="input-group mb-2">
                <input id="cari" type="text" class="form-control" placeholder="Cari disini.." name="search">
                <button class="btn btn-warning" type="submit">Cari</button>
            </div>
            </form>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible col-lg-3" role="alert" id="myAlert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{-- <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> --}}
    </div>
    @endif

    <div class="klik fs-6 mb-3">
      <a href="/order/create" class="btn ml-3" data-bs-toggle="modal" data-bs-target="#modalOrder" data-bs-whatever="@post" style="background: rgb(255, 217, 0)" type="button">Pilih Pelanggan
        <span data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px">
        </span>
      </a>
    </div>

    <div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="xmodalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="xmodalLabel">Tambah Pelanggan</h1>
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
      
            <table class="table table-striped table-bordered">
              <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telp</th>
                <th>Aksi</th>
              </thead>
              <tbody id="bodyModal">
                @foreach ($pelanggan as $key => $trans)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $trans->nama }}</td>
                    <td>{{ $trans->alamat }}</td>
                    <td>{{ $trans->nohp }}</td>
                    <td>
                      <a href="{{ route('order.create', $trans->id) }}" class="btn btn-primary btn-xs btn-flat">
                        <i class="fa fa-check-circle">Pilih</i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="d-flex justify-content-center mt-3">
      {{ $pelanggan->links() }}
    </div> --}}
</body>

<div class="container mb-3">
    
      <table id="myTable">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:10%">No. Nota</th>
              <th style="width:10%">Tanggal</th>
              <th style="width:10%">Waktu</th>
              <th style="width:15%">Pelanggan</th>
              <th style="width:15%">Total</th>
              <th style="width:15%">Aksi</th>
            </tr>
            {{-- <tr class="space" style="height:0.1px" ><th style="background-color:white" > </th></tr> --}}
          </thead>
          <tbody id="body">
          @foreach ($transaksi as $trans)
            <tr>
              <td style="text-align: center">{{ $loop->iteration }}</td>
              <td>{{ $trans->no_nota }}</td>
              <td>{{ $trans->tanggal }}</td>
              <td>{{ $trans->time }}</td>
              <td>{{ $trans->pelanggan? $trans->pelanggan->nama:'Not Found' }}</td>
              <td style="text-align: right">{{ format_uang ($trans->total) }}</td>
              <td style="text-align: center">
                <a href="/order/{{ $trans->id }}" class="btn btn-sm btn-info"><i data-feather="eye"></i><a>
                @csrf
                |
                {{-- <a href="/pelanggan/{{ $cp->id }}/edit" data-bs-toggle="modal" data-bs-target="#formedit" class="btn btn-sm btn-info"><i data-feather="edit"></i><a> --}}
                <a href="/orderrinci" class="btn btn-sm btn-info"><i data-feather="edit"></i><a>
                @csrf
                |
                <form action="/order/{{ $trans->id }}" method="post" class="d-inline">
                 @csrf
                 @method('delete')
                 <button class="btn btn-sm btn-danger" onclick="return confirm('Anda ingin Menghapus Data?')"> <span data-feather="trash-2"></span></button>
                </form>
                {{-- <a href="/order/hapus{{ $cp->id }}" class="btn btn-sm btn-danger"><i ></i></a> --}}
              </td>
            </tr> 
          @endforeach
          </tbody>
          
      </table>
    
</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $("#cari").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#body tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  $(document).ready(function(){
    $("#cariModal").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#bodyModal tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
