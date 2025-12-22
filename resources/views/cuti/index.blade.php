@extends('layouts.app')

@section('page-title', 'Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Statistik --}}
    <div class="row mb-5">
        <div class="col-md-4"><div class="cuti-card pending"><div><h2>1</h2><p>Pending</p></div><span class="icon">⏰</span></div></div>
        <div class="col-md-4"><div class="cuti-card approved"><div><h2>0</h2><p>Disetujui</p></div><span class="icon">✔</span></div></div>
        <div class="col-md-4"><div class="cuti-card rejected"><div><h2>0</h2><p>Ditolak</p></div><span class="icon">✖</span></div></div>
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
                    <tr>
                        <td class="text-center">1</td>
                        <td>Teuku Maulana Iqbal</td>
                        <td>Berobat</td>
                        <td>12 Desember 2025</td>
                        <td>15 Desember 2025</td>
                        <td class="text-center">
                            <span class="badge bg-warning text-dark">PENDING</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('cuti.detail', 1) }}"
                               class="btn btn-sm btn-light border px-4">
                                Lihat
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
