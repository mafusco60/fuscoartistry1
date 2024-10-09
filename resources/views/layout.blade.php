<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link
            rel="icon"
            href="{{ asset('favicon.ico') }}"
            type="image/x-icon"
        />

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="{{ asset('favicon.png') }}"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
            rel="stylesheet"
        />

        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>{{ $title ?? 'Fusco Artistry' }}</title>
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body class="bg-gray-100">
        <x-header />
        @if (request()->is('/'))
            <x-hero />

            <x-top-banner />
        @endif

        <main class="container mx-auto p-8">
            {{-- Display alert message --}}
            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}" />
            @endif

            @if (session('error'))
                <x-alert type="error" message="{{ session('error') }}" />
            @endif

            {{ $slot }}
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-fancybox="gallery"]').fancybox({
                    // Options will go here
                });
            });
        </script>

        {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
    </body>
</html>
