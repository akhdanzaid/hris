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
                           class="form-control @error('jenis_pengumuman') is-invalid @enderror"
                           placeholder="Contoh: Libur Nasional"
                           value="{{ old('jenis_pengumuman') }}">

                    @error('jenis_pengumuman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="4"
                              placeholder="Masukkan deskripsi pengumuman">{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kepada --}}
                <div class="mb-3">
                    <label class="form-label">Kepada</label>
                    <select name="kepada"
                            class="form-select @error('kepada') is-invalid @enderror">
                        <option value="">-- Pilih Tujuan --</option>
                        <option value="Semua Karyawan" {{ old('kepada') == 'Semua Karyawan' ? 'selected' : '' }}>
                            Semua Karyawan
                        </option>
                        <option value="HRD" {{ old('kepada') == 'HRD' ? 'selected' : '' }}>
                            HRD
                        </option>
                        <option value="Manager" {{ old('kepada') == 'Manager' ? 'selected' : '' }}>
                            Manager
                        </option>
                    </select>

                    @error('kepada')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control @error('tanggal') is-invalid @enderror"
                           value="{{ old('tanggal') }}">

                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('pengumuman.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8; border:none;">
                        Simpan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
