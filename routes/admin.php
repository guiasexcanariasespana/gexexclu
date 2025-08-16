<?php

use App\Formapago;
use App\Http\Controllers\Admin\SmsnotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ClaseController;
use App\Http\Controllers\Admin\PlaneController;
use App\Http\Controllers\Admin\PrecioController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LugarController;
use App\Http\Controllers\Admin\AnuncioController;
use App\Http\Controllers\Admin\FormapagoController;
use App\Http\Controllers\Admin\ImagensController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\NotaController;
use App\Http\Controllers\Admin\ProvinciaController;
use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\Notification\Sms\CreateNotificacionController;
use App\Http\Controllers\Admin\PagoController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('anuncios/eliminar_imagen', [AnuncioController::class, 'eliminar_imagen'])->name('admin.eliminar_imagen'); //->middleware('ensureverificado');
Route::post('anuncios/guardar_imagen/{anuncio}', [AnuncioController::class, 'guardar_imagen'])->name('admin.guardar_imagen');//->middleware('ensureverificado');


Route::group(['middleware' => 'esadmin'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin.home');

    Route::post('anuncios/imagenes_guardar_orden/{anuncio}', [AnuncioController::class, 'imagenes_guardar_orden'])->name('admin.imagenes_guardar_orden');

    Route::post('anuncios/{anuncio}/marcar_portada_doble', [AnuncioController::class,
    'marcar_portada_doble'])->name('admin.anuncio.marcar_portada_doble');
    Route::post('anuncios/{anuncio}/quitar_portada_doble', [AnuncioController::class,
    'quitar_portada_doble'])->name('admin.anuncio.quitar_portada_doble');

    Route::resource('smsnotifications', SmsnotificationController::class)->names('smsnotifications');
    Route::resource('pagos', PagoController::class)->names('pagos');

    Route::get('anuncios/{anuncio}/rechazar_video', [AnuncioController::class, 'rechazar_video'])->name('admin.rechazar_video');
    Route::get('anuncios/{anuncio}/aceptar_video', [AnuncioController::class, 'aceptar_video'])->name('admin.aceptar_video');

    Route::get('pictures/{imagen}/rechazar_imagen', [ImagensController::class, 'rechazar_imagen'])->name('admin.imagens.rechazar_imagen');
    Route::get('pictures/{imagen}/aceptar_imagen', [ImagensController::class, 'aceptar_imagen'])->name('admin.imagens.aceptar_imagen');

    Route::get('anuncios/{anuncio}/verificar_user', [AnuncioController::class, 'verificar_user'])->name('admin.anuncios.verificar_user');
    Route::get('anuncios/{anuncio}/rechazar_user', [AnuncioController::class, 'rechazar_user'])->name('admin.anuncio.rechazar_user');

    Route::post('anuncios/{anuncio}/store_pago', [AnuncioController::class, 'store_pago'])->name('admin.anuncios.store_pago');
    Route::get('anuncios/{anuncio}/registrar_pago', [AnuncioController::class, 'registrar_pago'])->name('admin.anuncio.registrar_pago');

    Route::post('anuncios/{anuncio}/guardar_video', [AnuncioController::class, 'guardar_video'])->name('admin.anuncios.guardar_video');
    Route::get('anuncios/{anuncio}/cargar_video', [AnuncioController::class, 'cargar_video'])->name('admin.anuncio.cargar_video');

    Route::post('anuncios/{anuncio}/subir_verificar_perfil', [AnuncioController::class, 'subir_verificar_perfil'])->name('admin.subir_verificar_perfil');
    Route::get('anuncios/{anuncio}/quitar_foto_verificacion', [AnuncioController::class, 'quitar_foto_verificacion'])->name('admin.quitar_foto_verificacion');

    Route::post('anuncios/{anuncio}/guardar_orden', [AnuncioController::class, 'guardar_orden'])->name('admin.imagenes.guardar_orden');
    Route::get('anuncios/{anuncio}/ordernar_imagenes', [AnuncioController::class, 'ordernar_imagenes'])->name('admin.anuncio.ordernar_imagenes');
    Route::get('datatables/anuncios', [DatatableController::class, 'anuncio'])->name('datatable.anuncio');
    Route::post('anuncios/{anuncio}/guardar_portada', [AnuncioController::class, 'guardar_portada'])->name('admin.anuncios.guardar_portada');
    Route::get('anuncios/{anuncio}/definir_portada', [AnuncioController::class, 'definir_portada'])->name('admin.anuncio.definir_portada');
    Route::get('anuncios/{anuncio}/imagenes', [AnuncioController::class, 'imagenes'])->name('admin.anuncio.imagenes');
    Route::post('notas/{anuncio}/anunciostore', [NotaController::class, 'anunciostore'])->name('admin.anuncio.notas.anunciostore');
    Route::get('notas/{anuncio}/anunciocreate', [NotaController::class, 'anunciocreate'])->name('admin.anuncio.notas.anunciocreate');
    Route::get('anuncios/{anuncio}/reactivar_anuncio', [AnuncioController::class, 'reactivar_anuncio'])->name('admin.anuncio.reactivar_anuncio');
    
    Route::get('anuncios/{anuncio}/finalizar_anuncio', [AnuncioController::class, 'finalizar_anuncio'])->name('admin.anuncio.finalizar_anuncio');

    
    Route::get('anuncios/{anuncio}/a_a_publicar', [AnuncioController::class, 'a_a_publicar'])->name('admin.anuncio.a_a_publicar');    
    Route::get('anuncios/{anuncio}/a_borrador', [AnuncioController::class, 'a_borrador'])->name('admin.anuncio.a_borrador');    
    Route::get('anuncios/{anuncio}/pausar_anuncio', [AnuncioController::class, 'pausar_anuncio'])->name('admin.anuncio.pausar_anuncio');    
    Route::get('anuncios/{anuncio}/suspender_anuncio', [AnuncioController::class, 'suspender_anuncio'])->name('admin.anuncio.suspender_anuncio');
    Route::get('anuncios/{anuncio}/rechazar_anuncio', [AnuncioController::class, 'rechazar_anuncio'])->name('admin.anuncio.rechazar_anuncio');
    Route::get('anuncios/{anuncio}/aprobar_anuncio', [AnuncioController::class, 'aprobar_anuncio'])->name('admin.anuncio.aprobar_anuncio');
    Route::get('anuncios/{anuncio}/gestion_imagenes', [AnuncioController::class, 'gestion_imagenes'])->name('admin.anuncio.gestion_imagenes');
    Route::post('anuncios/{anuncio}/delete_images', [AnuncioController::class, 'fileDestroy'])->name('admin.anuncio.delete_images');
    Route::post('anuncios/{anuncio}/store_images', [AnuncioController::class, 'store_images'])->name('admin.anuncio.store_images');
    Route::get('anuncios/{anuncio}/create_images', [AnuncioController::class, 'create_images'])->name('admin.anuncio.create_images');
    Route::resource('anuncios', AnuncioController::class)->names('admin.anuncios');

    Route::get('states/{state}/create_precio', [StateController::class, 'create_precio'])->name('state.create_precio');
    Route::post('states/store_precio', [StateController::class, 'store_precio'])->name('state.store_precio');
    Route::get('states/{precio}/edit_precio', [StateController::class, 'edit_precio'])->name('state.edit_precio');
    Route::get('states/{precio}/update_precio', [StateController::class, 'update_precio'])->name('state.update_precio');
    Route::delete('states/precio/{precio}', [StateController::class, 'destroy_precio'])->name('state.delete_precio');
    Route::resource('states', StateController::class)->names('states');

    Route::get('zones/{zone}/create_precio', [ZoneController::class, 'create_precio'])->name('zone.create_precio');
    Route::post('zones/store_precio', [ZoneController::class, 'store_precio'])->name('zone.store_precio');
    Route::get('zones/{precio}/edit_precio', [ZoneController::class, 'edit_precio'])->name('zone.edit_precio');
    Route::get('zones/{precio}/update_precio', [ZoneController::class, 'update_precio'])->name('zone.update_precio');
    Route::delete('zones/precio/{precio}', [ZoneController::class, 'destroy_precio'])->name('zone.delete_precio');
    Route::resource('zones', ZoneController::class)->names('zones');

    Route::resource('municipios', MunicipioController::class)->names('municipios');
    Route::resource('provincias', ProvinciaController::class)->names('provincias');
    Route::resource('categorias', CategoriaController::class)->names('categorias');
    Route::resource('clases', ClaseController::class)->names('clases');
    Route::resource('tags', TagController::class)->names('tags');
    Route::resource('planes', PlaneController::class)->names('planes');
    Route::resource('precios', PrecioController::class)->names('precios');
    Route::resource('formapagos', FormapagoController::class)->names('formapagos');


    Route::resource('lugars', LugarController::class)->names('lugars');

    Route::resource('roles', RoleController::class)->names('admin.roles');


    Route::delete('notas/{nota}', [NotaController::class, 'destroy'])->name('admin.notas.delete');
    Route::put('notas/{nota}/update', [NotaController::class, 'update'])->name('admin.notas.update');
    Route::get('notas/{nota}/edit', [NotaController::class, 'edit'])->name('admin.nota.edit');
    Route::get('notas/{nota}', [NotaController::class, 'show'])->name('admin.notas.show');

    Route::get('datatables/users', [DatatableController::class, 'user'])->name('datatable.user');
    
    Route::get('users/{id}/suplantar', [UserController::class, 'suplantar'])->name('admin.user.suplantar');
    Route::get('users/{/leaveImpersonate', [UserController::class, 'leaveImpersonate'])->name('admin.user.leaveImpersonate');
    
    Route::get('users/{id}/rechazar_perfil', [UserController::class, 'rechazar_perfil'])->name('admin.user.rechazar_perfil');
    Route::get('users/{id}/aprobar_perfil', [UserController::class, 'aprobar_perfil'])->name('admin.user.aprobar_perfil');
    Route::get('users/{id}/ver_autorizar', [UserController::class, 'edit_autorizar'])->name('admin.users.ver_autorizar');
    Route::post('notas/{user}/userstore', [NotaController::class, 'userstore'])->name('admin.users.notas.userstore');
    Route::get('notas/{user}/usercreate', [NotaController::class, 'usercreate'])->name('admin.users.notas.usercreate');
    Route::post('users/{anuncio}/update_anuncio', [UserController::class, 'update_anuncio'])->name('admin.users.update_anuncio');
    Route::get('users/{anuncio}/edit_anuncio', [UserController::class, 'edit_anuncio'])->name('admin.users.edit_anuncio');
    Route::post('users/{user}/store_anuncio', [UserController::class, 'store_anuncio'])->name('admin.users.store_anuncio');
    Route::get('users/{user}/create_anuncio', [UserController::class, 'create_anuncio'])->name('admin.users.create_anuncio');
    Route::put('users/{user}/updateroles', [UserController::class, 'updateroles'])->name('admin.users.updateroles');
    Route::get('users/{user}/editroles', [UserController::class, 'editroles'])->name('admin.users.editroles');
    Route::resource('users', UserController::class)->names('admin.users');

    // Modulo Home 2.0
    Route::get('home', [HomeController::class, 'home'])->name('admin.home2');
    Route::get('accesos', [HomeController::class, 'accesos'])->name('admin.accesos');
    Route::get('usuarios', [HomeController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('new-anuncios', [HomeController::class, 'anuncios'])->name('admin.anuncios2');
    Route::get('accesos/eliminar', [HomeController::class, 'destroy'])->name('admin.accesos.eliminar');

    // Modulo de Notificaciones 2.0
    Route::get('notifications', [SmsnotificationController::class, 'new_notifications_index'])->name('admin.notifications');
    Route::post('/update-texts', function (Request $request) {
        $data = $request->only(['text_72h', 'text_48h', 'text_24h']);
        
        // Actualizar archivo .env
        foreach ($data as $key => $value) {
            file_put_contents(app()->environmentFilePath(), preg_replace(
                "/^" . strtoupper($key) . "=.*/m",
                strtoupper($key) . "=\"" . addslashes($value) . "\"",
                file_get_contents(app()->environmentFilePath())
            ));
        }
    
        // Limpiar caché del entorno para reflejar cambios
        Artisan::call('config:clear');
    
        return redirect()->back()->with('success', 'Mensajes actualizados correctamente.');
    })->name('updateTexts');


    Route::get('perfil', [PerfilController::class, 'index'])->name('perfil.index');
    //Notification
    Route::get('48Horas', [
        CreateNotificacionController::class
        , '__invoke'
    ])->name('notification.sms.create');
    
});

