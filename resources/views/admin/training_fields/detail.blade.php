<x-guest-layout>
    <x-slot name="head">
        <link rel="stylesheet" type="text/css" href="{{ asset('libs/dataTables/datatables.min.css') }}"/>
    </x-slot>

    <div class="page-content" v-cloak>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/center">Académico</a></li>
                                <li class="breadcrumb-item active">Detalle de Campo de formación profesional</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    @if(session('error'))
                        <div class="alert alert-dismissible alert-danger fade show" role="alert">
                            <strong>{{session('error')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                               
                                <h5 class="fs-16 mb-1">{{$trainingField->name}}</h5>
                                <p class="text-muted mb-3">{{"Clave: ".$trainingField->key}}</p>

                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Estatus:</h6>
                                        <p class="text-muted">@if($trainingField->status == 1) {{ 'Activo' }} @else {{ 'Inactivo' }} @endif</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Tipo:</h6>
                                        <p class="text-muted">{{$trainingField->type ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Cantidad de cursos asociados:</h6>
                                        <p class="text-muted">@{{trainingField.courses.length}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$trainingField->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$trainingField->updated_at ?? '-'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" data-bs-toggle="modal" data-bs-target="#modalAgregar"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(trainingField.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

                {{-- CARD MAIN CONTENT INFO --}}
                <div class="col-xxl-9">
                    {{-- TRAINING FIELD: COURSES --}}
                    <div class="card">
                        {{-- TABS TITLE --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#coursesDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Cursos asociados
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4 pt-3">
                            <div class="tab-content">
                                {{-- COURSES DETAILS --}}
                                <div class="tab-pane active" id="coursesDetails" role="tabpanel">
                                    <div id="trainingFieldCoursesList">
                                        <div class="row p-0">
                                            <div class="col-sm-8 d-flex align-items-center">
                                                <h5 class="m-0">Lista de cursos</h5>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="search-box">
                                                    <input type="text" class="form-control search" placeholder="Buscar un curso">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="trainingFieldCoursesTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="trainingField_course_key">Clave</th>
                                                        <th class="sort" data-sort="trainingField_course_name">Nombre</th>
                                                        <th class="sort" data-sort="actions">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <tr v-for="course in trainingField.courses">
                                                        <td class="trainingField_course_key">@{{ course.key }}</td>
                                                        <td class="trainingField_course_name">@{{ course.name }}</td>
                                                        <td class="actions d-flex justify-content-center align-items-center">
                                                            <a :href="'{{ url('course') }}'+'/'+course.id" class="btn btn-soft-success">
                                                                <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div v-if="(trainingField.courses.length === 0)">
                                                <div class="alert alert-borderless shadow alert-info" role="alert">
                                                    <strong> Aviso: </strong> No hay ningún curso asociado a este campo de formación.
                                                </div>
                                            </div>

                                            <div class="noresult" style="display: none">
                                                <div class="text-center">
                                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                    </lord-icon>
                                                    <h5 class="mt-2">Lo sentimos, no se encontrarón resultados.</h5>
                                                    <p class="text-muted mb-0">Se realizó la búsqueda entre todos los registros, pero no se encontró alguna coincidencia.</p>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="d-flex justify-content-end">
                                            <div class="pagination-wrap hstack gap-2">
                                                <a class="page-item pagination-prev disabled">
                                                    Anterior
                                                </a>
                                                <ul class="pagination listjs-pagination mb-0"></ul>
                                                <a class="page-item pagination-next">
                                                    Siguiente
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>

                    <!-- Modal editar campo -->
                    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalTitle">Editar campo de formación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body container-fluid">
                                    <form :action="'{{ url('training-field') }}'+'/'+trainingField.id" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" :value="trainingField.id">

                                        <div class="row g-3">
                                            <div class="col-xxl-6">
                                                <div>
                                                    <label for="key" class="form-label">Clave</label>
                                                    <input type="text" class="form-control" id="key" name="key" placeholder="Ingrese la clave del campo" :value="trainingField.key" required>
                                                    @error('key')
                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-xxl-6">
                                                <div>
                                                    <label for="name" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el nombre del campo" :value="trainingField.name" required>
                                                    @error('name')
                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-xxl-6">
                                                <div>
                                                    <label for="status" class="form-label">Estatus</label>
                                                    <select class="form-select" name="status" :value="trainingField.status" required>
                                                        <option disabled value="" selected>Seleccione un estatus</option>
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><!--end col-->

                                            <div class="col-xxl-6">
                                                <div>
                                                    <label for="type" class="form-label">Tipo</label>
                                                    <select class="form-select" name="type" :value="trainingField.type" required>
                                                        <option disabled value="" selected>Seleccione un tipo</option>
                                                        <option value="Estatal">Estatal</option>
                                                        <option value="Federal">Federal</option>
                                                    </select>
                                                    @error('type')
                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->

                </div>
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end container fluid -->
    </div>


    <x-slot name="scripts">
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        trainingField: @json($trainingField),
                        url:'{{ url("training-field") }}',
                    }
                },
                methods:{
                    async destroy(id){
                        Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Confirme esta acción para eliminar",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0ab39c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, ¡Eliminar!',
                        cancelButtonText: 'Cancelar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            axios.get(`{{ url('training-field/${id}/delete')}}`)
                                .then(response => {
                                    window.location = this.url;
                                })
                                .catch(error => {
                                    window.location = this.url;
                                })
                            }
                        })
                    },
                },
                mounted(){
                }
            }).mount('#app')
        </script>
    </x-slot>
    </x-guest-layout>
