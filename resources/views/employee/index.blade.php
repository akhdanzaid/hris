@extends('layouts.app')

@section('page-title', 'Data Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    {{-- Card utama --}}
    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">List Data Karyawan</h5>

            <a href="{{ route('employee.create') }}"
               class="btn btn-primary btn-sm px-4"
               style="background:#759EB8;border:none">
                Tambah
            </a>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">

            {{-- Search --}}
            <form method="GET"
                  action="{{ route('employee.index') }}"
                  class="row g-2 align-items-center mb-5">
                <div class="col">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari Karyawan Berdasarkan NIK atau Nama"
                           value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-secondary px-4"
                            >
                        Search
                    </button>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-card">
                    <thead class="text-center">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th style="width:120px">Foto</th>
                            <th>Jabatan</th>
                            <th>No. Telepon</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($karyawan as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($karyawan->currentPage() - 1) * $karyawan->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <img
                                        src="{{ $item->photo
                                            ? asset('images/karyawan/' . $item->photo)
                                            : asset('assets/img/user-placeholder.png') }}"
                                        alt="Foto Karyawan"
                                        class="rounded-circle"
                                        style="width:45px;height:45px;object-fit:cover;">
                                </td>
                                <td>{{ $item->position->name ?? '-' }}</td>
                                <td>{{ $item->phone }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employee.detail', $item->id) }}"
                                       class="btn btn-sm btn-light border px-4">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Data karyawan belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($karyawan->hasPages())
                <div class="d-flex justify-content-end mt-3">
                    {{ $karyawan->links('pagination::bootstrap-5') }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
