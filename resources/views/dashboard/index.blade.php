@extends('layouts.app')

@section('page-title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    {{-- Welcome Banner --}}
    <div class="welcome-box mb-4 {{ session('just_logged_in') ? 'animate-welcome' : '' }}">
        <div class="welcome-content {{ session('just_logged_in') ? 'animate-text' : '' }}">
            <h3 class="mb-1">SELAMAT DATANG</h3>
            <p class="mb-0">
                {{ Auth::user()->username }}
            </p>
        </div>

        <img src="{{ asset('images/karyawan/hrd.png') }}"
            alt="avatar"
            class="welcome-avatar {{ session('just_logged_in') ? 'animate-avatar' : '' }}">
    </div>

    {{-- Statistik card --}}
    <div class="row g-3 mb-5">

        <div class="col-md-3">
            <div class="stat-card 
                {{ session('just_logged_in') ? 'animate-stat delay-1' : '' }}">
                <h3>{{ $totalKaryawan }}</h3>
                <p>Karyawan</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card 
                {{ session('just_logged_in') ? 'animate-stat delay-2' : '' }}">
                <h3>50</h3>
                <p>Total Hadir</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card
                {{ session('just_logged_in') ? 'animate-stat delay-3' : '' }}">
                <h3>{{ $pendingCuti }}</h3>
                <p>Pengajuan Cuti</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card
                {{ session('just_logged_in') ? 'animate-stat delay-4' : '' }}">
                <h3>{{ $currentTask }}</h3>
                <p>To do</p>
            </div>
        </div>

    </div>


    {{-- Todo --}}
    <div class="page-index-body">
        <h3 class="fw-bold mb-4">Todo List</h3>

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
                            <th>Tanggal</th>
                            <th class="text-end">Aksi</th>
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
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDeleteTodo({{ $todo->id }})">
                                        ✕
                                    </button>

                                    <form id="delete-todo-{{ $todo->id }}"
                                        action="{{ route('dashboard.todo.destroy', $todo->id) }}"
                                        method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
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

@push('scripts')
<script>
function confirmDeleteTodo(todoId) {
    Swal.fire({
        title: 'Hapus Todo?',
        text: 'Todo yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-todo-' + todoId).submit();
        }
    });
}
</script>
@endpush

