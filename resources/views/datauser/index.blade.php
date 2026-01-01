@extends('layouts.app')

@section('page-title', 'Data User')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="form-container">

    <div class="card form-card">

        {{-- Header --}}
        <div class="card-header page-header d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Data User</h5>

            <button type="button"
                    class="btn btn-primary btn-sm px-4"
                    style="background:#759EB8;border:none"
                    data-bs-toggle="modal"
                    data-bs-target="#formModal">
                Tambah Data
            </button>
        </div>

        {{-- Body --}}
        <div class="card-body page-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'hrd' ? 'primary' : 'secondary' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    @if ($user->role !== 'hrd')
                                        <form action="{{ route('datauser.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm px-3">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                    <!-- rencana bakal diganti pake fontawesome/icon biar lebih oke jdi sementara gini dlu-->
                                        <span class="text-muted">—</span> 
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Data user kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Modal Tambah User --}}
<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form Input User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('datauser.register') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               class="form-control"
                               name="username"
                               placeholder="Masukkan username"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               class="form-control"
                               name="email"
                               placeholder="Masukkan email"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Masukkan password"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="hrd">HRD</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary btn-sm px-4"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-primary btn-sm px-4"
                            style="background:#759EB8;border:none">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
