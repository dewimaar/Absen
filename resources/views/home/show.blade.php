@extends('layouts.home')

@section('content')
<style>
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
    .attendance-history-container {
        overflow-x: auto;
        white-space: nowrap;
    }

    .attendance-card {
        display: inline-block;
        margin-right: 10px;
    }
    .attendance-card .card-body {
        height: 165px;
        width: 350px;
        overflow-y: auto;
    }
</style>
<div class="container py-5">
    <div class="row">
        <!-- <div class="col-md-6 mb-3 mb-md-0"> -->
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
            <div class="mb-2">
                @include('partials.attendance-badges')
            </div>
            @include('partials.alerts')

            <h1 class="fs-2">{{ $attendance->title }}</h1>
            <p class="text-muted">{{ $attendance->description }}</p>

            <div class="mb-4">
                <span class="badge text-bg-light border shadow-sm">Masuk : {{
                    substr($attendance->data->start_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_start_time,0,-3 )}}</span>
                <span class="badge text-bg-light border shadow-sm">Pulang : {{
                    substr($attendance->data->end_time, 0 , -3) }} - {{
                    substr($attendance->data->batas_end_time,0,-3 )}}</span>
            </div>

            @if (!$attendance->data->is_using_qrcode)
            <livewire:presence-form :attendance="$attendance" :data="$data" :holiday="$holiday">
            @else
            @include('home.partials.qrcode-presence')
            @endif
        <!-- </div> -->
        <div class="col-md-6">
            <h5 class="mb-3 mt-3">Histori 30 Hari Terakhir</h5>
            <div class="attendance-history-container">
                @foreach ($priodDate as $date)
                {{-- not presence / tidak hadir --}}
                @php
                $histo = $history->where('presence_date', $date)->first();
                @endphp
                <div class="card mb-3 attendance-card">
                    <div class="card-body p-0 shadow">
                        <!-- <h6 class="card-header">No: {{ $loop->iteration }}</h6> -->
                        <p class="card-header p-2">Tanggal: {{ $date }}</p>
                        <div class="p-2">
                            <!-- <p class="card-text">Tanggal: {{ $date }}</p> -->
                            @if (!$histo)
                                <p class="card-text">Status:
                                    @if($date == now()->toDateString())
                                        <span class="badge text-bg-info">Belum Hadir</span>
                                    @else
                                        <span class="badge text-bg-danger">Tidak Hadir</span>
                                    @endif
                                </p>
                            @else
                                <p class="card-text">Jam Masuk: {{ $histo->presence_enter_time }}</p>
                                <p class="card-text">Jam Pulang:
                                    @if($histo->presence_out_time)
                                        {{ $histo->presence_out_time }}
                                    @else
                                        <span class="badge text-bg-danger">Belum Absensi Pulang</span>
                                    @endif
                                </p>
                                <p class="card-text">Status:
                                    @if ($histo->is_permission)
                                        <span class="badge text-bg-warning">Izin</span>
                                    @else
                                        <span class="badge text-bg-success">Hadir</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
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
@endsection