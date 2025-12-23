@extends('layouts.app')

@section('page-title', 'Detail Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Detail Pengajuan Cuti</h5>
        </div>

        <div class="card-body page-body">

            {{-- NIK --}}
            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control"
                       value="{{ $cuti->karyawan->nik }}" disabled>
            </div>

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control"
                       value="{{ $cuti->karyawan->name }}" disabled>
            </div>

            {{-- Telepon --}}
            <div class="mb-3">
                <label class="form-label">Nomor Telepon Aktif</label>
                <input type="text" class="form-control"
                       value="{{ $cuti->karyawan->phone }}" disabled>
            </div>

            {{-- Alasan --}}
            <div class="mb-3">
                <label class="form-label">Alasan Mengajukan Cuti</label>
                <input type="text" class="form-control"
                       value="{{ $cuti->alasan }}" disabled>
            </div>

            {{-- Tanggal --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai Cuti</label>
                    <input type="date" class="form-control"
                           value="{{ $cuti->tanggal_mulai }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Akhir Cuti</label>
                    <input type="date" class="form-control"
                           value="{{ $cuti->tanggal_selesai }}" disabled>
                </div>
            </div>

            {{-- Berkas --}}
            <div class="mb-4">
                <label class="form-label">Berkas Pendukung / Surat Keterangan</label><br>

                @if ($cuti->berkas)
                    <button type="button"
                            class="btn btn-outline-secondary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#berkasModal">
                        🔗 Lihat Berkas
                    </button>
                @else
                    <span class="text-muted">Tidak ada berkas</span>
                @endif
            </div>

            {{-- Action --}}
            <div class="page-action d-flex gap-2">
                <a href="{{ route('cuti.index') }}"
                   class="btn btn-secondary btn-sm px-4">
                    Kembali
                </a>

                @if ($cuti->status === 'pending')
                    <form action="{{ route('cuti.reject', $cuti->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-danger btn-sm px-4"
                                onclick="return confirm('Tolak pengajuan cuti ini?')">
                            Tolak
                        </button>
                    </form>

                    <form action="{{ route('cuti.approve', $cuti->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success btn-sm px-4"
                                onclick="return confirm('Setujui pengajuan cuti ini?')">
                            Setujui
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>

</div>

<!-- preview -->
@if ($cuti->berkas)
<div class="modal fade" id="berkasModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Preview Berkas Pendukung</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                @php
                    $ext = pathinfo($cuti->berkas, PATHINFO_EXTENSION);
                @endphp

                @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('storage/'.$cuti->berkas) }}"
                         class="img-fluid rounded">
                @elseif ($ext === 'pdf')
                    <iframe src="{{ asset('storage/'.$cuti->berkas) }}"
                            width="100%" height="500px"></iframe>
                @else
                    <a href="{{ asset('storage/'.$cuti->berkas) }}"
                       class="btn btn-primary" target="_blank">
                        Download Berkas
                    </a>
                @endif

            </div>

        </div>
    </div>
</div>
@endif

@endsection
