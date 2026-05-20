<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'QJMOTOR - France' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    @include('layouts.navbar')

    <div class="main-app-container">
        {{ $slot }}
    </div>

</body>
</html>