<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عمارت شمس - @yield('pageTitle')</title>
    <meta name="theme-color" content="#0ea5d9"/>
    <meta name="description" content="اپلیکیشن گروه ساختمانی شمس">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<?php
$user = auth()->user();
?>

<body>
<header></header>

<div class="main-top">
    <p class="mb-0">خوش آمدید</p>
    <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
    <div class="notif">
        @if (Route::is('main'))
            @if($unread > 0)
                <a href="{{ route('Notification.all') }}">
                    <iconify-icon icon="mdi:bell" style="color: white;" width="30" height="30">
                    </iconify-icon>
                </a>
                <span>{{ $unread }}</span>
            @else
                <a href="{{ route('Notification.all') }}">
                    <iconify-icon icon="clarity:notification-line" style="color: white;" width="30" height="30">
                    </iconify-icon>
                </a>
            @endif
        @else
            <a class="btn p-0" href="@yield('backRoute')">
                <iconify-icon icon="ion:chevron-back-circle" style="color: white;" width="30" height="30">
                </iconify-icon>
            </a>
        @endif
    </div>
</div>

@yield('content')

<script src="{{ asset('js/iconify-icon.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://static.pushe.co/pusheweb.js"></script>
<script>
    Pushe.init("0gr6782o9j30onmg");
    Pushe.displayBell();
    Pushe.subscribe();

    var loggedIn = {{ auth()->check() ? 'true' : 'false' }};
    if (loggedIn) {
        Pushe.getDeviceId().then(function (deviceId) {
            console.log(`Users's unique deviceId is: ${deviceId}`);
        });

        const phoneNumber = {{ auth()->user()->phone }};
        Pushe.setUserPhoneNumber(phoneNumber)
            .then(() => console.log(`Successfully set phoneNumber`))
            .catch(error => console.error(`Error: ${error}`));

        const customId = {{ auth()->user()->personal_code }};
        Pushe.setCustomId(customId)
            .then(() => console.log(`Successfully set customId`))
            .catch(error => console.error(`Error: ${error}`));

        // Pushe.getUserPhoneNumber()
        //     .then(phoneNumber => console.log(`User PhoneNumber is ${phoneNumber}`));
        // Pushe.getCustomId()
        //     .then(customId => console.log(`customId is ${customId}`));
    }
</script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')
</body>

</html>
