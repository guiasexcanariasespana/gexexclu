<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $role1 = Role::create(['name'=>'Admin']);
       $role2 = Role::create(['name'=>'Inicial']);
       $role3 = Role::create(['name' => 'Verificado']);


####Dashboard       
       Permission::create(['name'=>'admin.home',
                    'description' => 'Ver dashboard'])->syncRoles([$role1, $role2]);

####Admin anuncios
Permission::create([
                     'name' => 'admin.anuncios',
                     'description' => 'Gestión de Anuncios.'
              ])->assignRole([$role1]);
####Users
       Permission::create(['name'=>'admin.users.index',
                'description' => 'Ver Listado de usuarios'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.users.edit',
                'description' => 'Editar usuario'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.users.create',
       'description' => 'Crear usuario'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.users.show',
       'description' => 'Mostrar usuario'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.users.destroy',
       'description' => 'Eliminar usuario'])->assignRole([$role1]);
####categorias
       Permission::create(['name'=>'admin.categorias.index',
                    'description' => 'Ver Listado de Categorías'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.categorias.create',
                    'description' => 'Crear Categoría'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.categorias.edit',
                    'description' => 'Editar Categoría'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.categorias.show',
                    'description' => 'Ver Categoría'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.categorias.destroy',
                'description' => 'Eliminar Categoría'])->assignRole([$role1]);

####clases
       Permission::create(['name'=> 'admin.clases.index',
                    'description' => 'Ver Listado de Clases'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.clases.create',
                    'description' => 'Crear Clase'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.clases.edit',
                    'description' => 'Editar Clase'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.clases.show',
                    'description' => 'Ver Clase'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.clases.destroy',
                'description' => 'Eliminar Clase'])->assignRole([$role1]);

####tags           
       Permission::create(['name'=>'admin.tags.index',
                    'description' => 'Ver Listado de Etiquetas'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.tags.create',
                                        'description' => 'Crear etiqueta'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.tags.edit',
                    'description' => 'Editar etiqueta'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.tags.show',
                    'description' => 'Ver etiqueta'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.tags.destroy',
                    'description' => 'Eliminar etquita'])->assignRole([$role1]);
####Roles
       Permission::create(['name'=>'admin.roles.index',
                    'description' => 'Ver Listado de roles'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.roles.create',
                                        'description' => 'Crear rol'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.roles.edit',
                    'description' => 'Editar rol'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.roles.show',
                    'description' => 'Ver rol'])->assignRole([$role1]);
       Permission::create(['name'=>'admin.roles.destroy',
                    'description' => 'Eliminar rol'])->assignRole([$role1]);

####PLANES             
       Permission::create(['name'=>'admin.planes.index',
                    'description' => 'Ver Listado de Planes'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.planes.create',
                    'description' => 'Crear Plan'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.planes.edit',
                    'description' => 'Editar Plan'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.planes.show',
                    'description' => 'Ver Plan'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.planes.destroy',
                'description' => 'Eliminar Plan'])->assignRole([$role1]);

####Provincias
       Permission::create(['name'=>'admin.states.index',
                    'description' => 'Ver Listado de Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.states.create',
                    'description' => 'Crear Provincia'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.states.edit',
                    'description' => 'Editar Provincia'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.states.show',
                    'description' => 'Ver Provincia'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.states.destroy',
                'description' => 'Eliminar Provincia'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.states.precio',
                'description' => 'Gestion de Precios (Provincia)'])->assignRole([$role1]);           

####Zonas
       Permission::create(['name'=>'admin.zones.index',
                    'description' => 'Ver Listado de Zonas'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.zones.create',
                    'description' => 'Crear Zonas'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.zones.edit',
                    'description' => 'Editar Zonas'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.zones.show',
                    'description' => 'Ver Zona'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.zones.destroy',
                'description' => 'Eliminar Zona'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.zones.precio',
                'description' => 'Gestion de Precios (Zona)'])->assignRole([$role1]);         

####Formas de Pago             
       Permission::create(['name'=>'admin.formapagos.index',
                    'description' => 'Ver Listado de Formas de Pagos'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.formapagos.create',
                    'description' => 'Crear Forma de Pago'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.formapagos.edit',
                    'description' => 'Editar Forma de Pago'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.formapagos.show',
                    'description' => 'Ver Forma de Pago'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.formapagos.destroy',
                'description' => 'Eliminar Forma de Pago'])->assignRole([$role1]);


####Lugares             
       Permission::create(['name'=>'admin.lugares.index',
                    'description' => 'Ver Listado de Lugares'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.lugares.create',
                    'description' => 'Crear Lugar'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.lugares.edit',
                    'description' => 'Editar Lugar'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.lugares.show',
                    'description' => 'Ver Lugar'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.lugares.destroy',
                'description' => 'Eliminar Lugar'])->assignRole([$role1]);

####Provincias
       Permission::create(['name'=>'admin.provincias.index',
                    'description' => 'Ver Listado de Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.provincias.create',
                    'description' => 'Crear Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.provincias.edit',
                    'description' => 'Editar Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.provincias.show',
                    'description' => 'Ver Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.provincias.destroy',
                'description' => 'Eliminar Provincias'])->assignRole([$role1]);
       Permission::create(['name'=> 'admin.provincias.precio',
                'description' => 'Gestion de Precios (Provincias)'])->assignRole([$role1]);


####municipios
              Permission::create([
                     'name' => 'admin.municipios.index',
                     'description' => 'Ver Listado de Municipios'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.municipios.create',
                     'description' => 'Crear Municipios'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.municipios.edit',
                     'description' => 'Editar Municipios'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.municipios.show',
                     'description' => 'Ver Municipios'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.municipios.destroy',
                     'description' => 'Eliminar Municipios'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.municipios.precio',
                     'description' => 'Gestion de Precios (Municipios)'
              ])->assignRole([$role1]);

              ####pagos
              Permission::create([
                     'name' => 'admin.pagos.index',
                     'description' => 'Ver Listado de pagos'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.pagos.create',
                     'description' => 'Crear pagos'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.pagos.edit',
                     'description' => 'Editar pagos'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.pagos.show',
                     'description' => 'Ver pagos'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.pagos.destroy',
                     'description' => 'Eliminar pagos'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.pagos.precio',
                     'description' => 'Gestion de Precios (pagos)'
              ])->assignRole([$role1]);

              ####smsnotificacion
              Permission::create([
                     'name' => 'admin.smsnotificacion.index',
                     'description' => 'Ver Listado de smsnotificacion'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.smsnotificacion.create',
                     'description' => 'Crear smsnotificacion'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.smsnotificacion.edit',
                     'description' => 'Editar smsnotificacion'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.smsnotificacion.show',
                     'description' => 'Ver smsnotificacion'
              ])->assignRole([$role1]);
              Permission::create([
                     'name' => 'admin.smsnotificacion.destroy',
                     'description' => 'Eliminar smsnotificacion'
              ])->assignRole([$role1]);
             

              ###Dashboard
              Permission::create([
                     'name' => 'admin.dashboard',
                     'description' => 'Admin Dashboard'
              ])->assignRole([$role1]);


              ###Imagenes
              Permission::create([
                     'name' => 'admin.gestion.imagenes',
                     'description' => 'Gestión de Imágenes'
              ])->assignRole([$role1]);

              ###Imagenes
              Permission::create([
                     'name' => 'admin.notas',
                     'description' => 'Gestión de Notas (Administrador)'
              ])->assignRole([$role1]); 



    }
}
