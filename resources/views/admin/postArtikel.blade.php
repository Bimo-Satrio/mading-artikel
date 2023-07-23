@extends('layouts.main')

@section('title')
    Tambah Artikel
@endsection


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
          <li class="breadcrumb-item">
            <a href="{{ route('data-artikel') }}">Artikel</a>
          </li>
          <li class="breadcrumb-item {{ Request::routeIs('post-artikel') ? 'active' : '' }} ">
            <a href="{{ route('post-artikel') }}">Tambahkan Artikel</a>
          </li>

        </ol>
      </nav>
    <div class="card">
        <div class="card-body">
            <h5>Tambahkan Artikel</h5>
            <form action="/admin/add-post-artikel" method="post" enctype="multipart/form-data">
                @csrf

                <div class="my-4">
                <label for="judul_artikel">Judul Artikel</label>
                <input  type="text" class="form-control @error('judul_artikel') is-invalid @enderror" name="judul_artikel" id="judul_artikel" placeholder="Judul Artikel">
                @error('judul_artikel')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="my-4">
                <label for="foto_artikel">Foto</label>
                <input  type="file" class="form-control @error('foto_artikel') is-invalid @enderror" name="foto_artikel" id="foto_artikel">
                @error('foto_artikel')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="my-4">
                <textarea  name="isi_artikel" id="isi_artikel @error('isi_artikel') is-invalid @enderror" cols="30" rows="10"  placeholder="Isi Artikel">
                </textarea>
                @error('isi_artikel')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <button type="inpput" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

