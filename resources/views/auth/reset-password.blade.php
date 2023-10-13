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

            <x-jet-validation-errors class="mb-3" />

            <form method="POST" action="/reset-password">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <x-jet-label value="{{ __('Correo electrónico') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email', $request->email)" placeholder="Ingrese correo electrónico" required autofocus />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Contraseña') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" placeholder="Ingrese la contraseña" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirmar contraseña') }}" />

                    <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password"
                                 name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password" />
                    <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end">
                        <x-jet-button>
                            {{ __('Actualizar') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
        </div>
    </body>
</html>
    
