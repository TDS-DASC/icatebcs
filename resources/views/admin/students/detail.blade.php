<x-guest-layout>
    <x-slot name="head">
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
                                <li class="breadcrumb-item"><a href="/student">Capacitandos</a></li>
                                <li class="breadcrumb-item active">Detalle capacitando</li>
                            </ol></h4>
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
                                    @if($students->avatar_path !== 'cover.jpg')
                                        <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" :src="assetAvatar(students.avatar_path)" alt="Header Avatar">
                                    @else
                                        <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ 'https://ui-avatars.com/api/?name='.$students->name.' '.$students->first_name }}" alt="Header Avatar">
                                    @endif
                                </div>
                                
                                <h5 class="fs-16 mb-1">{{$students->name." ".$students->first_name." ".$students->last_name}}</h5>
                                <p class="text-muted mb-3">{{"No. Control: ".$students->no_control}}</p>

                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Pertenece al centro:</h6>
                                        <p class="text-muted">{{$students->center->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$students->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4 mb-3">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$students->updated_at ?? '-'}}</p>
                                    </div>
                                    <div>
                                        <h6>Editado por:</h6>
                                        <p class="text-muted">{{ $students->update_author->id ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <h6>Creado por:</h6>
                                        <p class="text-muted">{{ $student->create_author->name ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" href="{{ url('student/'.$students->id.'/edit') }}"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(students.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Datos personales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#addressDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Domicilio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#documentationDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Documentación
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#moreDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Más detalles
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user"></i> Historial de cursos
                                    </a>
                                </li> --}}
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- PERSONAL DETAILS --}}
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Nombre</h6>
                                                <p class="text-muted">{{$students->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Apellido paterno</h6>
                                                <p class="text-muted">{{$students->first_name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Apellido materno</h6>
                                                <p class="text-muted">{{$students->last_name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">CURP</h6>
                                                <p class="text-muted">{{$students->curp ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Fecha de nacimiento</h6>
                                                <p class="text-muted">{{$students->birthdate ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Sexo</h6>
                                                <p class="text-muted">{{$students->gender ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Correo</h6>
                                                <p class="text-muted">{{$students->email ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Celular</h6>
                                                <p class="text-muted">{{$students->phone_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Teléfono</h6>
                                                <p class="text-muted">{{$students->telephone_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Grado académico</h6>
                                                {{-- <p class="text-muted">{{$students->academic_level ?? '-'}}</p> --}}
                                                <p class="text-muted">
                                                    @switch($students->academic_level)
                                                        @case(1)
                                                            {{ "Primaria" }}
                                                            @break
                                                        @case(2)
                                                            {{ "Secundaria" }}
                                                            @break
                                                        @case(3)
                                                            {{ "Carrera Técnica" }}
                                                            @break
                                                        @case(4)
                                                            {{ "Bachillerato" }}
                                                            @break
                                                        @case(5)
                                                            {{ "Licenciatura/Ingenierías" }}
                                                            @break
                                                        @case(6)
                                                            {{ "Posgrado" }}
                                                            @break
                                                        @default
                                                            {{ $students->academic_level ?? '-' }}
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Grado adquirido</h6>
                                                <p class="text-muted">{{$students->acquired_grade ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado civil</h6>
                                                <p class="text-muted">{{$students->marital_status ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Condición laboral</h6>
                                                <p class="text-muted">{{$students->job_condition ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Lugar de nacimiento</h6>
                                                <p class="text-muted">{{$students->birth_place->name  ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- ADDRESS DETAILS --}}
                                <div class="tab-pane" id="addressDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Colonia</h6>
                                                <p class="text-muted">{{$students->address->colonia ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Calle</h6>
                                                <p class="text-muted">{{$students->address->calle ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número</h6>
                                                <p class="text-muted">{{$students->address->numero ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Código postal</h6>
                                                <p class="text-muted">{{$students->address->codigo_postal ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Ciudad</h6>
                                                <p class="text-muted">{{$students->address->city->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado</h6>
                                                <p class="text-muted">{{$students->address->city->state->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                {{-- DOCUMENTATION DETAILS --}}
                                <div class="tab-pane" id="documentationDetails" role="tabpanel">
                                    <div class="row">
                                        {{-- INE --}}
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">INE</h6>
                                                <p class="text-muted">@if($students->document_official_ine == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- PASSPORT --}}
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Pasaporte</h6>
                                                <p class="text-muted">@if($students->document_passport == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- CURP --}}
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">CURP</h6>
                                                <p class="text-muted">@if($students->document_curp == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- FMM2 o FMM3 --}}
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Forma Migratoria Múltiple (FMM2 o FMM3)</h6>
                                                <p class="text-muted">@if($students->document_fmm2_fmm3 == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- FMM2 o FMM3 --}}
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Carta Responsiva</h6>
                                                <p class="text-muted">@if($students->document_responsive_card == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- COMENTADO HASTA DEFINIR LOS DOCUMENTOS REQUERIDOS --}}
                                        {{-- <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Último grado de estudio </h6>
                                                <p class="text-muted">@if($students->document_study == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Acta de nacimiento</h6>
                                                <p class="text-muted">@if($students->document_birth == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comprobante de domicilio</h6>
                                                <p class="text-muted">@if($students->document_address == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Documento de CURP</h6>
                                                <p class="text-muted">@if($students->document_curp == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Entregó fotografía</h6>
                                                <p class="text-muted">@if($students->document_photos == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Identificación oficial</h6>
                                                <p class="text-muted">@if($students->document_official_ine == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Acredita como extranjero</h6>
                                                <p class="text-muted">@if($students->document_foreign == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col--> --}}
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
                                                <p class="text-muted">@if($students->disability_visual == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Motriz</h6>
                                                <p class="text-muted">@if($students->disability_motor == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Auditiva</h6>
                                                <p class="text-muted">@if($students->disability_hearing == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4"> 
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Intelectual</h6>
                                                <p class="text-muted">@if($students->disability_intellectual == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Comunicativa</h6>
                                                <p class="text-muted">@if($students->disability_communication == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
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
                                                <p class="text-muted">@if($students->group_adolescente == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Jefe(a) de familia</h6>
                                                <p class="text-muted">@if($students->group_jefamilia == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Grupos indígenas</h6>
                                                <p class="text-muted">@if($students->group_indigenas == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Cereso</h6>
                                                <p class="text-muted">@if($students->group_cereso == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Tercera edad</h6>
                                                <p class="text-muted">@if($students->group_terceraedad == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Migrantes</h6>
                                                <p class="text-muted">@if($students->group_migrantes == 1) {{ 'SI' }} @else {{ 'NO' }} @endif</p>
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


                    <table class="bg-white text-center m-auto col-12">
                        <tr style="border-bottom: 1px solid #F0EDED">
                            <td><b class="nav-link">Clave del grupo</b></td>
                            <td class="nav-link"><b>Estado</b></td>
                        </tr>
                        <tr>
                            @foreach ($students->groups as $group)
                                <td class="p-3 text-muted">{{$group->key}}</td>
                                <td class="p-3 text-muted">{{$group->pivot->status ?? 'Indefinido'}}</td>
                            @endforeach
                        </tr> 
                    </table>
                    <!-- End Page-content -->

                </div>
            </div>
            

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
                        students: @json($students),
                        arrayStudents: [],
                        url:'{{ url("student") }}',
                    }
                },
                methods:{
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
