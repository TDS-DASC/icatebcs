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
                                <li class="breadcrumb-item"><a href="/course">Académico</a></li>
                                <li class="breadcrumb-item active">Cursos</li>
                            </ol></h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                {{-- WIDGET - TOTAL DE CURSOS --}}
                <div class="col-lg-4">
                    <!-- card -->
                    <div class="card card-animate bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Total de cursos</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ Object.keys(courses).length }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-book-2-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="courseList">
                                <div class="row g-4 mb-3">
                                    <div class="d-flex justify-content-sm-between">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        @can('Agregar cursos')
                                            <a type="button" href="{{ url('course/create') }}" class="btn btn-success float-end"><i class="ri-add-line align-bottom me-1"></i> Agregar</a>
                                        @endcan
                                    </div>
                                </div>
    
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="courseTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="course_key">Clave</th>
                                                <th class="sort" data-sort="course_name">Nombre</th>
                                                <th class="sort" data-sort="course_type">Tipo</th>
                                                <th class="sort" data-sort="course_modality">Modalidad</th>
                                                <th class="sort" data-sort="course_constancy">Constancia</th>
                                                <th class="sort" data-sort="course_duration">Duración en horas</th>
                                                @if(auth()->user()->can('Editar cursos') || auth()->user()->can('Eliminar cursos'))
                                                    <th class="sort" data-sort="actions">Acciones</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="course in courses">
                                                <td class="course_key">@{{ course.key }}</td>
                                                <td class="course_name">@{{ course.name }}</td>
                                                <td class="course_type">@{{ course.type_course }}</td>
                                                <td class="course_modality">@{{ course.modality_course }}</td>
                                                <td class="course_constancy">@{{ course.constancy_type }}</td>
                                                <td class="course_duration">@{{ course.duration_course }}</td>
                                                @if(auth()->user()->can('Editar cursos') || auth()->user()->can('Eliminar cursos'))
                                                    <td class="col-lg-1">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-info edit-item-btn  dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item btn" id="detail" :href="'{{ url('course') }}/'+course.id">Detalles</a>
                                                                    @can('Editar cursos')
                                                                        <a class="dropdown-item btn" id="edit" data-bs-toggle="modal" data-bs-target="#modalAgregar" @click="edit(course.id)">Editar</a>
                                                                    @endcan
                                                                    @can('Eliminar cursos')
                                                                        <a class="dropdown-item btn" @click="destroy(course.id)">Eliminar</a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
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
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>

            

        {{-- </div> --}}
        <!-- Modal editar campo -->
        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalTitle">@{{title_modal}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body container-fluid">
                        <form :action="url" method="POST">
                            @csrf
                            <div v-if="isEditing">
                                @method('PUT')
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" :value="course.id">
                            </div>
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="key" class="form-label">Clave</label>
                                        <input type="text" class="form-control" name="key" id="key" placeholder="Ingrese la clave del curso" onkeypress="return slug(event)" required :value="course.key">
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el nombre del curso" onkeypress="return soloLetras(event)" required :value="course.name">
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="description" class="form-label">Descripción</label>
                                        <input class="form-control" name="description" id="description" placeholder="Descripción del curso" required :value="course.description">
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="type_course" class="form-label">Tipo</label>
                                        <select class="form-select" name="type_course" required v-model="course.type_course">
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

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="modality_course" class="form-label">Modalidad</label>
                                        <select class="form-select" name="modality_course" required v-model="course.modality_course">
                                            <option disabled value="" selected>Seleccione la modalidad</option>
                                                <option value="Presencial">Presencial</option>
                                                <option value="Distancia">Distancia</option>
                                                <option value="Mixta">Mixta</option>
                                        </select>
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="constancy_type" class="form-label">Constancia</label>
                                        <select class="form-select" name="constancy_type" required v-model="course.constancy_type">
                                            <option disabled value="" selected>Seleccione el tipo de constancia</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Curso Aceleración Específica">Curso Aceleración Específica</option>
                                            <option value="Capacitación a Distancia">Capacitación a Distancia</option>
                                        </select>
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="training_field_id" class="form-label">Campo de formación</label>
                                        <select class="form-select" name="training_field_id" required v-model="course.training_field_id">
                                            <option disabled value="" selected>Seleccione el campo de formación</option>
                                            <option :value="trainingField.id" v-for="trainingField in trainingFields">@{{trainingField.name}}</option>
                                        </select>
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="duration_course" class="form-label">Duración en horas</label>
                                        <input type="number" class="form-control" name="duration_course" id="duration_course" onkeypress="return soloNumeros(event)" maxlength="4" placeholder="Ingrese la duración del curso" required v-model="course.duration_course">
                                    </div>
                                </div><!--end col-->

                                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            {{-- <i class="ri-user-2-fill me-1"></i> --}}
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <x-slot name="scripts">
        <script src="{{ asset('js/global.js') }}"></script>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue

            createApp({
                data() {
                    return {
                        courses: @json($courses),
                        course: {
                            id: "",
                            key: "",
                            name: "",
                            type_course: "",
                            modality_course: "",
                            constancy_type: "",
                            duration_course: "",
                            training_field_id: "",
                            instructors: [],
                        },
                        instructors: @json($instructors),
                        trainingFields: @json($training_fields),
                        url:'{{ url("course") }}',
                        title_modal: '',
                        isEditing: false,
                        find_instructor_status: false,
                        find_instructor_success: false,
                        find_instructor_msg: "",
                        course_instructors: [],
                        course_instructors_names: [],
                    }
                },
                methods:{
                    cleanErrors(display){
                        const errors = document.querySelectorAll('div.alert-danger');

                        switch(display){
                            case "show":
                                errors.forEach(error =>{
                                    error.style.display = "block";
                                });
                            break;
                            case "hide":
                                errors.forEach(error =>{
                                    error.style.display = "none";
                                });
                            break;
                        }
                    },
                    resetForm(){
                        this.course = {
                            id: "",
                            key: "",
                            name: "",
                            type_course: "",
                            modality_course: "",
                            constancy_type: "",
                            duration_course: "",
                            training_field_id: "",
                        }
                    },
                    resetFormPlaceOld(){
                        this.course = {
                            key: "{{ old('key') }}",
                            name: "{{ old('name') }}",
                            type_course: "{{ old('type_course') }}",
                            modality_course: "{{ old('modality_course') }}",
                            constancy_type: "{{ old('constancy_type') }}",
                            duration_course: "{{ old('duration_course') }}",
                            training_field_id: "{{ old('training_field_id') }}",
                        }
                    },
                    add(display){
                        if(display === 'old'){
                            this.state_id = parseInt("{{old('state_id')}}") || "";
                            this.resetFormPlaceOld();
                        }else{
                            this.state_id = "";
                            this.resetFormInBlank();
                        }
                        this.title_modal = "Agregar curso";
                        this.resetForm();
                        this.url = '{{ url("course") }}';
                        this.isEditing = false;
                        this.cleanErrors("hide");
                    },
                    edit(id){
                        this.title_modal = "Editar curso";
                        this.resetForm();
                        this.course_instructors = [];
                        this.course_instructors_names = [];
                        this.course = this.courses.find(course => course.id === id);
                        this.course.instructors.forEach(instructor => {
                            this.course_instructors.push(instructor.id);
                            this.course_instructors_names.push(instructor.name+" "+instructor.first_name+" "+instructor.last_name);
                        });
                        this.url =  '{{ url("course") }}'+`/${id}`;
                        this.isEditing = true;
                        this.cleanErrors("hide");
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
                                        this.courses = this.courses.filter(course => course.id !== id)
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
                        const asset = "{{ asset('storage/course/covers') }}"
                        return asset + "/" + urlImg;
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
                },
                mounted(){
                // Plugin datatables

                    @if(count($errors) > 0)
                        if("{{old('_method')}}" === "PUT"){
                            document.getElementById('edit').click()
                            document.getElementById('edit').onclick = this.edit({{old('id')}});
                            this.cleanErrors("show");
                        }else{
                            document.getElementById('add').click()
                            document.getElementById('add').onclick = this.add('old');
                            this.cleanErrors("show");
                        }
                    @endif

                    $('.dataTables-example').DataTable({
                        pageLength: 10,
                        responsive: true,
                        dom: '<"html5buttons"B>lTfgitp',
                        buttons: [
                                { extend: 'copy'},
                                {extend: 'csv'},
                                {extend: 'excel', title: 'ExampleFile'},
                                {extend: 'pdf', title: 'ExampleFile'},

                                {
                                    extend: 'print',
                                    customize: function (win){
                                        $(win.document.body).addClass('white-bg');
                                        $(win.document.body).css('font-size', '10px');

                                        $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                    }
                                }
                            ],
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },

                    });
                    //$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
                }
            }).mount('#app')
            </script>
    </x-slot>

</x-guest-layout>
