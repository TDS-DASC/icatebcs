<x-guest-layout>
    <x-slot name="head">
        <link rel="stylesheet" href="{{ asset('libs/sweetalert2.min.css') }}">
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
                                <li class="breadcrumb-item active">Editar grupo</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form action="{{ route('group.update', $group)}}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }} ">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader">
                                <h4 class="card-title mb-0">Datos del grupo</h4>
                            </div><!-- end card header -->
                            <div v-if="showCollapse" class="collapse show">
                                <div class="card-body">
                                    {{-- ROW --}}
                                    <div class="row gy-3">
                                        {{-- CENTER --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-government-fill me-1"></i>
                                                    <label for="Centro">Centro</label>
                                                </div>
                                                <select class="form-select" id="center_id" name="center_id" v-model="group.center_id" required>
                                                    <option value="" disabled selected>Seleccione un centro</option>
                                                    <option :value="group.center_id">@{{group.place.center.name}}</option>
                                                </select>
                                                @error('center_id')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- COURSE --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-book-2-fill me-1"></i>
                                                    <label for="course_id">Curso</label>
                                                </div>
                                                <select class="form-select" id="course_id" name="course_id" v-model="course_id" required>
                                                    <option value="" disabled selected>Seleccione un curso</option>
                                                    <option v-for="course in courses" :value="course.id">@{{course.name}}</option>
                                                </select>
                                                @error('course_id')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- PLACE --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-map-pin-fill me-1"></i>
                                                    <label for="place_id">Lugar de impartición</label>
                                                </div>
                                                <select class="form-select" id="place_id" name="place_id" v-model="group.place_id" required>
                                                    <option value="" disabled selected>Seleccione un lugar de impartición</option>
                                                    <option v-for="place in places" :value="place.id">@{{place.name}}</option>
                                                </select>
                                                @error('place_id')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- INSTRUCTOR --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-user-2-fill me-1"></i>
                                                    <label for="instructor_id">Instructor</label>
                                                </div>
                                                <select class="form-select" id="instructor_id" name="instructor_id" v-model="instructor_id" required>
                                                    <option value="" disabled selected>Seleccione un instructor</option>
                                                    <option v-for="instructor in instructors_resp" :value="instructor.id">@{{instructor.first_name}} @{{instructor.last_name}} @{{instructor.name}}</option>
                                                </select>
                                                @error('instructor_id')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                                <div v-if="((center_id=='')||(center_id!=''))&&(course_id!='')&&(instructors.length==0)&&(instructors_resp.length==0)">
                                                    <div class="alert alert-borderless shadow alert-warning mb-0" role="alert">
                                                        <b>Aviso:</b> El curso seleccionado no tiene instructores en ningún centro.
                                                    </div>
                                                </div>
                                                <div v-else-if="(center_id=='')&&(course_id!='')&&(instructors.length>0)">
                                                    <div class="alert alert-borderless shadow alert-warning mb-0" role="alert">
                                                        <b>Aviso:</b> Seleccione un centro para visualizar los instructores disponibles para este curso.
                                                    </div>
                                                </div>
                                                <div v-else-if="(center_id!='')&&(course_id!='')&&(instructors.length>0)&&(instructors_resp.length==0)">
                                                    <div class="alert alert-borderless shadow alert-warning mb-0" role="alert">
                                                        <b>Aviso:</b> El centro seleccionado no tiene instructores para este curso.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- START DATE --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-calendar-2-fill me-1"></i>
                                                    <label for="name">Fecha de inicio</label>
                                                </div>
                                                <input type="date" id="date_start" name="date_start" class="form-control" v-model="group.date_start" required>
                                                @error('date_start')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- FINAL DATE --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-calendar-2-fill me-1"></i>
                                                    <label for="name">Fecha final</label>
                                                </div>
                                                <input type="date" id="date_end" name="date_end" class="form-control" v-model="group.date_end" required>
                                                @error('date_end')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- START HOUR --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-time-fill me-1"></i>
                                                    <label for="name">Hora de inicio</label>
                                                </div>
                                                <input type="time" id="time_start" name="time_start" class="form-control" v-model="group.time_start" required>
                                                @error('time_start')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- FINAL HOUR --}}
                                        <div class="col-sm-6 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-time-fill me-1"></i>
                                                    <label for="name">Hora de salida</label>
                                                </div>
                                                <input type="time" id="time_end" name="time_end" class="form-control" v-model="group.time_end" required>
                                                @error('time_end')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>{{-- end row --}}
                                    {{-- ROW --}}
                                    <div class="row gy-3">
                                        {{-- DAYS --}}
                                        <div class="d-flex">
                                            <i class="ri-calendar-todo-fill me-1"></i>
                                            <label for="name">Días a la semana</label>
                                        </div>
                                        <div v-for="day in days" class="col-sm-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" :id="day.name" name="days[]" :value="day.id" :checked="group.days.find(item=>item.id==day.id)">
                                                <label class="form-check-label" :for="day.name">
                                                    @{{day.name}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>{{-- end row --}}
                                </div>
                            </div>
                        </div>{{-- end card --}}
                    </div>{{-- end col --}}

                    {{-- STUDENTS CARD --}}
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader">
                                <h4 class="card-title mb-0">Estudiantes del grupo</h4>
                            </div><!-- end card header -->
                            <div v-if="showCollapse" class="collapse show">
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-team-fill me-1"></i>
                                                    <label for="students">Añade estudiantes al grupo:</label>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <input type="text" id="find_student" name="" class="form-control" placeholder="Introduce el CURP" maxlength="18" oninput="this.value = this.value.toUpperCase()" onkeypress="return letrasYNumerosSinEspacios(event)">
                                                    <button type="button" class="btn btn-info" style="padding: 0 0.4rem !important;" @click="addStudent()">
                                                        <i class="mdi mdi-magnify align-middle" style="font-size: 24px;"></i>
                                                    </button>
                                                </div>
                                                <div v-if="(find_student_status)" class="mt-1">
                                                    <div :class="[find_student_success ? 'alert alert-borderless shadow alert-success' : 'alert alert-borderless shadow alert-warning']" role="alert">
                                                        <strong> Aviso: </strong> @{{find_student_msg}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h5>Lista de estudiantes</h5>
                                                <span class="badge badge-soft-info" style="font-size:12px">Total: @{{group_students.length}}</span>
                                            </div>
                                            <input v-for="student in group_students" type="hidden" name="students[]" :value="student">
                                            <div v-if="group_students.length>0" class="col-lg-12">
                                                <div class="row">
                                                    <div v-for="(student, index) in group_students_names" :key="index" class="col-lg-6 d-flex justify-content-between align-items-center gap-1 mb-2">
                                                        <label :id="index" class="form-control fw-normal border-0 m-0">
                                                            <b>@{{index+1}}.</b> @{{student}}
                                                        </label>
                                                        <button type="button" @click="removeStudent(index)" class="btn btn-danger" style="padding: 0 0.4rem !important; max-height: 35.5px; min-height: 35.5px; height: 35.5px;">
                                                            <i class="bx bx-x align-middle" style="font-size: 24px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div class="alert alert-borderless shadow alert-info" role="alert">
                                                    Todavía no se han añadido estudiantes.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>{{-- end card --}}
                    </div>{{-- end col --}}

                </div>{{-- end row --}}
                <div class="row">
                    <div class="d-flex justify-content-end align-items-center gap-2 mb-2">
                        <a class="btn btn-danger" @click="cancel">Cancelar</a>
                        <a id="cancelar" href="{{ url('group') }}"></a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <x-slot name="scripts">
        <script src="{{ asset('js/global.js') }}"></script>
        <script>

            const { createApp } = Vue

            createApp({
                data() {
                    return {
                        showCollapse: true,
                        group: @json($group),
                        center: @json($center),
                        center_id: '',
                        courses: @json($courses),
                        course_id: '',
                        places: [],
                        instructors: [],
                        instructor_id: '',
                        instructors_resp: [],
                        students: @json($students),
                        days: @json($days),
                        find_student_status: false,
                        find_student_success: false,
                        find_student_msg: "",
                        group_students: [],
                        group_students_names: [],
                    }
                },
                created() {
                    this.center_id = this.group.center_id;
                    this.course_id = this.group.course_id;
                    this.instructor_id = this.group.instructor_id;
                    this.places = this.center[0].places;
                    this.sortResults("name", this.places);
                    let course_select = this.courses.filter(course => course.id === this.group.course_id);
                    this.instructors = course_select[0].instructors;
                    this.instructors_resp = this.instructors.filter(instructor => instructor.center_id === this.center_id);
                    this.sortResults("first_name", this.instructors_resp);
                    this.group.students.forEach(student => {
                        this.group_students.push(student.id);
                        this.group_students_names.push(student.name+" "+student.first_name+" "+student.last_name);
                    });
                    this.group.date_start = this.group.date_start.slice(0,10);
                    this.group.date_end = this.group.date_end.slice(0,10);
                    this.group.time_start = this.group.time_start.slice(0,5);
                    this.group.time_end = this.group.time_end.slice(0,5);
                },
                watch: {
                    course_id(newCourse, oldCourse) {
                        let course_select = this.courses.filter(course => course.id === newCourse);
                        this.instructors = course_select[0].instructors;
                        if(this.center_id!=''){
                            this.instructors_resp = this.instructors.filter(instructor => instructor.center_id === this.center_id);
                            this.sortResults("first_name", this.instructors_resp);
                        }
                        this.group.course_id = newCourse;
                        document.getElementById("instructor_id").selectedIndex = 0;
                    },
                    instructor_id(newInstructor, oldInstructor) {
                        if(newInstructor!="") {
                            this.group.instructor_id = newInstructor;
                        }
                    },
                },
                methods: {
                    collapsed(){
                        this.showCollapse = this.showCollapse ? false : true;
                    },
                    verifyCheckbox(id){
                        document.getElementById(`${id}`).value = (document.getElementById(`${id}`).checked) ? '1' : '0';
                    },
                    sortResults(key, array) {
                        array.sort(function(a, b) {
                            return (a[key] > b[key]) ? 1 : ((a[key] < b[key]) ? -1 : 0);
                        });
                    },
                    cancel(){
                        Swal.fire({
                            title: '¿Estas seguro?',
                            text: "Confirme esta acción para cancelar",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#0ab39c',
                            confirmButtonText: 'Sí, ¡Cancelar!',
                            cancelButtonText: 'No, ¡Permanecer aquí!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('cancelar').click();
                            }
                        })  
                    },
                    addStudent() {
                        this.find_student_status = false;
                        this.find_student_success = false;
                        let curp = document.getElementById("find_student").value;
                        if(curp === null || curp.match(/^ *$/) !== null) {
                            this.find_student_msg = "El campo se encuentra vacío, ingrese un CURP.";
                            this.find_student_status = true;
                        } else {
                            let student = this.students.filter(student => student.curp === curp);
                            this.find_student_status = true;
                            if(student.length==0) {
                                this.find_student_msg = "No se encontró ningún estudiante con ese CURP, verifique que este escrito correctamente.";
                            }else if(student.length==1) {
                                let student_group_match = this.group_students.filter(id => id === student[0].id);
                                if(student_group_match.length==0) {
                                    let student_name = student[0].name+" "+student[0].first_name+" "+student[0].last_name;
                                    this.group_students.push(student[0].id);
                                    this.group_students_names.push(student_name);
                                    this.find_student_msg = student_name+" se ha añadido a la lista de integrantes del grupo.";
                                    document.getElementById("find_student").value = "";
                                    this.find_student_success = true;
                                } else {
                                    this.find_student_msg = "Ese estudiante ya se encuentra añadido al grupo.";
                                }
                            }
                        }
                    },
                    removeStudent(indice) {
                        this.group_students = this.group_students.filter((student, index) => index !== indice);
                        this.group_students_names = this.group_students_names.filter((student, index) => index !== indice);
                    },
                },
                mounted() {
                },
            }).mount('#app')
        </script>
    </x-slot>
</x-guest-layout>
