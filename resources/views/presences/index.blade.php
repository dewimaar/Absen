@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('css/presences.css') }}">
@endpush

@section('content')
@include('partials.alerts')

<div class="row">
    <div class="col-md-7">
        @foreach ($attendances as $attendance)
        <div class="card mb-3">
            <div class="card-body shadow">
                <a href="{{ route('presences.show', $attendance->id) }}" class="text-decoration-none text-dark">
                    <h5 class="card-title">{{ $attendance->title }}</h5>
                    <p class="card-text">{{ $attendance->description }}</p>
                </a>
            </div>
            <div class="position-absolute top-0 end-0 p-3">
                @include('partials.attendance-badges')
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
