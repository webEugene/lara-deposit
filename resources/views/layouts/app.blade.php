<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
<nav class="p-6 bg-white flex justify-between mb-2">
    <ul class="flex items-center">
        <li>
            <a href="{{ url('/') }}" class="p-3">Home</a>
        </li>
    </ul>
    <ul class="flex items-center">
        @auth
            <li>
                <a href="{{ route('user.index', auth()->user()->id) }}" class="p-3">{{ auth()->user()->login }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="p-3">Logout</button>
                </form>
            </li>
        @endauth
        @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
        @endguest
    </ul>
</nav>
@yield('content')
</body>
</html>
{{--friday - 2h (installation, migrations (2 tables), start app style and structure)--}}
