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
                                <li class="breadcrumb-item"><a href="/user">Usuarios</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
                            </ol></h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <header>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="userList">
                                <div class="row g-4 mb-3">
                                    <div class="d-flex justify-content-sm-between">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Realizar una búsqueda">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        @can('Agregar usuarios')
                                            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalUser" id="addUser" @click="addUser"><i class="ri-add-line align-bottom me-1"></i>Agregar</button>
                                        @endcan
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="userTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort" data-sort="avatar">Foto</th>
                                                <th class="sort" data-sort="user_name">Nombre</th>
                                                <th class="sort" data-sort="user_email">Correo electrónico</th>
                                                <th class="sort" data-sort="user_center">Centro asignado</th>
                                                <th class="sort" data-sort="user_rol">Rol asignado</th>
                                                @if(auth()->user()->can('Editar usuarios') || auth()->user()->can('Eliminar usuarios'))
                                                    <th class="sort" data-sort="actions">Acciones</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            <tr v-for="user in users">
                                                <td class="col1"><div class="avatr d-flex justify-content-center">
                                                    <img class="img-fluid" width="50" height="50"
                                                            :src="user.profile_photo_path != 'cover.jpg' ? assetAvatar(user.profile_photo_path) : 'https://ui-avatars.com/api/?name='+user.name"
                                                            :alt="user.name">
                                                    </div>
                                                </td>
                                                <td class="user_name">@{{ user.name }}</td>
                                                <td class="user_email">@{{ user.email }}</td>
                                                <td class="user_center">@{{ user.center ? user.center.name : "Sin centro asignado" }}</td>
                                                <td class="user_rol">@{{ user.roles[0] ? user.roles[0].name : "Sin rol" }}</td>
                                                @if(auth()->user()->can('Editar usuarios') || auth()->user()->can('Eliminar usuarios'))
                                                    <td class="col-1">
                                                        <div class="d-flex gap-2">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-info edit-item-btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>
                                                                <div class="dropdown-menu">
                                                                    <!-- <a class="dropdown-item btn" >Detalles</a> -->
                                                                    @can('Editar usuarios')
                                                                        <a class="dropdown-item btn" id="editUser" data-bs-toggle="modal" data-bs-target="#modalUser" @click="editUser(user.id)">Editar</a>
                                                                    @endcan
                                                                    @can('Eliminar usuarios')
                                                                        <a class="dropdown-item btn" @click="destroyUser(user.id)">Eliminar</a>
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
            </header>


        </div>

        <!-- container-fluid -->
        <!-- Modal crear/editar centro -->
        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalTitle">@{{title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body container-fluid">

                        <form class="flex flex-col w-full" :action="url" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div v-if="isEditing">
                                @method('PUT')
                                <input type="hidden" name="_method"  value="PUT">
                                <input type="hidden" name="id" id="id" v-model="user.id">
                            </div>
                           <div v-else><input type="hidden" name="_method" value="POST"></div>
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del usuario" onkeypress="return soloLetras(event)" :value="user.name" maxlength="250" required>
                                            @error('name')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                            @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo electrónico" :value="user.email" maxlength="250" required>
                                        @error('email')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="center_id" class="form-label">Centro</label>
                                        <select class="form-control" name="center_id" v-model="center_id">
                                            <option selected disabled value="">Seleccione un centro</option>
                                            <option :value="center.id" v-for="center in centers">@{{center.name}}</option>
                                        </select>
                                        @error('center')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="role" class="form-label">Perfil</label>
                                        <select class="form-control" name="role_id" id="role" v-model="role_id">
                                            <option selected disabled value="">Seleccione un rol</option>
                                            <option :value="role.id" v-for="role in roles">@{{role.name}}</option>
                                        </select>
                                        @error('role')
                                            <div class="alert alert-borderless alert-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div><!--end col-->

                                <div class="col-xxl-12">
                                    <div>
                                        <label for="profile_photo_path" class="form-label">Foto de perfil</label>
                                        <input type="hidden" name="profile_photo_path" value="cover.jpg">
                                        <input type="file" name="profile_photo_path" class="form-control" accept="image/*" data-max-size="1507459" filename="cover.jpg">
                                    </div>
                                </div><!--end col-->
                                <div class="col-xxl-12" v-if="isEditing">
                                    <a href="#" @click="mostrarPass">@{{textShowPass}}</a>
                                </div><!--end col-->
                                <div>
                                    <div class="col-xxl-12">
                                        <div v-if="showPassword">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña" required>
                                        </div>
                                            @error('password')
                                                <div class="alert alert-borderless alert-danger" role="alert">
                                                        @foreach($errors->get('password') as $error)
                                                            <li><strong>{{$error}}</strong></li>
                                                        @endforeach
                                                </div>
                                            @enderror
                                    </div><!--end col-->
                                    <div class="col-xxl-12">
                                        <div v-if="showPassword">
                                            <label for="password_confirmation" class="form-label mt-4">Repita la contraseña</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repita la contraseña" required>
                                        </div>
                                    </div><!--end col-->
                                </div>

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                        @if(auth()->user()->can('Agregar usuarios') || auth()->user()->can('Editar usuarios'))
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
    <!-- End Page-content -->

    <x-slot name="scripts">
        <script src="{{ asset('js/global.js') }}"></script>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script rel="stylesheet" type="text/javascript" src="{{ asset('libs/dataTables/datatables.min.js') }}"></script>
        <script>

             const { createApp } = Vue
            createApp({
                data() {
                    return {
                        url: "{{ url('user') }}",
                        title: "",
                        textShowPass: 'Mostrar actualizar contraseña',
                        showPassword: false,
                        users: @json($users),
                        roles: @json($roles),
                        centers: @json($centers),
                        user: {
                            name: '',
                            email: '',

                        },
                        isEditing: false,
                        role_id: '',
                        center_id: ''
                    }
                },
                watch:{
                    role_id(newState, oldState){
                        if(newState !== oldState){
                            if(this.isEditing == false && newState != "") {
                                this.user.name = document.getElementById("name").value;
                                this.user.email = document.getElementById("email").value;
                            }
                        }
                    }
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
                    resetFormBlank(){
                        this.user = {
                            name: '{{ old("name") }}',
                            email: '{{ old("email") }}',
                        };
                        this.role_id = '{{ old("role_id") }}';
                        this.center_id = '{{ old("center_id") }}';
                        this.showPassword = false;
                        this.textShowPass = "Mostrar actualizar contraseña";
                    },
                    mostrarPass(){
                        this.showPassword = !this.showPassword;
                        this.textShowPass = this.showPassword ? "Ocultar actualizar contraseña" : "Mostrar actualizar contraseña";
                    },
                    addUser(){

                        this.resetFormBlank();
                        

                        this. url= "{{ url('user') }}";
                        this.title = "Agregar usuario";
                        this.isEditing = false;
                        this.showPassword = true;

                        this.cleanErrors("hide");
                    },
                    editUser(id){
                        this.resetFormBlank();
                        this.title = "Editar usuario";
                        this.user = this.users.find(user => user.id === id);
                        this. url= "{{ url('user') }}"+"/"+this.user.id;
                        this.isEditing = true;
         
                        this.role_id = this.user.roles.length > 0 ? this.user.roles[0].id : "";
                        this.center_id = this.user.center_id ?? "";

                        this.cleanErrors("hide");
                    },
                    destroyUser(id){
                        console.log(id);
                        this.url = "{{ url('user') }}";
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
                                        this.users = this.users.filter(user => user.id !== id);
                                    })
                                })
                                .catch(error => {
                                    Swal.fire("Error!","No encontramos lo que buscaba.","error")
                                })
                        }
                        })
                    },
                    assetAvatar(urlImg) {
                        const asset = "{{ asset('storage/user/covers') }}"
                        return asset + "/" + urlImg;
                    },
                },
                mounted(){
                    @if(count($errors) > 0)
                    if("{{old('_method')}}" === "PUT"){
                        document.getElementById('editUser').onclick = this.editUser({{old('id')}});
                        document.getElementById('editUser').click()
                        this.mostrarPass();
                        this.cleanErrors("show");
                    }else{
                        document.getElementById('addUser').click()
                        document.getElementById('addUser').onclick = this.addUser();
                        this.cleanErrors("show");
                    }
                    @endif
                }
            }).mount('#app');
        </script>
    </x-slot>

</x-guest-layout>
