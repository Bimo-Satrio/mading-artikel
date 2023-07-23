@extends('layouts.apps')

@section('title')
    Beranda
@endsection

@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item {{ Request::routeIs('hasil-pencarian') ? 'active' : '' }} " aria-current="page">Hasil
                Pencarian</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <form action="/pencarian" method="GET">
            @csrf
            <div class="col-12 col-md-12">
                <input type="text" class="form-control" placeholder="Pencarian" name="input" id="input"
                    value="{{ old('input') }}">
            </div>
        </form>
    </div>

    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mt-5">
        @forelse ($hasilPencarian as $pencarian)
            <div class="col mb-5">
                <div class="card h-100">
                    <img class="card-img-top" src="{{ asset('public/' . $pencarian->foto_artikel) }}" class="img-thumbnail"
                        alt="..." />
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $pencarian->judul_artikel }}</h5>
                            <p>{!! Str::limit(strip_tags($pencarian->isi_artikel), 50) !!}</p>
                            <br>
                            <h5>Ditambahkan Pada : <br> {{ date('d F Y', strtotime($pencarian->created_at)) }}</h5>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                href="{{ Route('baca-artikel', $pencarian->id_artikel) }}">Baca Artikel</a></div>
                    </div>
                </div>
            </div>
        @empty
            <h5>Pencarian Tidak Ditemukan</h5>
        @endforelse
    </div>
@endsection
