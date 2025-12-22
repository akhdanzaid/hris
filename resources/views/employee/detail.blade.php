@extends('layouts.app')

@section('page-title', 'Detail Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header">
            <h5 class="page-title mb-0">Detail Karyawan</h5>
        </div>

        <div class="card-body page-body">
            <form action="{{ route('employee.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Informasi Dasar --}}
                <h6 class="section-title">Informasi Dasar</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $karyawan->nik }}"
                               readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $karyawan->name }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text"
                               name="birth_place"
                               class="form-control"
                               value="{{ $karyawan->birth_place }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date"
                               name="birth_date"
                               class="form-control"
                               value="{{ $karyawan->birth_date }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="L" {{ $karyawan->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $karyawan->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                {{-- Kontak --}}
                <h6 class="section-title mt-5">Kontak</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ $karyawan->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $karyawan->email }}">
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
                                <option value="{{ $dept->id }}"
                                    {{ $karyawan->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <select name="position_id" class="form-select">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ $karyawan->position_id == $pos->id ? 'selected' : '' }}>
                                    {{ $pos->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Bergabung</label>
                        <input type="date"
                               name="join_date"
                               class="form-control"
                               value="{{ $karyawan->join_date }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status Karyawan</label>
                        <select name="status_id" class="form-select">
                            <option value="" disabled selected>Pilih Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $karyawan->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Rincian Gaji --}}
                <h6 class="section-title mt-5">Rincian Gaji</h6>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="Rp. 20.000.000"
                               disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Potongan</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="Rp. 100.000"
                               disabled>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Total Gaji</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="Rp. 19.900.000"
                               disabled>
                    </div>
                </div>

                {{-- Foto --}}
                <h6 class="section-title mt-5">Foto Profil</h6>

                <div class="photo-upload mb-4">
                    <label class="photo-box">

                        <input type="file"
                            name="photo"
                            hidden
                            accept="image/*"
                            onchange="previewPhoto(event)">

                        <div class="photo-placeholder">
                            <img id="photoPreview"
                                src="{{ $karyawan->photo ? asset('images/karyawan/'.$karyawan->photo) : '' }}"
                                class="photo-img {{ $karyawan->photo ? '' : 'd-none' }}">
                            <span id="photoText"
                                class="{{ $karyawan->photo ? 'd-none' : '' }}">
                                Upload Photo Here
                            </span>

                        </div>
                    </label>
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('employee.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                        class="btn btn-success btn-sm px-4">
                        Update
                    </button>
                    <form action="{{ route('employee.destroy', $karyawan->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data karyawan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm px-4">
                            Hapus
                        </button>
                    </form>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

<script>
function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('photoPreview');
    const text = document.getElementById('photoText');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            text.classList.add('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>


