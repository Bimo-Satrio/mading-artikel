@extends('layouts.apps')
@section('title')
    {{ $bacaArtikels->judul_artikel }}
@endsection


@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item {{ Request::routeIs('baca-artikel') ? 'active' : '' }} " aria-current="page">Library
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-8 col-sm-8 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $bacaArtikels->judul_artikel }}</h5>
                    <hr>
                    <img class="img-thumbnail" src="{{ asset('public/' . $bacaArtikels->foto_artikel) }}">
                    <p>{!! $bacaArtikels->isi_artikel !!}</p>
                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-body">

                    <h5>Komentar : </h5>

                    @foreach ($bacaArtikels->komentar as $komentar)
                        <div class="my-1">
                            <p>Email : {{ $komentar->email }}</p>
                        </div>

                        <div class="my-1">
                            <p>Nama : {{ $komentar->nama }}</p>
                        </div>

                        <div class="my-1">
                            <p>Komentar : {!! $komentar->komentar !!}</p>
                        </div>
                    @endforeach


                    <h5>Berikan Komentar : </h5>

                    <form action="/tambah-komentar" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $bacaArtikels->id_artikel }}" name="id_artikel" id="id_artikel">

                        <div class="my-4">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"r"
                                placeholder="Email" id="email" name="email" required>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-4">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror""
                                placeholder="Nama" id="nama" name="nama" required>
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                        </div>

                        <textarea class="my-4 @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Komentar"
                            required>
                        </textarea>
                        @error('komentar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="my-4">
                            <div class="float-end">
                                <button class="btn btn-primary" type="submit">Komentar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <div class="col-4 col-sm-4 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Ditambahkan Pada : {{ date('d F Y', strtotime($bacaArtikels->created_at)) }}</h5>
                    <hr>
                    <h5>Oleh : {{ $bacaArtikels->user->name }}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
