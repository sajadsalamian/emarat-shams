<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عمارت شمس - @yield('pageTitle')</title>
    <meta name="theme-color" content="#0ea5d9"/>
    <meta name="description" content="اپلیکیشن گروه ساختمانی شمس">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}"/>
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<?php
$user = auth()->user();
?>

<body>

@yield('content')

<script src="{{ asset('js/iconify-icon.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
