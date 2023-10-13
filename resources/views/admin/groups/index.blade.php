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
                                <li class="breadcrumb-item active">Grupos</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
        
        <div class="row">
            {{-- WIDGET - TOTAL DE GRUPOS --}}
            <div class="col-lg-4">
                <!-- card -->
                <div class="card card-animate bg-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-white-50 mb-0">Total de grupos</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ Object.keys(groups).length }} </h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                    <i class="ri-group-2-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col widget -->
        
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
            <!-- end page title -->

            <div class="col-lg-12">
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
            </div>

            {{-- CARD TABLE --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="groupList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-5">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    @can('Agregar grupos')
                                        <a type="button" href="{{ url('group/create') }}" class="btn btn-success float-end"><i class="ri-add-line align-bottom me-1"></i> Agregar</a>
                                        <a type="button" @click="resetFormExcel()" data-bs-toggle="modal" data-bs-target="#modalExcel" class="btn btn-primary ms-2"><i class="bx bx-import me-1"></i> Importar Excel</a> 
                                    @endcan
                                    <a type="button" href="{{ route('groups.excel') }}" class="btn btn-primary ms-2"><i class="ri-download-fill align-bottom me-1"></i> Descargar Excel</a>
                                </div>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="groupTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="group_key">Clave</th>
                                            <th class="sort" data-sort="group_course">Curso</th>
                                            <th class="sort" data-sort="group_date_start">Fecha inicio</th>
                                            <th class="sort" data-sort="group_date_end">Fecha clausura</th>
                                            <th class="sort" data-sort="group_place">Lugar</th>
                                            <th class="sort" data-sort="group_instructor">Instructor</th>
                                            @if(auth()->user()->can('Editar grupos') || auth()->user()->can('Eliminar grupos'))
                                                <th class="sort" data-sort="actions">Acciones</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <tr v-for="group in groups">
                                            <td class="group_key">@{{ group.key }}</td>
                                            <td class="group_course">@{{ group.course.name }}</td>
                                            <td class="group_date_start">@{{ group.date_start.slice(0,10) }}</td>
                                            <td class="group_date_end">@{{ group.date_end.slice(0,10) }}</td>
                                            <td class="group_place">@{{ group.place.name }}</td>
                                            <td class="group_instructor">@{{ group.instructor.name }} @{{ group.instructor.first_name }} @{{ group.instructor.last_name }}</td>
                                            @if(auth()->user()->can('Editar grupos') || auth()->user()->can('Eliminar grupos'))
                                                <td class="col-1">
                                                    <div class="d-flex gap-2">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item btn" id="detail" :href="'{{ url('group') }}'+'/'+group.id">Detalles</a>
                                                                @can('Editar grupos')
                                                                    <a class="dropdown-item btn" :id="group.key" @click="editGroup(group.key, group.id)">Editar</a>
                                                                @endcan
                                                                @can('Eliminar grupos')
                                                                    <a class="dropdown-item btn" @click="destroy(group.id)">Eliminar</a>
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
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col-lg-12 -->
        </div>
        <!-- end row -->

        {{-- MODAL IMPORT EXCEL --}}
        <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="modalExcelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalTitle">Importar excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formExcel" action="{{ route('groups.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <div class="file-drop-area">
                                        <span class="fake-btn">Buscar excel</span>
                                        <span class="file-msg">o arrastra y suelta aqui el archivo</span>
                                        <input class="file-input" type="file" id="groups" name="groups" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="gap-2">
                                        <button type="button" @click="importExcel()" class="btn btn-success me-3">Aceptar</button>
                                        <button type="button" class="btn btn-light" id="btnCloseImport" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div><!--end col-->
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        <!--end modal--> 

    </div>
    <!-- End Page-content -->

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue

            createApp({
                data() {
                    return {
                        groups: @json($groups),
                        url:'{{ url("group") }}',
                        respImport: [],
                        respImportCode: 0,
                        respImportMessage: [],
                        respImportErrors: [],
                        respImportRecords: [],
                    }
                },
                methods:{
                    editGroup(key, id){
                        console.table(key, id);
                        document.getElementById(key).href = `{{ url('group/${id}/edit') }}`;
                        document.getElementById(key).click();
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
                                        this.groups = this.groups.filter(group => group.id !== id)
                                        //window.location = this.url
                                    })
                                })
                                .catch(error => {
                                    Swal.fire("Error!","No encontramos lo que buscaba.","error")
                                })
                            }
                        })
                    },
                    resetFormExcel() {
                        document.getElementById("formExcel").reset();
                        $('.file-input').val(''); 
                        $('.file-msg').text('o arrastra y suelta aqui el archivo');
                    },
                    async importExcel() {
                        if(document.querySelector("#groups").value=="") {
                            alert("No puede quedar el campo vacío, añade un archivo .xml o .xlsx");
                        } else {
                            const excelFile = document.querySelector("#groups");
                            const formData = new FormData();
                            formData.append("groups", excelFile.files[0]);
                            axios.post(`{{ route('groups.import') }}`, formData, {
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
                }
            }).mount('#app')
        </script>
        
    </x-slot>

</x-guest-layout>
