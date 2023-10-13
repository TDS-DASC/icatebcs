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
                                <li class="breadcrumb-item"><a href="/group">Grupos</a></li>
                                <li class="breadcrumb-item active">Detalle grupos</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div id="statusCodeSucess" class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert">
                        <strong>Acción realizada correctamente.</strong> 
                        <br> 
                        El estatus del estudiante se ha actualizado, es necesario recargar la página para visualizar los cambios.
                        <br>
                        <button class="btn btn-success my-3" onclick="window.location.reload();">Recargar página</button>
                        <button type="button" onclick="window.location.reload();" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div id="statusCodeFailed" class="alert alert-dismissible alert-danger fade show" style="display: none;" role="alert">
                        <strong>Ha ocurrido un error.</strong> 
                        <br> 
                        No fue posible cambiar el estatus del estudiante, vuelva a intentarlo y verifique que ingresó todos los datos correctamente.
                        <button type="button" onclick="window.location.reload();" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fs-16 mb-3">Datos del grupo</h5>
                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Clave:</h6>
                                        <p class="text-muted">{{$group->key ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Pertenece al centro:</h6>
                                        <p class="text-muted">{{$group->place->center->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Curso:</h6>
                                        <p class="text-muted">{{$group->course->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Campo de formación:</h6>
                                        <p class="text-muted">{{$group->course->training_field->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Cantidad de estudiantes:</h6>
                                        <p class="text-muted">@{{studentsAmount.length}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Horario:</h6>
                                        <p class="text-muted">@if(isset($group->time_start)&&isset($group->time_end)) {{ substr($group->time_start, 0, 5).' - '.substr($group->time_end, 0, 5) }} @else {{ 'No disponible' }} @endif</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4 mb-3">
                                        <h6 class="mb-1">Días de la semana:</h6>
                                        <p v-for="day in group.days" class="text-muted m-0">@{{day.name}}</p>
                                    </div>
                                    <div class="col-xxl-6 col-sm-4">
                                        <h6 class="mb-1">Fecha inicio:</h6>
                                        <p class="text-muted">{{ $group->date_start ? substr($group->date_start, 0,  10) : "-" }}</p>
                                    </div>
                                    <div class="col-xxl-6 col-sm-4">
                                        <h6 class="mb-1">Fecha final:</h6>
                                        <p class="text-muted">{{ $group->date_end ? substr($group->date_end, 0,  10) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <h5 class="fs-16 mb-3">Datos del sistema</h5>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$group->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-6">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$group->updated_at ?? '-'}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" href="{{ url('group/'.$group->id.'/edit') }}"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(group.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#members" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Integrantes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#course" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Curso
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#place" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Lugar
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">
                                {{-- MEMBERS DETAILS --}}
                                <div class="tab-pane active" id="members" role="tabpanel">
                                    {{-- INSTRUCTOR TABLE --}}
                                    <div class="row mb-5">
                                        <div id="groupInstructorList">
                                            <div class="row p-0">
                                                <div class="col-sm-8 d-flex align-items-center">
                                                    <h5 class="m-0">Instructor</h5>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-card mt-3 mb-1">
                                                <table class="table align-middle table-nowrap" id="groupInstructorTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="key">Clave</th>
                                                            <th class="sort" data-sort="instructor_curp">CURP</th>
                                                            <th class="sort" data-sort="instructor_name">Nombre</th>
                                                            <th class="sort" data-sort="instructor_first_name">Apellido Paterno</th>
                                                            <th class="sort" data-sort="instructor_last_name">Apellido Materno</th>
                                                            <th class="sort" data-sort="actions">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list form-check-all">
                                                        <tr>
                                                            <td class="key">{{$group->instructor->key}}</td>
                                                            <td class="instructor_curp">{{$group->instructor->curp}}</td>
                                                            <td class="instructor_name">{{$group->instructor->name}}</td>
                                                            <td class="instructor_first_name">{{$group->instructor->first_name}}</td>
                                                            <td class="instructor_last_name">{{$group->instructor->last_name}}</td>
                                                            <td class="actions d-flex justify-content-center align-items-center">
                                                                <a href="{{ url('instructor/'.$group->instructor->id) }}" class="btn btn-soft-secondary">
                                                                    <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="noresult" style="display: none">
                                                    <div class="text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                                        </lord-icon>
                                                        <h5 class="mt-2">Lo sentimos, no se encontrarón resultados.</h5>
                                                        <p class="text-muted mb-0">Se realizó la búsqueda entre todos los registros, pero no se encontró alguna coincidencia.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end" >
                                                <div class="pagination-wrap hstack gap-2" style="display: none">
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
                                    <!--end row-->
                                    {{-- STUDENTS TABLE --}}
                                    <div class="row">
                                        <div id="groupStudentsList">
                                            <div class="row p-0">
                                                <div class="col-sm-4 d-flex align-items-center">
                                                    <h5 class="m-0">Estudiantes</h5>
                                                </div>
                                                <div class="col-sm-8 d-flex justify-content-end">
                                                    <a class="btn btn-info px-2 py-0 me-2 d-flex align-items-center" style="max-height:37.5px;"  data-bs-toggle="modal" data-bs-target="#modalEstatus" onclick="resetModalStatus()">
                                                        <i class="las la-graduation-cap me-1" style="font-size:22px;"></i> Modificar estatus
                                                    </a>
                                                    <div class="search-box">
                                                        <input type="text" class="form-control search" placeholder="Buscar un estudiante">
                                                        <i class="ri-search-line search-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive table-card mt-3 mb-1">
                                                <table class="table align-middle table-nowrap" id="groupStudentsTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="sort" data-sort="group_student_key">No. Control</th>
                                                            <th class="sort" data-sort="group_student_curp">CURP</th>
                                                            <th class="sort" data-sort="group_student_name">Nombre</th>
                                                            <th class="sort" data-sort="group_student_first_name">Apellido Paterno</th>
                                                            <th class="sort" data-sort="group_student_last_name">Apellido Materno</th>
                                                            <th class="sort" data-sort="group_student_estatus">Estatus</th>
                                                            <th class="sort" data-sort="actions">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list form-check-all">
                                                        <tr v-for="student in group.students">
                                                            <td class="group_student_key">@{{ student.no_control }}</td>
                                                            <td class="group_student_curp">@{{ student.curp }}</td>
                                                            <td class="group_student_name">@{{ student.name }}</td>
                                                            <td class="group_student_first_name">@{{ student.first_name }}</td>
                                                            <td class="group_student_last_name">@{{ student.last_name }}</td>
                                                            <td class="group_student_status">@{{ student.pivot.status ?? "-" }}</td>
                                                            <td class="actions d-flex justify-content-center align-items-center">
                                                                <a :href="'{{ url('student') }}'+'/'+student.id" class="btn btn-soft-success me-2">
                                                                    <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                                </a>
                                                                <button onclick="changeStatus(this)" :data-student="JSON.stringify(student)" class="btn btn-soft-info me-2">
                                                                    <i class="ri-edit-box-fill align-bottom me-2"></i>Cambiar estatus
                                                                </button>
                                                                {{-- <button onclick="showAlert()" class="btn btn-soft-primary">
                                                                    <i class="ri-file-3-fill align-bottom me-2"></i>Constancia
                                                                </button> --}}
                                                                {{-- CONSTANCIA FORMATO --}}
                                                                <form :id="'constancy'+student.id" action="{{ route('students.constancy') }}" method="GET">
                                                                    <input type="text" :id="'student_id_'+student.id" name="student_id" hidden>
                                                                    <input type="text" :id="'group_id_'+student.id" name="group_id" hidden>
                                                                    <button type="button" onclick="downloadConstancy(this)" :data-student="JSON.stringify(student)" class="btn btn-soft-primary">
                                                                        <i class="ri-file-3-fill align-bottom me-2"></i>Constancia {{-- @{{ student.id }} --}}
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
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
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- COURSE DETAILS --}}
                                <div class="tab-pane" id="course" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex justify-content-between">
                                            <h5>Curso</h5>
                                            <a href="{{ url('course/'.$group->course->id) }}" class="btn btn-soft-info">Ver detalles</a>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Clave:</h6>
                                                <p class="text-muted">{{$group->course->key ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Nombre:</h6>
                                                <p class="text-muted">{{$group->course->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tipo de curso:</h6>
                                                <p class="text-muted">{{$group->course->type_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Campo de formación:</h6>
                                                <p class="text-muted">{{$group->course->training_field->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Duración del curso:</h6>
                                                <p class="text-muted">{{$group->course->duration_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Modalidad:</h6>
                                                <p class="text-muted">{{$group->course->modality_course ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tipo de constancia:</h6>
                                                <p class="text-muted">{{$group->course->constancy_type ?? '-'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Temas:</h6>
                                                <ul class="ps-4">
                                                    <li v-for="theme in group.course.themes" class="text-muted">
                                                        @{{theme.name}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Descripción:</h6>
                                                <p class="text-muted" style="text-align: justify">{{$group->course->description ?? '-'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- PLACE --}}
                                <div class="tab-pane" id="place" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex justify-content-between">
                                            <h5>Lugar</h5>
                                            <a href="{{ url('place/'.$group->place->id) }}" class="btn btn-soft-info">Ver detalles</a>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Nombre del lugar:</h6>
                                                <p class="text-muted">{{$group->place->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Calle:</h6>
                                                <p class="text-muted">{{$group->place->address->calle ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Colonia:</h6>
                                                <p class="text-muted">{{$group->place->address->colonia ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número:</h6>
                                                <p class="text-muted">{{$group->place->address->numero ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Código postal:</h6>
                                                <p class="text-muted">{{$group->place->address->codigo_postal ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Ciudad:</h6>
                                                <p class="text-muted">{{$group->place->address->city->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Centro:</h6>
                                                <p class="text-muted">{{$group->place->center->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->

            {{-- MODAL ESTATUS --}}
            <div class="modal fade" id="modalEstatus" tabindex="-1" role="dialog" aria-labelledby="modalEstatusLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="estatusModalTitle">Cambiar estatus de estudiante</h5>
                            <button type="button" id="modal-btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('students.change.group.status') }}" method="POST">
                                @csrf
                                <input type="hidden" id="group_id" name="group_id" :value="group.id">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group mb-4">
                                            <div class="d-flex mb-1">
                                                <label for="student_id">Estudiante:</label>
                                            </div>
                                            <select class="form-select" id="student_id" name="student_id" onchange="onChangeStudent()">
                                                <option disabled selected value="">Seleccionar estudiante</option>
                                                <option v-for="student in group.students" :value="student.id">@{{student.first_name}} @{{student.last_name}} @{{student.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="status_actual">Estatus actual:</label>
                                    <p id="status_actual" class="text-muted">Sin estatus asignado.</p>
                                    <div class="col-xl-12">
                                        <div class="form-group mb-4">
                                            <div class="d-flex mb-1">
                                                <label for="status_student">Estatus nuevo:</label>
                                            </div>
                                            <select class="form-select" id="status_student" name="status">
                                                <option disabled selected value="">Seleccionar estatus</option>
                                                <option value="Acreditado">Acreditado</option>
                                                <option value="No acreditado">No acreditado</option>
                                                <option value="Desertor">Desertor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex gap-2">
                                            <button type="button" onclick="updateStatus()" class="btn btn-success me-1">Aceptar</button>
                                            <button type="button" class="btn btn-light" id="btnCloseImport" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            <!--end modal--> 

        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
        {{-- <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script> --}}
        <script type="text/javascript">
            var all_students = @json($group);
            var status_code = 0;
            
            function changeStatus(target){
                let student_data = JSON.parse(target.getAttribute('data-student'));

                $('#modalEstatus').modal('show'); 
                document.getElementById("student_id").value = student_data.id;
                //Texto Estatus
                document.getElementById("status_actual").innerHTML = student_data.pivot.status;
                if(student_data.pivot.status==null||student_data.pivot.status=="") {
                    document.getElementById("status_actual").innerHTML = "Sin estatus asignado.";
                }
                //Select Estatus
                document.getElementById("status_student").value = student_data.pivot.status;
                if(student_data.pivot.status!="Finalizado"&&student_data.pivot.status!="Créditos insuficientes"&&student_data.pivot.status!="Suspendido") {
                    document.getElementById("status_student").selectedIndex = 0;
                }
            }

            function onChangeStudent() {
                let student_selected_resp = all_students.students.filter(student => student.id == document.getElementById("student_id").value);
                if(student_selected_resp.length > 0) {
                    //Texto Estatus
                    document.getElementById("status_actual").innerHTML = student_selected_resp[0].pivot.status;
                    if(student_selected_resp[0].pivot.status==null||student_selected_resp[0].pivot.status=="") {
                        document.getElementById("status_actual").innerHTML = "Sin estatus asignado.";
                    }
                    //Select Estatus
                    document.getElementById("status_student").value = student_selected_resp[0].pivot.status;
                    if(student_selected_resp[0].pivot.status!="Finalizado"&&student_selected_resp[0].pivot.status!="Créditos insuficientes"&&student_selected_resp[0].pivot.status!="Suspendido") {
                        document.getElementById("status_student").selectedIndex = 0;
                    }
                }
            }

            function resetModalStatus(){
                document.getElementById("student_id").selectedIndex = 0;
                document.getElementById("status_actual").innerHTML = "Sin estatus asignado.";
                document.getElementById("status_student").selectedIndex = 0;
                status_code = 0;
            }

            async function updateStatus(){
                if(document.getElementById("student_id").value!=""&&document.getElementById("status_student").value!=""){
                    let status_data = { 
                        group_id: document.getElementById("group_id").value, 
                        student_id: document.getElementById("student_id").value,
                        status: document.getElementById("status_student").value,
                    };
                    const resp = await axios.post(`{{ route('students.change.group.status') }}`, status_data);
                    status_code = resp.data.code;
                    if(status_code==2) {
                        document.getElementById("statusCodeSucess").style.display = 'block';
                    } else if(status_code==-2) {
                        document.getElementById("statusCodeFailed").style.display = 'block';
                    }
                    document.getElementById("modal-btn-close").click();
                    window.scrollTo(0, 0);
                } else {
                    alert("No deje campos vacíos.")
                }
            }

            function showAlert() {
                Swal.fire({
                    title: 'Ha ocurrido un error inesperado, intentelo nuevamente.',
                    icon: 'info',
                    confirmButtonColor: '#0ab39c',
                    confirmButtonText: 'Aceptar',
                })
            }

            function downloadConstancy(target) {
                let student_data = JSON.parse(target.getAttribute('data-student'));
                document.getElementById("student_id_"+student_data.id).value = student_data.id;
                document.getElementById("group_id_"+student_data.id).value = `{{$group->id}}`;
                document.getElementById("constancy"+student_data.id).submit();
            }
        </script>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        group: @json($group),
                        studentsAmount: null,
                        studentsResp: [],
                        url:'{{ url("group") }}',
                    }
                },
                created() {
                    this.studentsAmount = this.group.students;
                    this.studentsResp = this.group.students;
                    this.sortResults("first_name", this.studentsResp);
                },
                methods:{
                    sortResults(key, array) {
                        array.sort(function(a, b) {
                            return (a[key] > b[key]) ? 1 : ((a[key] < b[key]) ? -1 : 0);
                        });
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
