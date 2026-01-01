@extends('layouts.app')

@section('page-title', 'Detail Karyawan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="card form-card">

        <div class="card-header page-header">
            <h5 class="page-title mb-0">Detail Karyawan</h5>
        </div>

        <div class="card-body page-body">

            <form action="{{ route('employee.update', $karyawan->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ================= INFORMASI DASAR ================= --}}
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
                               value="{{ $karyawan->name }}"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text"
                               name="birth_place"
                               class="form-control"
                               value="{{ $karyawan->birth_place }}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date"
                               name="birth_date"
                               class="form-control"
                               value="{{ $karyawan->birth_date }}"
                               required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="gender" class="form-select" required>
                            <option value="L" {{ $karyawan->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $karyawan->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                {{-- ================= KONTAK ================= --}}
                <h6 class="section-title mt-5">Kontak</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ $karyawan->phone }}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $karyawan->email }}">
                    </div>
                </div>

                {{-- ================= DETAIL PEKERJAAN ================= --}}
                <h6 class="section-title mt-5">Detail Pekerjaan</h6>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Departemen</label>
                        <select name="department_id" class="form-select" required>
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
                        <select name="position_id" class="form-select" required>
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
                               value="{{ $karyawan->join_date }}"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status Karyawan</label>
                        <select name="status_id" class="form-select" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $karyawan->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- ================= RINCIAN GAJI ================= --}}
                <h6 class="section-title mt-5">Rincian Gaji</h6>

                @if ($gajiTerakhir)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Gaji Pokok</label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="Rp. {{ number_format($gajiTerakhir->gaji_pokok, 0, ',', '.') }}"
                                   disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Potongan</label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="Rp. {{ number_format($gajiTerakhir->total_potongan, 0, ',', '.') }}"
                                   disabled>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Total Gaji</label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="Rp. {{ number_format($gajiTerakhir->total_gaji, 0, ',', '.') }}"
                                   disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Periode</label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="{{ $gajiTerakhir->periode }}"
                                   disabled>
                        </div>
                    </div>
                @else
                    <div class="card border-0 bg-light mt-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                Data gaji belum tersedia untuk karyawan ini.
                            </span>

                            <a href="{{ route('gaji.create', ['nik' => $karyawan->nik]) }}"
                               class="btn btn-primary btn-sm px-4"
                               style="background:#759EB8;border:none">
                                Tambah Gaji
                            </a>
                        </div>
                    </div>
                @endif

                {{-- ================= FOTO ================= --}}
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
                                 src="{{ $karyawan->photo
                                        ? asset('images/karyawan/'.$karyawan->photo)
                                        : asset('assets/img/user-placeholder.png') }}"
                                 class="photo-img">
                        </div>
                    </label>
                    <small class="text-muted d-block mt-2">
                        Klik foto jika ingin mengganti foto profil
                    </small>
                </div>

               {{-- ================= ACTION ================= --}}
                <div class="d-flex justify-content-end align-items-center gap-3 mt-5">

                    {{-- Kembali --}}
                    <a href="{{ route('employee.index') }}"
                    class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>

                    {{-- FORM UPDATE --}}
                    <form action="{{ route('employee.update', $karyawan->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="m-0">
                        @csrf
                        @method('PUT')

                        <button type="submit"
                                class="btn btn-success btn-sm px-4">
                            Update
                        </button>
                    </form>

                    {{-- FORM DELETE --}}
                    <form action="{{ route('employee.destroy', $karyawan->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data karyawan ini?')"
                        class="m-0">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm px-4">
                            Hapus
                        </button>
                    </form>

                </div>


        </div>
    </div>
</div>
@endsection

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('photoPreview').src = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>
