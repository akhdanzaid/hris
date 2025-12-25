@extends('layoutsk.app')

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

   
@endsection
