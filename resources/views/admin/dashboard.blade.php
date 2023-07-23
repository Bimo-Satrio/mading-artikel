@extends('layouts.main')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Halo Admin !</h5>
                <p class="mb-4">
                    Selamat Datang
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">

                </div>
                <span class="fw-semibold d-block mb-1">Total Artikel</span>
                <h3 class="card-title mb-2">{{ $artikels }}</h3>

              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">

                </div>
                <span class="fw-semibold d-block mb-1">Total Laporan Artikel</span>
                <h3 class="card-title mb-2">{{ $artikels }}</h3>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
    </div>
  </div>
@endsection



