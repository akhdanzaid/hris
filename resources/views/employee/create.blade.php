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

                {{-- ================= Informasi Dasar ================= --}}
                <h6 class="section-title">Informasi Dasar</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text"
                               name="nik"
                               value="{{ old('nik') }}"
                               class="form-control @error('nik') is-invalid @enderror"
                               required>
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text"
                               name="birth_place"
                               value="{{ old('birth_place') }}"
                               class="form-control @error('birth_place') is-invalid @enderror"
                               required>
                        @error('birth_place')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date"
                               name="birth_date"
                               value="{{ old('birth_date') }}"
                               class="form-control @error('birth_date') is-invalid @enderror"
                               required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender"
                                class="form-select @error('gender') is-invalid @enderror"
                                required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>
                                Pilih Jenis Kelamin
                            </option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ================= Kontak ================= --}}
                <h6 class="section-title mt-5">Kontak</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="form-control @error('phone') is-invalid @enderror"
                               required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ================= Detail Pekerjaan ================= --}}
                <h6 class="section-title mt-5">Detail Pekerjaan</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Departemen</label>
                        <select name="department_id"
                                class="form-select @error('department_id') is-invalid @enderror"
                                required>
                            <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>
                                Pilih Departemen
                            </option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <select name="position_id"
                                class="form-select @error('position_id') is-invalid @enderror"
                                required>
                            <option value="" disabled {{ old('position_id') ? '' : 'selected' }}>
                                Pilih Jabatan
                            </option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ old('position_id') == $pos->id ? 'selected' : '' }}>
                                    {{ $pos->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('position_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Bergabung</label>
                        <input type="date"
                               name="join_date"
                               value="{{ old('join_date') }}"
                               class="form-control @error('join_date') is-invalid @enderror"
                               required>
                        @error('join_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status Karyawan</label>
                        <select name="status_id"
                                class="form-select @error('status_id') is-invalid @enderror"
                                required>
                            <option value="" disabled {{ old('status_id') ? '' : 'selected' }}>
                                Pilih Status
                            </option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ================= Foto ================= --}}
                <h6 class="section-title mt-5">Foto Profile</h6>

                <div class="photo-upload mb-4">
                    <label class="photo-box">
                        <input type="file"
                               name="photo"
                               hidden
                               accept="image/*"
                               onchange="previewPhoto(event)">
                        <div class="photo-placeholder">
                            <img id="photoPreview" class="photo-img d-none">
                            <span id="photoText">Upload Photo Here</span>
                        </div>
                    </label>
                </div>

                {{-- ================= Action ================= --}}
                <div class="d-flex justify-content-end gap-2 mt-5">
                    <a href="{{ route('employee.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8;border:none">
                        Tambah
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('photoPreview');
        const text = document.getElementById('photoText');

        img.src = e.target.result;
        img.classList.remove('d-none'); // 🔥 tampilkan gambar
        text.classList.add('d-none');   // 🔥 sembunyikan teks
    };
    reader.readAsDataURL(file);
}
</script>

