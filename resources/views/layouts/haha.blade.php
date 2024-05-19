<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('styles')
</head>
<body>
<div class="wrapper">
    <div>
        @yield('content')
    </div>
</div>
@yield('scripts')
</body>
</html>