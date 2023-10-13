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
                            <li class="breadcrumb-item"><a href="/student">Capacitandos</a></li>
                            <li class="breadcrumb-item active">Editar capacitando</li>
                        </ol></h4>

                    <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/student">Estudiantes</a></li>
                            <li class="breadcrumb-item active">Estudiantes</li>
                        </ol>
                    </div> -->
                    
                </div>
            </div>
        </div>
        <!-- end page title -->
        @if(session('error'))
            <div class="alert alert-borderless alert-danger" role="alert">
                <strong>{{session('error')}}</strong>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-borderless alert-success" role="alert">
                <strong>{{session('success')}}</strong>
            </div>
        @endif
        <form id="frmUpdateStudent" action="{{ route('student.update', $student)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <h4 class="card-title mb-0">Datos personales</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row gy-4">
                                <!-- curp, birthdate, gender -->
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-todo-fill"></i>
                                            <label for="curp">CURP</label>
                                        </div>
                                        <input type="text" id="curp_input" name="curp" class="form-control text-uppercase" placeholder="CURP" @input="validateCurp()" minlength="18" maxlength="18" onkeypress="return letrasYNumeros(event)" :value="student.curp" {{-- v-model="student.curp" --}}>
                                        <div id="resultado" class="alert alert-borderless shadow alert-warning" hidden></div>
                                        @error('curp')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-calendar-fill"></i>
                                            <label for="birthdate">Fecha de nacimiento</label>
                                        </div>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Fecha de nacimiento" min="{{date('1920-01-01')}}" max="{{date('Y-m-d')}}" v-model="student.birthdate">
                                        @error('birthdate')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-group-fill"></i>
                                            <label for="gender">Sexo</label>
                                        </div>
                                        <select class="form-select" id="gender" name="gender"  v-model="student.gender">
                                            <option disabled selected value="null">Seleccione su sexo</option>
                                            <option value="Hombre">Hombre</option>
                                            <option value="Mujer">Mujer</option>
                                        </select>
                                        @error('gender')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- name, lastname -->
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="name">Nombre</label>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="Nombre" onkeypress="return soloLetras(event)" v-model="student.name">
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
                                            <i class="ri-user-fill"></i>
                                            <label for="name">Apellido paterno</label>
                                        </div>
                                        <input type="text" name="first_name" class="form-control" placeholder="Apellido paterno" onkeypress="return soloLetras(event)" v-model="student.first_name">
                                        @error('first_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="name">Apellido materno</label>
                                        </div>
                                        <input type="text" name="last_name" class="form-control" placeholder="Apellido materno" onkeypress="return soloLetras(event)" v-model="student.last_name">
                                        @error('last_name')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email, phone number, telephone number -->
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-at-fill"></i>
                                            <label for="email">Correo electrónico</label>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="Correo eletrónico" v-model="student.email">
                                        @error('email')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-phone-fill"></i>
                                            <label for="number">Número celular</label>
                                        </div>
                                        <input type="number" name="phone_number" class="form-control" placeholder="Número celular" onkeypress="return soloNumeros(event)" v-model="student.phone_number">
                                        @error('phone_number')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-phone-fill"></i>
                                            <label for="telephone_number">Número teléfonico</label>
                                        </div>
                                        <input type="number" name="telephone_number" class="form-control" placeholder="Número teléfonico" onkeypress="return soloNumeros(event)" v-model="student.telephone_number">
                                        @error('telephone_number')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                              <!-- academic level, acquired_grade, martial status, job condition -->
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-bank-fill"></i>
                                            <label for="academic_level">Grado académico</label>
                                        </div>
                                        <select class="form-select" name="academic_level" v-model="student.academic_level">
                                            <option disabled selected value="null">Seleccione su grado académico</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Carrera Técnica">Carrera Técnica</option>
                                            <option value="Bachillerato">Bachillerato</option>
                                            <option value="Licenciatura/Ingeniería">Licenciatura/Ingeniería</option>
                                            <option value="Posgrado">Posgrado</option>
                                        </select>
                                        @error('academic_level')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-award-fill formStyle-iconCardHeader"></i>
                                            <label for="acquired_grade">Grado adquirido*</label>
                                        </div>
                                        <select class="form-select" name="acquired_grade" v-model="student.acquired_grade" required>
                                            <option disabled selected value="null">Seleccione un grado académico</option>
                                            <option value="Cursando">Cursando</option>
                                            <option value="Constancia">Constancia</option>
                                            <option value="Certificado">Certificado</option>
                                            <option value="Sin documento">Sin documento</option>
                                        </select>
                                        @error('acquired_grade')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="marital_status">Estado civil</label>
                                        </div>
                                        <select class="form-select" name="marital_status" v-model="student.marital_status">
                                            <option disabled selected value="null">Seleccione su estado civil</option>
                                            <option value="Soltero">Soltero</option>
                                            <option value="Casado">Casado</option>
                                        </select>
                                        @error('marital_status')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="academic_level">Estado laboral</label>
                                        </div>
                                        <select class="form-select" name="job_condition" v-model="student.job_condition">
                                            <option disabled value="null" selected>Seleccione su condición laboral</option>
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
                                        @error('job_condition')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="birth_place">Lugar de nacimiento</label>
                                        </div>
                                        <select class="form-select" name="birth_place" v-model="student.birth_place">
                                            <option disabled selected value="null">Seleccione su lugar de nacimiento</option>
                                            <option v-for="state in states" :value="parseInt(state.key)">@{{state.name}}</option>
                                        </select>
                                        @error('birth_place')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-todo-fill"></i>
                                            <label for="center">Asigne un centro</label>
                                        </div>
                                        <select class="form-select" name="center_id" v-model="student.center_id">
                                            <option disabled selected value="null">Asigne un centro</option>
                                            <option v-for="center in centers" :value="center.id">@{{center.name}}</option>
                                        </select>
                                        @error('center_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-todo-fill"></i>
                                            <label for="center">Foto del capacitando</label>
                                        </div>
                                        <input type="file" name="avatar_path" class="form-control" accept="image/*" data-max-size="1507459" filename="cover.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- address data -->
                <!-- colonia, cp, numero, city_id -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <h4 class="card-title mb-0">Datos del domicilio</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row gy-4">
            
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="colonia">Colonia</label>
                                        </div>
                                        <input type="text" name="colonia" class="form-control" placeholder="Colonia" onkeypress="return letrasYNumeros(event)" v-model="student.address.colonia">
                                        @error('colonia')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="calle">Calle</label>
                                        </div>
                                        <input type="text" name="calle" class="form-control" placeholder="Calle" onkeypress="return letrasYNumeros(event)" v-model="student.address.calle">
                                        @error('calle')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="codigo_postal">Código postal</label>
                                        </div>
                                        <input type="number" name="codigo_postal" class="form-control" placeholder="Código postal" onkeypress="return soloNumeros(event)" v-model="student.address.codigo_postal">
                                        @error('codigo_postal')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="numero">Número</label>
                                        </div>
                                        <input type="number" name="numero" class="form-control" placeholder="Número" onkeypress="return numeroDeCasa(event)" v-model="student.address.numero">
                                        @error('numero')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="state_id">Estado</label>
                                        </div>
                                        <select class="form-select" name="state_id">
                                            <option value="3" selected>Baja California Sur</option>
                                            <!-- <option v-for="state in states" :value="state.id">@{{state.name}}</option> -->
                                        </select>
                                        @error('state_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="city_id">Ciudad</label>
                                        </div>
                                        <select class="form-select" name="city_id" v-model="city">
                                            <option disabled value="null" selected>Seleccione su ciudad</option>
                                            <option v-for="citie in cities" :value="citie.id">@{{citie.name}}</option>
                                        </select>
                                        @error('city_id')
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
                <!-- job data -->
                <div class="col-lg-12" v-if="student.job_condition === 'Empleado'">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <h4 class="card-title mb-0">Datos laborales</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="row gy-4">
                                <!-- name, lastname -->
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="job_company">Nombre de la empresa</label>
                                        </div>
                                        <input type="text" name="job_company" class="form-control" placeholder="Nombre de la empresa" onkeypress="return letrasYNumeros(event)" v-model="student.job_company">
                                    </div>
                                </div>
            
                                <div class="col-lg-8 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-todo-fill"></i>
                                            <label for="address_job">Dirección del lugar de trabajo</label>
                                        </div>
                                        <input type="text" name="address_job" class="form-control" placeholder="Dirección del lugar de trabajo" onkeypress="return letrasYNumeros(event)" v-model="student.address_job">
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="job_position">Posición laboral</label>
                                        </div>
                                        <input type="text" name="job_position" class="form-control" placeholder="Posición laboral" onkeypress="return letrasYNumeros(event)" v-model="student.job_position">
                                    </div>
                                </div>
            
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-user-fill"></i>
                                            <label for="years_worked">Años trabajados</label>
                                        </div>
                                        <select class="form-select" name="years_worked" v-model="student.years_worked">
                                            <option disabled selected value="null" >Seleccione los años laborados</option>
                                            <option value="1">menos de 1 año</option>
                                            <option value="2">2 años</option>
                                            <option value="3">3 años</option>
                                            <option value="5">5 años o más</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <i class="ri-calendar-fill"></i>
                                            <label for="job_phone_number">Número de contacto</label>
                                        </div>
                                        <input type="number" name="job_phone_number" class="form-control" placeholder="Número de contacto" onkeypress="return soloNumeros(event)" v-model="student.job_phone_number">
                                    </div>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <button type="button" class="btn" @click="collapsed">
                                <h4 class="card-title mb-0">Discapacidad y grupos vulnerables<i v-if="showCollapse" class="ri-arrow-up-s-fill" style=""></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div v-if="showCollapse" class="collapse show">
                            <div class="card-body">
                                <div class="row gy-4">
                                    <!-- discapacidad -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header formStyle-cardHeader">
                                                <h4 class="card-title mb-0">Discapacidad</h4>
                                            </div><!-- end card header -->
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="disability_visual" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="disability_visual" name="disability_visual" :checked="!!student.disability_visual" value="1">
                                                                    <label class="form-check-label" for="disability_visual">
                                                                        Visual
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="disability_motor" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="disability_motor" name="disability_motor" :checked="!!student.disability_motor" value="1">
                                                                    <label class="form-check-label" for="disability_motor">
                                                                        Motriz
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="disability_hearing" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="disability_hearing" name="disability_hearing"  :checked="!!student.disability_hearing" value="1">
                                                                    <label class="form-check-label" for="disability_hearing">
                                                                        Auditiva
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="disability_intellectual" value="0">
                                                                <input class="form-check-input" type="checkbox" id="disability_intellectual" name="disability_intellectual"  :checked="!!student.disability_intellectual" value="1">
                                                                <label class="form-check-label" for="disability_intellectual">
                                                                    Intelectual
                                                                </label>
                                                            </div>
                                                        </div>
            
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="disability_communication" value="0">
                                                                <input class="form-check-input" type="checkbox" id="disability_communication" name="disability_communication" :checked="!!student.disability_communication" value="1">
                                                                <label class="form-check-label" for="disability_communication">
                                                                    Comunicativa
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                        </div>
                                    </div>
                                    <!-- grupos vulnerables -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header formStyle-cardHeader">
                                                    <h4 class="card-title mb-0">Grupos vulnerables</h4>
                                            </div><!-- end card header -->
            
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="group_adolescente" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="group_adolescente" name="group_adolescente" :checked="!!student.group_adolescente" value="1" >
                                                                    <label class="form-check-label" for="group_adolescente">
                                                                        Adolescente
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="group_jefamilia" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="group_jefamilia" name="group_jefamilia"  :checked="!!student.group_jefamilia" value="1">
                                                                    <label class="form-check-label" for="group_jefamilia">
                                                                        Jefe(a) de familia
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="group_indigenas" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="group_indigenas" name="group_indigenas"  :checked="!!student.group_indigenas" value="1">
                                                                    <label class="form-check-label" for="group_indigenas">
                                                                        Indígena
                                                                    </label>
                                                                </div>
                                                        </div>
            
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_cereso" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_cereso" name="group_cereso" :checked="!!student.group_cereso"value="1">
                                                                <label class="form-check-label" for="group_cereso">
                                                                    Cereso
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_terceraedad" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_terceraedad" name="group_terceraedad"  :checked="!!student.group_terceraedad" value="1">
                                                                <label class="form-check-label" for="group_terceraedad">
                                                                    Tercera edad
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_migrantes" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_migrantes" name="group_migrantes"  :checked="!!student.group_migrantes" value="1"> 
                                                                <label class="form-check-label" for="group_migrantes">
                                                                    Migrante
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <button type="button" class="btn btn-link" @click="collapsedDoc">
                                <h4 class="card-title mb-0">Documentación<i v-if="showCollapseDoc" class="ri-arrow-up-s-fill"></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div v-if="showCollapseDoc" class="collapse show">
                            <div class="card-body">
                                <div class="row gy-4">
                                    {{-- INE --}}
                                    <div class="col-lg-2 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_official_ine" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_official_ine" name="document_official_ine" :checked="!!student.document_official_ine"value="1">
                                            <label class="form-check-label" for="document_official_ine">
                                                INE
                                            </label>
                                        </div>
                                    </div>
                                    {{-- PASSPORT --}}
                                    <div class="col-lg-2 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_passport" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_passport" name="document_passport" :checked="!!student.document_passport"value="1">
                                            <label class="form-check-label" for="document_passport">
                                                Pasaporte
                                            </label>
                                        </div>
                                    </div>
                                    {{-- CURP --}}
                                    <div class="col-lg-2 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_curp" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_curp" name="document_curp" :checked="!!student.document_curp"value="1">
                                            <label class="form-check-label" for="document_curp">
                                                CURP
                                            </label>
                                        </div>
                                    </div>
                                    {{-- FMM2 o FMM3 --}}
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_fmm2_fmm3" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_fmm2_fmm3" name="document_fmm2_fmm3" :checked="!!student.document_fmm2_fmm3" value="1">
                                            <label class="form-check-label" for="document_fmm2_fmm3">
                                                Forma Migratoria Múltiple (FMM2 o FMM3)
                                            </label>
                                        </div>
                                    </div>
                                    {{-- CARTA RESPONSIVA --}}
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_responsive_card" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_responsive_card" name="document_responsive_card" :checked="!!student.document_responsive_card" value="1">
                                            <label class="form-check-label" for="document_responsive_card">
                                                Carta responsiva
                                            </label>
                                        </div>
                                    </div>
                                    {{-- COMENTADO HASTA DEFINIR LOS DOCUMENTOS REQUERIDOS --}}
                                    {{-- <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_study" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_study" name="document_study" :checked="!!student.document_study"value="1">
                                            <label class="form-check-label" for="document_study">
                                                Ultimo grado de estudio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_birth" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_birth" name="document_birth"  :checked="!!student.document_birth" value="1" >
                                            <label class="form-check-label" for="document_birth">
                                                Acta de nacimiento
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_address" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_address" name="document_address"  :checked="!!student.document_address" value="1">
                                            <label class="form-check-label" for="document_address">
                                                Comprobante de domicilio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_curp" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_curp" name="document_curp"  :checked="!!student.document_curp" value="1" >
                                            <label class="form-check-label" for="document_curp">
                                                CURP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_photos" value="0">
                                            <input class="form-check-input" type="checkbox"id="document_photos" name="document_photos"  :checked="!!student.document_photos" value="1">
                                            <label class="form-check-label" for="document_photos">
                                                Entregó fotografía
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_official_ine" value="0">
                                            <input class="form-check-input" type="checkbox" id="document_official_ine" name="document_official_ine"  :checked="!!student.document_official_ine"  value="1">
                                            <label class="form-check-label" for="document_official_ine">
                                                Identificación oficial
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input type="hidden" name="document_foreign" value="0"> 
                                            <!-- asd --> 
                                            <input class="form-check-input" type="checkbox" id="document_foreign" name="document_foreign"  :checked="!!student.document_foreign" value="1" >
                                            <label class="form-check-label" for="document_foreign">
                                                Acredita como extranjero
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- CARTA RESPONSIVA --}}
                                <div class="row gy-4">
                                    <div class="col-lg-12 my-4">
                                        <a href="{{ asset('Formato_Carta_Responsiva_2022.docx') }}" class="d-flex align-items-center" download>
                                            <i class="ri-file-download-fill me-1" style="font-size: 20px;"></i>Descargar documento de Carta Responsiva
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="d-flex justify-content-end align-items-center gap-2 mb-2 ">
                    <a  class="btn btn-danger" @click="cancel">Cancelar</a>
                    <a id="cancelar" href="{{ url('student') }}"></a>
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
                    showCollapseDoc: true,
                    url:``,
                    student: @json($student),
                    states: @json($states),
                    cities: @json($cities),
                    centers: @json($centers),
                    state: '',
                    city: '',
                }
            },
            watch:{
                state(newState, oldState){
                    if(newState !== oldState){
                        this.getCitiesByState();
                    }
                }
            },
            methods:{
                collapsed(){
                    this.showCollapse = this.showCollapse ? false : true;
                },  
                collapsedDoc(){
                    this.showCollapseDoc = this.showCollapseDoc ? false : true;
                },
                async getCitiesByState(){
                    if(this.state !== 'Seleccione el estado donde vive'){
                        try{
                            const response = await axios.get(`{{ url('cities/${this.state}') }}`)
                            const data = await response.data.data;
                            this.cities = data;
                            if(this.state !== this.student.address.city.state.id){
                                this.city = "null";
                            }
                        }
                        catch(e){
                            console.error(e);
                        }
                    }
                },
                handleSubmit(){
                    this.url = `{{ url('student/${this.student.id}') }}`;
                    let form = document.getElementById('frmUpdateStudent');
                    form.submit();
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
                validateCurp() {
                    const regex = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
                    var input = document.getElementById("curp_input"),
                        result = document.getElementById("resultado"),
                        curp = input.value.toUpperCase(),
                        validated = curp.match(regex),
                        valid = "";
                    document.getElementById("birthdate").value = "";
                    document.getElementById("gender").selectedIndex = 0;
                    result.hidden = false;
                    result.classList.remove('alert-success');
                    result.classList.add('alert-warning');

                    if(!validated) {
                        valid = "CURP no válido";
                    } else if(validated) {
                        if (validated[2] != this.curpLastChar(validated[1])) {
                            valid = "CURP no válido";
                        } else {
                            valid = "CURP válido";
                            var curpBirthdate = curp.match(/^\w{4}(\w{2})(\w{2})(\w{2})(\w{1})/),
                                year = parseInt(curpBirthdate[1],10)+1900,
                                month = parseInt(curpBirthdate[2], 10),
                                day = parseInt(curpBirthdate[3], 10),
                                gender = curpBirthdate[4],
                                birthdate = "";
                            if( year < 1950 ){
                                year += 100;
                            } 
                            birthdate = year+"-";
                            birthdate += (month<10) ? "0"+month+"-" : month+"-";
                            birthdate += (day<10) ? "0"+day : day;
                            
                            document.getElementById("birthdate").value = birthdate;
                            document.getElementById("gender").selectedIndex = (gender=='H') ? 1 : 2;                         
                            result.classList.remove('alert-warning');
                            result.classList.add('alert-success');
                        }
                    }
                    result.innerHTML = "<b>Verificación: </b> " + valid;
                },
                curpLastChar(curpLastChar) {
                    var characters = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
                        sumLenght = 0.0,
                        digitLenght = 0.0;
                    for(var i=0; i<17; i++) {
                        sumLenght = sumLenght + characters.indexOf(curpLastChar.charAt(i)) * (18 - i);
                    } 
                    digitLenght = 10 - sumLenght % 10;
                    if (digitLenght == 10) {
                        return 0;
                    } 
                    return digitLenght;
                },
            },
            mounted(){
                this.state = this.student.address.city.state.id;
                this.city = this.student.address.city.id;
            },
           
        }).mount('#app')
    </script>
</x-slot>
</x-guest-layout>