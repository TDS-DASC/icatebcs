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
                                <li class="breadcrumb-item"><a href="/instructor">Instructores</a></li>
                                <li class="breadcrumb-item active">Editar instructor</li>
                            </ol></h4>
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
            <form id="frmUpdateInstructor" action="{{ route('instructor.update', $instructor)}}"  method="POST" enctype="multipart/form-data">
                @method('PUT')
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
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-todo-fill formStyle-iconCardHeader"></i>
                                                    <label for="curp">CURP*</label>
                                                </div>
                                                <input type="text" id="curp_input" name="curp" class="form-control text-uppercase" placeholder="CURP" @input="validateCurp()" onkeypress="return letrasYNumeros(event)" v-model="instructor.curp" maxlength="18" required>
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
                                                    <i class="ri-todo-fill formStyle-iconCardHeader"></i>
                                                    <label for="rfc">RFC*</label>
                                                </div>
                                                <input type="text" name="rfc" class="form-control text-uppercase" placeholder="RFC" onkeypress="return letrasYNumeros(event)" maxlength="13" v-model="instructor.rfc" required>
                                                @error('rfc')
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
                                                <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Fecha de nacimiento" min="{{date('1920-01-01')}}" max="{{date('Y-m-d')}}" :value="instructor.birthdate" required>
                                                @error('birthdate')
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
                                                <input type="text" name="name" class="form-control" placeholder="Nombre" onkeypress="return soloLetras(event)" :value="instructor.name" required>
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
                                                <input type="text" name="first_name" class="form-control" placeholder="Apellido paterno" onkeypress="return soloLetras(event)" :value="instructor.first_name" required>
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
                                                <input type="text" name="last_name" class="form-control" placeholder="Apellido materno" onkeypress="return soloLetras(event)" :value="instructor.last_name" required>
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
                                                    <label for="email">Correo electrónico*</label>
                                                </div>
                                                <input type="email" name="email" class="form-control" placeholder="Correo eletrónico" v-model="instructor.email" required>
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
                                                <input type="number" name="phone_number" class="form-control" minlength="10" maxlength="10" placeholder="Número celular" onkeypress="return soloNumeros(event)" :value="instructor.phone_number" required>
                                        
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-phone-fill formStyle-iconCardHeader"></i>
                                                    <label for="telephone_number">Número particular*</label>
                                                </div>
                                                <input type="number" name="telephone_number" class="form-control" placeholder="Número particular" onkeypress="return soloNumeros(event)" :value="instructor.telephone_number" minlength="10" maxlength="10" required>
                                            
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-bank-fill formStyle-iconCardHeader"></i>
                                                    <label for="last_grade">Último grado concluido*</label>
                                                </div>
                                                <select class="form-select" name="last_grade" :value="instructor.last_grade" required>
                                                    <option disabled selected value="default">Seleccione un grado</option>
                                                    <option value="1">Preescolar</option>
                                                    <option value="2">Primaria</option>
                                                    <option value="3">Secundaria</option>
                                                    <option value="4">Preparatoria</option>
                                                    <option value="5">Licenciatura / Ingeniería</option>
                                                    <option value="6">Maestría / Doctorado</option>
                                                </select>
                                                @error('last_grade')
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
                                                <select class="form-select" name="acquired_grade" :value="instructor.acquired_grade" required>
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
                                                <select class="form-select" name="marital_status" :value="instructor.marital_status" required>
                                                    <option disabled selected value="">Seleccione su estado civil</option>
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                    <option value="Union libre">Union libre</option>
                                                    <option value="Divorciado">Divorciado</option>
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
                                                    <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                    <label for="birth_place">Lugar de nacimiento*</label>
                                                </div>
                                                <select class="form-select" name="birth_place" :value="instructor.birth_place" required>
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
                                                    <label for="center_id">Asigne un centro*</label>
                                                </div>
                                                <select class="form-select" name="center_id" :value="instructor.center.id"required>
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
                                                    <i class="ri-calendar-fill formStyle-iconCardHeader"></i>
                                                    <label for="admission_date">Fecha de ingreso*</label>
                                                </div>
                                                <input type="date" name="admission_date" class="form-control" min="{{date('1980-01-01')}}" max="{{date('Y-m-d')}}" :value="instructor.admission_date" required>
                                                @error('admission_date')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div id="divAvatarInput" class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-image-add-fill formStyle-iconCardHeader"></i>
                                                    <label for="avatar_path">Foto del instructor</label>
                                                </div>
                                                <input type="file" name="avatar_path" class="form-control" accept="image/png, image/jpg, image/jpeg" filename="cover.jpg" @change="avatarInput()">
                                                <div class="valid-feedback">
                                                    Formato de imagen válido.
                                                </div>
                                                <div class="invalid-feedback">
                                                    Formato de imagen no válido.
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <small><b>Formatos aceptados:</b> .PNG, .JPG, .JPEG</small>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <small><b>Peso máxmo:</b> 2MB</small>
                                                    </div>
                                                </div>
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
                                                <input type="text" name="colonia" class="form-control" placeholder="Colonia" onkeypress="return letrasYNumeros(event)" :value="instructor.address.colonia" required>
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
                                                <input type="text" name="calle" class="form-control" placeholder="Calle" onkeypress="return letrasYNumeros(event)" :value="instructor.address.calle" required>
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
                                                <input type="text" name="codigo_postal" class="form-control" placeholder="Código postal" onkeypress="return soloNumeros(event)" minlength="5" maxlength="5" :value="instructor.address.codigo_postal" required>
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
                                                <input type="text" name="numero" class="form-control" placeholder="Número" onkeypress="return numeroDeCasa(event)" minlength="5" maxlength="5" :value="instructor.address.numero" required>
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
                                                <select class="form-select" name="state_id"  v-model="state_id"  required> 
                                                    <option value="" selected disabled>Seleccione un estado</option>
                                                    <option v-for="state in states" :value="state.id">@{{state.name}}</option> 
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
                                                <select class="form-select" name="city_id" :value="instructor.address.city.id" required>
                                                    <option value="" disabled selected>Seleccione una ciudad</option>
                                                    <option v-for="citie in cities_respaldo" :value="citie.id">@{{citie.name}}</option>
                                                </select>
                                                @error('city_id')
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
                                                    <label for="municipio">Municipio*</label>
                                                </div>
                                                <input type="text" name="municipio" class="form-control" placeholder="Municipio" onkeypress="return soloLetras(event)" :value="instructor.address.municipio" required>
                                                @error('municipio')
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
                    <!-- bank data bank_id	interbank_key	bank_account -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader">
                                <button type="button" class="btn btn-link" @click="collapsedBank" data-bs-toggle="collapse" data-bs-target="#jobCondition" aria-expanded="false" aria-controls="jobCondition">
                                    <h4 class="card-title mb-0">Datos bancarios<i v-if="showCollapseBank" class="ri-arrow-up-s-fill"></i>
                                    <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                </button>
                            </div><!-- end card header -->
                            <div id="jobCondition" class="collapse show">
                                <div class="card-body">
                                    <div class="row gy-4">
                                        <!-- bank -->
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                    <label for="bank_id">Nombre del banco</label>
                                                </div>
                                                <select class="form-select" name="bank_id" :value="instructor.bank_id" required>
                                                    <option value="" disabled selected>Seleccione un banco</option>
                                                    <option v-for="bank in banks" :value="bank.id">@{{bank.marca}}</option>
                                                </select>
                                                @error('bank_id')
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
                                                    <label for="interbank_key">Clave interbancaria</label>
                                                </div>
                                                <input type="text" name="interbank_key" class="form-control" placeholder="Clave interbancaria" onkeypress="return soloNumeros(event)" minlength="18" maxlength="18" :value="instructor.interbank_key" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-user-fill formStyle-iconCardHeader"></i>
                                                    <label for="bank_account">Cuenta bancaria</label>
                                                </div>
                                                <input type="text" name="bank_account" class="form-control" placeholder="Cuenta bancaria" onkeypress="return soloNumeros(event)" minlength="11" maxlength="11" :value="instructor.bank_account" >
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-4">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <i class="ri-bank-card-fill formStyle-iconCardHeader"></i>
                                                    <label for="card_number">Número de tarjeta</label>
                                                </div>
                                                <input type="text" name="card_number" class="form-control" placeholder="Número de tarjeta" onkeypress="return soloNumeros(event)" minlength="14" maxlength="19" :value="instructor.card_number" >
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
                                                                        <input class="form-check-input" type="checkbox" id="disability_visual" name="disability_visual" :checked="!!instructor.disability_visual" value="1">
                                                                        <label class="form-check-label" for="disability_visual">
                                                                            Visual
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-4">
                                                                    <div class="form-check">
                                                                        <input type="hidden" name="disability_motor" value="0">
                                                                        <input class="form-check-input" type="checkbox" id="disability_motor" name="disability_motor" :checked="!!instructor.disability_motor" value="1">
                                                                        <label class="form-check-label" for="disability_motor">
                                                                            Motriz
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-4">
                                                                    <div class="form-check">
                                                                        <input type="hidden" name="disability_hearing" value="0">
                                                                        <input class="form-check-input" type="checkbox" id="disability_hearing" name="disability_hearing"  :checked="!!instructor.disability_hearing" value="1">
                                                                        <label class="form-check-label" for="disability_hearing">
                                                                            Auditiva
                                                                        </label>
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="disability_intellectual" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="disability_intellectual" name="disability_intellectual"  :checked="!!instructor.disability_intellectual" value="1">
                                                                    <label class="form-check-label" for="disability_intellectual">
                                                                        Intelectual
                                                                    </label>
                                                                </div>
                                                            </div>
                
                                                            <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="disability_communication" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="disability_communication" name="disability_communication" :checked="!!instructor.disability_communication" value="1">
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
                                                                    <input class="form-check-input" type="checkbox" id="group_adolescente" name="group_adolescente" :checked="!!instructor.group_adolescente" value="1" >
                                                                    <label class="form-check-label" for="group_adolescente">
                                                                        Adolescente
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="group_jefamilia" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="group_jefamilia" name="group_jefamilia"  :checked="!!instructor.group_jefamilia" value="1">
                                                                    <label class="form-check-label" for="group_jefamilia">
                                                                        Jefe(a) de familia
                                                                    </label>
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="group_indigenas" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="group_indigenas" name="group_indigenas"  :checked="!!instructor.group_indigenas" value="1">
                                                                    <label class="form-check-label" for="group_indigenas">
                                                                        Indigenas
                                                                    </label>
                                                                </div>
                                                        </div>
            
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_cereso" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_cereso" name="group_cereso" :checked="!!instructor.group_cereso"value="1">
                                                                <label class="form-check-label" for="group_cereso">
                                                                    Cereso
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_terceraedad" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_terceraedad" name="group_terceraedad"  :checked="!!instructor.group_terceraedad" value="1">
                                                                <label class="form-check-label" for="group_terceraedad">
                                                                    Tercera edad
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mb-4">
                                                            <div class="form-check">
                                                                <input type="hidden" name="group_migrantes" value="0">
                                                                <input class="form-check-input" type="checkbox" id="group_migrantes" name="group_migrantes"  :checked="!!instructor.group_migrantes" value="1"> 
                                                                <label class="form-check-label" for="group_migrantes">
                                                                    Migrantes
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
                                <button @click="collapsedDoc" type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#documentacion" aria-expanded="false" aria-controls="documentacion">
                                    <h4 class="card-title mb-0">Documentación recibida <i v-if="showCollapseDoc" class="ri-arrow-up-s-fill"></i>
                                    <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                </button>
                            </div><!-- end card header document_rfc	document_address	document_curp	document_official_ine	document_certificate_medical	document_bank_account	-->
                            <div id="documentacion" class="collapse show">
                                <div class="card-body">
                                    <div class="row gy-4">
                                        <!-- Documentación Académica -->
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header formStyle-cardHeader" >
                                                    <button type="button" class="btn btn-link" @click="collapsedAcademic">
                                                        <h4 class="card-title mb-0">Académica<i v-if="showCollapseAcademic" class="ri-arrow-up-s-fill"></i>
                                                        <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                                    </button>
                                                </div><!-- end card header -->
                                                <div v-if="showCollapseAcademic" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="row gy-3 mb-4">
                                                            {{-- 'SI ES EVALUADOR' --}}
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <div class="d-flex">
                                                                    <i class="ri-edit-box-fill formStyle-iconCardHeader"></i>
                                                                        <label for="evaluador">Seleccione sí es evaluador</label>
                                                                    </div>
                                                                    <select class="form-select" name="evaluador" id="evaluador" v-model="evaluador">
                                                                        <option value="1">Si</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- 'NÚMERO DE EVALUADOR' --}}
                                                            <div class="col-lg-6">
                                                                {{-- EN CASO DE SER EVALUADOR --}}
                                                                <div class="form-group" v-if="evaluador_selected==true">
                                                                    <div class="d-flex">
                                                                        <i class="ri-contacts-book-2-fill formStyle-iconCardHeader"></i>
                                                                        <label for="evaluator_code">Número de evaluador</label>
                                                                    </div>
                                                                    <input type="text" name="evaluator_code" id="evaluator_code" class="form-control" placeholder="Ingrese el número" :value="instructor.evaluator_code" onkeypress="return soloNumeros(event)">
                                                                </div>
                                                                @error('evaluator_code')
                                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                                        <strong>{{$message}}</strong>
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row gy-3 mb-4">
                                                            <div class="d-flex">
                                                                <i class="ri-survey-fill me-1"></i><label for="standard">Comprobantes y certificados</label>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-6 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_study" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_study" value="1" name="document_study" @click="verifyCheckbox('document_study')" :checked="!!instructor.document_study">
                                                                    <label class="form-check-label" for="document_study">
                                                                        Comprobante de estudios
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-6 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="own_certifications" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="own_certifications" value="1" name="own_certifications" @click="verifyCheckbox('own_certifications')" :checked="!!instructor.own_certifications">
                                                                    <label class="form-check-label" for="own_certifications">
                                                                        Certificaciones propias
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            {{-- CERTIFICADOS VIGENTES (EC0217.01 y/o EC0301) //COMENTADO HASTA DEFINIR SI ES REQUERIDO --}}
                                                            {{-- <div class="col-sm-8 col-md-7 col-lg-12 col-xxl-6 mb-2">
                                                                <div class="form-group">
                                                                    <div class="d-flex">
                                                                        <label for="alineacion_217">Certificado Vigente (EC0217.01 y/o EC0301)</label>
                                                                    </div>
                                                                    <select class="form-select" name="alineacion_217" :value="instructor.alineacion_217" required>
                                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                                        <option value="0">Ninguno</option>
                                                                        <option value="1">Alguno de los dos</option>
                                                                        <option value="2">Ambos</option>
                                                                    </select>
                                                                    @error('alineacion_217')
                                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                                            <strong>{{$message}}</strong>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div> --}}
                                                        </div><!-- end row -->
                                                        <div class="row gy-4">
                                                            <div class="d-flex">
                                                                <i class="ri-bookmark-3-fill me-1"></i><label for="standard">Estándares</label>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0038" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0038" value="1" name="standard_ec0038" @click="verifyCheckbox('standard_ec0038')" :checked="!!instructor.standard_ec0038">
                                                                    <label class="form-check-label" for="standard_ec0038">
                                                                        EC0038
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0128" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0128" value="1" name="standard_ec0128" @click="verifyCheckbox('standard_ec0128')" :checked="!!instructor.standard_ec0128">
                                                                    <label class="form-check-label" for="standard_ec0128">
                                                                        EC0128
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0076" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0076" value="1" name="standard_ec0076" @click="verifyCheckbox('standard_ec0076')" :checked="!!instructor.standard_ec0076">
                                                                    <label class="form-check-label" for="standard_ec0076">
                                                                        EC0076
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="alineacion_217" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="alineacion_217" value="1" name="alineacion_217" @click="verifyCheckbox('alineacion_217')" :checked="!!instructor.alineacion_217">
                                                                    <label class="form-check-label" for="alineacion_217">
                                                                        EC0217.01
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0249" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0249" value="1" name="standard_ec0249" @click="verifyCheckbox('standard_ec0249')" :checked="!!instructor.standard_ec0249">
                                                                    <label class="form-check-label" for="standard_ec0249">
                                                                        EC0249
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="alineacion_301" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="alineacion_301" value="1" name="alineacion_301" @click="verifyCheckbox('alineacion_301')" :checked="!!instructor.alineacion_301">
                                                                    <label class="form-check-label" for="alineacion_301">
                                                                        EC0301
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0305" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0305" value="1" name="standard_ec0305" @click="verifyCheckbox('standard_ec0305')" :checked="!!instructor.standard_ec0305">
                                                                    <label class="form-check-label" for="standard_ec0305">
                                                                        EC0305
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0105" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0105" value="1" name="standard_ec0105" @click="verifyCheckbox('standard_ec0105')" :checked="!!instructor.standard_ec0105">
                                                                    <label class="form-check-label" for="standard_ec0105">
                                                                        EC0105
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0127" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0127" value="1" name="standard_ec0127" @click="verifyCheckbox('standard_ec0127')" :checked="!!instructor.standard_ec0127">
                                                                    <label class="form-check-label" for="standard_ec0127">
                                                                        EC0127
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0435" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0435" value="1" name="standard_ec0435" @click="verifyCheckbox('standard_ec0435')" :checked="!!instructor.standard_ec0435">
                                                                    <label class="form-check-label" for="standard_ec0435">
                                                                        EC0435
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-3 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="standard_ec0081" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="standard_ec0081" value="1" name="standard_ec0081" @click="verifyCheckbox('standard_ec0081')" :checked="!!instructor.standard_ec0081">
                                                                    <label class="form-check-label" for="standard_ec0081">
                                                                        EC0081
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xxl-6 mb-2">
                                                                <div class="form-group">
                                                                    <div class="d-flex">
                                                                        <label for="other_standard">Otros (estándares adicionales)</label>
                                                                    </div>
                                                                    <input type="text" name="other_standard" class="form-control" placeholder="Estándares adicionales" onkeypress="return soloLetras(event)" :value="instructor.other_standard">
                                                                    @error('other_standard')
                                                                        <div class="alert alert-borderless alert-danger" role="alert">
                                                                            <strong>{{$message}}</strong>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
    
                                        <!-- Documentación Administrativa -->
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header formStyle-cardHeader">
                                                    <button type="button" class="btn btn-link" @click="collapsedAdministrative">
                                                        <h4 class="card-title mb-0">Administrativa<i v-if="showCollapseAdministrative" class="ri-arrow-up-s-fill"></i>
                                                        <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                                    </button>
                                                </div><!-- end card header -->
                                                <div v-if="showCollapseAdministrative" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="row gy-4">
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_rfc" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_rfc" value="1" name="document_rfc" @click="verifyCheckbox('document_rfc')" :checked="!!instructor.document_rfc">
                                                                    <label class="form-check-label" for="document_rfc">
                                                                        Comprobante RFC
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_address" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_address" value="1" name="document_address" @click="verifyCheckbox('document_address')" :checked="!!instructor.document_rfc">
                                                                    <label class="form-check-label" for="document_address">
                                                                        Comprobante de domicilio
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_curp" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_curp" value="1" name="document_curp" @click="verifyCheckbox('document_curp')" :checked="!!instructor.document_curp">
                                                                    <label class="form-check-label" for="document_curp">
                                                                        Comprobante CURP
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_official_ine" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_official_ine" value="1" name="document_official_ine" @click="verifyCheckbox('document_official_ine')" :checked="!!instructor.document_official_ine">
                                                                    <label class="form-check-label" for="document_official_ine">
                                                                        Identificación oficial
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_certificate_medical" value="0">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="document_certificate_medical" name="document_certificate_medical" @click="verifyCheckbox('document_certificate_medical')" :checked="!!instructor.document_certificate_medical">
                                                                    <label class="form-check-label" for="document_certificate_medical">
                                                                        Certificado médico
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="document_bank_account" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="document_bank_account" value="1" name="document_bank_account" @click="verifyCheckbox('document_bank_account')" :checked="!!instructor.document_bank_account">
                                                                    <label class="form-check-label" for="document_bank_account">
                                                                        Cuenta bancaria
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="curriculum" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="curriculum" value="1" name="curriculum"  @click="verifyCheckbox('curriculum')" :checked="!!instructor.curriculum">
                                                                    <label class="form-check-label" for="curriculum">
                                                                        Currículum vitae institucional
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="account_status" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="account_status" value="1" name="account_status" @click="verifyCheckbox('account_status')" :checked="!!instructor.account_status">
                                                                    <label class="form-check-label" for="account_status">
                                                                        Estado de cuenta
                                                                    </label>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="curriculum_vitae" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="curriculum_vitae" value="1" name="curriculum_vitae" @click="verifyCheckbox('curriculum_vitae')" :checked="!!instructor.curriculum_vitae">
                                                                    <label class="form-check-label" for="curriculum_vitae">
                                                                        Currículum vitae
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-sm-4 col-md-6 col-lg-4 mb-2">
                                                                <div class="form-check">
                                                                    <input type="hidden" name="perfil_instructor" value="0">
                                                                    <input class="form-check-input" type="checkbox" id="perfil_instructor" value="1" name="perfil_instructor" @click="verifyCheckbox('perfil_instructor')" :checked="!!instructor.perfil_instructor">
                                                                    <label class="form-check-label" for="perfil_instructor">
                                                                        Perfil instructor
                                                                    </label>
                                                                </div>
                                                            </div> --}}
                                                        </div><!-- end row -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CAMPOS DE FORMACIÓN --}}
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header formStyle-cardHeader">
                                <button type="button" class="btn btn-link" @click="collapsedTrainingFields">
                                    <h4 class="card-title mb-0">Campos de formación profesional<i v-if="showCollapseTrainingFields" class="ri-arrow-up-s-fill"></i>
                                    <i v-else class="ri-arrow-down-s-fill"></i></h4>
                                </button>
                            </div><!-- end card header -->
                            <div v-if="showCollapseTrainingFields" class="collapse show">
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-sm-6 col-lg-3 mb-4" v-for="training_field in training_fields">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" :id="'training_field'+training_field.id" name="training_fields[]" :value="training_field.id" :checked="instructor.training_fields.find(item=>item.id==training_field.id)">
                                                <label class="form-check-label" :for="'training_field'+training_field.id">
                                                    @{{training_field.name}}
                                                </label>
                                            </div>
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
                        <a id="cancelar" href="{{ url('instructor') }}"></a>
                        @can('Editar instructores')
                            <button type="submit" class="btn btn-success">Guardar</button>
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
                        showCollapseBank: true,
                        showCollapseAddress: true,
                        showCollapse: true,
                        showCollapseDisabilities: true,
                        showCollapseVulnerable: true,
                        showCollapseDoc: true,
                        showCollapseAcademic: true,
                        showCollapseAdministrative: true,
                        showCollapseTrainingFields: true,
                        url:'{{ url("instructor") }}',
                        states: @json($states),
                        instructor: @json($instructor),
                        centers: @json($centers),
                        cities: @json($cities),
                        cities_respaldo: [],
                        banks: @json($banks),
                        state_id: '',
                        evaluador: 0,
                        evaluador_selected: false,
                        training_fields: @json($training_fields),
                    }
                },
                watch:{
                    state_id(newState, oldState){
                        if(newState !== oldState){
                            //se almacena en respaldo las ciudades que se actualizan
                            this.cities_respaldo = this.cities.filter(city => city.state_id === newState);
                            //buscamos si las ciudades actualizadas tienen la ciudad que tiene registrada el centro
                        }
                    },
                    evaluador(newEvaluador, oldEvaluador) {
                        if(newEvaluador==1) {
                            this.evaluador_selected = true;
                        } else {
                            this.evaluador_selected = false;
                            //document.getElementById("evaluator_code").value = "";
                        }
                    }
                },
                methods:{
                    collapsedBank(){
                        this.showCollapseBank = !this.showCollapseBank;
                    },  
                    collapsedPersonal(){
                        this.showCollapsePersonal = this.showCollapsePersonal ? false : true;
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
                    collapsedAcademic(){
                        this.showCollapseAcademic = this.showCollapseAcademic ? false : true;
                    },
                    collapsedAdministrative(){
                        this.showCollapseAdministrative = this.showCollapseAdministrative ? false : true;
                    },
                    collapsedTrainingFields(){
                        this.showCollapseTrainingFields = this.showCollapseTrainingFields ? false : true;
                    },  
                    verifyCheckbox(id){
                        document.getElementById(`${id}`).value = (document.getElementById(`${id}`).checked) ? '1' : '0';
                    },
                    avatarInput(){
                        document.getElementById("divAvatarInput").classList.add("was-validated");
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
                                result.classList.remove('alert-warning');
                                result.classList.add('alert-success');
    
                                try {
                                    const resp = await axios.get(`{{ route('instructors.curp.exists') }}`, {
                                        params: {
                                            curp: curp
                                        }
                                    });
                                    if(resp.data.data[0].exists==true&&resp.data.data[0].id!=null){
                                        Swal.fire({
                                            title: 'Ya existe un instructor con ese CURP, seras redireccionado a sus detalles.',
                                            icon: 'info',
                                            confirmButtonColor: '#0ab39c',
                                            confirmButtonText: 'Aceptar',
                                            allowOutsideClick: false,
                                        }).then((result) => {
                                            window.location = this.url+'/'+resp.data.data[0].id;
                                        })
                                    } else if(resp.data.data[0].exists==false&&resp.data.data[0].id==null){
                                        this.curpValidated = true;
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
                },
                mounted(){
                    this.state_id = this.instructor.address.city.state.id;
                    this.evaluador = this.instructor.evaluador;
                },
            }).mount('#app')
        </script>
    </x-slot>
    </x-guest-layout>