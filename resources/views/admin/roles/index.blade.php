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
                            <li class="breadcrumb-item"><a href="/profile">Roles y permisos</a></li>
                            <li class="breadcrumb-item active">Roles y permisos</li>
                        </ol></h4>

                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-lg-12">
            @if(session('success'))
            <div class="col">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h5> Proceso realizado exitosamente. </h5>
                   
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            
                <div class="card">
                    <div class="card-header">
                        <div class="col">
                            <h4 class="card-title float-start">Perfiles</h4>
                            @can('Agregar permisos')
                                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalPermissions" @click="addRole"><i class="ri-add-line align-bottom me-1"></i> Agregar</button>
                            @endcan
                        </div>
                    </div><!-- end card header -->
                </div>
            </div>
            
            <div class="col-xxl-3 col-lg-6" v-for="(rol, index) in roles">
                <div class="card card-body text-center">
                    <div class="avatar-sm mx-auto mb-3">
                        <div class="avatar-title bg-soft-success text-success fs-17 rounded">
                            <i class="ri-admin-fill"></i>
                        </div>
                    </div>
                    <h4 class="card-title">@{{rol.name}}</h4>
                    <p class="card-text text-muted">Para visualizar y/o editar los permisos que tiene el perfil @{{rol.name}} de clic al siguiente botón</p>
                    
                    <div id="rowButtonsProfiles" class="row">
                        @can('Editar permisos')
                        <div class="col-sm-12 mt-2">
                            <a class="btn btn-success buttonOptions" data-bs-toggle="modal" data-bs-target="#modalPermissions" @click="editRole(index)">Visualizar permisos</a>
                        </div>
                        @endcan
                        @can('Eliminar permisos')
                        <div class="col-sm-12 mt-2">
                            <button class="btn btn-danger buttonOptions" :disabled="'{{Auth::user()->roles->pluck('name')[0]}}' === rol.name" @click="deleteRole(rol.id)"><i class="ri-delete-bin-2-line ri-xl"></i>Eliminar</button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal roles & permissions --}}
<div class="modal fade" id="modalPermissions"  role="dialog" aria-labelledby="Permisos" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mt-4">
                <h5 class="modal-title" id="modalPermission">@{{titleModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                
                <form id="frmRole" method="POST" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                    @csrf
                    <!-- Pendiente mandar el campo name del rol para actualizar -->
                 
                    <div v-if="error">
                        <!-- Danger Alert -->
                        <div class="alert alert-borderless alert-danger" role="alert">
                            <strong> @{{error}} </strong>
                        </div>
                    </div>
              
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" v-model="rol_name" onkeypress="return letrasYNumeros(event)" placeholder="Nombre del rol">
                   
                    <div class="row p-2" v-for="(categoria, index) in permission">
                            <h5 class="mt-2">@{{ categoria[0].category }}</h5>
                        
                            <div class="col-sm-3 mb-2" v-for="perm in categoria">
                                <div class="form-check"  v-if="checkPermission(perm.id)">
                                    <input class="form-check-input" type="checkbox" :id="perm.name" :name="perm.name" checked="true" @click="addPermission(perm.id)" >
                                    <label class="form-check-label" :for="perm.name">
                                        @{{perm.name}}
                                    </label>
                                </div>
                                <div class="form-check"  v-if="!checkPermission(perm.id)">
                                    <input class="form-check-input" type="checkbox" :id="perm.name" :name="perm.name" @click="addPermission(perm.id)">
                                    <label class="form-check-label" :for="perm.name">
                                        @{{perm.name}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mt-2">
                    </div>
                    
                   
                    
                    <div class="modal-footer">
                            <div v-if="!method_post">
                                <input type="hidden" name="id" :value="rol.id">
                                <input type="hidden" name="_method" value="PUT">
                            </div>
                        <a class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<x-slot name="scripts">
    <script src="{{ asset('js/global.js') }}"></script>
    <script>
        const { createApp } = Vue
        createApp({
            data() {
                return {
                    roles: @json($roles),
                    url: '',
                    permission: @json($permissions),
                    permissions_id: [],
                    titleModal: '',
                    rol: [],
                    perms: [],
                    rol_name: '',
                    method_post: false,
                    error: '',
                }
            },
            methods:{
                checkPermission(id){
                    if(typeof this.perms.find(permiso => permiso === id) !== "undefined"){
                        return true;
                    }
                    return false;
                },
                addPermission(id){
                   
                    let permiso = this.permissions_id.find(permiso => permiso === id);
                   
                    if(typeof permiso === "undefined"){
                        this.permissions_id.push(id);
                    }else{
                        this.permissions_id = this.permissions_id.filter(permiso => permiso !== id);
                    }
                    
                },
                handleSubmit(){
                    this.error = '';
                    if(document.getElementById('name').value.length < 3){
                        this.error = "Es necesario un nombre";
                    }else{
                        let form = document.getElementById('frmRole');
                        let input;           
                        for(let i = 0; i<this.permissions_id.length; i++){
                            input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "permissions[]"; 
                            input.value = this.permissions_id[i];
                            form.appendChild(input);
                        }

                        form.action = this.url;
                        form.submit();
                    }
                },
                addRole(){
                    this.permissions_id = [];
                    this.perms = [];
                    this.titleModal = "Agregar rol y permisos";
                    this.rol_name = '';
                    this.method_post = true;
                    this.url = `{{ url('profile') }}`;
                },
                editRole(index){
                    this.perms = [];
                    this.method_post = false;
                    this.rol = this.roles[index];
                    this.url = `{{ url('profile/${this.rol.id}') }}`;
                    this.titleModal = 'Rol de ' + this.rol.name;
                    this.rol_name = this.rol.name;
                    for(let i = 0; i < this.rol.permissions.length; i++){
                        this.perms.push(this.rol.permissions[i].id);
                    }
                    this.permissions_id = this.perms;
                },
                deleteRole(id){
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
                        axios.get(`{{ url('profile/${id}/delete')}}`)
                            .then(response => {
                                Swal.fire("Hecho", "Registro eliminado correctamente", "success")
                                .then(value =>{
                                    this.roles = this.roles.filter(rol => rol.id !== id)
                                    //window.location = this.url
                                })
                            })
                            .catch(error => {
                                Swal.fire("Error!","No encontramos lo que buscaba.","error")
                            })
                    }
                    })
                    
                },

            }
        }).mount("#app");
    </script>
</x-slot>
</x-guest-layout>