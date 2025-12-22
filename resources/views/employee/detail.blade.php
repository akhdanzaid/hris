@extends('layouts.app')

@section('page-title', 'Detail Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Detail Karyawan</h5>
        </div>

        <div class="card-body page-body">

            {{-- Informasi Dasar --}}
            <h6 class="section-title">Informasi Dasar</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" value="20191001" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="Mahasigma" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" value="Laki-laki" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tempat, Tanggal Lahir</label>
                    <input type="text" class="form-control"
                           value="Jakarta Timur, 30 Februari 2000" readonly>
                </div>
            </div>

            {{-- Kontak --}}
            <h6 class="section-title mt-5">Kontak</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" value="0812345678" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="teamanggur@gmail.com" readonly>
                </div>
            </div>

            {{-- Detail Pekerjaan --}}
            <h6 class="section-title mt-5">Detail Pekerjaan</h6>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Departemen</label>
                    <input type="text" class="form-control" value="Top Managerial" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jabatan</label>
                    <input type="text" class="form-control" value="CEO" readonly>
                </div>
            </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Bergabung</label>
                    <input type="text" class="form-control" value="01 Januari 2019" readonly>
                </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Status Karyawan</label>
                    <input type="text" class="form-control" value="Tetap" readonly>
                </div>
            </div>

            {{-- Rincian Gaji --}}
            <h6 class="section-title mt-5">Rincian Gaji</h6>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Gaji Pokok</label>
                    <input type="text" class="form-control" value="Rp. 20.000.000" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Total Potongan</label>
                    <input type="text" class="form-control" value="Rp. 100.000" disabled>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label">Total Gaji</label>
                    <input type="text" class="form-control" value="Rp. 19.900.000" disabled>
                </div>
            </div>

            {{-- Foto --}}
            <h6 class="section-title mt-5">Foto Profil</h6>
            <div class="photo-upload">
                <div class="photo-placeholder">
                    <img src="https://i.pravatar.cc/150" alt="Foto Profil">
                </div>
            </div>

            {{-- Action --}}
            <div class="page-action mt-5 d-flex justify-content-end gap-2">
                <a href="{{ route('employee.index') }}" class="btn btn-secondary btn-sm px-4">
                    Kembali
                </a>
                <button class="btn btn-success btn-sm px-4">
                    Update
                </button>
                <button class="btn btn-danger btn-sm px-4">
                    Hapus
                </button>
            </div>

        </div>
    </div>

</div>
@endsection
