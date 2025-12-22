@extends('layouts.app')

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
            <form method="POST" action="{{ route('akun.update') }}">
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
                           value="{{ $user->email }}">
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password baru">
                </div>

                {{-- Role (Readonly) --}}
                <div class="mb-4">
                    <label class="form-label">Role</label>

                    {{-- Tampil readonly --}}
                    <input type="text"
                           class="form-control bg-light"
                           value="{{ ucfirst($user->role) }}"
                           readonly>

                    {{-- Hidden agar tetap terkirim --}}
                    <input type="hidden"
                           name="role"
                           value="{{ $user->role }}">
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-3 mt-5">
                    <a href="{{ route('dashboard.index') }}"
                       class="btn btn-secondary btn-sm px-4">
                        Kembali
                    </a>
                    <a href=""
                            class="btn btn-primary btn-sm px-4" style="background:#759EB8; border:none;">
                        Simpan
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
