@extends('layouts.app')

@section('page-title', 'Gaji')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <h3 class="fw-bold mb-3">List Data Gaji</h3>

    {{-- Button --}}
    <div class="mb-4">
        <a href="{{ route('gaji.create') }}" class="btn btn-primary btn mb-4 px-4" style="background:#759EB8; border:none;">
            Tambah Gaji
        </a>
    </div>

    {{-- Search --}}
    <div class="mb-3">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari Nama Karyawan">
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary btn px-4" style="background:#759EB8; border:none;">
                    Search
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-employee align-middle">
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
            @foreach ($gajis as $index => $gaji)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $gaji->karyawan->nik }}</td>
                <td>{{ $gaji->karyawan->name }}</td>
                <td>Rp. {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                <td class="text-center">
                    <a href="{{ route('gaji.edit', $gaji->id) }}"
                    class="btn btn-sm btn-light border px-3">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
