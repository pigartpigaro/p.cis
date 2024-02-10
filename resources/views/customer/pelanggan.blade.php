@extends('template.main')
@section('container')

{{-- <script src="/js/alert.js"></script> --}}

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Pelanggan</h1>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">
    <form action="/pelanggan">
      <div class="input-group mb-2">
        <input type="text" class="form-control" placeholder="Cari disini.." name="search" value="{{ request('search') }}">
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

<div class="klik fs-6 mb-2">Tambah Pelanggan <button class="btn" data-bs-toggle="modal" data-bs-target="#form" data-bs-whatever="@post" style="width: 50px; height: 50px" type="button"><span data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px"></span> </button>
</div> 


<div class="modal fade" id="form" tabindex="-1" aria-labelledby="xmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="xmodalLabel">Tambah Pelanggan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form action="/pelanggan" class="form-container p-2" method="post">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" name="nama" class="form-control rounded @error ('nama') is-invalid @enderror" id="nama" placeholder="Nama" required autofocus>
                  <label for="nama">Nama</label>
                  @error ('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-floating mt-3 mb-3">
                  <input type="text" name="alamat" class="form-control rounded @error ('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" require="">
                  <label for="alamat">Alamat</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                  <input type="text" name="nohp" class="form-control rounded @error ('nohp') is-invalid @enderror" id="nohp" placeholder="NoHP" required autofocus>
                  <label for="nohp">Nomor HP</label>
                  @error ('nohp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save">SIMPAN</button>
                </div>
            </form>  
        </div>     
      </div>
    </div>
</div>



<div class="container mb-3">
  @if($pelanggan->count())
  
    <table id="myTable">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th>Nama</th>
            <th style="width:40%">Alamat</th>
            <th>No. HP</th>
            <th style="width:10%">Aksi</th>
          </tr>
          <tr class="space" style="height:0.2px" ><th style="background-color:white" > </th></tr>
        </thead>
        <tbody>
        @foreach ($pelanggan as $cp)
          <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $cp->nama }}</td>
            <td>{{ $cp->alamat }}</td>
            <td>{{ $cp->nohp }}</td>
            <td style="text-align: center">
              {{-- <a href="/pelanggan/{{ $cp->id }}/edit" data-bs-toggle="modal" data-bs-target="#formedit" class="btn btn-sm btn-info"><i data-feather="edit"></i><a> --}}
              <a href="/pelanggan/{{ $cp->id }}/edit" class="btn btn-sm btn-info"><i data-feather="edit"></i><a>
              @csrf
              |
              <form action="/pelanggan/{{ $cp->id }}" method="post" class="d-inline">
               @csrf
               @method('delete')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Anda ingin Menghapus Data?')"> <span data-feather="trash-2"></span></button>
              </form>
              {{-- <a href="/pelanggan/hapus{{ $cp->id }}" class="btn btn-sm btn-danger"><i ></i></a> --}}
            </td>
          </tr> 
        @endforeach
        </tbody>
        
    </table>
    @else
      <p class="text-center fs-4">Belum Ada data</p>
  @endif
</div>

<div class="d-flex justify-content-center mt-3">
{{ $pelanggan->links() }}
</div>




@endsection

