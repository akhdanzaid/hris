@extends('layouts.app')

@section('page-title', 'Detail Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Pengajuan Cuti</h5>
        </div>

        <div class="card-body page-body">
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" value="20191001" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" value="Teuku Maulana Iqbal" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon Aktif</label>
                <input type="text" class="form-control" value="081290008000" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Alasan Mengajukan Cuti</label>
                <input type="text" class="form-control" value="Berobat" disabled>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai Cuti</label>
                    <input type="date" class="form-control" value="2025-12-12" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Akhir Cuti</label>
                    <input type="date" class="form-control" value="2025-12-15" disabled>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Berkas Pendukung / Surat Keterangan</label><br>
                <button type="button" class="btn btn-outline-secondary btn-sm">
                    🔗 Lihat
                </button>
            </div>

            {{-- Action --}}
            <div class="page-action">
                <a href="{{ route('cuti.index') }}" class="btn btn-secondary btn-sm px-4">
                    Kembali
                </a>
                <button type="button" class="btn btn-danger btn-sm px-4">
                    Tolak
                </button>
                <button type="button" class="btn btn-success btn-sm px-4">
                    Setujui
                </button>
            </div>

        </div>
    </div>

</div>
@endsection
