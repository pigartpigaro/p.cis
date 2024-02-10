@extends('template.main')
@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Edit Satuan Produk</h1>
</div>

<div class="container justify-content-center mt-5" style="width:50%" >
    <form action="/satuan/{{ $satuan->id }}" class="form-container p-2" method="post">
        @method('put')
        @csrf
        <div class="form-floating mb-3">
            <input type="text" name="nama" class="form-control rounded @error ('nama') is-invalid @enderror" id="nama" placeholder="Nama" required autofocus value="{{ old('nama', $satuan->nama) }}">
            <label for="nama">Nama</label>
            @error ('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
</div>

@endsection