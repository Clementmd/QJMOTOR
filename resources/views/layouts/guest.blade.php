<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'QJMOTOR' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="guest-wrapper">
        {{ $slot }}
    </div>
    <style>
        .guest-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6; 
        }
    </style>
</head>
</body>
</html>