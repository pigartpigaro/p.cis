@extends('template.main')
@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Tambah Satuan Produk</h1>
</div>

<div class="container justify-content-center mt-5" style="width:50%" >
  <form action="/produk/{{ $produk->id }}" class="form-container p-2" method="post">
    @method('put')
      @csrf
      <div class="form-floating mb-3">
        <input type="text" name="nama" class="form-control rounded @error ('nama') is-invalid @enderror" id="nama" placeholder="Nama" required autofocus value="{{ old('nama', $produk->nama) }}">
        <label for="nama">Nama</label>
        @error ('nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-floating mb-3">
        <input type="text" name="harga" class="form-control rounded @error ('harga') is-invalid @enderror" id="harga" placeholder="Harga" required autofocus value="{{ old('harga', $produk->harga) }}">
        <label for="harga">Harga</label>
        @error ('harga')
          <div class="invalid-feedback">
            Harap diisi dengan Angka
          </div>
        @enderror
      </div>
      <div class="form-floating mb-3" >
        {{-- <label for="kategori" class="form-label">Kategori</label> --}}
        <select name="kategori_id" class="form-select  @error ('kategori_id') is-invalid @enderror" style="height: 60px" placeholder="Kategori_id" required>
          
          <option selected disabled>-</option>
          @foreach ($kategoris as $kategori)
            @if(old('kategori_id') == $kategori->id)
              <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                @else
              <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endif
          @endforeach
        </select>
        <label>Pilih Kategori</label>
        <div class="invalid-feedback">
          Harap Dipilih.
        </div>
      </div>
      <div class="form-floating mb-3">
        {{-- <label for="satuan" class="form-label">Satuan</label> --}}
        <select name="satuan_id" class="form-select @error ('satuan_id') is-invalid @enderror" style="height: 60px" required>
          <option selected disabled>-</option>
          @foreach ($satuans as $satuan)
            @if(old('satuan_id') == $satuan->id)
              <option value="{{ $satuan->id }}" selected>{{ $satuan->nama }}</option>
                @else
              <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
            @endif
          @endforeach
        </select>
        <label>Pilih Satuan</label>
        <div class="invalid-feedback">
          Harap Dipilih.
        </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">SIMPAN</button>
      </div>
  </form>  
</div>


{{-- <script>

    var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e)
        {
            harga.value = formatRupiah(this.value, 'Rp. ');
        });
        
        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    
</script> --}}

@endsection