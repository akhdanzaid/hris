@extends('layouts.app')

@section('page-title', 'Pengumuman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="page-index-header mb-4">
        <h3 class="fw-bold mb-3">Pengumuman</h3>

        <a href="{{ route('pengumuman.create') }}"
           class="btn btn-primary mb-4 px-4"
           style="background:#759EB8; border:none;">
            Buat Pengumuman
        </a>
    </div>

    <div class="page-index-body">
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Search --}}
<form method="GET" action="{{ route('pengumuman.index') }}"
      class="row g-2 align-items-center mb-3">
    <div class="col">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Cari Pengumuman"
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
                        <th>Jenis Pengumuman</th>
                        <th>Deskripsi</th>
                        <th>Kepada</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
              <tbody>
            @forelse ($pengumuman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->jenis_pengumuman }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->kepada }}</td>
                    <td>{{ $item->waktu}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada pengumuman
                    </td>
                </tr>
            @endforelse
</tbody>

            </table>
        </div>

    </div>

</div>
@endsection
