@extends('layouts.app')

@push('style')
@powerGridStyles
<link rel="stylesheet" href="{{ asset('css/button.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
<style>
    #tambah{
        background:#1B73C4;
        color: #fff;
    }
</style>
@endpush

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('attendances.create') }}" class="btn btn-sm " id="tambah">
            <span data-feather="plus-circle" class="align-text-bottom me-1"></span>
            Tambah Data Absensi
        </a>
    </div>
</div>
@endsection

@section('content')
@include('partials.alerts')
<livewire:attendance-table />
@endsection

@push('script')
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
@powerGridScripts
@endpush