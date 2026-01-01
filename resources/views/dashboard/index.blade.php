@extends('layouts.app')

@section('page-title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner --}}
    <div class="welcome-box d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Selamat Datang</h4>
            <p class="mb-0 text-muted">@if(Auth::check())
                {{ Auth::user()->username }}
                @endif</p>
        </div>
        <img src="{{ asset('img/avatar.png') }}" alt="avatar" class="welcome-avatar">
    </div>

    {{-- Statistik --}}
    <div class="row g-3 mb-5">

    {{-- Total Karyawan --}}
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $totalKaryawan }}</h3>
            <p>Karyawan</p>
        </div>
    </div>

    {{-- Total Hadir (sementara static) --}}
    <div class="col-md-3">
        <div class="stat-card">
            <h3>50</h3>
            <p>Total Hadir</p>
        </div>
    </div>

    {{-- Cuti Disetujui --}}
    <div class="col-md-3">
    <div class="stat-card">
        <h3>{{ $pendingCuti }}</h3>
        <p>Pengajuan Cuti</p>
    </div>
    </div>

    {{-- Current Task --}}
    <div class="col-md-3">
        <div class="stat-card">
            <h3>{{ $currentTask }}</h3>
            <p>Current Task</p>
        </div>
    </div>

</div>


    {{-- Todo --}}
    <div class="page-index-body">
        <h3 class="fw-bold mb-4">Todo List</h3>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dashboard.todo.store') }}" method="POST"
        class="d-flex gap-2 mb-4">
        @csrf

        <input type="text"
            name="title"
            class="form-control"
            placeholder="Add new task"
            required>

        <input type="date"
            name="due_date"
            class="form-control"
            style="max-width:180px"
            required>

        <button type="submit"
                class="btn btn-primary px-4"
                style="background:#759EB8; border:none;">
            Tambah
        </button>
    </form>


        <div class="card todo-card">
            <div class="card-body p-1">
                <table class="table align-middle mb-1">
                    <thead class="table-light">
                        <tr>
                            <th>To do</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($todos as $todo)
                        <tr>
                            {{-- Kolom todo --}}
                            <td class="{{ $todo->is_done ? 'todo-text done' : 'todo-text' }}">
                                {{ $todo->title }}
                            </td>

                            {{-- Kolom tanggal --}}
                            <td>
                                {{ \Carbon\Carbon::parse($todo->due_date)->format('d/m/Y') }}
                            </td>

                            {{-- Kolom action --}}
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">

                                    {{-- tombol done / unread --}}
                                    <form action="{{ route('dashboard.todo.toggle', $todo->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="btn btn-sm {{ $todo->is_done ? 'btn-primary' : 'btn-outline-primary' }}">
                                            ✓
                                        </button>
                                    </form>

                                    {{-- tombol hapus --}}
                                    <form action="{{ route('dashboard.todo.destroy', $todo->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin mau hapus todo ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            ✕
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
