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
                                <li class="breadcrumb-item"><a href="/center">Lugares</a></li>
                                <li class="breadcrumb-item active">Lugares</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                {{--  WIDGET: TOTAL DE LUGARES --}}
                <div class="col-lg-4">
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
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white"> @{{ Object.keys(places).length }} </h4>
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
                {{-- NOTIFICACION DEL SISTEMA (EXITO/ERROR) --}}
                <div class="col-lg-12">
                    @if(session('error'))
                        <div class="alert alert-dismissible alert-danger fade show" role="alert">
                            <strong>Surgió un error al momento de intentar agregar el nuevo lugar.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>El proceso se realizó exitosamente, se ha agregado un nuevo lugar.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

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
                <button type="button" class="btn-close" @click="resetImportCode();reloadPage()" data-bs-dismiss="alert" aria-label="Close"></button>
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

            {{-- CONTENT --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="placeList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-5">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    @can('Agregar lugares')
                                        <button type="button" id="add" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalCenter" @click="add('')"><i class="ri-add-line align-bottom me-1"></i>Agregar</button>
                                    @endcan
                                    <a type="button" @click="resetFormExcel()" data-bs-toggle="modal" data-bs-target="#modalExcel" class="btn btn-primary ms-2"><i class="bx bx-import me-1"></i> Importar Excel</a> 
                                    <a type="button" href="{{ route('places.excel') }}" class="btn btn-primary ms-2"><i class="ri-download-fill align-bottom me-1"></i> Descargar Excel</a> 
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
                                            <th class="sort" data-sort="place_center">Centro</th>
                                            @if(auth()->user()->can('Editar lugares') || auth()->user()->can('Eliminar lugares'))
                                                <th class="sort" data-sort="actions">Acciones</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <tr v-for="place in places">
                                            <td class="col-lg-1"><div class="avatar d-flex justify-content-center">
                                                <img class="img-fluid" width="50" height="50"
                                                        :src="place.cover_path !== 'cover.jpg' ? assetAvatar(place.cover_path) : 'https://ui-avatars.com/api/?name='+place.name"
                                                        :alt="place.name">
                                                </div>
                                            </td>
                                            <td class="place_key">@{{ place.key }}</td>
                                            <td class="place_name">@{{ place.name }}</td>
                                            <td class="place_telephone_number">@{{ place.telephone_number }}</td>
                                            <td class="place_address">@{{ place.address.colonia }}</td>
                                            <td class="place_center">@{{ place.center.name }}</td>
                                            @if(auth()->user()->can('Editar lugares') || auth()->user()->can('Eliminar lugares'))
                                                <td class="col-lg-1">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item btn" id="detail" :href="'{{ url('place') }}/'+place.id">Detalles</a>
                                                                @can('Editar lugares')
                                                                    <a class="dropdown-item btn" id="edit" data-bs-toggle="modal" data-bs-target="#modalCenter" @click="edit(place.id)">Editar</a>
                                                                @endcan
                                                                @can('Eliminar lugares')
                                                                    <a class="dropdown-item btn" @click="destroy(place.id)">Eliminar</a>
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
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->

            <!-- Modal crear/editar centro -->
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-labelledby="modalCenter" aria-modal="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">@{{title_modal}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container-fluid">
                            <form class="flex flex-col w-full" :action="url" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div v-if="isEditing">
                                @method('PUT')
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" :value="place.id">
                            </div>
                                <!-- fila para cada grupo -->
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <div>
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del lugar" :value="place.name" maxlength="250" required>
                                            @error('name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                </div>

                                <!-- fila para cada grupo -->
                                <div class="row g-3 mb-3">
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="telephone_number" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" minlength="10" maxlength="10" onkeypress="return soloNumeros(event)" placeholder="Ingrese un número teléfonico" :value="place.telephone_number" maxlength="10" required>
                                            @error('telephone_number')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <!-- Pendiente recibir los centros para iterarlos -->
                                            <label for="center_id" class="form-label">Centro</label>
                                            <select class="form-select" id="center_id" name="center_id" :value="place.center_id" required>
                                                <option disabled value="" selected>Seleccione un centro</option>
                                                <option :value="center.id" v-for="center in centers">@{{ center.name }}</option>
                                            </select>
                                            @error('center_id')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="cover_path" class="form-label">Subir imagen del lugar</label>
                                            <input type="hidden" name="cover_path" value="cover.jpg">
                                            <input type="file" id="cover_path" name="cover_path" class="form-control" accept="image/*" data-max-size="1507459" filename="cover.jpg">
                                        </div>
                                    </div><!--end col-->
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12  my-3">
                                        <span class="modal-title ml-0" id="">Dirección</span>
                                    </div>
                                </div>
                                
                                <!-- fila para cada grupo -->
                                <div class="row mb-3">
                                    <div class="col-xxl-12">
                                        <div>
                                            <label for="calle" class="form-label">Calle</label>
                                            <input type="text" class="form-control" id="calle" name="calle" placeholder="Ingrese la calle"  :value="place.address.calle" maxlength="250" required> <!-- :value="place.address.calle" -->
                                            @error('calle')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <div>
                                            <label for="colonia" class="form-label">Colonia</label>
                                            <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Ingrese la colonia del centro"  :value="place.address.colonia" maxlength="250" required><!-- :value="place.address.colonia" -->
                                            @error('colonia')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- fila para cada grupo -->
                                <div class="row g-3 mb-3">
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" class="form-control text-uppercase" id="numero" name="numero" placeholder="Ingrese el número" onkeypress="return numeroDeCasa(event)" :value="place.address.numero" maxlength="5" required><!-- :value="place.address.numero" -->
                                            @error('numero')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="codigo_postal" class="form-label">Código postal</label>
                                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal" onkeypress="return soloNumeros(event)" :value="place.address.codigo_postal" minlength="5" maxlength="5" required> <!-- :value="place.address.codigo_postal" -->
                                            @error('codigo_postal')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <!--end col-->
                                </div>

                                <!-- fila para cada grupo -->
                                <div class="row g-3 mb-3">
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="state_id" class="form-label">Estado</label>
                                            <select class="form-select" id="state_id" name="state_id" :value="place.address.city.state_id" required>
                                                <option disabled value="" selected>Seleccione la ciudad</option>
                                                <option :value="state.id" v-for="state in state_respaldo">@{{state.name}}</option>
                                            </select>
                                            @error('state_id')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <!-- Pendiente recibir las ciudades para iterarlas -->
                                            <label for="city_id" class="form-label">Ciudad</label>
                                            <select class="form-select" name="city_id" :value="place.address.city_id" required>
                                                <option disabled value="" selected>Seleccione la ciudad</option>
                                                <option :value="city.id" v-for="city in cities_respaldo">@{{city.name}}</option>
                                            </select>
                                            @error('city_id')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="locality" class="form-label">Localidad</label>
                                            <input type="text" class="form-control" id="locality" name="locality" placeholder="Ingrese la localidad"  :value="place.locality" maxlength="250" required>
                                            @error('locality')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                            @if(auth()->user()->can('Agregar lugares') || auth()->user()->can('Editar lugares'))
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                            @endif
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
                            <form id="formExcel" action="{{ route('places.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="file-drop-area">
                                            <span class="fake-btn">Buscar excel</span>
                                            <span class="file-msg">o arrastra y suelta aqui el archivo</span>
                                            <input class="file-input" type="file" id="places" name="places" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
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
    <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script>

        const { createApp } = Vue

        createApp({
            data() {
                return {
                    url: "{{ url('place') }}",
                    isEditing: false,
                    places: @json($places),
                    centers: @json($centers),
                    cities: @json($cities),
                    states: @json($states),
                    title_modal: '',
                    place: {
                        id: '',
                        name: '',
                        telephone_number: '',
                        locality: '',
                        center_id: '',
                        address:{
                            calle: '',
                            numero: '',
                            colonia: '',
                            codigo_postal: '',
                            city_id: '',
                            city:{
                                id:'',
                                state_id: ''
                            }
                        }
                    },
                    state_id: '',
                    state_respaldo: [],
                    cities_respaldo: [],
                    respImport: [],
                    respImportCode: 0,
                    respImportMessage: [],
                    respImportErrors: [],
                    respImportRecords: [],
                }
            },
            created() {
                this.state_respaldo = this.states.filter(state => state.name === "Baja California Sur");
                this.cities_respaldo = this.cities.filter(city => city.state_id === 3);
            },
            methods:{
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
                resetFormPlaceOld(){
                    this.place = {
                        name: "{{old('name')}}",
                        telephone_number: "{{old('telephone_number')}}",
                        locality: "{{old('locality')}}",
                        center_id: "{{old('center_id')}}",
                        address:{
                            calle: "{{old('calle')}}",
                            numero: "{{old('numero')}}",
                            colonia: "{{old('colonia')}}",
                            codigo_postal: "{{old('codigo_postal')}}",
                            city_id: "",
                            city:{
                                state_id: parseInt("{{old('state_id')}}"),
                                id: parseInt("{{old('city_id')}}")
                            }
                        }
                    }
                },
                resetFormInBlank(){
                    this.place = {
                        id: '',
                        name: "",
                        telephone_number: "",
                        locality: "",
                        center_id: "",
                        address:{
                            calle: "",
                            numero: "",
                            colonia: "",
                            codigo_postal: "",
                            city_id: "",
                            city:{
                                state_id: "",
                                id: ""
                            }
                        }
                    }
                    this.state_id = 3
                },
                detail(){
                    Swal.fire({
                        title: "Sección en desarrollo.",
                        icon: "info",
                        customClass: {
                            icon: "no-before-icon",
                        },
                    });
                },
                edit(id){
                    this.resetFormInBlank();
                    this.title_modal = "Editar lugar";
                    this.url = "{{ url('place') }}"+"/"+id;
                    this.place = this.places.find(place => place.id === id);
                    this.isEditing = true;
                    this.cleanErrors("hide");
                    this.state_id = this.place.address.city.state_id;
                },
                add(display){
                    if(display === 'old'){
                        this.state_id = parseInt("{{old('state_id')}}") || "";
                        this.resetFormPlaceOld();
                    }else{
                        this.state_id = "";
                        this.resetFormInBlank();
                    }
                    this.title_modal = "Agregar lugar";
                    this.url = "{{ url('place') }}";
                    this.isEditing = false;
                    this.state_id = 3; //Asigna por defecto el estado con ID #3: "Baja California Sur".
                    this.cleanErrors("hide");
                },
                destroy(id){
                    this.url = "{{ url('place') }}";
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
                                    this.places = this.places.filter(place => place.id !== id);
                                })
                            })
                            .catch(error => {
                                Swal.fire("Error!","No encontramos lo que buscaba.","error")
                            })
                        }
                    })
                },
                assetAvatar(urlImg) {
                    const asset = "{{ asset('storage/place/covers') }}"
                    return asset + "/" + urlImg;
                },
                resetFormExcel() {
                    document.getElementById("formExcel").reset();
                    $('.file-input').val(''); 
                    $('.file-msg').text('o arrastra y suelta aqui el archivo');
                },
                async importExcel() {
                    if(document.querySelector("#places").value=="") {
                        alert("No puede quedar el campo vacío, añade un archivo .xml o .xlsx");
                    } else {
                        const excelFile = document.querySelector("#places");
                        const formData = new FormData();
                        formData.append("places", excelFile.files[0]);
                        axios.post(`{{ route('places.import') }}`, formData, {
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
                reloadPage() {
                    location.reload();
                }
            },
            mounted(){
               @if(count($errors) > 0)
                    if("{{old('_method')}}" === "PUT"){
                        document.getElementById('edit').click()
                        document.getElementById('edit').onclick = this.edit({{old('id')}});
                        this.cleanErrors("show");
                    }else{
                        document.getElementById('add').click()
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
        }).mount('#app')
    </script>
    </x-slot>

</x-guest-layout>
