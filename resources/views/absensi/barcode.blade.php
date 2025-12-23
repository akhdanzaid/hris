@extends('layouts.app')

@section('page-title', 'Barcode Absensi')

@section('content')
<div class="container-fluid">

    <div class="card p-5 text-center">

        <h4 class="fw-bold mb-2">Barcode Absensi</h4>
        <p class="text-muted mb-4">
            Silahkan scan barcode ini untuk Absensi
        </p>

        {{-- QR DUMMY UNTUK PREVIEW --}}
        <div class="mb-4">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=ABSENSI-{{ $tipe }}"
                 alt="QR Code">
        </div>

        {{-- FORM → CONTROLLER ANDA --}}
        <form method="POST" action="{{ route('absensi.store') }}">
            @csrf

            {{-- DUMMY KARYAWAN --}}
            <input type="hidden" name="karyawan_id" value="1">

            <input type="hidden" name="tipe" value="{{ $tipe }}">
            <input type="hidden" name="metode" value="barcode">

            <button type="submit" class="btn btn-success px-5">
                Konfirmasi Absensi
            </button>
        </form>

        <div class="mt-4">
            <a href="{{ route('absensi.index') }}" class="btn btn-light">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection
