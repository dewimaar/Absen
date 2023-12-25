@extends('layouts.auth')

@push('style')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
@endpush

@section('content')

<div class="w-100">

    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('auth.login') }}" id="login-form">
            <img src="{{ asset('img/Kemenkumham1.svg') }}" class=" mx-auto d-block">
            <h1 class="h3 fw-bold text-center">E-Presensi</h1>
            <p class="h3 mb-4 fw-normal text-center">Silahkan Masuk</p>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="name@example.com">
                <label for="floatingInputEmail">Alamat Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Kata Sandi">
                <label for="floatingPassword">Kata Sandi</label>
            </div>

            <!-- Tautan Lupa Kata Sandi -->
            <div class="mb-3 text-end">
                <a href="{{ route('password.request') }}" style="text-decoration: none; font-size: 13px;">Lupa kata sandi?</a>
            </div>

            <div class="form-check mb-3 mt-5">
                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckRemember">
                <label class="form-check-label" for="flexCheckRemember">
                    Ingatkan Saya di Perangkat ini
                </label>
            </div>
            <button class="w-100 btn btn-primary" type="submit" id="login-form-button">Masuk</button>
        </form>
    </main>

</div>
@endsection

@push('script')
<script type="module" src="{{ asset('js/auth/login.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen checkbox "Ingatkan Saya di Perangkat Ini"
        var rememberCheckbox = document.getElementById('flexCheckRemember');

        // Ambil elemen input email dan password
        var emailInput = document.getElementById('floatingInputEmail');
        var passwordInput = document.getElementById('floatingPassword');

        // Cek apakah checkbox di-check saat halaman dimuat
        var storedRemember = localStorage.getItem('storedRemember');
        if (storedRemember === 'true') {
            rememberCheckbox.checked = true;

            // Ambil nilai email dan password dari cookie atau local storage
            var storedEmail = localStorage.getItem('storedEmail');
            var storedPassword = localStorage.getItem('storedPassword');

            // Set nilai input email dan password
            if (storedEmail && storedPassword) {
                emailInput.value = storedEmail;
                passwordInput.value = storedPassword;
            }
        }

        // Tambahkan event listener untuk saat form disubmit
        document.getElementById('login-form').addEventListener('submit', function() {
            // Jika checkbox di-check, simpan nilai email dan password ke cookie atau local storage
            localStorage.setItem('storedRemember', rememberCheckbox.checked);
            if (rememberCheckbox.checked) {
                localStorage.setItem('storedEmail', emailInput.value);
                localStorage.setItem('storedPassword', passwordInput.value);
            }
        });
    });
</script>
@endpush
