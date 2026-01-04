@extends('layouts.app')

@section('page-title', 'Absensi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="card p-5 text-center">

        <h4 class="fw-bold mb-2">
            Absensi {{ ucfirst($session->tipe) }}
        </h4>

        <p class="text-muted mb-4">
            Silahkan scan barcode untuk melakukan absensi
        </p>

        <div class="mb-4">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ $session->token }}"
                 alt="QR Code Absensi">
        </div>

        <form method="POST" action="{{ route('absensik.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $session->token }}">
            <input type="hidden" name="tipe" value="{{ $session->tipe }}">

            <button class="btn btn-success px-5">
                Konfirmasi Absensi
            </button>
        </form>

    </div>

</div>
@endsection
