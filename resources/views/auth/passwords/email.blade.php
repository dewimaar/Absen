@extends('layouts.auth')

@push('style')
<link rel="stylesheet" href="{{ asset('css/auth/email.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
@endpush

@section('content')

<div class="w-100">

    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <img src="{{ asset('img/Kemenkumham1.svg') }}" class=" mx-auto d-block">
            <h1 class="h3 mt-3 fw-bold text-center">Lupa Sandi</h1>
            <p class="h3 mt-4 fw-normal">Masukkan Alamat Email</p>
            
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="name@example.com">
                <label for="floatingInputEmail">Alamat Email</label>
            </div>
            <button class="w-100 btn btn-primary" type="submit" id="login-form-button">{{ __('Selanjutnya') }}</button>
        </form>
        <div class="text-end">
            <a href="{{ route('auth.login') }}" class="btn btn-link" style="text-decoration: none;">
                {{ __('Kembali ke login') }}
            </a>
        </div>
    </main>

</div>
@endsection

@push('script')
<script type="module" src="{{ asset('js/auth/forgot-password.js') }}"></script>
@endpush

