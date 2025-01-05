<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/js/public.ts', 'resources/css/public.css'])
    </head>
    <body class="bg-whiten font-satoshi antialiased">
        @include('parts.header')
        <div class="container mt-6">
            @yield('body')
        </div>
        @include('parts.footer')
    </body>
</html>
