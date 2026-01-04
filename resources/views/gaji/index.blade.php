@extends('layouts.app')

@section('page-title', 'Gaji')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    {{-- Card utama --}}
    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">List Data Gaji Karyawan</h5>

            <a href="{{ route('gaji.create') }}"
               class="btn btn-primary btn-sm px-4"
               style="background:#759EB8;border:none">
                Tambah
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">

            {{-- Search --}}
            <form method="GET"
                  action="{{ route('gaji.index') }}"
                  class="row g-2 align-items-center mb-4">
                <div class="col">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari Nama Karyawan"
                           value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-secondary px-4">
                        Search
                    </button>
                </div>
            </form>

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


            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-card">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Gaji Pokok</th>
                            <th>Total Potongan</th>
                            <th>Total Gaji</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gajis as $index => $gaji)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $gaji->karyawan->nik ?? '-' }}</td>
                                <td>{{ $gaji->karyawan->name ?? '-' }}</td>
                                <td>
                                    Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($gaji->total_potongan, 0, ',', '.') }}
                                </td>
                                <td class="fw-semibold">
                                    Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('gaji.edit', $gaji->id) }}"
                                       class="btn btn-sm btn-light border px-4">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Data gaji belum tersedia
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
