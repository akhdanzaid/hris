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
        <div class="col-md-3"><div class="stat-card"><h3>54</h3><p>Karyawan</p></div></div>
        <div class="col-md-3"><div class="stat-card"><h3>50</h3><p>Total Hadir</p></div></div>
        <div class="col-md-3"><div class="stat-card"><h3>2</h3><p>Pengajuan Cuti</p></div></div>
        <div class="col-md-3"><div class="stat-card"><h3>3</h3><p>Current Task</p></div></div>
    </div>

    {{-- Todo --}}
    <div class="page-index-body">
        <h3 class="fw-bold mb-4">Todo List</h3>

        <form id="todoForm" class="d-flex gap-2 mb-4">
            <input type="text" class="form-control" placeholder="Add new task" required>
            <input type="date" class="form-control" style="max-width:180px">
            <button type="submit" class="btn btn-primary px-4" style="background:#759EB8; border:none;">
                Tambah
            </button>
        </form>

        <div class="card todo-card">
            <div class="card-body p-1">
                <table class="table align-middle mb-1">
                    <thead class="table-light">
                        <tr>
                            <th>Todo</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody id="todoList">
                        <tr>
                            <td class="todo-text">Training Office Worker</td>
                            <td>16/12/2025</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1 btn-check">✓</button>
                                <button class="btn btn-sm btn-outline-danger">✕</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
