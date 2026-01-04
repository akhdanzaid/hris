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
            <form action="{{ route('gaji.update', $gaji->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $gaji->karyawan->nik }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Karyawan</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $gaji->karyawan->name }}"
                           readonly>
                </div>


                                <div class="mb-4">
                    <label class="form-label">Gaji Pokok</label>
                    <input type="number"
                        name="gaji_pokok"
                        class="form-control"
                        value="{{ $gaji->gaji_pokok }}"
                        min="0"
                        required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Total Potongan</label>
                    <input type="number"
                        name="total_potongan"
                        class="form-control"
                        value="{{ $gaji->total_potongan ?? 0 }}"
                        min="0"
                        required>
                </div>


                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('gaji.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8;border:none">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

