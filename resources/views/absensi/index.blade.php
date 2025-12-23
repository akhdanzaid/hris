@extends('layouts.app')

@section('page-title', 'Absensi')

@section('content')
<div class="container-fluid">

    {{-- TAB --}}
    <div class="mb-4">
        <a href="{{ route('absensi.barcode', 'hadir') }}" class="btn btn-dark">
            Absensi Hadir
        </a>
        <a href="{{ route('absensi.barcode', 'pulang') }}" class="btn btn-light">
            Absensi Pulang
        </a>
    </div>

    <div class="card">
        <div class="card-header fw-semibold">
            Absensi Hadir
        </div>

        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label">Jam Mulai</label>
                    <input type="text" class="form-control" value="07:30" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jam Selesai</label>
                    <input type="text" class="form-control" value="08:30" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal Absensi</label>
                    <input type="text" class="form-control"
                           value="{{ now()->format('d/m/Y') }}" readonly>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-light">Kembali</button>
                <a href="{{ route('absensi.barcode', 'hadir') }}"
                   class="btn btn-primary">
                    Mulai
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
