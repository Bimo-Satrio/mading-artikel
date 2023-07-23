@extends('layouts.main')

@section('title')
    Laporan Artikel
@endsection


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Bootstrap Dark Table -->
    <div class="card">
        <h5 class="card-header">Laporan Artikel</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Judul Artikel</th>
                <th>Jumlah Komentar</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ( $laporanArtikels as $artikel )
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $artikel->judul_artikel }}</td>
                <td>{{ $artikel->komentar->count() }}</td>
              </tr>
              @empty
              <h5>Kosong</h5>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Bootstrap Dark Table -->
</div>
@endsection
