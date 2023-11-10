<x-improved-guest>
    <x-slot:head>
        <link rel="stylesheet" type="text/css" href="{{ asset('libs/dataTables/datatables.min.css') }}"/>
    </x-slot>
    <div class="page-content" v-cloak v-if="students">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/student">Capacitandos</a></li>
                                <li class="breadcrumb-item active">Capacitandos</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
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
                {{-- WIDGETS --}}
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-animate bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Total de capacitandos</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">{{ $total_students }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="bx bxs-user-account"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-animate" style="background-color: #4c66ba;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Unidad de capacitación La Paz</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">@{{ widgets[0].total_students }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-government-fill text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-animate" style="background-color: #4c66ba;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Acción móvil Los Cabos</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">@{{ widgets[1].total_students }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-government-fill text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-animate" style="background-color: #4c66ba;">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Acción Móvil Comondú</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">@{{ widgets[2].total_students }}</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-government-fill text-white"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- FILTERS --}}
                <div class="card">
                    <div class="card-header pt-4 pb-0 border-0">
                        <h5 class="fs-4 mb-1">Filtros de búsqueda</h5>
                    </div>
                    <div class="card-body">
                        <form id="formFilters" action="{{ route('student.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-xl-3 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-select" id="academic_level" name="academic_level" v-model="filters.academic_level">
                                            <option disabled selected value="default">Seleccionar grado académico</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Profesional">Profesional</option>
                                            <option value="Maestria o Doctorado">Maestria o Doctorado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-select" id="job_condition" name="job_condition" v-model="filters.job_condition">
                                            <option disabled selected value="default" selected>Seleccionar condición laboral</option>
                                            <option value="Empleado">Empleado</option>
                                            <option value="Desempleado">Desempleado</option>
                                            <option value="Pensionado">Pensionado</option>
                                            <option value="Jubilado">Jubilado</option>
                                            <option value="Iniciativa Privada">Iniciativa Privada</option>
                                            <option value="Estudiante">Estudiante</option>
                                            <option value="Gobierno">Gobierno</option>
                                            <option value="Propio Jefe">Propio Jefe</option>
                                            <option value="Social">Social</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-select" id="center_id" name="center_id" v-model="filters.center">
                                            <option disabled selected value="default">Seleccionar centro</option>
                                            <option v-for="center in centers" :value="center.id">@{{center.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="form-group">
                                        <select class="form-select" id="city" name="city" v-model="filters.city">
                                            <option disabled selected value="default" selected>Seleccionar ciudad</option>
                                            <option v-for="city in cities" :value="city.id">@{{city.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-secondary w-100" @click="submitFilters()">
                                            <i class="ri-equalizer-fill me-1 align-bottom"></i>Filtrar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-warning w-100" @click="restartFilters()">
                                            <i class="ri-refresh-line me-1 align-bottom"></i>Reiniciar filtros
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xl- col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-info w-100" @click="showAllData()">
                                            <i class="ri-file-text-fill  me-1 align-bottom"></i>Mostrar todo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- RESPONSE IMPORT --}}
                <div v-if="respImportCode==2" class="alert alert-success alert-border-left alert-dismissible fade shadow show mb-xl-2" role="alert">
                    <h1 class="fs-15 fw-bold text-success text-center mb-4">@{{ respImportMessage }}</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="fs-14 fw-normal text-dark text-center mb-3"><span class="fw-bolder">Registros exitosos nuevos:</span> @{{ respImportRecords }}</h2>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="fs-14 fw-normal text-dark text-center mb-3"><span class="fw-bolder">Cantidad de errores:</span> @{{ respImportErrors.length }}</h2>
                        </div>
                    </div>
                    <button type="button" class="btn-close" @click="resetImportCode()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div v-if="respImportCode==-2" class="alert alert-danger alert-border-left alert-dismissible fade shadow show mb-xl-2" role="alert">
                    <h1 class="fs-15 fw-bold text-danger text-center mb-4">@{{ respImportMessage }}</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="fs-14 fw-normal text-dark text-center mb-3"><span class="fw-bolder">Registros exitosos nuevos:</span> @{{ respImportRecords }}</h2>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="fs-14 fw-normal text-dark text-center mb-3"><span class="fw-bolder">Cantidad de errores:</span> @{{ respImportErrors.length }}</h2>
                        </div>
                    </div>
                    <table class="table table-danger">
                        <tr>
                            <th>Fila</th>
                            <th>Campo</th>
                            <th>Error</th>
                        </tr>
                        <tr v-for="error in respImportErrors">
                            <td> @{{ error.row }} </td>
                            <td> @{{ error.attribute }} </td>
                            <td> @{{ error.errors[0] }} </td>
                        </tr>
                    </table>
                    <button type="button" class="btn-close" @click="resetImportCode()" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                {{-- CONTENT --}}
                <div class="card">
                    <div class="card-header pt-4 pb-0 border-0">
                        <h5 class="fs-4 mb-1">Capacitandos</h5>
                    </div>
                    <div class="card-body">
                        <div id="studentList">
                            <div class="row g-4 mb-3">
                                    <div class="col-sm-5">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 d-flex justify-content-end">
                                        @can('Agregar estudiantes')
                                            <a type="button" href="{{ url('/student/create') }}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Agregar</a>
                                        @endcan
                                        <a type="button" @click="resetFormExcel()" data-bs-toggle="modal" data-bs-target="#modalExcel" class="btn btn-primary ms-2"><i class="bx bx-import me-1"></i> Importar Excel</a>
                                        <a type="button" @click="downloadExcel()" class="btn btn-primary ms-2"><i class="ri-download-fill align-bottom me-1"></i> Descargar Excel</a>
                                    </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="studentTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="avatar">Foto</th>
                                            <th class="sort" data-sort="no_control">No. Control</th>
                                            <th class="sort" data-sort="curp">CURP</th>
                                            <th class="sort" data-sort="student_name">Nombre</th>
                                            <th class="sort" data-sort="student_first_name">Apellido Paterno</th>
                                            <th class="sort" data-sort="student_last_name">Apellido Materno</th>
                                            <th class="sort" data-sort="phone">Teléfono</th>
                                            <th class="sort" data-sort="center_name">Centro</th>
                                            <th class="sort" data-sort="actions">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <tr v-for="student in students.data">
                                            <td class="col1">
                                                <div class="avatar d-flex justify-content-center">
                                                    <div v-html="this.generateAvatar(student.name, student.first_name)"></div>
                                                </div>
                                            </td>
                                            <td class="no_control">@{{ student.no_control }}</td>
                                            <td class="curp">@{{ student.curp }}</td>
                                            <td class="student_name">@{{ student.name }}</td>
                                            <td class="student_first_name">@{{ student.first_name }}</td>
                                            <td class="student_last_name">@{{ student.last_name }}</td>
                                            <td class="phone">@{{ student.phone_number }}</td>
                                            <td class="center_name">@{{ student.center.name }}</td>
                                            <td class="col-1">
                                                <div class="d-flex gap-2">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item btn" id="detailStudent" :href="'{{ url('student') }}'+'/'+student.id">Detalles</a>
                                                            <a class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#modalInscribir" @click="inscribir(student.id,student.name,student.first_name,student.last_name)">Inscribir a grupo</a>
                                                            @can('Editar estudiantes')
                                                                <a class="dropdown-item btn" :id="student.no_control" @click="editStudent(student.no_control,student.id)">Editar</a>
                                                            @endcan
                                                            @can('Eliminar estudiantes')
                                                                <a class="dropdown-item btn" @click="destroy(student.id)">Eliminar</a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
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
                                    <template v-if="students.prev_page_url">
                                        <a class="page-item pagination-prev" @click="loadPrevStudents">
                                            Anterior
                                        </a>
                                    </template>
                                    <ul class="pagination listjs-pagination mb-0">
                                        <li v-for="link in students.links.filter((link) => link.label < students.current_page)">
                                            <span class="page" @click="loadStudents(link.url)">@{{ link.label}}</span>
                                        </li>
                                        <li class="active">
                                            <span class="page">@{{ students.current_page }}</span>
                                        </li>
                                        <li v-for="link in students.links.filter((link) => link.label > students.current_page)">
                                            <span class="page" @click="loadStudents(link.url)">@{{ link.label}}</span>
                                        </li>
                                    </ul>
                                    <template v-if="students.next_page_url">
                                        <a class="page-item pagination-next" @click="loadNextStudents">
                                            Siguiente
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL IMPORT EXCEL --}}
        <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="modalExcelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalTitle">Importar excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formExcel" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <div class="file-drop-area">
                                        <span class="fake-btn">Buscar excel</span>
                                        <span class="file-msg">o arrastra y suelta aqui el archivo</span>
                                        <input class="file-input" type="file" id="capacitandos" name="capacitandos" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="gap-2">
                                        <button type="button" @click="importExcel()" class="btn btn-success me-3">Aceptar</button>
                                        <button type="button" class="btn btn-light" id="btnCloseImport" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL INSCRIBIR --}}
        <div class="modal fade" id="modalInscribir" tabindex="-1" role="dialog" aria-labelledby="modalInscribirLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inscribirModalTitle">Inscribir en un grupo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('student.group.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" id="student_id" name="student_id" value="">
                            <div class="row">
                                <div class="col-xl-12">
                                    <label for="student_id">Estudiante:</label>
                                    <p class="text-muted">@{{modal_student_name}}</p>
                                </div>
                                <div class="col-xl-12 col-sm-6">
                                    <div class="form-group mb-4">
                                        <div class="d-flex mb-1">
                                            <label for="group_id">Grupo:</label>
                                        </div>
                                        <select class="form-select" id="group_id" name="group_id">
                                            <option disabled selected value="">Seleccionar grupo</option>
                                            <option v-for="group in groups" :value="group.id">@{{group.course.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-success me-1">Aceptar</button>
                                        <button type="button" class="btn btn-light" id="btnCloseImport" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot:scripts>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script type="module">
            const { createApp } = window.Vue
            const UIAvatarSvg = new window.UIAvatarSvg()

            createApp({
                data() {
                    return {
                        students: null,
                        widgets: @json($widgets),
                        cities: @json($cities),
                        groups: @json($groups),
                        centers: @json($centers),
                        filters: { academic_level: 'default', job_condition: 'default', center: 'default', city: 'default' },
                        url:'{{ url("student") }}',
                        urlExcel:'{{ route("students.excel") }}',
                        respImport: [],
                        respImportCode: 0,
                        respImportMessage: [],
                        respImportErrors: [],
                        respImportRecords: [],
                        modal_student_name: "",
                    }
                },
                methods:{
                    loadNextStudents() {
                        axios.get(this.students.next_page_url)
                            .then(res => this.students = res.data)
                            .catch(err => console.error(err));
                    },
                    loadPrevStudents() {
                        axios.get(this.students.prev_page_url)
                            .then(res => this.students = res.data)
                            .catch(err => console.error(err));
                    },
                    loadStudents(url) {
                        axios.get(url)
                            .then(res => this.students = res.data)
                            .catch(err => console.error(err));
                    },
                    generateAvatar(name, lastname) {
                        return UIAvatarSvg
                            .text(name[0] + lastname[0])
                            .size(54)
                            .bgColor('#dcdbdb')
                            .textColor('#0e0e0e')
                            .generate();
                    },
                    detailStudent(){
                        Swal.fire({
                            title: "Sección en desarrollo.",
                            icon: "info",
                            customClass: {
                                icon: "no-before-icon",
                            },
                        });
                    },
                    editStudent(no_control,id){
                        document.getElementById(no_control).href = `{{ url('student/${id}/edit') }}`;
                        document.getElementById(no_control).click();
                    },
                    submitFilters() {
                        axios.get('http://0.0.0.0/api/students?', {
                            params: {
                                academic_level: this.filters.academic_level === 'default' ? null : this.filters.academic_level,
                                job_condition: this.filters.job_condition === 'default' ? null : this.filters.job_condition,
                                center: this.filters.center === 'default' ? null : this.filters.center,
                                city: this.filters.city === 'default' ? null : this.filters.city
                            }})
                            .then(res => this.students = res.data)
                            .catch(err => console.error('error: ' + err));
                    },
                    restartFilters() {
                        document.getElementById('academic_level').selectedIndex = 0;
                        document.getElementById('job_condition').selectedIndex = 0;
                        document.getElementById('center_id').selectedIndex = 0;
                        document.getElementById("formFilters").action = this.url;
                        document.getElementById('city').selectedIndex = 0;
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
                                    Swal.fire("Hecho", "Registro eliminado correctamente", "success")
                                    .then(value =>{
                                        this.students = this.students.filter(student => student.id !== id)
                                        //window.location = this.url
                                    })
                                })
                                .catch(error => {
                                    Swal.fire("Error!","No encontramos lo que buscaba.","error")
                                })
                            }
                        })
                    },
                    assetAvatar(urlImg) {
                        const asset = "{{ asset('storage/student/covers') }}"
                        return asset + "/" + urlImg;
                    },
                    showAllData() {
                        document.getElementById('academic_level').selectedIndex = 0;
                        document.getElementById('job_condition').selectedIndex = 0;
                        document.getElementById('center_id').selectedIndex = 0;
                        document.getElementById('city').selectedIndex = 0;
                        document.getElementById("formFilters").action = this.url;
                        document.getElementById("formFilters").submit();
                    },
                    downloadExcel() {
                        document.getElementById("formFilters").action = this.urlExcel;
                        document.getElementById("formFilters").submit();
                    },
                    resetFormExcel() {
                        document.getElementById("formExcel").reset();
                        $('.file-input').val('');
                        $('.file-msg').text('o arrastra y suelta aqui el archivo');
                    },
                    async importExcel() {
                        if(document.querySelector("#capacitandos").value=="") {
                            alert("No puede quedar el campo vacío, añade un archivo .xml o .xlsx");
                        } else {
                            const excelFile = document.querySelector("#capacitandos");
                            const formData = new FormData();
                            formData.append("capacitandos", excelFile.files[0]);
                            axios.post(`{{ route('students.import') }}`, formData, {
                                headers: {
                                    "Content-Type": "multipart/form-data",
                                },
                            })
                            .then((res) => {
                                this.responseImport = JSON.parse(JSON.stringify(res.data));
                                this.respImportCode = this.responseImport.code;
                                this.respImportMessage = this.responseImport.message;
                                this.respImportErrors = this.responseImport.data.errors;
                                this.respImportRecords = this.responseImport.data.new_records;
                                this.resetFormExcel();
                                document.getElementById("btnCloseImport").click();
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                        }
                    },
                    resetImportCode() {
                        this.respImportCode = 0;
                    },
                    inscribir(id, name, first_name, last_name) {
                        document.getElementById("student_id").value = id;
                        this.modal_student_name = name+" "+first_name+" "+last_name;
                    },
                },
                mounted(){
                    /* IMPORT EXCEL: Drag and drop */
                    var $fileInput = $('.file-input');
                    var $droparea = $('.file-drop-area');

                    $fileInput.on('dragenter focus click', function() {
                        $droparea.addClass('is-active');
                    });
                    $fileInput.on('dragleave blur drop', function() {
                        $droparea.removeClass('is-active');
                    });

                    $fileInput.on('change', function() {
                        var filesCount = $(this)[0].files.length;
                        var $textContainer = $(this).prev();
                        if (filesCount === 1) {
                            var fileName = $(this).val().split('\\').pop();
                            $textContainer.text(fileName);
                        } else {
                            $textContainer.text(filesCount + ' archivos seleccionados');
                        }
                    });

                    $('.file-input').change(function () {
                        var fileExtension = ['xml', 'xlsx'];
                        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                            alert("Formato de archivos permitidos: ."+fileExtension.join(', .'));
                            $('.file-input').val('');
                            $('.file-msg').text('Formato inválido, arrastra otro archivo.');
                        }
                    });

                    axios.get('http://0.0.0.0/api/students?')
                        .then(res => this.students = res.data)
                        .catch(err => console.error('error: ' + err));
                }
            }).mount('#app')
        </script>
    </x-slot>
</x-layouts.improved-guest>
