@push('style')
<link rel="stylesheet" href="{{ asset('css/home-navbar.css') }}">
@endpush
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: rgba(37, 36, 89, 1);">
    <div class="container mb-5">
        <a class="navbar-brand bg-transparent fw-bold" href="{{ route('home.index') }}"><span><img src="{{ asset('img/Kemenkumham.png') }}" class="mb-2 mx-1 mt-1" style="width: 40px; height: 40px; margin-left: -5px; color: #000;"></span> <h1 style="font-size: 20px; margin-left: 55px; margin-top: -49px; font-weight: bold;">E-Presensi</h1> <p style="margin-left: 55px; margin-top: -10px; margin-bottom: 0px; font-size: 15px; font-weight: bold;">Kumham Jateng</p></a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav align-items-md-center gap-md-4 py-2 py-md-0">
                <li class="nav-item px-4 py-1 px-md-0 py-md-0 text-center">
                    <a class="nav-link {{ request()->routeIs('home.*') ? 'active fw-bold' : '' }}" aria-current="page"
                        href="{{ route('home.index') }}" style=" color: #fff; border: 1px solid #48C4FA; border-radius: 8px; background-color: #48C4FA;">Beranda</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0 fw-bold text-center">
                    <a class="nav-link {{ request()->routeIs('Information.*') ? 'active fw-bold' : '' }}" aria-current="page"
                        href="{{ route('home.Information.index') }}" style=" color: #fff; border: 1px solid green; border-radius: 8px; background-color: green;">Informasi</a>
                </li>
                <li class="nav-item px-4 py-1 px-md-0 py-md-0 fw-bold text-center">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" style=" color: #fff; border: 1px solid red; border-radius: 8px; background-color: red;">
                        Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('auth.logout') }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</div>