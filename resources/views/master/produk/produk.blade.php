@extends('template.main')
@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Produk</h1>
</div>

<div class="row justify-content-center">
  <div class="col-md-6">
    <form action="/produk">
      @if (request('kategori'))
          <input type="hidden" name="kategori" value="{{ request('kategori') }}">
      @endif
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

<div class="klik fs-6 mb-2">Tambah Produk
    <a href="/produk/create" class="btn" style="width: 50px; height: 40px" type="button">
      <span data-feather="plus-circle" class="align-middle text-primary" style="width: 25px; height: 25px">
      </span>
    </a>
</div>

<div class="container mb-3">
  @if($produk->count())
  
    <table id="myTable">
        <thead>
          <tr>
            <th style="width:5%">No</th>
            <th>Nama</th>
            <th style="width:20%">Harga</th>
            <th>Satuan</th>
            <th style="width:20%">Kategori</th>
            <th style="width:10%">Aksi</th>
          </tr>
          <tr class="space" style="height:0.2px" ><th style="background-color:white" > </th></tr>
        </thead>
        <tbody>
        @foreach ($produk as $p)
          <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td style="text-align: right">{{ format_uang ($p->harga) }}</td>
            <td>{{ $p->satuan? $p->satuan->nama:'Not Found' }}</td>
            <td>{{ $p->kategori? $p->kategori->nama:'Not Found'}}</td>
            <td style="text-align: center">
              {{-- <a href="/pelanggan/{{ $cp->id }}/edit" data-bs-toggle="modal" data-bs-target="#formedit" class="btn btn-sm btn-info"><i data-feather="edit"></i><a> --}}
              <a href="/produk/{{ $p->id }}/edit" class="btn btn-sm btn-info"><i data-feather="edit"></i><a>
              @csrf
              |
              <form action="/produk/{{ $p->id }}" method="post" class="d-inline">
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
{{ $produk->links() }}
</div>
@endsection