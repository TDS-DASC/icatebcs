<x-guest-layout>
  <x-slot name="head">
  </x-slot>
  <div class="page-content" v-cloak>
    <div class="container-fluid">

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">Reportes</li>
                <li class="breadcrumb-item active">Descargar reportes</li>
              </ol>
            </h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          @if(session('success'))
            <div class="col">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5> Proceso realizado exitosamente. </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          @endif

          <div class="card">
            <div class="card-header">
              <div class="col">
                <h4 class="card-title float-start">Reportes</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-lg-6">
          <div class="card card-body text-center">
            <div class="avatar-sm mx-auto mb-3">
              <div class="avatar-title bg-soft-success text-success fs-17 rounded">
                <i class="ri-admin-fill"></i>
              </div>
            </div>
            <h4 class="card-title">Instructores</h4>
            <p class="card-text text-muted">
              Reporte de instructores
            </p>
            <div id="rowButtonsProfiles" class="row">
              <div class="col-sm-12 mt-2">
                <a href="{{ route('reports.download.instructors') }}" download class="btn btn-success buttonOptions">Descargar</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-lg-6">
          <div class="card card-body text-center">
            <div class="avatar-sm mx-auto mb-3">
              <div class="avatar-title bg-soft-success text-success fs-17 rounded">
                <i class="ri-admin-fill"></i>
              </div>
            </div>
            <h4 class="card-title">Capacitandos</h4>
            <p class="card-text text-muted">
              Reporte de capacitandos
            </p>
            <div id="rowButtonsProfiles" class="row">
              <div class="col-sm-12 mt-2">
                <a class="btn btn-success buttonOptions">Descargar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot name="scripts">
    <script src="{{ asset('js/global.js') }}"></script>
    <script>
        const {createApp} = Vue
        createApp({}).mount("#app");
    </script>
  </x-slot>
</x-guest-layout>
