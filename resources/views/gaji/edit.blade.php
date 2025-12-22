@extends('layouts.app')

@section('page-title', 'Edit Gaji')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        <div class="card-header page-header">
            <h5 class="page-title mb-0">Edit Data Gaji</h5>
        </div>

        <div class="card-body page-body">

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" value="{{ $gaji['nik'] }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" value="{{ $gaji['nama'] }}" disabled>
            </div>

            <div class="mb-4">
                <label class="form-label">Gaji Pokok</label>
                <input type="text" class="form-control"
                       name="gaji_pokok"
                       value="{{ number_format($gaji['gaji_pokok'], 0, ',', '.') }}">
            </div>

            <div class="page-action">
                <a href="{{ route('gaji.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
                <button class="btn btn-primary btn-sm px-4" style="background:#759EB8;border:none">
                    Update
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
