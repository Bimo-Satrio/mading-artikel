@extends('layouts.main')

@section('title')
    Artikel
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (Session::has('success'))
    <div class="alert alert-success">Sukses Menambahkan Artikel</div>
    @endif

    @if (Session::has('hapusSuccess'))
    <div class="alert alert-danger">Artikel Berhasil Dihapus</div>
    @endif

    <div class="row">
        <div class="col-10 col-sm-10 col-md-10">
        </div>
        <div class="col-2 col-sm-2 col-md-2">
            <div class="my-4">
                <a href="{{ route('post-artikel') }}">
                    <button class="btn btn-primary">Tambahkan Artikel</button>
                </a>
            </div>
        </div>
    </div>
              <!-- Bootstrap Dark Table -->
              <div class="card">
                <h5 class="card-header">Artikel</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th>Nomor</th>
                        <th>Judul Artikel</th>
                        <th>Foto Artikel</th>
                        <th>Isi Artikel</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Tanggal Ditambahkan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        @forelse ( $artikels as $artikel )
                        <td>{{  $loop->iteration }}</td>
                        <td>{{ $artikel->judul_artikel }}</td>
                        <td>
                            <img src="{{ asset("public/".$artikel->foto_artikel) }}" class="img-thumbnail">
                        </td>
                        <td>{!!Str::limit(strip_tags($artikel->isi_artikel),50 )  !!}</td>

                        <td>{{ $artikel->user->name }}</td>
                        <td>{{ $artikel->created_at }}</td>
                        <td>
                            <a href="{{ route('komentar',$artikel->id_artikel) }}">
                                <button class="btn btn-primary">Kelola Komentar</button>
                            </a>
                            <br>
                            <a href="{{ route('ubah-artikel', $artikel->id_artikel) }}" data-confirm-delete="true">
                                <button class="btn btn-primary">Ubah</button>
                            </a>
                            <br>
                            <form action="/admin/hapus-artikel/{{ $artikel->id_artikel }}" method="POST">
                                    @csrf
                                    <a data-confirm-delete="true">
                                        <button class="btn btn-primary">Hapus</button>
                                    </a>
                            </form>
                        </td>
                      </tr>
                      @empty
                      <h5>Kosong</h5>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              {{ $artikels->links('pagination::bootstrap-5') }}
              <!--/ Bootstrap Dark Table -->
</div>
@endsection
