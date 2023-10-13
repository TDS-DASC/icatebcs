<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/ICATEBCS-favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icons.min.css') }}">
        <title>ICATE | Login</title>
        
    </head>
    <body>
        <!-- auth-page wrapper -->
                   
                       
        <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
                        <div class="bg-overlay"></div>
                        <!-- auth-page content -->
                        <div class="auth-page-content overflow-hidden pt-lg-5">
                            <div class="container">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="card overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col-lg-6">
                                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                                        <div class="bg-overlay"></div>
                                                        <div class="position-relative h-100 d-flex flex-column justify-content-center align-items-center">
                                                            <div class="mb-4">
                                                                <a href="{{url('home')}}" class="d-block">
                                                                    <img src="{{ asset('images/ICATEBCS_logo.png')}}" alt="" height="200">
                                                                </a>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                
                                                <div class="col-lg-6">
                                                    <div class="p-lg-5 p-4">
                                                        <div>
                                                            <h5 class="text-primary">Bienvenido</h5>
                                                            <p class="text-muted">Inicia sesión con tu cuenta para ingresar a ICATE.</p>
                                                        </div>
                                                        @if (session('errors'))
                                                            <div class="font-medium text-sm alert-danger mb-2 p-2 rounded">
                                                                <strong>Datos incorrectos</strong>
                                                            </div>
                                                        @endif
                                                            <form method="POST" action="{{ route('login') }}">
                                                                @csrf
                                                                
                                                                <div class="mb-3">
                                                                <x-jet-label for="email" value="{{ __('Email') }}" class="form-label"/>
                                                                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Ingrese correo electrónico" required autofocus />
                                                                    
                                                                </div>
                
                                                                <div class="mb-3">
                                                                    @if (Route::has('password.request'))
                                                                        <div class="float-end">
                                                                            <a href="{{ route('password.request') }}" class="text-muted">¿olvidó su contraseña?</a>
                                                                        </div>
                                                                    @endif
                                                                    <x-jet-label for="password-input" value="{{ __('Contraseña') }}" />
                                                                    
                                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                                        <x-jet-input id="password-input" class="form-control pe-5" type="password" name="password" placeholder="Ingrese contraseña" required autocomplete="current-password" />
                                                                        
                                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                                    </div>
                                                                </div>
                
                
                                                                <div class="mt-4">
                                                                    <button class="btn btn-success w-100" type="submit">Iniciar sesión</button>
                                                                </div>
                
                        
                
                                                            </form>
                  
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end container -->
                            <footer class="footer">
                                <div class="container-fluid">
                                    <div class="row d-flex justify-content-center">
                                        <script>document.write("Derechos reservados © "+new Date().getFullYear()+" ICATEBCS")</script> 
                                    </div>
                                </div>
                            </footer>
                        </div>
                        <!-- end auth page content -->
                    </div> 
                    <!-- Derechos reservados © 2022 - ICATEBCS  -->
                    <script src="{{ asset('libs\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
                    <script src="{{ asset('libs\feather-icons\feather.min.js')}}"></script>
                    <script src="{{ asset('js/pages/password-addon.init.js')}}"></script>
    </body>
</html>

    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}

