<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'QJMOTOR' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    <div class="main-guest-container">
        {{ $slot }}
    </div>

</body>
</html>