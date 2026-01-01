@extends('layoutsk.app')
@section('page-title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner (SAMA DENGAN HRD) --}}
    <div class="welcome-box d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Selamat Datang</h4>
            <p class="mb-0 text-muted">
                {{ Auth::user()->name ?? Auth::user()->username }}
            </p>
        </div>

        <img src="{{ asset('images/karyawan/1.png') }}"
             alt="avatar"
             class="welcome-avatar">
    </div>

    {{-- Info Gaji (MENGGANTIKAN STATISTIK HRD) --}}
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="stat-card">
                <p class="mb-1 text-muted">Gaji Pokok</p>
                <h3>Rp. 15.000.000</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <p class="mb-1 text-muted">Potongan</p>
                <h3>Rp. 100.000</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <p class="mb-1 text-muted">Total Gaji</p>
                <h3>Rp. 14.900.000</h3>
            </div>
        </div>
    </div>

    {{-- Konten Utama (SAMA SEPERTI HRD) --}}
    <div class="page-index-body">

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Karyawan</th>
                            <th>Keterangan</th>
                            <th>Mulai Cuti</th>
                            <th>Akhir Cuti</th>
                            <th style="width: 120px;" class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tommy Satrio W.</td>
                            <td>Liburan Nataru</td>
                            <td>26 Desember 2025</td>
                            <td>4 Januari 2026</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark px-3">
                                    Pending
                                </span>
                            </td>
                        </tr>

                        {{-- contoh jika data kosong --}}
                        {{--
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada pengajuan cuti
                            </td>
                        </tr>
                        --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


</div>
@endsection