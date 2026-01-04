@extends('layoutsk.app')

@section('page-title', 'Edit Akun')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">
    <div class="card form-card">

        <div class="card-header page-header">
            <h5 class="page-title mb-0">Edit Akun</h5>
        </div>

        <div class="card-body page-body">
            <form method="POST" action="{{ route('akun.update') }}" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan akun?')">
                @csrf
                @method('PUT')

                {{-- Username --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ $user->username }}"
                           readonly>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Kosongkan jika tidak ingin mengganti password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password baru">
                </div>

                {{-- Role --}}
                <div class="mb-4">
                    <label class="form-label">Role</label>
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ ucfirst($user->role) }}"
                           readonly>
                    <input type="hidden" name="role" value="{{ $user->role }}">
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('dashboardk.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8; border:none;"
                            >
                        Simpan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
