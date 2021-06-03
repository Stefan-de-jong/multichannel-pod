<!doctype html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta
    charset="utf-8"
    />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    />
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    />
    <title>
        {{ config('app.name', 'Laravel') }}</title>
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer>
    </script>
    <script
        src="{{ asset('js/app.js') }}"
        defer>
    </script>
    <link
        href="{{ mix('css/app.css') }}"
        rel="stylesheet"
    />
</head>

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    @include('includes.header')

    <div>
        @yield('content')
    </div>

</body>
</html>
