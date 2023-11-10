<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ICATE | Panel</title>
    <link rel="icon" type="image/png" href="{{ asset('images/ICATEBCS-favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    {{ $head }}
</head>
<body>
<div id="app">
    <div id="layout-wrapper">
        <x-sidebar/>
        <div class="main-content">
            {{ $slot }}
            <x-footer/>
        </div>
    </div>
</div>
@vite(['resources/js/app.js'])
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
{{--<script src="{{ asset('libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{ asset('libs\simplebar\simplebar.min.js')}}"></script>--}}
{{--<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>--}}
{{--<script src="{{ asset('libs\feather-icons\feather.min.js')}}"></script>--}}
{{--<script src="{{ asset('libs\swiper\swiper-bundle.min.js') }}"></script>--}}
{{--<script src="{{ asset('js\pages\plugins\lord-icon-2.1.0.js') }}"></script>--}}
{{--<script src="{{ asset('libs\sweetalert2\sweetalert2.min.js')}}"></script>--}}
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/plugins.js') }}"></script>--}}
{{--<script src="{{ asset('libs/prismjs/prism.js') }}"></script>--}}
{{--<script href="{{ asset('js/layout.js') }}"></script>--}}
{{--<script src="{{ asset('libs/list.js/list.min.js') }}"></script>--}}
{{--<script src="{{ asset('libs/list.pagination.js/list.pagination.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/pages/listjs.init.js') }}"></script>--}}
{{ $scripts }}
</body>
</html>
