@extends('layoutsk.app')

@section('page-title', 'Absensi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="card d-flex align-items-center justify-content-center"
         style="min-height: 60vh">

        <div class="text-center">

            <img src="{{ asset('images/karyawan/closed.png') }}"
                 alt="No Session"
                 style="max-width: 400px"
                 class="mb-4">

            <h4 class="fw-bold">
                Barcode Absensi Belum / Tidak tersedia Saat ini
            </h4>

            <p class="text-muted mt-2">
                Silahkan Tunggu HRD Membuka Sesi Absensi atau Hubungi HRD Untuk Informasi Lebih Lanjut.
            </p>

        </div>

    </div>

</div>
@endsection
