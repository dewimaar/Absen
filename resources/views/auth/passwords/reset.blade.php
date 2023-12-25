@extends('layouts.auth')

@push('style')
<link rel="stylesheet" href="{{ asset('css/auth/reset.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
@endpush

@section('content')

<div class="w-100">

    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('password.update') }}" id="reset-password-form">
            <img src="{{ asset('img/Kemenkumham1.svg') }}" class=" mx-auto d-block">
            <h1 class="h3 mt-3 fw-bold text-center">Lupa Sandi</h1>
            <p class="h3 mt-4 fw-normal">Lupa Sandi</p>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating">
                <input type="email" class="form-control mb-3" id="floatingInputEmail" name="email" value="{{ $email }}" placeholder="name@example.com" readonly>
                <label for="floatingInputEmail">Alamat Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control mb-3" id="floatingPassword" name="password" placeholder="Kata Sandi Baru">
                <label for="floatingPassword">Kata Sandi Baru</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control mb-3" id="floatingPasswordConfirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi Baru">
                <label for="floatingPasswordConfirmation">Konfirmasi Kata Sandi Baru</label>
            </div>
            <button class="w-100 btn btn-primary" type="submit" id="reset-password-form-button">Reset Kata Sandi</button>
        </form>
        <div class="text-end">
            <a href="{{ route('password.email') }}" class="btn btn-link" style="text-decoration: none;">
                {{ __('Kembali ke Email') }}
            </a>
        </div>
    </main>

</div>
@endsection

@push('script')
<script type="module" src="{{ asset('js/auth/forgot-password.js') }}"></script>
@endpush

