<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        #welcome {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 72px;
            font-weight: bold;
            font-family: monospace;
        }
    </style>
</head>
<body>
<div id="welcome">{{ config('app.name', 'Laravel') }}</div>
</body>
</html>
