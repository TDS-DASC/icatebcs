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
                                <li class="breadcrumb-item"><a href="/course">Cursos</a></li>
                                <li class="breadcrumb-item active">Agregar curso</li>
                            </ol></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form id="frmCourse" :action="url" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader" >
                                <h4 class="card-title mb-0">Datos del curso</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="row gy-4">
                                    <!-- name, lastname -->
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-book-2-fill"></i>
                                                <label for="name">Nombre</label>
                                            </div>
                                            <input type="text" name="name" class="form-control" placeholder="Nombre del curso" onkeypress="return letrasYNumeros(event)">
                                            @error('name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-folder-3-fill"></i>
                                                <label for="type_course">Tipo</label>
                                            </div>
                                            <select class="form-select" name="type_course" required>
                                                <option disabled selected>Seleccione el tipo de curso</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Extensión">Extensión</option>
                                                <option value="CAE">CAE</option>
                                                <option value="EBC">EBC</option>
                                                <option value="Integral">Integral</option>
                                                <option value="CAD">CAD</option>
                                            </select>
                                            @error('type_course')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-time-fill"></i>
                                                <label for="duration_course">Duración en horas</label>
                                            </div>
                                            <input type="text" name="duration_course" class="form-control" placeholder="Horas" required onkeypress="return soloNumeros(event)" maxlength="4">
                                            @error('duration_course')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-computer-fill"></i>
                                                <label for="modality_course">Modalidad</label>
                                            </div>
                                            <select class="form-select" name="modality_course" required>
                                                <option disabled selected>Seleccione la modalidad</option>
                                                <option value="Presencial">Presencial</option>
                                                <option value="Distancia">Distancia</option>
                                                <option value="Mixta">Mixta</option>
                                            </select>
                                            @error('modality_course')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-file-list-2-fill"></i>
                                                <label for="constancy_type">Tipo de constancia</label>
                                            </div>
                                            <select class="form-select" name="constancy_type" required>
                                                <option disabled selected>Seleccione el tipo de constancia</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Extension">Extensión</option>
                                                <option value="Curso Aceleración Específica">Curso Aceleración Específica</option>
                                                <option value="Capacitación a Distancia">Capacitación a Distancia</option>
                                            </select>
                                            @error('constancy_type')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-slideshow-fill"></i>
                                                <label for="training_field_id" class="form-label">Campo de formación</label>
                                            </div>
                                            <select class="form-select" name="training_field_id" required > <!-- v-model="course.training_field_id" -->
                                                <option disabled value="" selected>Seleccione el campo de formación</option>
                                                <option :value="trainingField.id" v-for="trainingField in trainingFields">@{{trainingField.name}}</option>
                                            </select>
                                            @error('training_field_id')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-slideshow-fill"></i>
                                                <label for="description" class="form-label">Descripción</label>
                                            </div>
                                            <textarea class="form-control" name="description" placeholder="Descripción del curso"></textarea>
                                            @error('description')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- INSTRUCTORS --}}
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header formStyle-cardHeader">
                                <h4 class="card-title mb-0">Agregar instructores</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-6 col-lg-6 col-xl-5 col-xxl-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-user-2-fill me-1"></i>
                                                <label for="instructors">Añade instructores que impartan el curso:</label>
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
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5>Lista de instructores</h5>
                                            <span class="badge badge-soft-info" style="font-size:12px">Total: @{{course_instructors.length}}</span>
                                        </div>
                                        <input v-for="instructor in course_instructors" type="hidden" name="instructors[]" :value="instructor">
                                        <div v-if="course_instructors.length>0" class="col-lg-12">
                                            <div class="row">
                                                <div v-for="(instructor, index) in course_instructors_names" :key="index" class="col-md-6 col-lg-6 col-xl-4 col-xxl-3 d-flex justify-content-between align-items-center gap-1 mb-2">
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
                                    </div>
                                </div>
                            </div>
                        </div>{{-- end card --}}
                    </div>
           
                    {{-- THEMES --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader">
                                <h4 class="card-title mb-0">Agregar temas</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex gap-2">
                                            <form id="temas"><input for="temas" class="form-control" type="text" placeholder="1 introducción a computación" @keyup.enter="addTheme(event)" v-model="theme"></form>
                                            <button type="button" class="btn btn-success" @click="addTheme"><i class="ri-add-line align-bottom"></i></button>
                                        </div>
                                        <div class="alert alert-borderless alert-danger form-control mt-2" role="alert" v-if="themeAdvice">
                                            <strong>@{{themeAdvice}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="themes[]" v-model="themes">
                                   
                                    <div class="col-sm-4 mb-4 d-flex flex-row" v-for="(theme, index) in themes" :key="index" >
                                        <input :id="index" type="text" class="form-control" disabled style="border-right: none; border-radius: 0; " :value="theme"><button type="button" @click="editTheme(index)" class="btn btn-info" style="border-left: none; border: 0; border-radius: 0;" ><i class="ri-edit-2-fill"></i></button><input type="button" @click="removeTheme(index)" class="btn btn-danger" style="border-left: none; border: 0; border-radius: 0; border-top-right-radius: 5px 5px; border-bottom-right-radius: 5px 5px;" value="X">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="d-flex justify-content-end align-items-center gap-2 mb-2">
                        <button class="btn btn-danger">Cancelar</button>
                        <button for="frmCourse" type="submit" @click="handleSubmit" class="btn btn-success">Guardar</button>
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
                        url: "{{ url('course') }}",
                        trainingFields: @json($training_fields),
                        instructors: @json($instructors),
                        find_instructor_status: false,
                        find_instructor_success: false,
                        find_instructor_msg: "",
                        course_instructors: [],
                        course_instructors_names: [],
                        theme: '',
                        themes: [],
                        themeAdvice: "",
                    }
                },
                methods:{
                    handleSubmit(){
                        document.getElementById('frmCourse').submit();
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
                    addTheme(e=false) {
                        if(!!e){
                            e.preventDefault();
                        }
                        this.themeAdvice = "";
                        if(/^[\d]+[\s][a-zA-Z\d\s]+$/.test(this.theme)) {
                            this.themes.push(this.theme);
                        
                            let respaldo = this.themes.map(res => {
                                return parseInt(res.split(" ")[0]);
                            });
                            
                            for(let i = 0; i < respaldo.length; i++){
                                for(let x = 0; x < respaldo.length - 1; x++){
                                    if(respaldo[x] > respaldo[x + 1]) {
                                        let swap = respaldo[x];
                                        respaldo[x] = respaldo[x + 1];
                                        respaldo[x + 1] = swap;

                                        swap = this.themes[x];
                                        this.themes[x] = this.themes[x + 1];
                                        this.themes[x + 1] = swap;
                                    }
                                }
                            }
                            this.theme = "";
                        }else{
                            this.themeAdvice = "Formato incorrecto, ingrese el tema con el siguiente formato. Ejemplo: 1 nombre del tema"
                        }
                        console.log(this.themes);
                        
                    },
                    editTheme(id){
                        let element = document.getElementById(id);
                        element.disabled = !element.disabled;
                    },
                    removeTheme(indice) {
                        this.themes = this.themes.filter((theme, index) => index !== indice);
                    }
                }
            }).mount('#app')
        </script>
    </x-slot>
    </x-guest-layout>
