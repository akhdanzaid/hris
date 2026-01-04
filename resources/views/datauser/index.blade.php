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

@endsection




