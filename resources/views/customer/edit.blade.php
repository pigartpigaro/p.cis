@extends('template.main')
@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Edit Pelanggan</h1>
</div>

<div class="container justify-content-center mt-5" style="width:50%" >
    <form action="/pelanggan/{{ $pelanggan->id }}" class="form-container p-2" method="post">
        @method('put')
        @csrf
          <div class="form-floating mb-3">
            <input type="text" name="nama" class="form-control rounded @error ('nama') is-invalid @enderror" id="nama" placeholder="Nama" required autofocus value="{{ old('nama', $pelanggan->nama) }}">
            <label for="nama">Nama</label>
            @error ('nama')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-floating mt-3 mb-3">
            <input type="text" name="alamat" class="form-control rounded @error ('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" require="" value="{{ old('alamat', $pelanggan->alamat) }}">
            <label for="alamat">Alamat</label>
          </div>
          <div class="form-floating mt-3 mb-3">
            <input type="text" name="nohp" class="form-control rounded @error ('nohp') is-invalid @enderror" id="nohp" placeholder="NoHP" required autofocus value="{{ old('nohp', $pelanggan->nohp) }}">
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

@endsection