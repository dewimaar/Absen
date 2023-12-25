@extends('layouts.app')

@section('buttons')
<div class="btn-toolbar mb-2 mb-md-0">
    <div>
        <a href="{{ route('positions.index') }}" class="btn btn-sm btn-primary">
            <span data-feather="arrow-left-circle" class="align-text-bottom text-white"></span>
            Kembali
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <livewire:position-create-form />
    </div>
</div>
@endsection