@extends('layouts.app')

@section('page-title', 'Buat Pengumuman')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Buat Pengumuman</h5>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">
            <form method="POST" action="{{ route('pengumuman.store') }}">
                @csrf

                {{-- Jenis Pengumuman --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Pengumuman</label>
                    <input type="text"
                           name="jenis_pengumuman"
                           class="form-control"
                           placeholder="Masukkan jenis pengumuman">
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan deskripsi pengumuman"></textarea>
                </div>

                {{-- Kepada --}}
                <div class="mb-3">
                    <label class="form-label">Kepada</label>
                    <input type="text"
                           name="kepada"
                           class="form-control"
                           placeholder="Ditujukan kepada">
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control">
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('pengumuman.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4" style="background:#759EB8; border:none;">
                        Tambah
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
