@extends('layoutsk.app')
@section('page-title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner --}}
    <div class="welcome-box mb-4 {{ session('just_logged_in') ? 'animate-welcome' : '' }}">
        <div class="welcome-content {{ session('just_logged_in') ? 'animate-text' : '' }}">
            <h3 class="mb-1">SELAMAT DATANG</h3>
            <p class="mb-0">
                {{ Auth::user()->username }}
            </p>
        </div>

        <img src="{{ asset('images/karyawan/klk.png') }}"
            alt="avatar"
            class="welcome-avatar {{ session('just_logged_in') ? 'animate-avatar' : '' }}">
    </div>

    {{-- Info Gaji --}}
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="stat-card
                {{ session('just_logged_in') ? 'animate-stat delay-1' : '' }}">
                <p class="mb-1 text-muted">Gaji Pokok</p>
                <h3>Rp. 15.000.000</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card
                {{ session('just_logged_in') ? 'animate-stat delay-2' : '' }}">
                <p class="mb-1 text-muted">Potongan</p>
                <h3>Rp. 100.000</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card
                {{ session('just_logged_in') ? 'animate-stat delay-3' : '' }}">
                <p class="mb-1 text-muted">Total Gaji</p>
                <h3>Rp. 14.900.000</h3>
            </div>
        </div>
    </div>

    {{-- view riwayat --}}
    <div class="page-index-body">

    <div class="card">

    {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Riwayat Pengajuan Cuti</h5>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
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
    @if ($cuti->count() > 0)
        @foreach ($cuti as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->karyawan->name }}</td>
                <td>{{ $item->alasan }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai }}</td>
                <td class="text-center">
                    @if ($item->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif ($item->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6" class="text-center text-muted py-3">
                Belum ada pengajuan cuti
            </td>
        </tr>
    @endif
</tbody>

                </table>
            </div>

        </div>
    </div>

</div>


</div>
@endsection