@extends('layouts.app')

@section('page-title', 'Data Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="page-index-header mb-4">
        <h3 class="fw-bold mb-3">List Data Karyawan</h3>

        <a href="{{ route('employee.create') }}"
           class="btn btn-primary mb-4 px-4"
           style="background:#759EB8; border:none;">
            Tambah Karyawan
        </a>
    </div>

    <div class="page-index-body">

        {{-- Search --}}
        <form method="GET"
            action="{{ route('employee.index') }}"
            class="row g-2 align-items-center mb-3">
            <div class="col">
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari Karyawan Berdasarkan NIK atau Nama"
                    value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary px-4"
                        style="background:#759EB8; border:none;">
                    Search
                </button>
            </div>
        </form>


        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-employee align-middle">
                <thead class="text-center">
                    <tr>
                        <th style="width:50px">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th style="width:200px">Foto</th>
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
                                    style="width:50px; height:50px; object-fit:cover;">
                            </td>
                            <td>{{ $item->position->name }}</td>
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
@endsection
