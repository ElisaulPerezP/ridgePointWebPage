<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">

    <!-- Scripts -->
    @vite([ 'resources/css/app.css',
            'resources/css/main.css',
            'resources/js/app.js',
            'resources/vendor/bootstrap/css/bootstrap.min.css',
            'resources/vendor/bootstrap-icons/bootstrap-icons.css',
            'resources/vendor/aos/aos.css',
            'resources/vendor/aos/aos.js',
            'resources/js/main.js',])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <div class="bg-black">

        <div>
            @if(isset($welcomeCarousel))
                <div>

                    @include('layouts.navigation')

                </div>
                <div>
                    {{$welcomeCarousel}}
                </div>
            @else
                @if(isset($slotHead))
                    <div class="container">
                        @include('layouts.navigation')
                        <section id="title" class="">
                            {{$slotHead}}
                        </section>
                    </div>
                @else
                    <div class="default-carousel">
                        <p>El contenido de cavecera no esta disponible.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div>
        <main>
            @if(isset($contactForm))
                {{$contactForm}}
            @else
                @if(isset($slotMain))
                    {{$slotMain}}
                @else
                    <div class="default-carousel">
                        <p>El contenido principal no esta disponible.</p>
                    </div>
                @endif
            @endif
        </main>
    </div>
</div>
</body>
</html>
