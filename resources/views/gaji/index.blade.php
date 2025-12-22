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
                {{-- DATA DUMMY --}}
                <tr>
                    <td class="text-center">1</td>
                    <td>20192001</td>
                    <td>Mahasigma</td>
                    <td>Rp. 20.000.000</td>
                    <td>Rp. 0</td>
                    <td>Rp. 20.000.000</td>
                    <td class="text-center">
                        <a href="{{ route('gaji.edit', 1) }}" 
                        class="btn btn-sm btn-light border btn-sm px-4">
                            Edit
                        </a>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>
@endsection
