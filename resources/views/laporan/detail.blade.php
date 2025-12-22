@extends('layouts.app')

@section('page-title', 'Rincian Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Rincian Laporan Absensi</h5>
        </div>

        <div class="card-body page-body">

            {{-- Informasi Dasar --}}
            <h6 class="section-title">Informasi Dasar</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" value="20191111" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="Mahasigma" disabled>
                </div>
            </div>

            {{-- Kontak --}}
            <h6 class="section-title mt-5">Kontak</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" value="089610002000" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="anggurteam@unsada.ac" disabled>
                </div>
            </div>

            {{-- Absensi --}}
            <h6 class="section-title mt-5">Absensi</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="Tidak Hadir" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" value="18/02/2025" disabled>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Timestamp</label>
                    <input type="text" class="form-control" value="-" disabled>
                </div>
            </div>

            {{-- Action --}}
            <div class="page-action mt-5 d-flex justify-content-end">
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary btn-sm px-4">
                    Kembali
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
