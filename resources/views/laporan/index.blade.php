@extends('layouts.app')

@section('page-title', 'Laporan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <h3 class="fw-bold mb-4">Laporan Absensi</h3>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-employee align-middle">
            <thead class="text-center">
                <tr>
                    <th style="width:50px">No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Timestamp</th>
                    <th style="width:100px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                {{-- DATA DUMMY --}}
                <tr>
                    <td class="text-center">1</td>
                    <td>20191001</td>
                    <td>Tommy Satrio W.</td>
                    <td>Manajer Pemasaran</td>
                    <td>Hadir</td>
                    <td>18/02/2025 </td>
                    <td>08:00:00</td>
                    <td class="text-center">
                        <a href="{{ route('laporan.detail', 1) }}"
                        class="btn btn-sm btn-light border btn-sm px-4">
                            Rincian
                        </a>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</div>
@endsection
