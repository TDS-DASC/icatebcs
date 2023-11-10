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
                                    <li class="breadcrumb-item"><a href="/center">Centros</a></li>
                                    <li class="breadcrumb-item active">Centros</li>
                                </ol>
                            </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <!-- start card header -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col">
                                    <h4 class="card-title float-start">Centros</h4>
                                    @can('Agregar centros')
                                        <button type="button" id="add" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalCentro" @click="createCenter('')"><i class="ri-add-line align-bottom me-1"></i> Agregar</button>
                                    @endcan
                                </div>
                            </div><!-- end card header -->
                        </div>
                    </div>
                    <!-- end card header -->

                    <!-- start content -->
                    <div class="col-xxl-3 col-lg-6 mb-4" v-for="(center, index) in centers">
                        <div class="card h-100" style="">
                            <div v-if="center.cover_path !== 'cover.jpg'">
                                <img class="img-fluid" style="width: 100%; height: 20rem; object-fit: contain;"
                                    :src="assetAvatar(center.cover_path)"
                                    :alt="center.cover_path"
                                >
                            </div>
                            <div v-else>
                                <img class="img-fluid" style="width: 100%; height: 20rem; object-fit: cover;"
                                    :src="'https://ui-avatars.com/api/?name='+center.name"
                                    :alt="center.name"
                                >
                            </div>
                            <div class="card-body pt-3">
                                {{-- OPCIONES DE BOTONES --}}
                                <div class="col team-settings">
                                    <div class="row">         
                                        <div class="col text-end dropdown dropdownTopCard">
                                            <button class="btn btn-sm btn-light dropdown btnOptionsDropdownTopCard" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill ri-xl align-middle"></i>
                                            </button>              
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li><a class="dropdown-item cursorPointer" :href="'{{ url('center') }}'+'/'+center.id"><i class="ri-eye-line me-2 align-bottom text-muted"></i>Detalles</a></li>
                                                @can('Editar centros')
                                                    <li><a class="dropdown-item cursorPointer" id="edit" data-bs-toggle="modal" data-bs-target="#modalCentro" @click="editCenter(center.id)"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Editar</a></li>
                                                @endcan
                                                @can('Eliminar centros')
                                                    <li><a class="dropdown-item cursorPointer" @click="destroyCenter(center.id)"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Eliminar</a></li>
                                                @endcan
                                            </ul>                                
                                        </div>
                                    </div>                              
                                </div>          
                                {{-- INFORMACIÓN DEL CENTRO --}} 
                                <div class="text-start">
                                    <a :href="'{{ url('center') }}'+'/'+center.id"><h4 class="card-title mb-1" style="color: #495057"><strong>@{{center.name}}</strong></h4></a>
                                </div>
                                <div class="text-start">
                                    <h4 class="card-title mb-2 text-muted">@{{center.center_type}}</h4>
                                </div>
                                <div class="d-flex gap-1 mb-1">
                                    <i class="ri-government-fill"></i>Direción: @{{center.address.colonia}}, @{{center.address.calle}}, @{{center.address.codigo_postal}} @{{center.address.city.name}}, @{{center.address.city.state.name}}
                                </div>
                                <div class="d-flex gap-1 mb-1">
                                    <i class="ri-phone-fill"></i>Teléfono: @{{center.telephone_number}}
                                </div>
                                <div class="d-flex gap-2 mb-1">
                                    <i class="ri-user-2-fill"></i>Director: @{{center.director_name}}
                                </div>
                                <div class="d-flex gap-2 mb-1">
                                <i class="ri-user-2-fill"></i>Posición del director:<p class="text-muted mb-0">@{{center.director_position}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end content -->
            </div>

            <!-- Modal crear/editar centro -->
            <div class="modal fade" id="modalCentro" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalTitle">@{{title_modal}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container-fluid">

                            <form class="flex flex-col w-full" :action="url" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div v-if="isEditing">
                                    @method('PUT')
                                    <input type="hidden" name="_method"  value="PUT">
                                    <input type="hidden" name="id" id="id" :value="center.id">
                                </div>
                               <div v-else><input type="hidden" name="_method" value="POST"></div>
                                <div class="row g-3">
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del centro" onkeypress="return letrasYNumeros(event)" :value="center.name" maxlength="100" required>
                                                @error('name')
                                                    <div class="alert alert-borderless alert-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </div>
                                                @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="short_name" class="form-label">Nombre corto</label>
                                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Ingrese un nombre corto" onkeypress="return letrasYNumeros(event)" :value="center.short_name" maxlength="100" required>
                                            @error('short_name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <label class="form-label">Tipo de centro</label>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="center_type" id="accionMovil" value="Accion movil" v-model="center.center_type" required>
                                                <label class="form-check-label" for="accionMovil"><p>Acción móvil</p></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="center_type" id="unidadCapacitacion" value="Unidad de Capacitacion" v-model="center.center_type" required>
                                                <label class="form-check-label" for="unidadCapacitacion">Unidad de capacitación</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="center_type" id="direccionGeneral" value="Direccion General" v-model="center.center_type" required>
                                                <label class="form-check-label" for="direccionGeneral">Dirección general</label>
                                            </div>
                                        </div>
                                        @error('center_type')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div><!--end col-->
                                    <div class="col-xxl-12">
                                        <div>
                                            <label for="director_name" class="form-label">Nombre del Director(a) General</label>
                                            <input type="text" class="form-control" id="director_name" name="director_name" placeholder="Ingrese el nombre del director" onkeypress="return soloLetras(event)" :value="center.director_name" maxlength="100" required>
                                            @error('director_name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="director_position" class="form-label">Posición del director</label>
                                            <select name="" id="" style="display: block">
                                                <option value="">Director(a)</option>
                                                <option value="">Encargado(a)</option>
                                            </select>
                                            {{-- <input type="text" class="form-control" id="director_position" name="director_position" placeholder="Ingrese la posición del director" onkeypress="return letrasYNumeros(event)" :value="center.director_position" maxlength="100" required> --}}
                                            @error('director_position')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="telephone_number" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="telephone_number" name="telephone_number" placeholder="Ingrese un número teléfonico" onkeypress="return soloNumeros(event)" :value="center.telephone_number" minlength="10" maxlength="10" required>
                                            @error('telephone_number')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div>
                                            <label for="cover_path" class="form-label">Subir imagen del centro</label>
                                            <input type="hidden" name="cover_path" value="cover.jpg">
                                            <input type="file" id="cover_path" name="cover_path" class="form-control" accept="image/*" data-max-size="1507459" filename="cover.jpg">
                                        </div>
                                    </div><!--end col-->
                                    <div class="">
                                        <h5 class="modal-title ml-0" id="">Dirección</h5>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div>
                                            <label for="calle" class="form-label">Calle</label>
                                            <input type="text" class="form-control" id="calle" name="calle" placeholder="Ingrese la calle" :value="center.address.calle" maxlength="250" required>
                                            @error('calle')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" class="form-control text-uppercase" id="numero" name="numero" placeholder="Ingrese el número" onkeypress="return letrasYNumeros(event)" :value="center.address.numero" maxlength="10" required>
                                            @error('numero')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-6">
                                        <div>
                                            <label for="colonia" class="form-label">Colonia</label>
                                            <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Ingrese la colonia" onkeypress="return letrasYNumeros(event)" :value="center.address.colonia" maxlength="100" required>
                                            @error('colonia')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-4">
                                        <div>
                                            <label for="codigo_postal" class="form-label">Código postal</label>
                                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="Ingrese el código postal" onkeypress="return soloNumeros(event)" :value="center.address.codigo_postal" maxlength="5" required>
                                            @error('codigo_postal')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-xxl-4">
                                        <div>
                                            <label for="state_id" class="form-label">Estado</label>
                                            <select class="form-select" name="state_id" :value="state_id" required>
                                                <option disabled value="" selected>Seleccione el estado</option>
                                                <option v-for="state in states" :value="state.id">@{{state.name}}</option>
                                            </select>
                                        </div>
                                        @error('state_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div><!--end col-->
                                    <div class="col-xxl-4">
                                        <div>
                                            <label for="city_id" class="form-label">Ciudad</label>
                                            <select class="form-select" name="city_id" :value="center.address.city_id" required>
                                                <option disabled value="" selected>Seleccione la ciudad</option>
                                                <option v-for="city in cities" :value="city.id">@{{city.name}}</option>
                                            </select>
                                        </div>
                                        @error('city_id')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="gap-2">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                            @if(auth()->user()->can('Agregar centros') || auth()->user()->can('Editar centros'))
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

        </div><!-- end page-content -->

        <x-slot name="scripts">
            <script src="{{ asset('js/global.js') }}"></script>
            <script>

                 const { createApp } = Vue
            createApp({
                data() {
                    return {
                        states: @json($states),
                        cities: @json($cities),
                        centers: @json($centers),
                        title_modal: '',
                        isEditing: false,
                        center: {
                            name: '',
                            short_name: '',
                            center_type: '',
                            director_name: '',
                            director_position: '',
                            telephone_number: '',
                            address:{
                                calle: '',
                                numero: '',
                                colonia: '',
                                codigo_postal: '',
                                city:{
                                    state_id: ''
                                },
                                city_id: '',
                            }
                        },
                        url: "{{ url('center') }}",
                        state_id: '',
                        cities_respaldo: [],
                    }
                },
                watch:{
                    state_id(newState, oldState){
                        if(newState !== oldState){
                            //se almacena en respaldo las ciudades que se actualizan
                            this.cities_respaldo = this.cities.filter(city => city.state_id === newState);
                            //buscamos si las ciudades actualizadas tienen la ciudad que tiene registrada el centro
                            const find = this.cities_respaldo.find(city => city.id === this.center.address.city.id);
                            //si se encuentra le asignamos el id
                            this.center.address.city_id = typeof find === "undefined" ? "" : find.id;
                            console.log(newState);
                        }
                    }
                },
                methods:{
                    resetFormCenter(){
                        this.center = {
                            name: "{{old('name')}}",
                            short_name: "{{old('short_name')}}",
                            center_type: "{{old('center_type')}}",
                            director_name: "{{old('director_name')}}",
                            director_position: "{{old('director_position')}}",
                            telephone_number: "{{old('telephone_number')}}",
                            address:{
                                calle: "{{old('calle')}}",
                                numero: "{{old('numero')}}",
                                colonia: "{{old('colonia')}}",
                                codigo_postal: "{{old('codigo_postal')}}",
                                city:{
                                    id: parseInt("{{old('city_id')}}"),
                                    state_id: parseInt("{{old('state_id')}}")
                                },
                                city_id: ""
                            }
                        }

                    },
                    resetFormInBlank(){
                        this.center = {
                            name: "",
                            short_name: "",
                            center_type: "",
                            director_name: "",
                            director_position: "",
                            telephone_number: "",
                            address:{
                                calle: "",
                                numero: "",
                                colonia: "",
                                codigo_postal: "",
                                city:{
                                    id: "",
                                    state_id: ""
                                },
                                city_id: ""
                            }
                        }
                        this.state_id = ""
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
                    createCenter(display){
                        if(display === 'old'){
                            this.state_id = parseInt("{{old('state_id')}}") || "";
                            this.resetFormCenter();
                        }else{
                            this.state_id = "";
                            this.resetFormInBlank();
                        }
                        this.title_modal = "Crear centro";
                        this.isEditing = false;
                        this.url = "{{ url('center') }}";

                        this.cleanErrors("hide");

                    },
                    detailCenter(){
                        Swal.fire({
                            title: "Sección en desarrollo.",
                            icon: "info",
                            customClass: {
                                icon: "no-before-icon",
                            },
                        });
                    },
                    editCenter(id){
                        this.title_modal = "Editar centro";
                        this.isEditing = true;
                        this.center = this.centers.find(center => center.id === id);

                        this.url = "{{ url('center') }}"+"/"+this.center.id;

                        this.cleanErrors("hide");
                        this.state_id = this.center.address.city.state_id;

                    },
                    destroyCenter(id){
                        this.url = "{{ url('center') }}";
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
                                        this.centers = this.centers.filter(centro => centro.id !== id);
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
                    @if(count($errors) > 0)

                        if("{{old('_method')}}" === "PUT"){
                            document.getElementById('edit').click();
                            document.getElementById('edit').onclick = this.editCenter({{old('id')}});
                            this.cleanErrors("show");
                        }else{
                            console.log("{{old('state_id')}}");
                            document.getElementById('add').click();
                            document.getElementById('add').onclick = this.createCenter('old');
                            this.cleanErrors("show");
                        }
                    @endif
                }
            }).mount('#app');
            </script>
        </x-slot>
    </x-guest-layout>
