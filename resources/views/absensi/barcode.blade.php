@extends('layouts.app')

@section('page-title', 'Barcode Absensi')

@section('content')
<div class="container-fluid">

    <div class="card p-5 text-center">

        <h4 class="fw-bold mb-2">Barcode Absensi</h4>
        <p class="text-muted mb-4">
            Silahkan scan barcode ini untuk Absensi {{ ucfirst($session->tipe) }}
        </p>

        {{-- QR CODE (BERBASIS TOKEN SESI) --}}
        <div class="mb-4">
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ $session->token }}"
                alt="QR Code Absensi">
        </div>

        {{-- ================================================= --}}
        {{-- KARYAWAN → KONFIRMASI ABSENSI --}}
        {{-- ================================================= --}}
        @auth
            @if(auth()->user()->role === 'karyawan')
                <form method="POST" action="{{ route('absensi.store') }}">
                    @csrf

                    <input type="hidden" name="karyawan_id"
                           value="{{ auth()->user()->karyawan->id }}">

                    <input type="hidden" name="tipe"
                           value="{{ $session->tipe }}">

                    <input type="hidden" name="token"
                           value="{{ $session->token }}">

                    <input type="hidden" name="metode" value="barcode">

                    <button type="submit" class="btn btn-success px-5">
                        Konfirmasi Absensi
                    </button>
                </form>
            @endif
        @endauth

        {{-- ================================================= --}}
        {{-- HRD → ADMIN OVERRIDE (OPSIONAL) --}}
        {{-- ================================================= --}}
        @auth
            @if(auth()->user()->role === 'hrd')
                <div class="mt-4 text-start">

                    <hr>

                    <h6 class="fw-bold mb-3">
                        Absensi Manual (HRD)
                    </h6>

                    <form method="POST" action="{{ route('absensi.manual') }}">
                        @csrf

                        <div class="mb-2">
                            <select name="karyawan_id" class="form-control" required>
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach($karyawan as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nik }} - {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="tipe"
                               value="{{ $session->tipe }}">

                        <input type="hidden" name="token"
                               value="{{ $session->token }}">

                        <input type="hidden" name="metode" value="manual">

                        <button type="submit" class="btn btn-warning">
                            Simpan Absensi Manual
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        {{-- BACK --}}
        <div class="mt-4">
            <a href="{{ route('absensi.index') }}" class="btn btn-light">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection
