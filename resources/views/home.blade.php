@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Kehadiran') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('home') }}" method="GET">
                        @csrf
                        <label for="nama">Tanggal Awal</label>
                        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" ><br>
                        <label for="nama">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" ><br>
                        <button class="btn btn-primary btn-sm" id="checkout" type="submit">Filter data</button>
                    </form>
<br>

                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID USER</th>
                                <th>Tanggal</th>
                                <th>Jam Cekin</th>
                                <th>Jam Cekout</th>
                                <th>Lat</th>
                                <th>Long</th>
                                <th>Lat Cekout</th>
                                <th>Long Cekout</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1; // Inisialisasi nomor urut
                            @endphp
                            @foreach($data as $item)
                            {{-- @php
                                var_dump($item); // Inisialisasi nomor urut
                            @endphp --}}
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $item->id_karyawan }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->cekin }}</td>
                                    <td>{{ $item->cekout }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td>{{ $item->latitude_out }}</td>
                                    <td>{{ $item->longitude_out }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @if (count($data) > 0)
                    {{-- <form action="{{ route('downloadexcel') }}" method="GET"> --}}
                        {{-- @csrf --}}
                        {{-- <input type="hidden" class="form-control" value={{ $_GET['tgl_awal']}} name="tgl_awal" id="tgl_awal" ><br>
                        <input type="hidden" class="form-control" value={{ $_GET['tgl_akhir']}} name="tgl_akhir" id="tgl_akhir" ><br> --}}
                        <button class="btn btn-success btn-sm" id="exportButton" type="submit">Download Excel</button>
                    {{-- </form> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>

<script>
    document.getElementById('exportButton').addEventListener('click', function() {
      var table = document.getElementById('tabel');
      var tableHTML = table.outerHTML;
  
      var blob = new Blob([tableHTML], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
  
      var blobUrl = URL.createObjectURL(blob);
  
      var link = document.createElement("a");
      link.href = blobUrl;
      link.download = "rekap_kehadiran.xls";
      link.style.display = "none";
  
      document.body.appendChild(link);
      link.click();
  
      document.body.removeChild(link);
    });
  </script>
  
  
@endsection
