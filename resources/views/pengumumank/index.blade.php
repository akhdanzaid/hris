@extends('layoutsk.app')

@section('page-title', 'Pengumuman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="page-index-body">

        {{-- Search --}}
        <form class="row g-2 align-items-center mb-3">
            <div class="col">
                <input type="text"
                       class="form-control"
                       placeholder="Cari Pengumuman">
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
                        <th>Jenis Pengumuman</th>
                        <th>Deskripsi</th>
                        <th>Kepada</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DATA DUMMY --}}
                    <tr>
                        <td class="text-center">1</td>
                        <td>Pengingat</td>
                        <td>Mengadakan pertemuan dengan perusahaan A</td>
                        <td>Produksi Tim Kreatif</td>
                        <td>4 Januari 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
