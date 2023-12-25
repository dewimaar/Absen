<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/Kemenkumham.png') }}" type="image/png">

    {{-- Include default styles --}}
    @include('partials.styles')

    {{-- Stack for additional styles --}}
    @stack('style')

    {{-- Set the title --}}
    <title>{{ $title ?? 'Default Title' }}</title>
</head>

<body>

    {{-- Include the toast container component --}}
    <x-toast-container />

    {{-- Yielded content for specific pages --}}
    @yield('base')

    {{-- Include default scripts --}}
    @include('partials.scripts')

    {{-- Stack for additional scripts --}}
    @stack('script')

</body>

</html>
