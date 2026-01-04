@extends('layouts.app')

@section('page-title', 'Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    {{-- Statistik --}}
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="cuti-card pending">
                <div>
                    <h2>{{ $pending }}</h2>
                    <p>Pending</p>
                </div>
                <span class="icon">⏰</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="cuti-card approved">
                <div>
                    <h2>{{ $approved }}</h2>
                    <p>Disetujui</p>
                </div>
                <span class="icon">✔</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="cuti-card rejected">
                <div>
                    <h2>{{ $rejected }}</h2>
                    <p>Ditolak</p>
                </div>
                <span class="icon">✖</span>
            </div>
        </div>
    </div>

    {{-- Card utama --}}
    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Pengajuan Cuti Karyawan</h5>

            <a href="{{ route('cuti.create') }}"
               class="btn btn-primary btn-sm px-4"
               style="background:#759EB8;border:none">
                Tambah
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle table-card">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Karyawan</th>
                            <th>Alasan</th>
                            <th>Mulai Cuti</th>
                            <th>Akhir Cuti</th>
                            <th>Status</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cuti as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->karyawan->name ?? '-' }}</td>
                                <td>{{ $item->alasan }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)
                                        ->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)
                                        ->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center">
                                    @if ($item->status === 'pending')
                                        <span class="badge bg-warning text-dark">PENDING</span>
                                    @elseif ($item->status === 'approved')
                                        <span class="badge bg-success">DISETUJUI</span>
                                    @elseif ($item->status === 'rejected')
                                        <span class="badge bg-danger">DITOLAK</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cuti.detail', $item->id) }}"
                                       class="btn btn-sm btn-light border px-4">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada pengajuan cuti
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
