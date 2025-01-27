<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link
            rel="icon"
            type="image/x-icon"
            href="{{ \App\Services\SettingService::getSrc('logo_favicon') }}"
        />

        <!-- prettier-ignore -->
        <title>{{ \App\Services\SettingService::get('site_title', config('app.name', 'Laravel')) }}</title>

        <meta
            name="description"
            content="{{ \App\Services\SettingService::get('site_description') }}"
        />

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
