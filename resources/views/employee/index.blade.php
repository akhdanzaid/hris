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
        <form method="GET" class="row g-2 align-items-center mb-3">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Cari Karyawan">
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary px-4" style="background:#759EB8; border:none;">
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
                        <th>Jabatan</th>
                        <th>No. Telepon</th>
                        <th style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>20219001</td>
                        <td>Moh. Suryono</td>
                        <td>CEO</td>
                        <td>085214321876</td>
                        <td class="text-center">
                            <a href="{{ route('employee.detail', 1) }}"
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
