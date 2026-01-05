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

        </div>

        {{-- Body --}}
        <div class="card-body page-body">

             {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                            <th>Aksi</th>
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
                                </td>
                                           <td class="text-center">
                            <form id="reset-form-{{ $user->id }}"
                                action="{{ route('datauser.reset-password', $user->id) }}"
                                method="POST"
                                class="d-inline">
                                @csrf
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        onclick="confirmReset({{ $user->id }}, '{{ $user->username }}')">
                                    Reset Password
                                </button>
                            </form>
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



{{-- UNTUK SWEET ALERT JS --}}
@push('scripts')
<script>
function confirmReset(userId, username) {
    Swal.fire({
        title: 'Reset Password?',
        html: `Password user <b>${username}</b> akan direset ke <b>123456</b>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Reset',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#f0ad4e',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('reset-form-' + userId).submit();
        }
    });
}
</script>
@endpush


@endsection




