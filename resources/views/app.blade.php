<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link
            rel="icon"
            type="image/x-icon"
            href="{{ \App\Services\SettingService::getSrc('logo_favicon') }}"
        />

        <script>
            var logo_default = '{{ \App\Services\SettingService::getSrc('logo_default') }}';
            var logo_dark = '{{ \App\Services\SettingService::getSrc('logo_dark') }}';
            var logo_icon = '{{ \App\Services\SettingService::getSrc('logo_icon') }}';
        </script>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
