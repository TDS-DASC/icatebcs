<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icons.min.css') }}">
        <title>ICATE | Olvide contraseña</title>
        
    </head>
    <body>
        <!-- auth-page wrapper -->
        <div class="row">
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <img src="{{asset('images/ICATEBCS.png')}}" width="500"  alt="">
                </x-slot>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <h4>{{ __('Ingresa tu correo electrónico y te enviaremos un enlace para la recuperación de contraseña.') }}</h4>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <x-jet-validation-errors class="mb-3" />
                    <form method="POST" action="/forgot-password">
                        @csrf
                        <div class="mb-3">
                            <x-jet-label value="Correo electrónico" />
                            <x-jet-input type="email" name="email" placeholder="Ingrese su correo electrónico" :value="old('email')" required autofocus />
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <x-jet-button>
                                {{ __('Enviar enlace a mi correo') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </x-jet-authentication-card>
        </div>
    </body>
</html>

