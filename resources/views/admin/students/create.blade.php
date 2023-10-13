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
                            <li class="breadcrumb-item active">Agregar capacitando</li>
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
        <form id="formStudent" :action="url" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader" >
                            <button type="button" class="btn btn-link" @click="collapsedPersonal" data-bs-toggle="collapse" data-bs-target="#personal" aria-expanded="false" aria-controls="personal">
                                <h4 class="card-title mb-0">Datos personales<i v-if="showCollapsePersonal" class="ri-arrow-up-s-fill"></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div id="personal" class="collapse show">
                            <div class="card-body">
                                <div class="row gy-4">
                                    <!-- curp, birthdate, gender -->
                                    <div class="col-lg-4 mb-1">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-todo-fill formStyle-iconCardHeader"></i>
                                                <label for="curp">CURP*</label>
                                            </div>
                                            <input type="text" id="curp_input" name="curp" class="form-control text-uppercase" placeholder="CURP" @input="validateCurp()" onkeypress="return letrasYNumeros(event)" minlength="18" maxlength="18" value="{{old('curp')}}" required>
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
                                                <i class="ri-calendar-fill formStyle-iconCardHeader"></i>
                                                <label for="birthdate">Fecha de nacimiento*</label>
                                            </div>
                                            <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Fecha de nacimiento" min="{{date('1920-01-01')}}" max="{{date('Y-m-d')}}" value="{{old('birthdate')}}" required>
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
                                                <i class="ri-group-fill formStyle-iconCardHeader"></i>
                                                <label for="gender">Sexo*</label>
                                            </div>
                                            <select class="form-select" id="gender" name="gender"  @if (old('gender') == null) value="default"  @else value="{{old('gender')}}" @endif>
                                                <option disabled selected value="default">Seleccione su sexo</option>
                                                <option value="hombre">Hombre</option>
                                                <option value="mujer">Mujer</option>
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
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="name">Nombre*</label>
                                            </div>
                                            <input type="text" name="name" class="form-control" placeholder="Nombre" onkeypress="return soloLetras(event)" value="{{old('name')}}" required>
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
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="first_name">Primer apellido*</label>
                                            </div>
                                            <input type="text" name="first_name" class="form-control" placeholder="Apellido paterno" onkeypress="return soloLetras(event)" value="{{old('first_name')}}" required>
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
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="last_name">Segundo apellido*</label>
                                            </div>
                                            <input type="text" name="last_name" class="form-control" placeholder="Apellido materno" onkeypress="return soloLetras(event)" value="{{old('last_name')}}" required>
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
                                                <i class="ri-at-fill formStyle-iconCardHeader"></i>
                                                <label for="email">Correo electrónico</label>
                                            </div>
                                            <input type="email" name="email" class="form-control" placeholder="Correo electrónico"  value="{{old('email')}}">
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
                                                <i class="ri-phone-fill formStyle-iconCardHeader"></i>
                                                <label for="number">Número celular*</label>
                                            </div>
                                            <input type="number" name="phone_number" class="form-control" minlength="10" maxlength="10" placeholder="Número celular" onkeypress="return soloNumeros(event)" value="{{old('phone_number')}}" required>
                                    
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-phone-fill formStyle-iconCardHeader"></i>
                                                <label for="telephone_number">Número teléfonico</label>
                                            </div>
                                            <input type="number" name="telephone_number" class="form-control" placeholder="Número teléfonico" onkeypress="return soloNumeros(event)" value="{{old('telephone_number')}}" minlength="10" maxlength="10">
                                        
                                        </div>
                                    </div>
                                <!-- academic level, acquired_grade, martial status, job condition -->
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-bank-fill formStyle-iconCardHeader"></i>
                                                <label for="academic_level">Grado académico*</label>
                                            </div>
                                            <select class="form-select" name="academic_level" @if (old('academic_level') == null) value="default"  @else value="{{old('academic_level')}}" @endif required>
                                                <option disabled selected value="default">Seleccione su grado académico</option>
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
                                            <select class="form-select" name="acquired_grade" @if (old('acquired_grade') == null) value="default"  @else value="{{old('acquired_grade')}}" @endif required>
                                                <option disabled selected value="default">Seleccione un grado adquirido</option>
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
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="marital_status">Estado civil*</label>
                                            </div>
                                            <select class="form-select" name="marital_status" @if (old('marital_status') == null) value="default"  @else value="{{old('marital_status')}}" @endif required>
                                                <option disabled selected value="default">Seleccione su estado civil</option>
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
                                                <i class="ri-suitcase-fill formStyle-iconCardHeader"></i>
                                                <label for="job_condition">Estado laboral*</label>
                                            </div>
                                            <select class="form-select" name="job_condition" v-model="jobCondition" required>
                                                <option disabled value="default" selected>Seleccione su condición laboral</option>
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
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="birth_place">Lugar de nacimiento*</label>
                                            </div>
                                            <select class="form-select" name="birth_place" @if (old('birth_place') == null) value="default"  @else value="{{old('birth_place')}}" @endif required>
                                                <option disabled selected value="default">Seleccione su lugar de nacimiento</option>
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
                                                <i class="ri-todo-fill formStyle-iconCardHeader"></i>
                                                <label for="center">Asigne un centro*</label>
                                            </div>
                                            <select class="form-select" name="center_id" @if (old('center_id') == null) value="default"  @else value="{{old('center_id')}}" @endif required>
                                                <option disabled selected value="default">Asigne un centro</option>
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
                                                <i class="ri-image-add-fill formStyle-iconCardHeader"></i>
                                                <label for="center">Foto del capacitando</label>
                                            </div>
                                            <input type="file" name="avatar_path" class="form-control" accept="image/*" data-max-size="1507459" filename="cover.jpg">
                                        </div>
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
                        <div class="card-header formStyle-cardHeader" >
                            <button type="button" class="btn btn-link" @click="collapsedAddress" data-bs-toggle="collapse" data-bs-target="#address" aria-expanded="false" aria-controls="address">
                                <h4 class="card-title mb-0">Datos del domicilio<i v-if="showCollapseAddress" class="ri-arrow-up-s-fill"></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div id="address" class="collapse show">
                            <div class="card-body">
                                <div class="row gy-4">
                
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-home-7-fill formStyle-iconCardHeader"></i>
                                                <label for="colonia">Colonia*</label>
                                            </div>
                                            <input type="text" name="colonia" class="form-control" placeholder="Colonia" onkeypress="return letrasYNumeros(event)" value="{{old('colonia')}}" required>
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
                                                <i class="ri-home-7-fill formStyle-iconCardHeader"></i>
                                                <label for="calle">Calle*</label>
                                            </div>
                                            <input type="text" name="calle" class="form-control" placeholder="Calle" onkeypress="return letrasYNumeros(event)" value="{{old('calle')}}" required>
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
                                                <i class="ri-home-7-fill formStyle-iconCardHeader"></i>
                                                <label for="codigo_postal">Código postal*</label>
                                            </div>
                                            <input type="number" name="codigo_postal" class="form-control" placeholder="Código postal" onkeypress="return soloNumeros(event)" value="{{old('codigo_postal')}}" required>
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
                                                <i class="ri-home-7-fill formStyle-iconCardHeader"></i>
                                                <label for="numero">Número*</label>
                                            </div>
                                            <input type="number" name="numero" class="form-control" placeholder="Número" onkeypress="return numeroDeCasa(event)" value="{{old('numero')}}" required>
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
                                                <i class="ri-road-map-fill formStyle-iconCardHeader"></i>
                                                <label for="state_id">Estado*</label>
                                            </div>
                                            <select class="form-select" name="state_id"  @if (old('state_id') == null) value="3"  @else value="{{old('state_id')}}" @endif required> 
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
                                                <i class="ri-map-pin-5-fill formStyle-iconCardHeader"></i>
                                                <label for="city_id">Ciudad*</label>
                                            </div>
                                            <select class="form-select" name="city_id" @if (old('city_id') == null) value="19"  @else value="{{old('city_id')}}" @endif required>
                                                <option selected="19" v-for="citie in cities" :value="citie.id">@{{citie.name}}</option>
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
                </div>
                <!-- job data -->
                <div class="col-lg-12" v-if="jobCondition === 'Empleado'">
                    <div class="card">
                        <div class="card-header formStyle-cardHeader">
                            <button type="button" class="btn btn-link" @click="collapsedJob" data-bs-toggle="collapse" data-bs-target="#jobCondition" aria-expanded="false" aria-controls="jobCondition">
                                <h4 class="card-title mb-0">Datos laborales<i v-if="showCollapsedJob" class="ri-arrow-up-s-fill"></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div id="jobCondition">
                            <div class="card-body">
                                <div class="row gy-4">
                                    <!-- name, lastname -->
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="job_company">Nombre de la empresa</label>
                                            </div>
                                            <input type="text" name="job_company" class="form-control" placeholder="Nombre de la empresa" onkeypress="return letrasYNumeros(event)"  value="{{old('job_company')}}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-8 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-todo-fill formStyle-iconCardHeader"></i>
                                                <label for="address_job">Dirección del lugar de trabajo</label>
                                            </div>
                                            <input type="text" name="address_job" class="form-control" placeholder="Dirección del lugar de trabajo" onkeypress="return letrasYNumeros(event)" value="{{old('address_job')}}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="job_position">Posición laboral</label>
                                            </div>
                                            <input type="text" name="job_position" class="form-control" placeholder="Posición laboral" onkeypress="return letrasYNumeros(event)" value="{{old('job_position')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                <label for="years_worked">Años trabajados</label>
                                            </div>
                                            <select class="form-select" name="years_worked" value="{{old('years_worked')}}" >
                                                <option disabled selected value="">Seleccione los años laborados</option>
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
                                                <i class="ri-calendar-fill formStyle-iconCardHeader"></i>
                                                <label for="job_phone_number">Número de contacto</label>
                                            </div>
                                            <input type="number" name="job_phone_number" class="form-control" placeholder="Número de contacto" onkeypress="return soloNumeros(event)" value="{{old('job_phone_number')}}" >
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
                            <button type="button" class="btn btn-link" @click="collapsed">
                                <h4 class="card-title mb-0">Discapacidad y grupos vulnerables<i v-if="showCollapse" class="ri-arrow-up-s-fill"></i>
                                <i v-else class="ri-arrow-down-s-fill"></i></h4>
                            </button>
                        </div><!-- end card header -->
                        <div v-if="showCollapse" class="collapse show">
                            <div class="card-body">
                                <div class="row gy-4">
                                    <!-- discapacidad -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header formStyle-cardHeader" >
                                                <button type="button" class="btn btn-link" @click="collapsedDisabilities">
                                                    <h4 class="card-title mb-0">Discapacidad<i v-if="showCollapseDisabilities" class="ri-arrow-up-s-fill"></i>
                                                    <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                                </button>
                                            </div><!-- end card header -->
                                            <div v-if="showCollapseDisabilities" class="collapse show">
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="disability_visual" name="disability_visual" @click="verifyCheckbox('disability_visual')" @if (old('disability_visual') == 1) value="1" checked  @else value="0" @endif >
                                                                    <label class="form-check-label" for="disability_visual">
                                                                        Visual
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="disability_motor" name="disability_motor" @click="verifyCheckbox('disability_motor')" @if (old('disability_motor') == 1) value="1" checked  @else value="0" @endif>
                                                                    <label class="form-check-label" for="disability_motor">
                                                                        Motriz
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="disability_hearing" name="disability_hearing" @click="verifyCheckbox('disability_hearing')" @if (old('disability_hearing') == 1) value="1" checked  @else value="0" @endif>
                                                                    <label class="form-check-label" for="disability_hearing">
                                                                        Auditiva
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="disability_intellectual" name="disability_intellectual" @click="verifyCheckbox('disability_intellectual')" @if (old('disability_intellectual') == 1) value="1" checked  @else value="0" @endif>
                                                                <label class="form-check-label" for="disability_intellectual">
                                                                    Intelectual
                                                                </label>
                                                            </div>
                                                        </div>
            
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="disability_communication" name="disability_communication" @click="verifyCheckbox('disability_communication')" @if (old('disability_communication') == 1) value="1" checked  @else value="0" @endif>
                                                                <label class="form-check-label" for="disability_communication">
                                                                    Comunicativa
                                                                </label>
                                                            </div>
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
                                                <button type="button" class="btn btn-link" @click="collapsedVulnerable">
                                                    <h4 class="card-title mb-0">Grupos vulnerables<i v-if="showCollapseVulnerable" class="ri-arrow-up-s-fill"></i>
                                                    <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                                </button>
                                            </div><!-- end card header -->
                                            <div v-if="showCollapseVulnerable" class="collapse show">
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="group_adolescente" name="group_adolescente" @click="verifyCheckbox('group_adolescente')" @if (old('group_adolescente') == 1) value="1" checked  @else value="0" @endif>
                                                                    <label class="form-check-label" for="group_adolescente">
                                                                        Adolescente
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="group_jefamilia" name="group_jefamilia" @click="verifyCheckbox('group_jefamilia')" @if (old('group_jefamilia') == 1) value="1" checked  @else value="0" @endif>
                                                                    <label class="form-check-label" for="group_jefamilia">
                                                                        Jefe(a) de familia
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="group_indigenas" name="group_indigenas" @click="verifyCheckbox('group_indigenas')" @if (old('group_indigenas') == 1) value="1" checked  @else value="0" @endif>
                                                                    <label class="form-check-label" for="group_indigenas">
                                                                        Indígena
                                                                    </label>
                                                                </div>
                                                        </div>
            
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="group_cereso" name="group_cereso" @click="verifyCheckbox('group_cereso')" @if (old('group_cereso') == 1) value="1" checked  @else value="0" @endif>
                                                                <label class="form-check-label" for="group_cereso">
                                                                    Cereso
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="group_terceraedad" name="group_terceraedad" @click="verifyCheckbox('group_terceraedad')" @if (old('group_terceraedad') == 1) value="1" checked  @else value="0" @endif>
                                                                <label class="form-check-label" for="group_terceraedad">
                                                                    Tercera edad
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="group_migrantes" name="group_migrantes" @click="verifyCheckbox('group_migrantes')" @if (old('group_migrantes') == 1) value="1" checked  @else value="0" @endif>
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
                                            <input class="form-check-input" type="checkbox" id="document_official_ine" name="document_official_ine" @click="verifyCheckbox('document_official_ine')" @if (old('document_official_ine') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_official_ine">
                                                INE
                                            </label>
                                        </div>
                                    </div>
                                    {{-- PASSPORT --}}
                                    <div class="col-lg-2 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_passport" name="document_passport" @click="verifyCheckbox('document_passport')" @if (old('document_passport') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_passport">
                                                Pasaporte
                                            </label>
                                        </div>
                                    </div>
                                    {{-- CURP --}}
                                    <div class="col-lg-2 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_curp" name="document_curp" @click="verifyCheckbox('document_curp')" @if (old('document_curp') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_curp">
                                                CURP
                                            </label>
                                        </div>
                                    </div>
                                    {{-- FMM2 o FMM3 --}}
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_fmm2_fmm3" name="document_fmm2_fmm3" @click="verifyCheckbox('document_fmm2_fmm3')" @if (old('document_fmm2_fmm3') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_fmm2_fmm3">
                                                Forma Migratoria Múltiple (FMM2 o FMM3)
                                            </label>
                                        </div>
                                    </div>
                                    {{-- CARTA RESPONSIVA --}}
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_responsive_card" name="document_responsive_card" @click="verifyCheckbox('document_responsive_card')" @if (old('document_responsive_card') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_responsive_card">
                                                Carta responsiva
                                            </label>
                                        </div>
                                    </div>
                                    {{-- COMENTADO HASTA DEFINIR LOS DOCUMENTOS REQUERIDOS --}}
                                    {{-- <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_study" name="document_study" @click="verifyCheckbox('document_study')" @if (old('document_study') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_study">
                                                Ultimo grado de estudio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_birth" name="document_birth" @click="verifyCheckbox('document_birth')" @if (old('document_birth') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_birth">
                                                Acta de nacimiento
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_address" name="document_address" @click="verifyCheckbox('document_address')" @if (old('document_address') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_address">
                                                Comprobante de domicilio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_curp" name="document_curp" @click="verifyCheckbox('document_curp')" @if (old('document_curp') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_curp">
                                                CURP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"id="document_photos" name="document_photos" @click="verifyCheckbox('document_photos')" @if (old('document_photos') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_photos">
                                                Entregó fotografía
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_official_ine" name="document_official_ine" @click="verifyCheckbox('document_official_ine')" @if (old('document_official_ine') == 1) value="1" checked  @else value="0" @endif>
                                            <label class="form-check-label" for="document_official_ine">
                                                Identificación oficial
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="document_foreign" name="document_foreign" @click="verifyCheckbox('document_foreign')" @if (old('document_foreign') == 1) value="1" checked  @else value="0" @endif>
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
                <div class="d-flex justify-content-end align-items-center gap-2 mb-2">
                    <a class="btn btn-danger" @click="cancel">Cancelar</a>
                    <a id="cancelar" href="{{ url('student') }}"></a>
                    @can('Agregar centros')
                        <button type="button" @click="submitForm" class="btn btn-success">Guardar</button>
                    @endcan
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
                    showCollapsePersonal: true,
                    showCollapseAddress: true,
                    showCollapse: true,
                    showCollapseDisabilities: true,
                    showCollapseVulnerable: true,
                    showCollapseDoc: true,
                    showCollapsedJob: true,
                    url:'{{ url("student") }}',
                    states: @json($states),
                    centers: @json($centers),
                    cities: @json($cities).filter(city => city.state_id === 3),
                    jobCondition: 'default',
                    state: 'Seleccione el estado donde vive',
                    disability_visual: 0,
                    curpValidated: false,
                }
            },
            methods:{
                collapsedPersonal(){
                    this.showCollapsePersonal = this.showCollapsePersonal ? false : true;
                },  
                collapsedJob(){
                    this.showCollapsedJob = this.showCollapsedJob ? false : true;
                },  
                collapsedAddress(){
                    this.showCollapseAddress = this.showCollapseAddress ? false : true;
                },  
                collapsed(){
                    this.showCollapse = this.showCollapse ? false : true;
                },  
                collapsedDisabilities(){
                    this.showCollapseDisabilities = this.showCollapseDisabilities ? false : true;
                }, 
                collapsedVulnerable(){
                    this.showCollapseVulnerable = this.showCollapseVulnerable ? false : true;
                }, 
                collapsedDoc(){
                    this.showCollapseDoc = this.showCollapseDoc ? false : true;
                },
                verifyCheckbox(id){
                    document.getElementById(`${id}`).value = (document.getElementById(`${id}`).checked) ? '1' : '0';
                },
                async getCitiesByState(){
                    //if(this.state !== 'Seleccione el estado donde vive'){
                        try{
                            const response = await axios.get(`{{ url('cities/3') }}`) //${this.state}
                            const data = await response.data.data;
                            this.cities = data;
                        }
                        catch(e){
                            console.error(e);
                        }
                    //}
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
                async validateCurp() {
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
  
                            try {
                                let curpExists = { curp: curp };
                                const resp = await axios.post(`{{ url('student/curp-exists') }}`, curpExists);
                                if(resp.data.exists==true&&resp.data.id!=null){
                                    console.log(resp.data.id.id);
                                    if(resp.data.id.id!=null){
                                        Swal.fire({
                                            title: 'Ya existe un capacitando con ese CURP, seras redireccionado a sus detalles.',
                                            icon: 'info',
                                            confirmButtonColor: '#0ab39c',
                                            confirmButtonText: 'Aceptar',
                                            allowOutsideClick: false,
                                        }).then((result) => {
                                            window.location = this.url+'/'+resp.data.id.id;
                                        })
                                    }
                                } else if(resp.data.exists==false&&resp.data.id==null){
                                    this.curpValidated = true;
                                    try {
                                        const resp = await axios.get(`{{ route('student.reactivate') }}`, {
                                            params: {
                                                curp: curp
                                            }
                                        });
                                        if(resp.data.code==2){
                                            Swal.fire({
                                                title: 'Se encontró un estudiante eliminado con este CURP.',
                                                text: 'Ha sido reactivado y sus datos se han recuperado, seras redireccionado a sus detalles.',
                                                icon: 'info',
                                                confirmButtonColor: '#0ab39c',
                                                confirmButtonText: 'Aceptar',
                                                allowOutsideClick: false,
                                            }).then((result) => {
                                                window.location = this.url+'/'+resp.data.data;
                                            })
                                        }
                                    } catch (e) {
                                        console.error(e);
                                    } 
                                } else {
                                    this.curpValidated = false;
                                }
                            } catch (e) {
                                console.error(e);
                            } 
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
                submitForm() {
                    var form = document.getElementById("formStudent");
                    this.validateCurp();
                    if(this.curpValidated==true){
                        form.submit();
                    } else {
                        Swal.fire({
                            title: 'El CURP no es válido o se esta verificando, vuelve a intentarlo.',
                            icon: 'warning',
                            confirmButtonColor: '#4c66ba',
                            confirmButtonText: 'Aceptar',
                        })
                    }
                },
            },
            mounted(){
                @if (old('job_condition') != null) this.jobCondition="{{old('job_condition')}}" @endif
            },
        }).mount('#app')
    </script>
</x-slot>
</x-guest-layout>