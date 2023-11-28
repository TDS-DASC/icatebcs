<x-guest-layout>
    <x-slot name="head">
        <link rel="stylesheet" href="{{ asset('libs/sweetalert2.min.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('libs/dataTables/datatables.min.css') }}"/> --}}
    </x-slot>

    <div class="page-content" v-cloak>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/student">Instructores</a></li>
                                <li class="breadcrumb-item active">Detalle instructor</li>
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
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    {{-- <img src="{{asset('images/ICATEBCS_logo.png')}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"> --}}
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" 
                                        @if( $instructor->avatar_path !== 'cover.jpg') src="{{ asset('storage/user/covers') }}/{{ $instructor->avatar_path }}" @else src="https://ui-avatars.com/api/?name={{ $instructor->name.' '.$instructor->first_name }}" @endif
                                    alt="Header Avatar">
                                </div>
                                <h5 class="fs-16 mb-1">{{$instructor->name." ".$instructor->first_name." ".$instructor->last_name}}</h5>
                                <p class="text-muted mb-3">{{"Clave: ".$instructor->key}}</p>

                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Pertenece al centro:</h6>
                                        <p class="text-muted">{{$instructor->center->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$instructor->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$instructor->updated_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4 mt-3">
                                        <h6>Editado por</h6>
                                        <p class="text-muted mb-0">{{ $instructor->update_author->name ?? '-' }}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4 mt-3">
                                        <h6>Creado por</h6>
                                        <p class="text-muted mb-0">{{ $instructor->create_author->name ?? '-'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-6 col-md-4 col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" href="{{ url('instructor/'.$instructor->id.'/edit') }}"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-xl-6 col-md-4 col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(instructor.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
                                    </div>
                                    <div class="col-xl-12 col-md-4 col-sm-12 mb-2">
                                        <form action="{{ route('instructors.pdf') }}" method="GET">
                                            <input type="text" name="id" value=" {{$instructor->id}} " hidden>
                                            <button type="submit" class="btn btn-soft-success buttonOptions"><i class="ri-printer-fill ri-xl me-1"></i>Descargar PDF</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end card-->
                    
                    <!--end card-->
                </div>
                <!--end col-->

                {{-- CARD MAIN CONTENT INFO --}}
                <div class="col-xxl-9">
                    <div class="card">
                        {{-- TABS TITLE --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Datos del instructor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#addressDetails" role="tab">
                                        <i class="far fa-user"></i> Domicilio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#bankData" role="tab">
                                        <i class="far fa-user"></i> Datos bancarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#documentationData" role="tab">
                                        <i class="far fa-user"></i> Documentación
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#moreDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Más detalles
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- PERSONAL DETAILS --}}
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">CURP</h6>
                                                <p class="text-muted">{{$instructor->curp ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">RFC</h6>
                                                <p class="text-muted">{{$instructor->rfc ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Cumpleaños</h6>
                                                <p class="text-muted">{{$instructor->birthdate ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Ciudad de origen</h6>
                                                <p class="text-muted">{{$instructor->birth_place ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado civil</h6>
                                                <p class="text-muted">{{$instructor->marital_status ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Correo electrónico</h6>
                                                <p class="text-muted">{{$instructor->email ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número telefónico</h6>
                                                <p class="text-muted">{{$instructor->telephone_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número de celular</h6>
                                                <p class="text-muted">{{$instructor->phone_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Fecha de admisión</h6>
                                                <p class="text-muted">{{$instructor->admission_date ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Fecha de suspensión</h6>
                                                <p class="text-muted">{{$instructor->suspension_date ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Centro</h6>
                                                <p class="text-muted">{{$instructor->center->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Último grado concluido</h6>
                                                <p class="text-muted">
                                                    @switch($instructor->last_grade)
                                                        @case(1)
                                                            {{ "PREESCOLAR" }}
                                                            @break
                                                        @case(2)
                                                            {{ "PRIMARIA" }}
                                                            @break
                                                        @case(3)
                                                            {{ "SECUNDARIA" }}
                                                            @break
                                                        @case(4)
                                                            {{ "PREPARATORIA / BACHILLERATO" }}
                                                            @break
                                                        @case(5)
                                                            {{ "LICENCIATURA / INGENIERÍA" }}
                                                            @break
                                                        @case(6)
                                                            {{ "MAESTRÍA / DOCTORADO" }}
                                                            @break
                                                        @default
                                                            {{ "-" }}
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Grado adquirido</h6>
                                                <p class="text-muted">{{ $instructor->acquired_grade ? $instructor->acquired_grade : "-" }}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- COMENTADO POR SI NO SE REQUIERE EN TABLA --}}
                                        {{-- <div class="col-lg-3 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Campos de formación profesional</h6>
                                                <ul class="ps-4" v-if="instructor.training_fields.length>0">
                                                    <li v-for="training_field in instructor.training_fields" class="text-muted">
                                                        @{{training_field.name}}
                                                    </li>
                                                </ul>
                                                <p v-else class="text-muted">Sin asignar</p>
                                            </div>
                                        </div>
                                        <!--end col--> --}}
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- ADDRESS DETAILS --}}
                                <div class="tab-pane" id="addressDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Colonia</h6>
                                                <p class="text-muted">{{$instructor->address->colonia ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Calle</h6>
                                                <p class="text-muted">{{$instructor->address->calle ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número</h6>
                                                <p class="text-muted">{{$instructor->address->numero ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Código postal</h6>
                                                <p class="text-muted">{{$instructor->address->codigo_postal ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Ciudad</h6>
                                                <p class="text-muted">{{$instructor->address->city->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado</h6>
                                                <p class="text-muted">{{$instructor->address->city->state->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- BANK DATA --}}
                                <div class="tab-pane" id="bankData" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Banco</h6>
                                                <p class="text-muted">{{$instructor->bank->marca ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Cuenta bancaria</h6>
                                                <p class="text-muted">{{$instructor->bank_account ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">CLABE</h6>
                                                <p class="text-muted">{{$instructor->interbank_key ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número de tarjeta</h6>
                                                <p class="text-muted">{{$instructor->card_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- DOCUMENTATION DATA --}}
                                <div class="tab-pane" id="documentationData" role="tabpanel">
                                    {{-- ADMINISTRATIVA --}}
                                    <div class="row">
                                        <h5>Administrativa</h5>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comprobante CURP</h6>
                                                <p class="text-muted">{{$instructor->document_curp ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Certificado médico</h6>
                                                <p class="text-muted">{{$instructor->document_certificate_medical ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comprobante RFC</h6>
                                                <p class="text-muted">{{$instructor->document_rfc ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comprobante de domicilio</h6>
                                                <p class="text-muted">{{$instructor->document_curp ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->                                
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Identificación oficial</h6>
                                                <p class="text-muted">{{$instructor->own_certifications ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Currículum vitae institucional</h6>
                                                <p class="text-muted">{{$instructor->curriculum ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Perfil instructor</h6>
                                                <p class="text-muted">{{$instructor->perfil_instructor ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col--> --}}
                                        {{-- <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado de cuenta</h6>
                                                <p class="text-muted">{{$instructor->account_status ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col--> --}}
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Currículum vitae</h6>
                                                <p class="text-muted">{{$instructor->curriculum_vitae ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <hr>
                                    {{-- ACADÉMICA --}}
                                    <div class="row mt-4">
                                        <h5 class="mb-4">Académica</h5>
                                        {{-- EVALUADOR Y NÚMERO --}}
                                        <h5 class="d-flex align-items-center" style="font-size: 14px;">
                                            <i class="ri-user-2-fill me-1" style="font-size: 20px;"></i>Información de evaluador
                                        </h5>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Evaluador</h6>
                                                <p class="text-muted">
                                                    @if( $instructor->evaluador == '1') {{ "Si" }} @else {{ "No" }} @endif
                                                </p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6" v-if="instructor.evaluador==1">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número de evaluador</h6>
                                                <p class="text-muted">
                                                    {{$instructor->evaluator_code ?? '-'}}
                                                </p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- COMPROBANTES Y CERTIFICACIONES --}}
                                        <h5 class="d-flex align-items-center mt-4" style="font-size: 14px;">
                                            <i class="ri-survey-fill me-1" style="font-size: 20px;"></i>Comprobantes y certificaciones
                                        </h5>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comprobante de estudios</h6>
                                                <p class="text-muted">{{$instructor->document_study ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Certificaciones propias</h6>
                                                <p class="text-muted">{{$instructor->document_curp ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- CERTIFICADOS VIGENTES (EC0217.01 y/o EC0301) //COMENTADO HASTA DEFINIR SI ES REQUERIDO --}}
                                        {{-- <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Certificados vigentes (EC0217.01 y/o EC0301)</h6>
                                                <p class="text-muted">{{$instructor->document_curp ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col--> --}}
                                        {{-- ESTÁNDARES --}}
                                        <h5 class="d-flex align-items-center mt-4" style="font-size: 14px;">
                                            <i class="ri-bookmark-3-fill me-1" style="font-size: 20px;"></i>Estándares
                                        </h5>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0038</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0038 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0128</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0128 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0076</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0076 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0217.01</h6>
                                                <p class="text-muted">{{$instructor->alineacion_217 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0249</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0249 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0301</h6>
                                                <p class="text-muted">{{$instructor->alineacion_301 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0305</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0305 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0105</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0105 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0127</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0127 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0435</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0435 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">EC0081</h6>
                                                <p class="text-muted">{{$instructor->standard_ec0081 ? "SI" : "NO"}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Otros</h6>
                                                <p class="text-muted">{{$instructor->other_standard ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- MORE DETAILS --}}
                                <div class="tab-pane" id="moreDetails" role="tabpanel">
                                    {{-- DISCPACIDAD --}}
                                    <div class="row">
                                        <h5>Discapacidad</h5>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Visual</h6>
                                                <p class="text-muted">@if($instructor->disability_visual == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Motriz</h6>
                                                <p class="text-muted">@if($instructor->disability_motor == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Auditiva</h6>
                                                <p class="text-muted">@if($instructor->disability_hearing == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Intelectual</h6>
                                                <p class="text-muted">@if($instructor->disability_intellectual == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comunicativa</h6>
                                                <p class="text-muted">@if($instructor->disability_communication == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    <hr>
                                    {{-- GRUPOS VULNERABLES --}}
                                    <div class="row mt-4">
                                        <h5>Grupos vulnerables</h5>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Adolescente</h6>
                                                <p class="text-muted">@if($instructor->group_adolescente == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Jefe(a) de familia</h6>
                                                <p class="text-muted">@if($instructor->group_jefamilia == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Grupos indígenas</h6>
                                                <p class="text-muted">@if($instructor->group_indigenas == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Cereso</h6>
                                                <p class="text-muted">@if($instructor->group_cereso == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tercera edad</h6>
                                                <p class="text-muted">@if($instructor->group_terceraedad == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Migrantes</h6>
                                                <p class="text-muted">@if($instructor->group_migrantes == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                            </div>
                        </div>
                    </div>

                    {{-- CARD COURSES --}}
                    <div class="card">
                        <div class="card-body p-4">
                            {{-- COURSES --}}
                            <div id="instructorCoursesList">
                                <div class="row p-0">
                                    <div class="col-sm-4 d-flex align-items-center">
                                        <h5 class="m-0">Cursos</h5>
                                    </div>
                                    <div class="col-sm-8 d-flex justify-content-end">
                                        <form action="{{ route('instructors.history') }}" method="GET">
                                            <input type="text" name="id" value=" {{$instructor->id}} " hidden>
                                            <button type="submit" class="btn btn-primary d-flex align-items-center me-2"><i class="ri-printer-fill ri-xl me-2"></i> Descargar Historial</button>
                                        </form>
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Buscar un curso">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="instructorCoursesTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="instructor_course_key">Clave</th>
                                                <th class="sort" data-sort="instructor_course_name">Nombre</th>
                                                <th class="sort" data-sort="instructor_course_type">Tipo de curso</th>
                                                <th class="sort" data-sort="instructor_course_modality">Modalidad</th>
                                                <th class="sort" data-sort="actions">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="course in instructor.courses">
                                                <td class="instructor_course_key">@{{ course.key }}</td>
                                                <td class="instructor_course_name">@{{ course.name }}</td>
                                                <td class="instructor_course_type">@{{ course.type_course }}</td>
                                                <td class="instructor_course_modality">@{{ course.modality_course }}</td>
                                                <td class="actions d-flex justify-content-center align-items-center">
                                                    <a :href="'{{ url('course') }}'+'/'+course.id" class="btn btn-soft-secondary">
                                                        <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div v-if="(instructor.courses.length === 0)">
                                        <div class="alert alert-borderless shadow alert-info" role="alert">
                                            <strong> Aviso: </strong> El instructor no imparte ningún curso.
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
                            </div><!-- end courses -->
                        </div><!-- end card body -->
                    </div><!-- end card courses -->

                    {{-- CARD GROUPS --}}
                    <div class="card">
                        <div class="card-body p-4">
                            {{-- GROUPS --}}
                            <div id="instructorGroupsList">
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
                                    <table class="table align-middle table-nowrap" id="instructorGroupsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="instructor_group_key">Clave</th>
                                                <th class="sort" data-sort="instructor_group_name">Curso</th>
                                                <th class="sort" data-sort="instructor_group_place">Lugar</th>
                                                <th class="sort" data-sort="instructor_group_date_start">Fecha inicio</th>
                                                <th class="sort" data-sort="instructor_group_date_end">Fecha final</th>
                                                <th class="sort" data-sort="actions">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="group in instructor.groups">
                                                <td class="instructor_group_key">@{{ group.key }}</td>
                                                <td class="instructor_group_name">@{{ group.course.name }}</td>
                                                <td class="instructor_group_place">@{{ group.place.name }}</td>
                                                <td class="instructor_group_date_start">@{{ group.date_start.slice(0, 10) }}</td>
                                                <td class="instructor_group_date_end">@{{ group.date_end.slice(0, 10) }}</td>
                                                <td class="actions d-flex justify-content-center align-items-center">
                                                    <a :href="'{{ url('group') }}'+'/'+group.id" class="btn btn-soft-success">
                                                        <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div v-if="(instructor.groups.length === 0)">
                                        <div class="alert alert-borderless shadow alert-info" role="alert">
                                            <strong> Aviso: </strong> El instructor no tiene ningún grupo.
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
                            </div><!-- end groups -->
                        </div><!-- end card body -->
                    </div><!-- end card groups -->

                    {{-- CARD TRAINING FIELDS --}}
                    <div class="card">
                        <div class="card-body p-4">
                            {{-- TRAINING FIELDS --}}
                            <div id="instructorTrainingFieldList">
                                <div class="row p-0">
                                    <div class="col-sm-8 d-flex align-items-center">
                                        <h5 class="m-0">Campos de formación profesional</h5>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Buscar un campo de formación">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="instructorTrainingFieldsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="instructor_training_field_key">Clave</th>
                                                <th class="sort" data-sort="instructor_training_field_name">Nombre</th>
                                                <th class="sort" data-sort="instructor_training_field_status">Estatus</th>
                                                <th class="sort" data-sort="actions">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="training_field in instructor.training_fields">
                                                <td class="instructor_training_field_key">@{{ training_field.key }}</td>
                                                <td class="instructor_training_field_name">@{{ training_field.name }}</td>
                                                <td class="instructor_training_field_status">@{{ training_field.status ? "Activo" : "Inactivo" }}</td>
                                                <td class="actions d-flex justify-content-center align-items-center">
                                                    <a :href="'{{ url('training-field') }}'+'/'+training_field.id" class="btn btn-soft-secondary">
                                                        <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div v-if="(instructor.training_fields.length === 0)">
                                        <div class="alert alert-borderless shadow alert-info" role="alert">
                                            <strong> Aviso: </strong> El instructor no tiene ningún campo de formación asignado.
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
                            </div><!-- end groups -->
                        </div><!-- end card body -->
                    </div><!-- end card groups -->

                </div>
                <!-- end col -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
        {{-- <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script> --}}
        <script>

            const { createApp } = Vue

            createApp({
                data() {
                    return {
                        instructor: @JSON($instructor),
                        url:'{{ url("instructor") }}',
                    }
                },
                methods:{
                    editStudent(no_control,id){
                        document.getElementById(no_control).href = `{{ url('student/${id}/edit') }}`;
                        document.getElementById(no_control).click();
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
                    assetAvatar(urlImg) {
                        const asset = "{{ asset('storage/student/covers') }}"
                        return asset + "/" + urlImg;
                    },
                },
                mounted(){
                }
            }).mount('#app')
        </script>
    </x-slot>
</x-guest-layout>
