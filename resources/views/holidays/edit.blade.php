@extends('layouts.app')
@push('style')
@powerGridStyles
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
        <a href="{{ route('holidays.index') }}" class="btn btn-sm " id="tambah">
            <span data-feather="arrow-left-circle" class="align-text-bottom"></span>
            Kembali
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <livewire:holiday-edit-form :holidays="$holidays" />
    </div>
</div>
@endsection