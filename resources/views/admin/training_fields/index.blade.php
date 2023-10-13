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
                                <li class="breadcrumb-item"><a href="/center">Académico</a></li>
                                <li class="breadcrumb-item active">Campos de formación profesional</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                {{--  WIDGET: TOTAL DE CAMPOS DE FORMACIÓN --}}
                <div class="col-lg-4">
                    <!-- card -->
                    <div class="card card-animate bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-uppercase fw-medium text-white-50 mb-0">Total de campos de formación</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ Object.keys(training_fields).length }} </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-light rounded fs-3 shadow">
                                        <i class="ri-briefcase-4-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>

            <div class="row">
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

                {{-- CARD TABLE --}}
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="trainingList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-5">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-sm-7 d-flex justify-content-end">
                                        @can('Agregar campos de formación')
                                            <button type="button" id="add" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalAgregar" @click="add"><i class="ri-add-line align-bottom me-1"></i>Agregar</button>
                                        @endcan
                                        <a type="button" @click="resetFormExcel()" data-bs-toggle="modal" data-bs-target="#modalExcel" class="btn btn-primary ms-2"><i class="bx bx-import me-1"></i> Importar Excel</a> 
                                        <a type="button" href="{{ route('training-fiels.excel') }}" class="btn btn-primary ms-2"><i class="ri-download-fill align-bottom me-1"></i> Descargar Excel</a> 
                                    </div>
                                </div>
    
                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="trainingTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="training_key">Clave</th>
                                                <th class="sort" data-sort="training_name">Nombre</th>
                                                <th class="sort" data-sort="training_status">Estatus</th>
                                                <th class="sort" data-sort="training_type">Tipo</th>
                                                <th class="sort" data-sort="training_amount_courses">Cant. cursos</th>
                                                @if(auth()->user()->can('Editar campos de formación') || auth()->user()->can('Eliminar campos de formación'))
                                                    <th class="sort" data-sort="actions">Acciones</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="training_field in training_fields">
                                                <td class="training_key">@{{ training_field.key }}</td>
                                                <td class="training_name">@{{ training_field.name }}</td>
                                                <td class="training_status">@{{ training_field.status ? "Activo" : "Inactivo" }}</td>
                                                <td class="training_type">@{{ training_field.type }}</td>
                                                <td class="training_amount_courses"><span class="badge badge-soft-secondary">@{{ training_field.course_amount }} cursos</span></td>
                                                @if(auth()->user()->can('Editar campos de formación') || auth()->user()->can('Eliminar campos de formación'))
                                                    <td class="col-lg-1">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item btn" id="detail" :href="'{{ url('training-field') }}'+'/'+training_field.id">Detalles</a>
                                                                    @can('Editar campos de formación')
                                                                        <a class="dropdown-item btn" id="edit" data-bs-toggle="modal" data-bs-target="#modalAgregar" @click="edit(training_field.id)">Editar</a>
                                                                    @endcan
                                                                    @can('Eliminar campos de formación')
                                                                        <button class="dropdown-item btn" @click="destroy(training_field.id)">Eliminar</button>
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
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <!-- Modal editar campo -->
            <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalTitle">@{{ title_modal }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container-fluid">
                            <form :action="url" method="POST">
                                @csrf
                                <div v-if="isEditing">
                                    @method('PUT')
                                    <input type="hidden" name="_method"  value="PUT">
                                    <input type="hidden" name="id" id="id" :value="train_field.id">
                                </div>
                                <div class="row g-3">
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="key" class="form-label">Clave</label>
                                            <input type="text" class="form-control" id="key" name="key" placeholder="Ingrese la clave del campo" :value="train_field.key" required>
                                            @error('key')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el nombre del campo" :value="train_field.name" required>
                                            @error('name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="status" class="form-label">Estatus</label>
                                            <select class="form-select" name="status" :value="train_field.status" required>
                                                <option disabled value="" selected>Seleccione un estatus</option>
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                            @error('status')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="type" class="form-label">Tipo</label>
                                            <select class="form-select" name="type" :value="train_field.type" required>
                                                <option disabled value="" selected>Seleccione un tipo</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Federal">Federal</option>
                                            </select>
                                            @error('type')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
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

            {{-- MODAL IMPORT EXCEL --}}
            <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="modalExcelLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalTitle">Importar excel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formExcel" action="{{ route('training-fiels.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="file-drop-area">
                                            <span class="fake-btn">Buscar excel</span>
                                            <span class="file-msg">o arrastra y suelta aqui el archivo</span>
                                            <input class="file-input" type="file" id="training_fields_excel" name="training_fields" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <x-slot name="scripts">
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        {{-- <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script> --}}

        <script>
             const { createApp } = Vue
             createApp({
                 data() {
                     return {
                        title_modal: '',
                        url: "{{ url('training-field') }}",
                        training_fields: @json($trainingFields),
                        train_field: {
                            key: '',
                            name: '',
                            status: '',
                            type: ''
                        },
                        isEditing: false,
                        respImport: [],
                        respImportCode: 0,
                        respImportMessage: [],
                        respImportErrors: [],
                        respImportRecords: [],
                     }
                 },
                 methods:{
                    resetForm(){
                        this.train_field = {
                            key: '',
                            name: '',
                            status: '',
                            type: ''
                        }
                    },
                    add(){
                        this.title_modal = "Agregar campo de formación";
                        this.url = "{{ url('training-field') }}";
                        this.isEditing = false;
                        this.resetForm();
                        this.cleanErrors("hide");
                    },
                    edit(id){
                        this.title_modal = "Editar campo de formación";
                        this.train_field = this.training_fields.find(train => train.id === id);
                        this.url += "/"+id
                        this.isEditing = true;
                        this.cleanErrors("hide");
                    },
                    destroy(id){
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
                            axios.get(`{{ url('training-field/${id}/delete')}}`)
                                .then(response => {
                                    Swal.fire("Hecho", "Registro eliminado correctamente", "success")
                                    .then(value =>{
                                        this.training_fields = this.training_fields.filter(train => train.id !== id)
                                        //window.location = this.url
                                    })
                                })
                                .catch(error => {
                                    Swal.fire("Error!","No encontramos lo que buscaba.","error")
                                })
                            }
                        })
                    },
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
                   resetFormExcel() {
                        document.getElementById("formExcel").reset();
                        $('.file-input').val(''); 
                        $('.file-msg').text('o arrastra y suelta aqui el archivo');
                    },
                    async importExcel() {
                        if(document.querySelector("#training_fields_excel").value=="") {
                            alert("No puede quedar el campo vacío, añade un archivo .xml o .xlsx");
                        } else {
                            const excelFile = document.querySelector("#training_fields_excel");
                            const formData = new FormData();
                            formData.append("training_fields", excelFile.files[0]);
                            axios.post(`{{ route('training-fiels.import') }}`, formData, {
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
                    //Plugin datatables
                    @if(count($errors) > 0)
                        if("{{old('_method')}}" === "PUT"){
                            document.getElementById('edit').click();
                            document.getElementById('edit').onclick = this.edit({{old('id')}});
                            this.cleanErrors("show");
                        }else{
                            console.log("{{old('state_id')}}");
                            document.getElementById('add').click();
                            document.getElementById('add').onclick = this.add('old');
                            this.cleanErrors("show");
                        }
                    @endif

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
             }).mount('#app');
        </script>
    </x-slot>

</x-guest-layout>
