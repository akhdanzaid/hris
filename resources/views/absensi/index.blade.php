@extends('layouts.app')

@section('page-title', 'Kelola Absensi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@php
    $tipe = request()->get('tipe', 'hadir');

    if (!in_array($tipe, ['hadir', 'pulang'])) {
        $tipe = 'hadir';
    }

    // Default jam per tipe
    $defaultJam = [
        'hadir'  => ['mulai' => '07:00', 'selesai' => '08:30'],
        'pulang' => ['mulai' => '16:00', 'selesai' => '17:00'],
    ];

    $session = \App\Models\AbsensiSession::whereDate('tanggal', today())
        ->where('tipe', $tipe)
        ->first();

    // Tentukan value input (session > default)
    $jamMulai   = $session->jam_mulai   ?? $defaultJam[$tipe]['mulai'];
    $jamSelesai = $session->jam_selesai ?? $defaultJam[$tipe]['selesai'];
@endphp


@section('content')
<div class="form-container">

    {{-- FLASH SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TAB SESI --}}
    <div class="d-flex gap-3 mb-4">
        <a href="{{ route('absensi.index', ['tipe' => 'hadir']) }}"
           class="btn px-4 {{ $tipe === 'hadir' ? 'btn-dark' : 'btn-light' }}">
            Sesi Hadir
        </a>

        <a href="{{ route('absensi.index', ['tipe' => 'pulang']) }}"
           class="btn px-4 {{ $tipe === 'pulang' ? 'btn-dark' : 'btn-light' }}">
            Sesi Pulang
        </a>
    </div>

    <div class="card form-card">

        {{-- HEADER --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">
                Kelola Sesi Absensi {{ ucfirst($tipe) }}
            </h5>
        </div>

        {{-- BODY --}}
        <div class="card-body page-body">

            {{-- FORM BUKA / UPDATE SESI --}}
            <form method="POST" action="{{ route('absensi.session.start') }}">
                @csrf

                <input type="hidden" name="tipe" value="{{ $tipe }}">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time"
                            name="jam_mulai"
                            class="form-control"
                            value="{{ $jamMulai }}"
                            step="60"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time"
                            name="jam_selesai"
                            class="form-control"
                            value="{{ $jamSelesai }}"
                            step="60"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal</label>
                        <input type="text"
                            class="form-control"
                            value="{{ now()->format('d/m/Y') }}"
                            readonly>
                    </div>
                </div>


                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if($session && $session->is_active)
                            <span class="badge bg-success">Sesi Aktif</span>
                        @else
                            <span class="badge bg-secondary">Sesi Tidak Aktif</span>
                        @endif
                    </div>

                    <button type="submit"
                            class="btn btn-primary"
                            style="background:#759EB8; border:none;">
                        {{ $session && $session->is_active ? 'Perbarui Sesi' : 'Buka Sesi' }}
                    </button>
                </div>
            </form>

            {{-- FORM TUTUP SESI (TERPISAH, TIDAK NESTED) --}}
            @if($session && $session->is_active)
                <form method="POST"
                      action="{{ route('absensi.session.close', $session->id) }}"
                      class="mt-3">
                    @csrf
                    <button class="btn btn-danger">
                        Tutup Sesi
                    </button>
                </form>
            @endif

        </div>
    </div>

    {{-- ABSENSI MANUAL --}}
    <div class="card form-card mt-4">

        <div class="card-header page-header">
            <h5 class="page-title mb-0">
                Absensi Manual Karyawan ({{ ucfirst($tipe) }})
            </h5>
        </div>

        <div class="card-body page-body">

        @if(!$session || !$session->is_active)
                <div class="alert alert-warning">
                    Sesi absensi belum dibuka. Silakan buka sesi terlebih dahulu.
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle table-card">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Karyawan</th>
                            <th>Status Hari Ini</th>
                            <th>Jam</th>
                            <th style="width:140px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($karyawan as $index => $item)

                        @php
                            $absen = $absensiHariIni[$item->id] ?? null;
                        @endphp

                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>

                            <td>{{ $item->name }}</td>

                            <td class="text-center">
                                @if($absen)
                                    @if($tipe === 'hadir')
                                        <span class="badge bg-success">
                                            {{ strtoupper($absen->status) }}
                                        </span>
                                    @else
                                        @if($absen->jam_pulang)
                                            <span class="badge bg-success">SUDAH PULANG</span>
                                        @else
                                            <span class="badge bg-warning text-dark">BELUM PULANG</span>
                                        @endif
                                    @endif
                                @else
                                    <span class="badge bg-secondary">BELUM ABSEN</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($absen)
                                    @if($tipe === 'hadir' && $absen->jam_masuk)
                                        {{ \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i') }}
                                    @elseif($tipe === 'pulang' && $absen->jam_pulang)
                                        {{ \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i') }}
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>

                            <td class="text-center">

                                <form method="POST"
                                    action="{{ route('absensi.store') }}">
                                    @csrf

                                    <input type="hidden" name="karyawan_id" value="{{ $item->id }}">
                                    <input type="hidden" name="tipe" value="{{ $tipe }}">
                                    <input type="hidden" name="metode" value="manual">
                                    <input type="hidden" name="token" value="{{ $session->token ?? '' }}">

                                    <button class="btn btn-sm btn-primary px-3" style="background:#759EB8; border:none;"
                                        {{ !$session || !$session->is_active ? 'disabled' : '' }}>
                                        Absen
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Tidak ada data karyawan
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
