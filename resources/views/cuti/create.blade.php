@extends('layouts.app')

@section('page-title', 'Pengajuan Cuti')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="card form-card">
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Ajukan Cuti</h5>
        </div>

        <div class="card-body page-body">
            <form method="POST"
                  action="{{ route('cuti.store') }}"
                  enctype="multipart/form-data">
                @csrf

                {{-- NIK --}}
                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text"
                           id="nik"
                           class="form-control"
                           placeholder="Masukkan NIK"
                           required>

                    <small id="nikError"
                           class="text-danger d-none">
                        NIK tidak ditemukan
                    </small>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           id="nama"
                           class="form-control bg-light"
                           readonly>
                </div>

                {{-- No Telp --}}
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon Aktif</label>
                    <input type="text"
                           id="phone"
                           class="form-control bg-light"
                           readonly>
                </div>

                {{-- Hidden karyawan_id --}}
                <input type="hidden"
                       name="karyawan_id"
                       id="karyawan_id">

                {{-- Alasan --}}
                <div class="mb-3">
                    <label class="form-label">Alasan Mengajukan Cuti</label>
                    <textarea name="alasan"
                              class="form-control"
                              rows="3"
                              required></textarea>
                </div>

                {{-- Tanggal --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Mulai Cuti</label>
                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Akhir Cuti</label>
                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control"
                               required>
                    </div>
                </div>

                {{-- Berkas --}}
                <div class="mb-4">
                    <label class="form-label">
                        Berkas Pendukung / Surat Keterangan
                    </label>
                    <input type="file"
                           name="berkas"
                           class="form-control">
                </div>

                {{-- Action --}}
                <div class="page-action d-flex gap-2">
                    <a href="{{ route('cuti.index') }}"
                        class="btn btn-secondary btn-sm px-4">
                            Kembali
                        </a>
                    <button type="submit"
                            id="btnSubmit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8;border:none">
                        Ajukan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- AJAX -->
<script>
const nikInput   = document.getElementById('nik');
const namaInput  = document.getElementById('nama');
const phoneInput = document.getElementById('phone');
const errorText  = document.getElementById('nikError');
const btnSubmit  = document.getElementById('btnSubmit');
const idInput    = document.getElementById('karyawan_id');

// default: tidak boleh submit
btnSubmit.disabled = true;

nikInput.addEventListener('blur', function () {
    const nik = this.value.trim();

    // reset state
    namaInput.value  = '';
    phoneInput.value = '';
    idInput.value    = '';
    btnSubmit.disabled = true;

    if (!nik) return;

    fetch(`/ajax/karyawan-by-nik/${nik}`)
        .then(res => res.json())
        .then(data => {
            if (data) {
                namaInput.value  = data.name;
                phoneInput.value = data.phone;
                idInput.value    = data.id;

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
