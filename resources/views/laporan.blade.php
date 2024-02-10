
@extends('template.main')

@section('container')
  {{-- <h4>Selamat Datang <b>{{Auth::user()->name}}</b>, Anda Login sebagai <b>{{Auth::user()->role}}</b>.</h4> --}}
  <h1>Ayo Ngoding</h1>
  <b>Belajar Route dan View pada Laravel</b>
  <ul>
    <li>Belajar Membuat Route Laravel</li>
    <li>Belajar Membuat View Laravel</li>
    <li>Menampilkan View menggunakan Route Laravel</li>
  </ul>




        <table class="table tabel_laporan" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
        </table>


@endsection
@push('scripts')

<script>
    $(function() {
        $('.tabel_laporan').DataTable({
          responsive: true,
          processing: true,
          serverSide: true,
          autoWidth: false,
            ajax: '{!! route('laporan.data') !!}', // memanggil route yang menampilkan data json
            columns: [
    {data: 'DT_RowIndex', searchable: false, sortable: false},
    {data: 'nama'},
    {data: 'satuan'},
    {data: 'harga'},
    {data: 'keterangan'},
    
  ]

});
});

</script>
@endpush

  