@extends('layoutsk.app')

@section('page-title', 'Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@php
    $karyawan = Auth::user()->karyawan;
@endphp

@section('content')
<div class="container-fluid">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Ajukan Cuti</h5>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">
            <form method="POST"
                  action="{{ route('cutik.store') }}"
                  enctype="multipart/form-data">
                @csrf

                {{-- NIK --}}
                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $karyawan->nik }}"
                           readonly>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $karyawan->name }}"
                           readonly>
                </div>

                {{-- No Telp --}}
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon Aktif</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $karyawan->phone }}"
                           readonly>
                </div>

                {{-- Alasan --}}
                <div class="mb-3">
                    <label class="form-label">Alasan Mengajukan Cuti</label>
                    <textarea name="alasan"
                              class="form-control"
                              rows="3"
                              required></textarea>
                </div>

                {{-- Tanggal --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai Cuti</label>
                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Akhir Cuti</label>
                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               required>
                    </div>
                </div>

                {{-- Berkas --}}
                <div class="mb-4">
                    <label class="form-label">
                        Berkas Pendukung / Surat Keterangan
                    </label>
                    <input type="file"
                           name="berkas"
                           class="form-control">
                </div>

                {{-- Action --}}
                <div class="page-action d-flex gap-2">
                    <a href="{{ route('cutik.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"               
                            style="background:#759EB8;border:none">
                        Ajukan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
