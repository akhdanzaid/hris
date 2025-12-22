@extends('layouts.app')

@section('page-title', 'Tambah Gaji')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        <div class="card-header page-header">
            <h5 class="page-title mb-0">Tambah Data Gaji</h5>
        </div>

        <div class="card-body page-body">
            <form method="POST" action="{{ route('gaji.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text"
                           name="nik"
                           class="form-control"
                           placeholder="Masukkan NIK Karyawan">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gaji Pokok</label>
                    <input type="number"
                           name="gaji_pokok"
                           class="form-control"
                           placeholder="Masukkan Gaji Pokok">
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('gaji.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4" style="background:#759EB8;border:none">
                        Tambah
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
