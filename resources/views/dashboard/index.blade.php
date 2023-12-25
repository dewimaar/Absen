@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
@endpush
@section('content')
<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body 1">
                    <h6 class="fs-6 fw-bold">Data Jabatan</h6>
                    <h4 class="fw-bold">{{ $positionCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body" id="card2">
                    <h6 class="fs-6 fw-bold">Data Pegawai</h6>
                    <h4 class="fw-bold">{{ $userCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body" id="card3">
                    <h6 class="fs-6 fw-bold">Hari Libur</h6>
                    <h4 class="fw-bold">{{ $holidayCount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection