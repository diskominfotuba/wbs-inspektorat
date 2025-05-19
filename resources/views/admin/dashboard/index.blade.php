@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h4 class="card-title text-primary fw-bold">Selamat Datang di Dashboard WBS</h4>
                                <p class="mb-4">
                                    Hallo {{ Auth::user()->name }}, pantau aktifitas pengaduanmu di sini.
                                </p>
                                <a href="{{ route('admin.pengaduan') }}" class="btn btn-primary">Lihat Semua Pengaduan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Pengaduan Diajukan</span>
                            <div class="mb-0 card-title d-flex align-items-start justify-content-between">
                                <h3 class="p-0 mb-0">{{ $totalPending }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Pengaduan Diterima</span>
                            <div class="mb-0 card-title d-flex align-items-start justify-content-between">
                                <h3 class="p-0 mb-0">{{ $totalDiterima }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Pengaduan Diproses</span>
                            <div class="mb-0 card-title d-flex align-items-start justify-content-between">
                                <h3 class="p-0 mb-0">{{ $totalDiproses }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mb-4">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <span class="fw-semibold d-block mb-1">Pengaduan Selesai</span>
                            <div class="mb-0 card-title d-flex align-items-start justify-content-between">
                                <h3 class="p-0 mb-0">{{ $totalClose }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
