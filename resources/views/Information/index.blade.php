@extends('layouts.home')

@section('content')
<style>
        #uploadBox {
        border: 2px solid #000;
        padding: 0px;
        width: 31%;
        height: 100px;
        position: relative;
        overflow: hidden;
    }

    #userPhotoContainer {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .container.py-5 {
        border-radius: 10px; 
    }
    
    #date {
        width: 95%;
        height: 90px;
        margin-top: -95px; 
        border-radius: 4px; 
        border: none; 
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);
    }
    #currentTime {
        font-size: 20px;
    }
    .card-header {
        background-color: #fcd100;
    }
    #pegawai {
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);
    }
    #admin {
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.8);
    }
</style>
<div class="container py-5">
    <div class="row d-flex justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card mx-auto mb-4" id="date">
                <div class="card-body">
                    <div class="text-center mb-2 fw-bold" id="currentDate">
                        {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
                    </div>
                    <div class="text-center fw-bold" id="currentTime">
                        {{ \Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                    </div>
                </div>
            </div>                
        <!-- </div> -->
        <div class="col-md-4">
            <div class="card mb-3" id="pegawai">
                <div class="card-header">
                    Informasi Pegawai
                </div>
                <div class="card-body">
                <span class="fw-bold d-block mb-1">Foto Profil</span>
                    <div id="uploadBox" class="text-center mb-2">
                        <label for="photoInput" style="cursor: pointer;">
                            <div id="userPhotoContainer">
                                <img id="userPhoto" src="{{ asset('img/kucing.jpeg') }}" alt="User Photo" class="img-fluid" width="100">
                            </div>
                        </label>
                        <input id="photoInput" type="file" style="display: none;">
                    </div>
                    <ul class="ps-3">
                        <li class="mb-1">
                            <span class="fw-bold d-block">Nama : </span>
                            <span>{{ auth()->user()->name }}</span>
                        </li>
                        <li class="mb-1">
                            <span class="fw-bold d-block">Email : </span>
                            <span>{{ auth()->user()->email }}</span>
                        </li>
                        <li class="mb-1">
                            <span class="fw-bold d-block">NIP : </span>
                            <span>{{ auth()->user()->nip }}</span>
                        </li>
                        <li class="mb-1">
                            <span class="fw-bold d-block">JABATAN : </span>
                            <span>{{ auth()->user()->position->name }}</span>
                        </li>
                        <li class="mb-1">
                            <span class="fw-bold d-block">No. Telp : </span>
                            <span>{{ auth()->user()->phone }}</span>
                        </li>
                        <li class="mb-1">
                            <span class="fw-bold d-block">Bergabung Pada : </span>
                            <span>{{ auth()->user()->created_at->diffForHumans() }} ({{
                                auth()->user()->created_at->format('d M Y') }})</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card" id="admin">
                <div class="card-header">
                    Informasi Admin
                </div>
                <div class="card-body">
                    <ul class="ps-3">
                        <li class="mb-1">
                            <span class="fw-bold d-block">Contact Admin</span>
                            <span>085606990671</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('js/home/time.js') }}"></script>
<script>
    const photoInput = document.getElementById('photoInput');
    const userPhoto = document.getElementById('userPhoto');

    const storageKey = 'userPhoto_' + {{ auth()->user()->id }};

    photoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                userPhoto.src = e.target.result;
                localStorage.setItem(storageKey, e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    const storedPhoto = localStorage.getItem(storageKey);
    if (storedPhoto) {
        userPhoto.src = storedPhoto;
    }
</script>
<script>
    function updateDateTime() {
        var currentDateElement = document.getElementById('currentDate');
        var currentTimeElement = document.getElementById('currentTime');

        var currentDateTime = new Date();
        var formattedDate = currentDateTime.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

        var hours = currentDateTime.getHours().toString().padStart(2, '0');
        var minutes = currentDateTime.getMinutes().toString().padStart(2, '0');
        var seconds = currentDateTime.getSeconds().toString().padStart(2, '0');

        var formattedTime = hours + ':' + minutes + ':' + seconds;

        currentDateElement.textContent = formattedDate;
        currentTimeElement.textContent = formattedTime;
    }

    // Memanggil fungsi update setiap detik
    setInterval(updateDateTime, 1000);

    // Memastikan bahwa waktu ditampilkan segera setelah halaman dimuat
    updateDateTime();
</script>
@endpush
@endsection

