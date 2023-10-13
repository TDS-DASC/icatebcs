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
                                <li class="breadcrumb-item"><a href="/student">Centros</a></li>
                                <li class="breadcrumb-item active">Detalle centro</li>
                            </ol></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->



            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-2">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img 
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image" 
                                        :src="center.cover_path !== 'cover.jpg' ? 
                                            assetAvatar(center.cover_path)
                                            : 'https://ui-avatars.com/api/?name='+center.name"
                                        :alt="center.cover_path"
                                    >
                                </div>
                                <h5 class="fs-16 mb-1">@{{center.name}}</h5>
                                <p class="text-muted mb-0">@{{center.short_name}}</p>
                            </div>
                            <div class="row">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active">Datos del centro</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Tipo de centro</h6>
                                        <p class="text-muted mb-0">@{{center.center_type}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Teléfono</h6>
                                        <p class="text-muted mb-0">@{{center.telephone_number}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Director</h6>
                                        <p class="text-muted mb-0">@{{center.director_name}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Posición del director</h6>
                                        <p class="text-muted">@{{center.director_position}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active">Dirección</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Calle</h6>
                                        <p class="text-muted">@{{center.address.calle}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Número</h6>
                                        <p class="text-muted">@{{center.address.numero}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Colonia</h6>
                                        <p class="text-muted">@{{center.address.colonia}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-12 col-lg-3 col-sm-6">
                                    <div class="my-3">
                                        <h6 class="fs-14 mb-1">Código postal</h6>
                                        <p class="text-muted">@{{center.address.codigo_postal}}</p>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                 <!--end col-->
                
                {{-- COLUMN WIDGETS AND TABLES --}}
                <div class="col-xxl-9">
                    <div class="row">
                        {{--  WIDGETS --}}
                        <div class="col-sm-6">

                            <!-- card -->
                            <div class="card card-animate bg-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="text-uppercase fw-medium text-white-50 mb-0">Total de lugares</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ Object.keys(center.places).length }} </h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                                <i class="ri-map-pin-fill"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-sm-6">
                            <!-- card -->
                            <div class="card card-animate bg-primary">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="text-uppercase fw-medium text-white-50 mb-0">Total de estudiantes</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">@{{ Object.keys(students).length }}</h4>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                                <i class="bx bxs-user-account"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                    </div>

                    {{-- TABLES --}}
                    <div class="col-12">
                        <div class="card" id="cardDetailsCenter">
                            <div class="card-header pt-4 border-0">
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link fs-5">
                                            <h5 class="fs-4 mb-1">Lugares</h5>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body p-4 pt-2">
                                {{-- <x-table>
                                    <x-slot name="tools">
                                    </x-slot>
                                    <x-slot name="thead">
                                        <th>Foto</th>
                                        <th>Clave</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <!-- <th>Acciones</th> -->
                                    </x-slot>
                                    <x-slot name="tbody">
                                    <tr v-for="place in center.places">
                                        <td class="col-lg-1"><div class="d-flex justify-content-center">
                                            <img class="img-fluid" 
                                                width="50" 
                                                height="50"
                                                :src="place.cover_path !== 'cover.jpg' ? 
                                                    assetAvatar(place.cover_path) : 
                                                    'https://ui-avatars.com/api/?name='+place.name"
                                                :alt="place.name">
                                            </div>
                                        </td>
                                        <td>@{{ place.key }}</td>
                                        <td>@{{ place.name }}</td>
                                        <td>@{{ place.telephone_number }}</td>
                                        <td>@{{ place.address.colonia }}</td>
                                        <!-- <td class="col-lg-1">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-sm btn-success edit-item-btn" id="edit" data-bs-toggle="modal" data-bs-target="#modalCenter" @click="actionsPlaces">Editar</a>
                                                <button class="btn btn-sm btn-danger item-btn" @click="actionsPlaces">Eliminar</button>
                                            </div>
                                        </td> -->
                                    </tr>
                                    </x-slot>
                                </x-table> --}}
                                
                                {{-- PLACES TABLE --}}
                                <div id="placeList">
                                    <div class="row g-2 mb-3">
                                        <div class="d-flex justify-content-sm-between">
                                            <div class="search-box col-">
                                                <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                            @can('Agregar centros')
                                                {{-- <button type="button" id="add" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalCenter" @click="add('')"><i class="ri-add-line align-bottom me-1"></i>Agregar</button> --}}
                                            @endcan
                                        </div>
                                    </div>
        
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="placeTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="sort" data-sort="avatar">Foto</th>
                                                    <th class="sort" data-sort="place_key">Clave</th>
                                                    <th class="sort" data-sort="place_name">Nombre</th>
                                                    <th class="sort" data-sort="place_telephone_number">Teléfono</th>
                                                    <th class="sort" data-sort="place_address">Dirección</th>
                                                    {{-- <th class="sort" data-sort="actions">Acciones</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                <tr v-for="place in center.places">
                                                    <td class="col-lg-1"><div class="avatar d-flex justify-content-center">
                                                        <img class="img-fluid" 
                                                            width="50" 
                                                            height="50"
                                                            :src="place.cover_path !== 'cover.jpg' ? 
                                                                assetAvatar(place.cover_path) : 
                                                                'https://ui-avatars.com/api/?name='+place.name"
                                                            :alt="place.name">
                                                        </div>
                                                    </td>
                                                    <td class="place_key">@{{ place.key }}</td>
                                                    <td class="place_name">@{{ place.name }}</td>
                                                    <td class="place_telephone_number">@{{ place.telephone_number }}</td>
                                                    <td class="place_address">@{{ place.address.colonia }}</td>
                                                    
                                                    {{-- <td class="col-lg-1">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="btn btn-sm btn-success edit-item-btn" id="edit" data-bs-toggle="modal" data-bs-target="#modalCenter" @click="actionsPlaces">Editar</a>
                                                                    <button class="btn btn-sm btn-danger item-btn" @click="actionsPlaces">Eliminar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td> --}}
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
                        </div>
                    </div>
                    

                    {{-- STUDENTS TABLE --}}
                    <div class="card">
                        <div class="card-header pt-4 border-0">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link fs-5">
                                        <h5 class="fs-4 mb-1">Estudiantes</h5>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4 pt-2">
                            <div id="placeStudentsList">   
                                <div class="row g-2 mb-3"> 
                                    <div class="d-flex justify-content-sm-between">
                                        <div class="search-box col-">
                                            <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>                     
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="placeStudentsTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="avatar">Foto</th>
                                                <th class="sort" data-sort="placeStudent_noControl">No. Control</th>
                                                <th class="sort" data-sort="placeStudent_name">Nombre</th>
                                                <th class="sort" data-sort="placeStudent_firstName">Apellido Paterno</th>
                                                <th class="sort" data-sort="placeStudent_lastName">Apellido Materno</th>
                                                <th class="sort" data-sort="placeStudent_email">Correo</th>
                                                <th class="sort" data-sort="placeStudent_academicLevel">Nivel Académico</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="student in students">
                                                <td class="col-lg-1"><div class="avatar d-flex justify-content-center">
                                                    <img class="img-fluid" 
                                                        width="50" 
                                                        height="50"
                                                        :src="student.avatar_path !== 'cover.jpg' ? 
                                                            assetAvatar(student.avatar_path) : 
                                                            'https://ui-avatars.com/api/?name='+student.name"
                                                        :alt="student.name">
                                                    </div>
                                                </td>
                                                <td class="placeStudent_noControl">@{{ student.no_control }}</td>
                                                <td class="placeStudent_name">@{{ student.name }}</td>
                                                <td class="placeStudent_firstName">@{{ student.first_name }}</td>
                                                <td class="placeStudent_lastName">@{{ student.last_name }}</td>
                                                <td class="placeStudent_email">@{{ student.email }}</td>
                                                <td class="placeStudent_academicLevel">@{{ student.academic_level }}</td>
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
                    </div>


                </div>
            </div>
            <!-- End Page-content -->
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        center: @json($center),
                        students: @json($students),
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
                        const asset = "{{ asset('storage/center/covers') }}"
                        return asset + "/" + urlImg;
                    },
                    
                },
                mounted(){
                   // Plugin datatables
        
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
