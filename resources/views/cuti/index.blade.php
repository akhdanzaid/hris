@extends('layouts.app')

@section('page-title', 'Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Statistik --}}
    <div class="row mb-5">
        <div class="col-md-4"><div class="cuti-card pending"><div><h2>{{ $pending }}</h2><p>Pending</p></div><span class="icon">⏰</span></div></div>
        <div class="col-md-4"><div class="cuti-card approved"><div><h2>{{ $approved }}</h2><p>Disetujui</p></div><span class="icon">✔</span></div></div>
        <div class="col-md-4"><div class="cuti-card rejected"><div><h2>{{ $rejected }}</h2><p>Ditolak</p></div><span class="icon">✖</span></div></div>
    </div>

    <div class="page-index-body">
        <h4 class="fw-bold mb-4">Pengajuan Cuti Karyawan</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Keterangan Alasan</th>
                        <th>Mulai Cuti</th>
                        <th>Akhir Cuti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <!-- forelse digunakan karena lebih cocok kalau datanya kosong -->
                @forelse ($cuti as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->karyawan->name ?? '-' }}</td>
                    <td>{{ $item->alasan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}</td>
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
            <a href="{{ route('cuti.create') }}"
                               class="btn btn-sm btn-light border px-4">
                                tambah
                            </a>
        </div>
    </div>

</div>
@endsection
