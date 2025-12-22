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
                    id="nik"
                    name="nik"
                    class="form-control"
                    value="{{ $karyawan->nik ?? '' }}"
                    {{ $karyawan ? 'readonly' : '' }}
                    required>

                    <small id="nikError" class="text-danger d-none">
                        NIK tidak ditemukan. Silakan buat data karyawan terlebih dahulu.
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Karyawan</label>
                    <input type="text"
                        id="nama"
                        class="form-control bg-light"
                        value="{{ $karyawan->name ?? '' }}"
                        readonly>
                </div>


                <div class="mb-3">
                    <label class="form-label">Gaji Pokok</label>
                    <input type="number"
                        name="gaji_pokok"
                        class="form-control"
                        placeholder="Masukkan Gaji Pokok"
                        required>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('gaji.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            id="btnSubmit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8;border:none"
                            {{ $karyawan ? '' : 'disabled' }}>
                        Tambah
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- js autofill -->
<script>
const nikInput  = document.getElementById('nik');
const namaInput = document.getElementById('nama');
const errorText = document.getElementById('nikError');
const btnSubmit = document.getElementById('btnSubmit');

// Kalau NIK datang dari detail karyawan
if (nikInput.hasAttribute('readonly')) {
    btnSubmit.disabled = false;
}

nikInput.addEventListener('blur', function () {
    const nik = this.value.trim();

    if (!namaInput) return;

    namaInput.value = '';
    btnSubmit.disabled = true;

    if (!nik) return;

    fetch(`/ajax/karyawan-by-nik/${nik}`)
        .then(res => res.json())
        .then(data => {
            if (data) {
                namaInput.value = data.name;
                errorText.classList.add('d-none');
                btnSubmit.disabled = false;
            } else {
                errorText.classList.remove('d-none');
            }
        })
        .catch(() => {
            errorText.classList.remove('d-none');
        });
});
</script>

@endsection


