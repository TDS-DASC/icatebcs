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
                                <li class="breadcrumb-item"><a href="/place">Lugares</a></li>
                                <li class="breadcrumb-item active">Detalle Lugar</li>
                            </ol>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
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
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    @if($place->cover_path !== 'cover.jpg')
                                        <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ asset('storage/place/covers/'.$place->cover_path) }}" alt="Cover Place">
                                    @else
                                        <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ 'https://ui-avatars.com/api/?name='.$place->name }}" alt="Cover Place">
                                    @endif
                                </div>
                                
                                <h5 class="fs-16 mb-1">{{$place->name}}</h5>
                                <p class="text-muted mb-3">{{"Clave: ".$place->key}}</p>

                                <div class="row mb-4">
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Pertenece al centro:</h6>
                                        <p class="text-muted">{{$place->center->name ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Fecha de creación:</h6>
                                        <p class="text-muted">{{$place->created_at ?? '-'}}</p>
                                    </div>
                                    <div class="col-xxl-12 col-sm-4">
                                        <h6 class="mb-1">Última actualización:</h6>
                                        <p class="text-muted mb-0">{{$place->updated_at ?? '-'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a class="btn btn-soft-info buttonOptions" data-bs-toggle="modal" data-bs-target="#modalPlace"><i class="ri-pencil-line ri-xl me-1"></i>Editar</a>
                                    </div>
                                    <div class="col-sm-6 mb-2">
                                        <button class="btn btn-soft-danger buttonOptions" @click="destroy(place.id)"><i class="ri-delete-bin-2-line ri-xl me-1"></i>Eliminar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

                {{-- CARD MAIN CONTENT INFO --}}
                <div class="col-xxl-9">
                    {{-- PLACE INFO --}}
                    <div class="card">
                        {{-- TABS TITLE --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#placeDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Datos del lugar
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- PLACE DETAILS --}}
                                <div class="tab-pane active" id="placeDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Nombre</h6>
                                                <p class="text-muted">{{$place->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Centro</h6>
                                                <p class="text-muted">{{$place->center->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Teléfono</h6>
                                                <p class="text-muted">{{$place->telephone_number ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Calle</h6>
                                                <p class="text-muted">{{$place->address->calle ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Número</h6>
                                                <p class="text-muted">{{$place->address->numero ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Colonia</h6>
                                                <p class="text-muted">{{$place->address->colonia ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Código postal</h6>
                                                <p class="text-muted">{{$place->address->codigo_postal ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Ciudad</h6>
                                                <p class="text-muted">{{$place->address->city->name ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Localidad</h6>
                                                <p class="text-muted">{{$place->locality ?? '-'}}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="my-3">
                                                <h6 class="fs-14 mb-1">Estado</h6>
                                                <p class="text-muted">{{$place->address->city->state->name ?? '-'}}</p>
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

                    {{-- GROUPS --}}
                    <div class="card">
                        {{-- TABS TITLE --}}
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#groupsDetails" role="tab" aria-selected="true">
                                        <i class="fas fa-home"></i> Grupos
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {{-- TABS CONTENT --}}
                        <div class="card-body p-4">
                            <div class="tab-content">

                                {{-- GROUPS DETAILS --}}
                                <div class="tab-pane active" id="groupsDetails" role="tabpanel">
                                    <div id="placeGroupsList">
                                        <div class="row p-0">
                                            <div class="col-sm-8 d-flex align-items-center">
                                                <h5 class="m-0">Lista de grupos</h5>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="search-box">
                                                    <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="table-responsive table-card mt-3 mb-1">
                                            <table class="table align-middle table-nowrap" id="placeGroupsTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="sort" data-sort="group_key">Clave</th>
                                                        <th class="sort" data-sort="group_course">Curso</th>
                                                        <th class="sort" data-sort="group_date_start">Fecha inicio</th>
                                                        <th class="sort" data-sort="group_date_end">Fecha final</th>
                                                        <th class="sort" data-sort="actions">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    <tr v-for="group in place.groups">
                                                        <td class="group_key">@{{ group.key }}</td>
                                                        <td class="group_course">@{{ group.course.name }}</td>
                                                        <td class="group_date_start">@{{ group.date_start.slice(0, 10) }}</td>
                                                        <td class="group_date_end">@{{ group.date_end.slice(0, 10) }}</td>
                                                        <td class="actions d-flex justify-content-center align-items-center">
                                                            <a :href="'{{ url('group') }}'+'/'+group.id" class="btn btn-soft-success">
                                                                <i class="ri-eye-fill align-bottom me-2"></i>Consultar
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div v-if="(place.groups.length === 0)">
                                                <div class="alert alert-borderless shadow alert-info" role="alert">
                                                    <strong> Aviso: </strong> No hay ningún grupo que se imparta en este lugar.
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
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Page-content -->

            <!-- Modal crear/editar centro -->
            <div class="modal fade" id="modalPlace" tabindex="-1" aria-labelledby="modalPlace" aria-modal="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Editar datos del lugar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container-fluid">
                            <form class="flex flex-col w-full" :action="'{{ url('place') }}'+'/'+place.id" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" :value="place.id">

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
                                            <input type="text" class="form-control" id="calle" name="calle" placeholder="Ingrese la calle"  :value="place.address.calle" maxlength="250" required>
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
                                            <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Ingrese la colonia del centro"  :value="place.address.colonia" maxlength="250" required>
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
                                            <input type="text" class="form-control text-uppercase" id="numero" name="numero" placeholder="Ingrese el número" onkeypress="return numeroDeCasa(event)" :value="place.address.numero" maxlength="5" required>
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
                                                <option disabled value="" selected>Seleccione el estado</option>
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
                                            <label for="city_id" class="form-label">Ciudad</label>
                                            <select class="form-select" id="city_id" name="city_id" :value="place.address.city_id" required>
                                                <option disabled value="" selected>Seleccione la ciudad</option>
                                                <option :value="city.id" v-for="city in cities">@{{city.name}}</option>
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

        </div>
        <!-- end container fluid -->
    </div>


    <x-slot name="scripts">
        <script src="{{ asset('js/global.js') }}"></script>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        place: @json($place),
                        centers: @json($centers),
                        url:'{{ url("place") }}',
                        states: @json($states),
                        state_respaldo: [],
                        cities: [],
                        /* place_state: "",
                        place_city: "", */
                    }
                },
                created() {
                    this.state_respaldo = this.states.filter(state => state.name === "Baja California Sur");
                    //this.place_state = this.place.address.city.state_id;
                    //this.place_city = this.place.address.city.id;

                    //this.state_respaldo = this.states.filter(state => state.name === "Baja California Sur");
                    //this.cities = this.cities.filter(city => city.state_id === 3);
                    this.cities = this.states.filter(state => state.id === 3);
                    this.cities = this.cities[0].cities;
                },
                /* watch: {
                    place_state(newPlaceState, oldPlaceState) {
                        this.cities = this.states.filter(state => state.id === newPlaceState);
                        this.cities = this.cities[0].cities;
                        this.place_city = "";
                    }
                }, */
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
                },
                mounted(){
                }
            }).mount('#app')
        </script>
    </x-slot>
    </x-guest-layout>
