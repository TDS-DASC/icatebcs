<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    <head>
        <x-head>
            @if (isset($head))
                {{ $head }}
            @endif
        </x-head>
    </head>
    <body>
        <div id="app">
            <div id="layout-wrapper">
                    
                <x-sidebar />
                <div class="main-content">
                    {{ $slot }}
                    <x-footer />
                </div>
            </div>
        </div>
        
        
        <x-scripts>
            @if (isset($scripts))
                {{ $scripts }}
            @endif
        </x-scripts>
    </body>
</html>
