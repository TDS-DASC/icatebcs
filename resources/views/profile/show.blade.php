{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')

            <x-jet-section-border />
        @endif

        @livewire('profile.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-jet-section-border />

            @livewire('profile.delete-user-form')
        @endif
    </div>
</x-app-layout> --}}

<x-guest-layout>
    <x-slot name="head">
    </x-slot>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/user">Usuarios</a></li>
                                <li class="breadcrumb-item active">Perfil</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            {{-- PROFILE --}}
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" 
                                        @if( isset(Auth::user()->profile_photo_path) && Auth::user()->profile_photo_path != 'cover.jpg') src="{{ asset('storage/user/covers') }}/{{ Auth::user()->profile_photo_path }}" @else src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" @endif
                                    alt="Header Avatar">
                                </div>
                                <h5 class="fs-4 mb-1">{{Auth::user()->name}}</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="ps-0 text-start" scope="row">Correo electrónico:</th>
                                                <td class="text-muted">{{Auth::user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0 text-start" scope="row">Fecha de creación:</th>
                                                <td class="text-muted">{{Auth::user()->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-0 text-start" scope="row">Última actualización:</th>
                                                <td class="text-muted">{{Auth::user()->updated_at}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row profile -->

        </div>
    </div>

    <x-slot name="scripts">
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        
                    }
                },
                methods:{
                    
                },
                mounted(){
                   
                }
            }).mount('#app')
        </script>
    </x-slot>

</x-guest-layout>