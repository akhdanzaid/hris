@extends('layouts.app')

@section('page-title', 'Tambah Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Tambah Karyawan</h5>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">
            <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Informasi Dasar --}}
                <h6 class="section-title">Informasi Dasar</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-select">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                {{-- Kontak --}}
                <h6 class="section-title mt-5">Kontak</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                {{-- Detail Pekerjaan --}}
                <h6 class="section-title mt-5">Detail Pekerjaan</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Departemen</label>
                        <select name="department_id" class="form-select">
                            <option value="" disabled selected>Pilih Departemen</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <select name="position_id" class="form-select">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Bergabung</label>
                        <input type="date" name="join_date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status Karyawan</label>
                            <select name="status_id" class="form-select">
                                <option value="" disabled selected>Pilih Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                    </div>
                </div>

                {{-- Foto --}}
                <h6 class="section-title mt-5">Foto Profile</h6>
                <div class="photo-upload mb-4">
                    <label class="photo-box">
                        <input type="file" name="photo" hidden>
                        <div class="photo-placeholder">
                            Upload Photo Here
                        </div>
                    </label>
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('employee.index') }}"
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
