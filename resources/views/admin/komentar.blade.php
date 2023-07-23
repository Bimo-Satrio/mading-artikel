@extends('layouts.main')

@section('title')
    Kelola Komentar
@endsection


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-body">

            <h5>Judul Artikel : {{ $artikels->judul_artikel }}</h5>
        </div>

    </div>
    <br>
    <div class="card">
        <div class="card-body">
            @foreach ($artikels->komentar as $komentar )

                <div class="row">
                    <div class="col-8 col-sm-8 col-md-8">
                        <p>Email : {{ $komentar->email }}</p>
                        <p>Nama : {{ $komentar->nama }}</p>
                        <p>Komentar : {!! $komentar->komentar !!}</p>
                    </div>


                    <div class="col-4 col-sm-4 col-md-4">
                        <form action="/admin/hapusKomentar/{{ $komentar->id_komentar }}" method="POST">
                         @csrf
                        <button class="btn btn-danger">
                            Hapus Komentar
                         </button>
                        </form>
                    </div>
                </div>

            @endforeach
        </div>
    </div>



</div>
@endsection
