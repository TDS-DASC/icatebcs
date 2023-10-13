<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrador']);
        //DIRECCIONES
        $soporte = Role::create(['name' => 'Soporte']);
        $direccion = Role::create(['name' => 'Dirección general']);
        $administracion = Role::create(['name' => 'Administración']);
        $planeacion = Role::create(['name' => 'Planeación']);
        $vinculacion = Role::create(['name' => 'Vinculación']);
        $tecnico_academico = Role::create(['name' => 'Técnico académica']);
        $juridico = Role::create(['name' => 'Jurídico']);
        $entidad_certificacion = Role::create(['name' => 'Entidad de certificación']);
        //UNIDAD DE CAPACITACION
        $personal_administrativo = Role::create(['name' => 'Personal administrativo']);

        $loscabos = Role::create(['name' => 'Los Cabos']);
        $comondu = Role::create(['name' => 'Comondu']);
        $loreto = Role::create(['name' => 'Loreto']);

        //Permission::create(['name' => 'Agregar Estudiante', 'category' => 1]);
        //Permission::create(['name' => 'Eliminar Estudiante', 'category' => 1]);
        //Permission::create(['name' => 'Editar Estudiante', 'category' => 1]);
        //Permission::create(['name' => 'Consultar Estudiante', 'category' => 1]);

        //Estudiantes
        Permission::create(['name' => 'Consultar estudiantes', 'category' => 1]);
        Permission::create(['name' => 'Agregar estudiantes', 'category' => 1]);
        Permission::create(['name' => 'Editar estudiantes', 'category' => 1]);
        Permission::create(['name' => 'Eliminar estudiantes', 'category' => 1]);
        Permission::create(['name' => 'Administrar recibos de estudiantes', 'category' => 1]);

        //Grupos
        Permission::create(['name' => 'Consultar grupos', 'category' => 2]);
        Permission::create(['name' => 'Agregar grupos', 'category' => 2]);
        Permission::create(['name' => 'Editar grupos', 'category' => 2]);
        Permission::create(['name' => 'Eliminar grupos', 'category' => 2]);
        Permission::create(['name' => 'Administrar constancias de grupos', 'category' => 2]);
        Permission::create(['name' => 'Administrar folios de grupos', 'category' => 2]);

        //Instructores
        Permission::create(['name' => 'Agregar instructores', 'category' => 3]);
        Permission::create(['name' => 'Consultar instructores', 'category' => 3]);
        Permission::create(['name' => 'Editar instructores', 'category' => 3]);
        Permission::create(['name' => 'Eliminar instructores', 'category' => 3]);
        Permission::create(['name' => 'Dar de baja instructores', 'category' => 3]);
        Permission::create(['name' => 'Administrar recibos instructores', 'category' => 3]);

        //Cursos
        Permission::create(['name' => 'Agregar cursos', 'category' => 4]);
        Permission::create(['name' => 'Consultar cursos', 'category' => 4]);
        Permission::create(['name' => 'Editar cursos', 'category' => 4]);
        Permission::create(['name' => 'Eliminar cursos', 'category' => 4]);
        Permission::create(['name' => 'Dar de baja cursos', 'category' => 4]);
        Permission::create(['name' => 'Catálogo Cursos', 'category' => 4]);

        //Campos de formación
        Permission::create(['name' => 'Consultar campos de formación', 'category' => 5]);
        Permission::create(['name' => 'Agregar campos de formación', 'category' => 5]);
        Permission::create(['name' => 'Editar campos de formación', 'category' => 5]);
        Permission::create(['name' => 'Eliminar campos de formación', 'category' => 5]);

        //Lugares
        Permission::create(['name' => 'Consultar lugares', 'category' => 6]);
        Permission::create(['name' => 'Agregar lugares', 'category' => 6]);
        Permission::create(['name' => 'Editar lugares', 'category' => 6]);
        Permission::create(['name' => 'Eliminar lugares', 'category' => 6]);

        //Centros
        Permission::create(['name' => 'Consultar centros', 'category' => 7]);
        Permission::create(['name' => 'Agregar centros', 'category' => 7]);
        Permission::create(['name' => 'Editar centros', 'category' => 7]);
        Permission::create(['name' => 'Eliminar centros', 'category' => 7]);

        //Sectores 
        Permission::create(['name' => 'Consultar sectores', 'category' => 8]);
        Permission::create(['name' => 'Agregar sectores', 'category' => 8]);
        Permission::create(['name' => 'Editar sectores', 'category' => 8]);
        Permission::create(['name' => 'Eliminar sectores', 'category' => 8]);

        //Convenios
        Permission::create(['name' => 'Consultar convenios', 'category' => 9]);
        Permission::create(['name' => 'Agregar convenios', 'category' => 9]);
        Permission::create(['name' => 'Editar convenios', 'category' => 9]);
        Permission::create(['name' => 'Eliminar convenios', 'category' => 9]);

        //Reportes
        Permission::create(['name' => 'Estadistica general reportes', 'category' => 10]);
        Permission::create(['name' => 'Administrativos reportes', 'category' => 10]);
        Permission::create(['name' => 'Vinculación reportes', 'category' => 10]);
        Permission::create(['name' => 'Tecnico academico reportes', 'category' => 10]);
        Permission::create(['name' => 'Planeación reportes', 'category' => 10]);

        //Reportes
        Permission::create(['name' => 'Admin Reportes', 'category' => 10]);
        Permission::create(['name' => 'Técnico Reportes', 'category' => 10]);
        Permission::create(['name' => 'Reportes', 'category' => 10]);

        //ECE
        Permission::create(['name' => 'EC Ece', 'category' => 11]);
        Permission::create(['name' => 'Candidatos Ece', 'category' => 11]);
        Permission::create(['name' => 'Evaluadores Ece', 'category' => 11]);
        Permission::create(['name' => 'Procesos Ece', 'category' => 11]);

        //Permisos
        Permission::create(['name' => 'Consultar permisos', 'category' => 12]);
        Permission::create(['name' => 'Agregar permisos', 'category' => 12]);
        Permission::create(['name' => 'Editar permisos', 'category' => 12]);
        Permission::create(['name' => 'Eliminar permisos', 'category' => 12]);

        //Usuarios
        Permission::create(['name' => 'Consultar usuarios', 'category' => 13]);
        Permission::create(['name' => 'Agregar usuarios', 'category' => 13]);
        Permission::create(['name' => 'Editar usuarios', 'category' => 13]);
        Permission::create(['name' => 'Eliminar usuarios', 'category' => 13]); 

        $user = User::find(1);
        $user->assignRole('Administrador'); 

        //USER ADMIN
        $admin->givePermissionTo([
            //Estudiantes
            'Consultar estudiantes',
            'Agregar estudiantes',
            'Editar estudiantes',
            'Eliminar estudiantes',
            'Administrar recibos de estudiantes',

            //Grupos
            'Consultar grupos',
            'Agregar grupos',
            'Editar grupos',
            'Eliminar grupos',
            'Administrar constancias de grupos',
            'Administrar folios de grupos',

            //Instructores
            'Agregar instructores',
            'Consultar instructores',
            'Editar instructores',
            'Eliminar instructores',
            'Dar de baja instructores',
            'Administrar recibos instructores',

            //Cursos
            'Agregar cursos',
            'Consultar cursos',
            'Editar cursos',
            'Eliminar cursos',
            'Dar de baja cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Consultar campos de formación',
            'Agregar campos de formación',
            'Editar campos de formación',
            'Eliminar campos de formación',

            //Lugares
            'Consultar lugares',
            'Agregar lugares',
            'Editar lugares',
            'Eliminar lugares',

            //Centros
            'Consultar centros',
            'Agregar centros',
            'Editar centros',
            'Eliminar centros',

            //Sectores
            'Consultar sectores',
            'Agregar sectores',
            'Editar sectores',
            'Eliminar sectores',

            //Convenios
            'Consultar convenios',
            'Agregar convenios',
            'Editar convenios',
            'Eliminar convenios',

            //Reportes
            'Estadistica general reportes',
            'Administrativos reportes',
            'Vinculación reportes',
            'Tecnico academico reportes',
            'Planeación reportes',

            'Admin Reportes',
            'Técnico Reportes',
            'Reportes',

            //ECE
            'EC Ece',
            'Candidatos Ece',
            'Evaluadores Ece',
            'Procesos Ece',

            //Permisos
            'Consultar permisos',
            'Agregar permisos',
            'Editar permisos',
            'Eliminar permisos',

            //Usuarios
            'Consultar usuarios',
            'Agregar usuarios',
            'Editar usuarios',
            'Eliminar usuarios'
        ]); 
        
        /* 

        //ADMINISTRACIÓN
        $administracion->givePermissionTo([
            //Estudiantess
            'Consultar estudiante',
            'Agregar estudiantes',
            'Editar estudiantes',
            'Eliminar estudiantes',
            'Administrar recibos de estudiantes',
            //Grupos

            'Folios Grupos',
            //Instructores
            'Mostrar Instructores',
            'Recibos Instructores',
            //Cursos

            //Campos de Formación

            //Lugares
            'Mostrar Lugares',
            //Centros
            'Mostrar Centros',
            //Sectores

            //Convenios

            //Reportes
            'Estadística General Reportes',
            'Administrativos Reportes',
            //ECE
            'Candidatos Ece',
            'Evaluadores Ece'
            //Reportes
        ]);
        
        //Soporte
        $soporte->givePermissionTo([
            //Estudiantes
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',
            'Agregar Grupos',
            'Constancias Grupos',
            'Folios Grupos',

            //Instructores
            'Agregar Instructores',
            'Mostrar Instructores',
            'Bajas Instructores',
            'Recibos Instructores',

            //Cursos
            'Agregar Cursos',
            'Mostrar Cursos',
            'Bajas Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Agregar Campos de formación',
            'Mostrar Campos de formación',

            //Lugares
            'Agregar Lugares',
            'Mostrar Lugares',

            //Centros
            'Agregar Centros',
            'Mostrar Centros',

            //Sectores
            'Agregar Sectores',
            'Mostrar Sectores',

            //Convenios
            'Agregar Convenios',
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',
            'Administrativos Reportes',
            'Vinculación Reportes',
            'Técnico Académico Reportes',
            'Planeación Reportes',

            //ECE
            'EC Ece',
            'Candidatos Ece',
            'Evaluadores Ece',
            'Procesos Ece',

            //Reportes
            'Admin Reportes',
            'Técnico Reportes',
            'Planeación Reportes'
        ]);

        //Dirección General
        $direccion->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE

            //Reportes
            'Admin Reportes',
            'Técnico Reportes',
            'Planeación Reportes'
        ]);  

        //PLANEACIÓN
        $planeacion->givePermissionTo([
            //Estudiantess
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',
            'Recibos Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',
            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios	
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',
            'Administrativos Reportes',
            'Vinculación Reportes',
            'Técnico Académico Reportes',
            'Planeación Reportes',
            //ECE
            'EC Ece',
            'Evaluadores Ece',
            'Procesos Ece',

            //Reportes
            'Técnico Reportes',
        ]);

        //VINCULACIÓN
        $vinculacion->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Mostrar Campos de formación',
            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Agregar Convenios',
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',
            'Vinculación Reportes',

            //ECE
            'EC Ece',
            'Evaluadores Ece'

            //Reportes
        ]);

        //TÉCNICO ACADÉMICA
        $tecnico_academico->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',
            'Agregar Grupos',
            'Constancias Grupos',
            'Folios Grupos',

            //Instructores
            'Agregar Instructores',
            'Mostrar Instructores',
            'Bajas Instructores',
            'Recibos Instructores',

            //Cursos
            'Agregar Cursos',
            'Mostrar Cursos',
            'Bajas Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Agregar Campos de formación',
            'Mostrar Campos de formación',

            //Lugares
            'Agregar Lugares',
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',
            'Técnico Académico Reportes',

            //ECE
            'EC Ece',
            'Candidatos Ece',
            'Evaluadores Ece',
            'Procesos Ece'
            //Reportes
        ]);

        //JURÍDICO
        $juridico->givePermissionTo([
            //Estudiantess

            //Grupos

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',

            //Campos de Formación

            //Lugares
            'Mostrar Lugares',
            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE
            'Evaluadores Ece'

            //Reportes
        ]);

        //ENTIDAD DE CERTIFICACION
        $entidad_certificacion->givePermissionTo([
            //Estudiantess


            //Grupos

            //Instructores


            //Cursos


            //Campos de Formación

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes


            //ECE
            'EC Ece',
            'Candidatos Ece',
            'Evaluadores Ece',
            'Procesos Ece'

            //Reportes
        ]);

        //Personal Administrativo
        $personal_administrativo->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE
            'EC Ece',
            'Evaluadores Ece'

            //Reportes
        ]);

        //Los Cabos
        $loscabos->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE
            'EC Ece',
            'Evaluadores Ece'


            //Reportes
        ]);

        //Comondu
        $comondu->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE
            'EC Ece',
            'Evaluadores Ece'

            //Reportes
        ]);

        //Loreto
        $loreto->givePermissionTo([
            //Estudiantess
            'Buscar Estudiantes',
            'Agregar Estudiantes',
            'Recibos Estudiantes',

            //Grupos
            'Buscar Grupos',

            //Instructores
            'Mostrar Instructores',

            //Cursos
            'Mostrar Cursos',
            'Catálogo Cursos',

            //Campos de Formación
            'Mostrar Campos de formación',

            //Lugares
            'Mostrar Lugares',

            //Centros
            'Mostrar Centros',

            //Sectores
            'Mostrar Sectores',

            //Convenios
            'Mostrar Convenios',

            //Reportes
            'Estadística General Reportes',

            //ECE
            'EC Ece',
            'Evaluadores Ece'


            //Reportes
        ]); */
    }
}
