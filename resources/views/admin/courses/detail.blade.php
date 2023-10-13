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
                                <li class="breadcrumb-item"><a href="/course">Cursos</a></li>
                                <li class="breadcrumb-item active">Detalle Curso</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fs-16 mb-3">Datos del curso</h5>
                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Nombre:</h6>
                                        <p class="text-muted">{{$course->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Clave:</h6>
                                        <p class="text-muted">{{$course->key ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Tipo de curso:</h6>
                                        <p class="text-muted">{{$course->type_course ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Duración en horas:</h6>
                                        <p class="text-muted">{{$course->duration_course ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Campo de formación:</h6>
                                        <p class="text-muted">{{$course->training_field->name ?? '-'}}</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <h5 class="fs-16 mb-3">Datos del sistema</h5>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$course->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$course->updated_at ?? '-'}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" data-bs-toggle="modal" data-bs-target="#modalAgregar" @click="edit(true)"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(course.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

                {{-- CARD MAIN CONTENT INFO --}}
                <div class="col-xxl-9">
                    <div class="card">
                        {{-- TABS TITLE --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#generalDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Datos generales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#instructorsDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Instructores
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#groupsDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Grupos
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- GENERAL DETAILS --}}
                                <div class="tab-pane active" id="generalDetails" role="tabpanel">
                                    <div class="row">
                                        {{-- GENERAL --}}
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <h5 class="m-0">Datos generales</h5>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Nombre:</h6>
                                                <p class="text-muted">{{$course->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-8">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Descripción:</h6>
                                                <p class="text-muted">{{$course->description ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tipo de curso:</h6>
                                                <p class="text-muted">{{$course->type_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Duración:</h6>
                                                <p class="text-muted">{{$course->duration_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Modalidad:</h6>
                                                <p class="text-muted">{{$course->modality_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tipo de constancia:</h6>
                                                <p class="text-muted">{{$course->constancy_type ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Campo de formación:</h6>
                                                <p class="text-muted">{{$course->training_field->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tipo de campo de formación:</h6>
                                                <p class="text-muted">{{$course->training_field->type ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    {{-- THEMES --}}
                                    <div class="row mt-4">
                                        <div class="col-sm-12 d-flex align-items-center">
                                            <h5 class="m-0">Temas</h5>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="my-3">
                                                <ul class="ps-4">
                                                    <li v-for="theme in course.themes" class="text-muted">
                                                        @{{theme.name}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- INSTRUCTORS --}}
                                <div class="tab-pane" id="instructorsDetails" role="tabpanel">
                                    {{-- INSTRUCTORS TABLE --}}
                                    <div class="row mb-5">
                                        <div id="groupInstructorList">
                                            <div class="row p-0">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <h5 class="m-0">Instructores</h5>
                                                </div>
                                                <div class="col-sm-8 d-flex justify-content-end">
                                                    <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#modalAgregar" @click="edit(false)"> 
                                                        <i class="ri-pencil-fill me-1 align-bottom"></i>Editar instructores
                                                    </button>
                                                    <div class="search-box">
                                                        <input type="text" class="form-control search" placeholder="Buscar un instructor">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-card mt-3 mb-1">
                                                <table class="table align-middle table-nowrap" id="groupInstructorTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="instructor_key">Clave</th>
                                                            <th class="sort" data-sort="instructor_curp">CURP</th>
                                                            <th class="sort" data-sort="instructor_name">Nombre</th>
                                                            <th class="sort" data-sort="instructor_first_name">Apellido Paterno</th>
                                                            <th class="sort" data-sort="instructor_last_name">Apellido Materno</th>
                                                            <th class="sort" data-sort="actions">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list form-check-all">
                                                        <tr v-for="instructor in course.instructors">
                                                            <td class="key">@{{instructor.key}}</td>
                                                            <td class="instructor_curp">@{{instructor.curp}}</td>
                                                            <td class="instructor_name">@{{instructor.name}}</td>
                                                            <td class="instructor_first_name">@{{instructor.first_name}}</td>
                                                            <td class="instructor_last_name">@{{instructor.last_name}}</td>
                                                            <td class="actions d-flex justify-content-center align-items-center">
                                                                <a :href="'{{ url('instructor') }}'+'/'+instructor.id" class="btn btn-soft-secondary">
                                                                    <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div v-if="(course.instructors.length === 0)">
                                                    <div class="alert alert-borderless shadow alert-info" role="alert">
                                                        <strong> Aviso: </strong> No hay ningún instructor que imparta este curso.
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
                                </div>
                                <!--end tab-pane-->

                                {{-- GROUPS --}}
                                <div class="tab-pane" id="groupsDetails" role="tabpanel">
                                    {{-- GROUPS TABLE --}}
                                    <div class="row mb-5">
                                        <div id="courseGroupList">
                                            <div class="row p-0">
                                                <div class="col-sm-8 d-flex align-items-center">
                                                    <h5 class="m-0">Grupos</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="search-box">
                                                        <input type="text" class="form-control search" placeholder="Buscar un grupo">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-card mt-3 mb-1">
                                                <table class="table align-middle table-nowrap" id="courseGroupTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="course_group_key">Clave</th>
                                                            <th class="sort" data-sort="course_group_place">Lugar</th>
                                                            <th class="sort" data-sort="course_group_center">Centro</th>
                                                            <th class="sort" data-sort="actions">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list form-check-all">
                                                        <tr v-for="group in course.groups">
                                                            <td class="course_group_key">@{{group.key}}</td>
                                                            <td class="course_group_place">@{{group.place.name}}</td>
                                                            <td class="course_group_center">@{{group.place.center.name}}</td>
                                                            <td class="actions d-flex justify-content-center align-items-center">
                                                                <a :href="'{{ url('group') }}'+'/'+group.id" class="btn btn-soft-secondary">
                                                                    <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div v-if="(course.groups.length === 0)">
                                                    <div class="alert alert-borderless shadow alert-info" role="alert">
                                                        <strong> Aviso: </strong> No hay ningún grupo al que se este impartiendo este curso.
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
                                            <div class="d-flex justify-content-end mt-2">
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
                                </div>
                                <!--end tab-pane-->

                            </div>
                        </div>
                    </div>
                </div><!--end card content-->
            </div>
            <!-- End Page-content -->

            {{-- MODAL EDIT --}}
            <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalTitle">@{{title_modal}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container-fluid">
                            <form :action="'{{ url('course') }}'+'/'+course.id" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" :value="course.id">

                                <div class="row g-3">
                                    <div v-show="edit_all_fields">
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="key" class="form-label">Clave:</label>
                                                <input type="text" class="form-control" name="key" id="key" placeholder="Ingrese la clave del curso" onkeypress="return slug(event)" required :value="course.key">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="name" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el nombre del curso" onkeypress="return soloLetras(event)" required :value="course.name">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="description" class="form-label">Descripción:</label>
                                                <input class="form-control" name="description" id="description" placeholder="Descripción del curso" required :value="course.description">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="type_course" class="form-label">Tipo:</label>
                                                <select class="form-select" name="type_course" required :value="course.type_course">
                                                    <option disabled value="" selected>Seleccione el tipo de curso</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Extensión">Extensión</option>
                                                    <option value="CAE">CAE</option>
                                                    <option value="EBC">EBC</option>
                                                    <option value="Integral">Integral</option>
                                                    <option value="CAD">CAD</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
        
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="modality_course" class="form-label">Modalidad:</label>
                                                <select class="form-select" name="modality_course" required :value="course.modality_course">
                                                    <option disabled value="" selected>Seleccione la modalidad</option>
                                                        <option value="Presencial">Presencial</option>
                                                        <option value="Distancia">Distancia</option>
                                                        <option value="Mixta">Mixta</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
        
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="constancy_type" class="form-label">Constancia:</label>
                                                <select class="form-select" name="constancy_type" required :value="course.constancy_type">
                                                    <option disabled value="" selected>Seleccione el tipo de constancia</option>
                                                    <option value="Regular">Regular</option>
                                                    <option value="Curso Aceleración Específica">Curso Aceleración Específica</option>
                                                    <option value="Capacitación a Distancia">Capacitación a Distancia</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
        
                                        <div class="col-xxl-12 mb-3">
                                            <div>
                                                <label for="training_field_id" class="form-label">Campo de formación:</label>
                                                <select class="form-select" name="training_field_id" required :value="course.training_field.id">
                                                    <option disabled value="" selected>Seleccione el campo de formación</option>
                                                    <option :value="trainingField.id" v-for="trainingField in training_fields">@{{trainingField.name}}</option>
                                                </select>
                                            </div>
                                        </div><!--end col-->
        
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="duration_course" class="form-label">Duración en horas:</label>
                                                <input type="number" class="form-control" name="duration_course" id="duration_course" onkeypress="return soloNumeros(event)" maxlength="4" placeholder="Ingrese la duración del curso" required :value="course.duration_course">
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end div v-show-->
    
                                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label for="instructors">Añadir instructores que impartan el curso:</label>
                                            </div>
                                            <div class="d-flex gap-1">
                                                <input type="text" id="find_instructor" name="" class="form-control" placeholder="Introduce el CURP" maxlength="18" oninput="this.value = this.value.toUpperCase()" onkeypress="return letrasYNumerosSinEspacios(event)">
                                                <button type="button" class="btn btn-info" style="padding: 0 0.4rem !important;" @click="addinstructor()">
                                                    <i class="mdi mdi-magnify align-middle" style="font-size: 24px;"></i>
                                                </button>
                                            </div>
                                            <div v-if="(find_instructor_status)" class="mt-1">
                                                <div :class="[find_instructor_success ? 'alert alert-borderless shadow alert-success' : 'alert alert-borderless shadow alert-warning']" role="alert">
                                                    <strong> Aviso: </strong> @{{find_instructor_msg}}
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5>Lista de instructores</h5>
                                            <span class="badge badge-soft-info" style="font-size:12px">Total: @{{course_instructors.length}}</span>
                                        </div>
                                        <input v-for="instructor in course_instructors" type="hidden" name="instructors[]" :value="instructor">
                                        <div v-if="course_instructors.length>0" class="col-lg-12">
                                            <div class="row">
                                                <div v-for="(instructor, index) in course_instructors_names" :key="index" class="col-md-6 d-flex justify-content-between align-items-center gap-1 mb-2">
                                                    <label :id="index" class="form-control fw-normal border-0 m-0">
                                                        <b>@{{index+1}}.</b> @{{instructor}}
                                                    </label>
                                                    <button type="button" @click="removeinstructor(index)" class="btn btn-danger" style="padding: 0 0.4rem !important; max-height: 35.5px; min-height: 35.5px; height: 35.5px;">
                                                        <i class="bx bx-x align-middle" style="font-size: 24px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="alert alert-borderless shadow alert-info" role="alert">
                                                Todavía no se han añadido instructores.
                                            </div>
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
        <!-- end container fluid -->
    </div>


    <x-slot name="scripts">
        <script src="{{ asset('js/global.js') }}"></script>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        course: @json($course),
                        instructors: @json($instructors),
                        training_fields: @json($training_fields),
                        url:'{{ url("course") }}',
                        edit_all_fields: false,
                        title_modal: '',
                        find_instructor_status: false,
                        find_instructor_success: false,
                        find_instructor_msg: "",
                        course_instructors: [],
                        course_instructors_names: [],
                    }
                },
                created() {
                    this.sortResults("name", this.training_fields);
                    this.course.instructors.forEach(instructor => {
                        this.course_instructors.push(instructor.id);
                        this.course_instructors_names.push(instructor.name+" "+instructor.first_name+" "+instructor.last_name);
                    });
                },
                methods:{
                    sortResults(key, array) {
                        array.sort(function(a, b) {
                            return (a[key] > b[key]) ? 1 : ((a[key] < b[key]) ? -1 : 0);
                        });
                    },
                    edit(all_fields) {
                        this.edit_all_fields = all_fields;
                        this.edit_all_fields ? this.title_modal = "Editar curso" : this.title_modal = "Editar instructores del curso";
                    },
                    addinstructor() {
                        this.find_instructor_status = false;
                        this.find_instructor_success = false;
                        let curp = document.getElementById("find_instructor").value;
                        if(curp === null || curp.match(/^ *$/) !== null) {
                            this.find_instructor_msg = "El campo se encuentra vacío, ingrese un CURP.";
                            this.find_instructor_status = true;
                        } else {
                            let instructor = this.instructors.filter(instructor => instructor.curp === curp);
                            this.find_instructor_status = true;
                            if(instructor.length==0) {
                                this.find_instructor_msg = "No se encontró ningún instructor con ese CURP, verifique que este escrito correctamente.";
                            }else if(instructor.length==1) {
                                let instructor_course_match = this.course_instructors.filter(id => id === instructor[0].id);
                                if(instructor_course_match.length==0) {
                                    let instructor_name = instructor[0].name+" "+instructor[0].first_name+" "+instructor[0].last_name;
                                    this.course_instructors.push(instructor[0].id);
                                    this.course_instructors_names.push(instructor_name);
                                    this.find_instructor_msg = instructor_name+" se ha añadido a la lista de instructores que imparten este curso.";
                                    document.getElementById("find_instructor").value = "";
                                    this.find_instructor_success = true;
                                } else {
                                    this.find_instructor_msg = "Este instructor ya se encuentra añadido.";
                                }
                            }
                        }
                    },
                    removeinstructor(indice) {
                        this.course_instructors = this.course_instructors.filter((instructor, index) => index !== indice);
                        this.course_instructors_names = this.course_instructors_names.filter((instructor, index) => index !== indice);
                    },
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
                            axios.get(this.url +"/" + id + "/delete")
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
