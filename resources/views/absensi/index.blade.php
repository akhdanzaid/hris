@extends('layouts.app')

@section('page-title', 'Absensi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@php
    // Ambil tipe absensi (HANYA: masuk / pulang)
    $tipe = request()->get('tipe', 'masuk');

    // Guard: jika tipe tidak valid, paksa ke 'masuk'
    if (!in_array($tipe, ['masuk', 'pulang'])) {
        $tipe = 'masuk';
    }

    // Default jam
    $default = [
        'masuk' => ['start' => '07:00', 'end' => '08:30'],
        'pulang' => ['start' => '16:00', 'end' => '17:00'],
    ];
@endphp

@section('content')
<div class="form-container">

    {{-- TAB --}}
    <div class="d-flex gap-3 mb-4">
        <a href="{{ route('absensi.index', ['tipe' => 'masuk']) }}"
           class="btn px-4 {{ $tipe === 'masuk' ? 'btn-dark' : 'btn-light' }}">
            Absensi Masuk
        </a>

        <a href="{{ route('absensi.index', ['tipe' => 'pulang']) }}"
           class="btn px-4 {{ $tipe === 'pulang' ? 'btn-dark' : 'btn-light' }}">
            Absensi Pulang
        </a>
    </div>

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">
                Absensi {{ ucfirst($tipe) }}
            </h5>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">

            <div class="row mb-4">
                {{-- Jam Mulai --}}
                <div class="col-md-4">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time"
                           class="form-control"
                           value="{{ $default[$tipe]['start'] }}">
                </div>

                {{-- Jam Selesai --}}
                <div class="col-md-4">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time"
                           class="form-control"
                           value="{{ $default[$tipe]['end'] }}">
                </div>

                {{-- Tanggal --}}
                <div class="col-md-4">
                    <label class="form-label">Tanggal Absensi</label>
                    <input type="text"
                           class="form-control"
                           value="{{ now()->format('d/m/Y') }}"
                           readonly>
                </div>
            </div>

            {{-- Catatan --}}
            @if($tipe === 'masuk')
                <small class="text-muted">
                    Melewati jam selesai akan tercatat sebagai <strong>telat</strong>.
                </small>
            @else
                <small class="text-muted">
                    Jam pulang normal dan tidak dihitung sebagai lembur.
                </small>
            @endif

            {{-- Action --}}
            <div class="page-action d-flex gap-2 mt-4">
                <a href="{{ route('dashboard.index') }}"
                   class="btn btn-secondary btn-sm px-4">
                    Kembali
                </a>

                <a href="{{ route('absensi.barcode', $tipe) }}"
                   class="btn btn-primary btn-sm px-4"
                   style="background:#759EB8; border:none;">
                    Mulai
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
