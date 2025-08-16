<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;
use App\Mail\AnuncioFueMailable;
use App\Mail\VencimientosMailable;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AnunciosController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CookiesPolicyController;
use App\Http\Controllers\DenunciaFormController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\RedsysController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\VerificarImagenController;
use App\Mail\CompraconfirmMail;
use App\Models\Anuncio;
use App\Http\Controllers\VerificarperfilController;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\AvisoLegalController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Cache;
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
// Ruta para login de usuarios
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// Ruta para login de administradores
// Ruta secreta de admin login
Route::get('/bielsa22admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/bielsa22admin/login', [LoginController::class, 'login'])->name('admin.login.post');



Route::get('/ejecutar-cron', function (Request $request) {
    return ejecutarCron($request, 'cron_ejecutado_hoy', '9879879887', [
        'anuncio:vence3',
        'anuncio:vence_hoy'
    ]);
});

Route::get('/ejecutar-cron-finalizacion', function (Request $request) {
    return ejecutarCron($request, 'cron_ejecutado_finalizacion', '9879879887', [
        'anuncio:finalizar'
    ]);
});

/**
 * Función para ejecutar comandos de Artisan con control de ejecución diaria.
 *
 * @param Request $request
 * @param string $cacheKey Clave para registrar la última ejecución
 * @param string $codigoSecreto Código para acceder a la ruta
 * @param array $comandos Lista de comandos de Artisan a ejecutar
 * @return \Illuminate\Http\JsonResponse
 */
function ejecutarCron(Request $request, $cacheKey, $codigoSecreto, $comandos)
{
    try {
        // Verificar el código de acceso
        if ($request->query('code') !== $codigoSecreto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Acceso no autorizado.',
            ], 403);
        }

        // Verificar si ya se ejecutó hoy
        if (Cache::get($cacheKey) === date('Y-m-d')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Las tareas ya se ejecutaron hoy.',
            ], 400);
        }

        // Ejecutar los comandos de Artisan
        $output = [];
        foreach ($comandos as $comando) {
            $output[$comando] = Artisan::call($comando);
        }

        // Registrar la ejecución en caché hasta el final del día
        Cache::put($cacheKey, date('Y-m-d'), now()->endOfDay());

        return response()->json([
            'status' => 'success',
            'message' => 'Tareas ejecutadas correctamente.',
            'output' => $output
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
}

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('get.sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('get.robots');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [PortalController::class, 'index'])->name('index_general');

###Para provincia y municipio pero sin categoría
Route::get('/escort/{provincia}', [PortalController::class, 'index_provincia'])->name('index_provincia');
Route::get('/escort/{provincia}/{municipio}', [PortalController::class, 'index_provincia_municipio'])->name('index_provincia_municipio');
Route::get('/escort/{provincia}/todos/{categoria}',[PortalController::class,'index_categoria_provincia'])->name('index_categoria_provincia');
Route::get('/escort/{provincia}/{municipio}/{categoria}',[PortalController::class,'index_categoria_municipio'])->name('index_categoria_municipio');
###Para provincia y municipio pero con categoría


Route::get('/escort/{provincia?}/{municipio?}', [PortalController::class, 'index'])->name('index');




//Route::get('/escort/{provincia?}/{municipio?}', [PortalController::class, 'index'])->name('index');



Route::get('/escort/{provincia}/{municipio}/{categoria}/{user_id}/{anuncio}', [PortalController::class, 'show'])->name('portal.show');
Route::get('/set_provincia/{provincia}', [PortalController::class, 'set_provincia'])->name('set_provincia');
Route::get('/set_municipio/{municipio}', [PortalController::class, 'set_municipio'])->name('set_municipio');
Route::get('/set_provincia_y_categoria/{provincia}/{categoria}', [PortalController::class, 'set_provincia_y_categoria'])->name('set_provincia_y_categoria');




Route::get('cookies-policy', [CookiesPolicyController::class, 'show'])->name('cookies.policy');

Route::get('aviso_legal', [AvisoLegalController::class, 'show'])->name('aviso_legal');

Route::get('denuncia/{anuncio}', [DenunciaFormController::class, 'form'])->name('denuncia.form');

Route::post('denuncia-send-form/{anuncio}', [DenunciaFormController::class, 'send'])->name('denuncia.send');

Route::get('contact', [ContactFormController::class, 'form'])->name('contact.form');

Route::post('send-form', [ContactFormController::class, 'send'])->name('contact.send');



Route::get('/paypal/process_cambio/{orderId}', [PayPalController::class, 'process_cambio'])->name('paypal.process_cambio');
Route::get('/paypal/process_ext/{orderId}', [PayPalController::class, 'process_ext'])->name('paypal.process_ext');
Route::get('/paypal/process/{orderId}', [PayPalController::class, 'process'])->name('paypal.process');
//Route::get('/paypal/guardar/{data}', [PayPalController::class, 'guardar'])->name('paypal.guardar');



/**
 * Comprobar redsys
 */
Route::get('/redsys/comprobar/{id}', [RedsysController::class, 'comprobar'])->name('redsys.comprobar');
//Route::get('/redsys/notification/{id}', 'RedsysController@comprobar')->name('redsys.comprobar');

Route::post('tpv/response', [RedsysController::class, 'recibir_pago'])->name('redsys.recibir_pago');

Route::post('tpv/response-test', [RedsysController::class, 'recibir_pago_test'])->name('redsys.recibir_pago_test');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    Route::get('/no_valido_ws', [DashboardController::class, 'no_valido_ws'])->name('no_valido_ws');
    Route::get('/validacion_ws', [DashboardController::class, 'enviar_codigo_validacion'])->name('enviar.codigo.validacion');
    Route::post('/verificar_codigows', [DashboardController::class, 'verificar_codigows'])->name('verificar.codigows');

    Route::get('/anuncios/pausar_anuncio/{id}', [AnunciosController::class, 'pausar_anuncio'])->name('pausar_anuncio')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');


    Route::get('/anuncios/reactivar_anuncio/{id}', [AnunciosController::class, 'reactivar_anuncio'])->name('reactivar_anuncio')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');

    Route::get('/upload_imagen_verificar', [VerificarImagenController::class, 'upload_imagen_verificar'])->name('upload_imagen_verificar')->middleware('verifiedphone')->middleware('compropago');




    Route::get('anuncios/quitar_foto_verificacion/{anuncio}', [VerificarperfilController::class, 'quitar_foto_verificacion'])->name('quitar_foto_verificacion')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::get('/subir_foto_valida/{user}', [VerificarperfilController::class, 'subir_foto_valida'])->name('subir_foto_valida')->middleware('verifiedphone')->middleware('compropago');
    Route::post('/verificar_perfil/{user}', [VerificarperfilController::class, 'verificar_perfil'])->name('verificar_perfil')->middleware('verifiedphone')->middleware('compropago');


    // Route::post('anuncios/{anuncio}/guardar_video', [AnuncioController::class, 'guardar_video'])->name('anuncios.guardar_video');
    // Route::get('anuncios/{anuncio}/cargar_video', [AnuncioController::class, 'cargar_video'])->name('anuncios.cargar_video');

    Route::post('anuncios/imagenes_guardar_orden/{anuncio}', [AnunciosController::class, 'imagenes_guardar_orden'])->name('imagenes_guardar_orden')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::get('anuncios/ordenar_imagenes/{anuncio}', [AnunciosController::class, 'ordenar_imagenes'])->name('ordenar_imagenes')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');

    Route::post('anuncios/eliminar_imagen', [AnunciosController::class, 'eliminar_imagen'])->name('eliminar_imagen')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::post('anuncios/guardar_imagenes/{anuncio}', [AnunciosController::class, 'guardar_imagenes'])->name('guardar_imagenes')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::post('anuncios/guardar_imagen/{anuncio}', [AnunciosController::class, 'guardar_imagen'])->name('guardar_imagen')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::get('/anuncios/subir_imagenes/{anuncio}', [AnunciosController::class, 'subir_imagenes'])->name('subir_imagenes')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::post('anuncios/pagar_extension_anuncio/{anuncio}', [AnunciosController::class, 'pagar_extension_anuncio'])->name('pagar_extension_anuncio')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('/mensaje', [MensajeController::class, 'test'])->name('mensaje.enviar');
    Route::get('/dashboard/edit_anuncio/{anuncio?}', [DashboardController::class, 'edit_anuncio'])->name('edit_anuncio')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('/dashboard/{anuncio?}', [DashboardController::class, 'index'])->name('dashboard')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');


    Route::post('/guarda_actualizacion_inicio/{anuncio}', [AnunciosController::class, 'guarda_actualizacion_inicio'])->name('guarda_actualizacion_inicio')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');#->middleware('verifiedphone')->middleware('ensureverificado');
    Route::get('/editar_mi_anuncio/{anuncio}', [AnunciosController::class, 'editar_mi_anuncio'])->name('editar_mi_anuncio')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');#->middleware('verifiedphone');


    Route::get('/registrar_cambio_plan_gratis/{anuncio}/{plan}', [AnunciosController::class, 'registrar_cambio_plan_gratis'])->name('registrar_cambio_plan_gratis')->middleware('verifiedphone');
    Route::post('anuncios/pagar_cambio_plan/{anuncio}', [AnunciosController::class, 'pagar_cambio_plan_anuncio'])->name('pagar_cambio_plan_anuncio')->middleware('verifiedphone'); //->middleware('ensureverificado');
    Route::get('/cambiar_plan_anuncio/{anuncio}/{clase?}', [AnunciosController::class, 'cambiar_plan_anuncio'])->name('cambiar_plan_anuncio')->middleware('verifiedphone');


    Route::get('/registrar_extension_gratis/{anuncio}/{plan}', [AnunciosController::class, 'registrar_extension_gratis'])->name('registrar_extension_gratis')->middleware('verifiedphone');
    Route::get('/registrar_gratis/{anuncio}', [AnunciosController::class, 'registrar_gratis'])->name('registrar_gratis')->middleware('verifiedphone');
    Route::get('/comprar_anuncio_inicio', [AnunciosController::class, 'comprar_anuncio_inicio'])->name('comprar_anuncio_inicio')->middleware('verifiedphone');
    Route::get('/comprar_anuncio', [AnunciosController::class, 'comprar_anuncio'])->name('comprar_anuncio')->middleware('verifiedphone')->middleware('compropago')->middleware('puedecomprar'); //->middleware('ensureverificado')

    Route::post('/guardar_anuncio_inicio', [AnunciosController::class, 'guardar_anuncio_inicio'])->name('guardar_anuncio_inicio')->middleware('verifiedphone');#->middleware('ensureverificado');

    Route::post('/guardar_anuncio', [AnunciosController::class, 'guardar_anuncio'])->name('guardar_anuncio')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('/pagar_anuncio/{anuncio}', [AnunciosController::class, 'pagar_anuncio'])->name('pagar_anuncio')->middleware('verifiedphone');#->middleware('compropago')->middleware('ensureverificado');
    Route::get('/anuncio_show/{anuncio}', [AnunciosController::class, 'anuncio_show'])->name('anuncio_show')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');

    Route::get('/anuncios/a_publicar/{anuncio}', [AnunciosController::class, 'a_publicar'])->name('a_publicar')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('/anuncios/extender_publicacion/{anuncio}', [AnunciosController::class, 'extender_publicacion'])->name('extender_publicacion')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('/anuncios/republicar/{anuncio}', [AnunciosController::class, 'republicar'])->name('republicar')->middleware('verifiedphone')->middleware('compropago');//->middleware('ensureverificado');
    Route::post('/anuncios/pagar_republicar/{anuncio}', [AnunciosController::class, 'pagar_republicar'])->name('pagar_republicar')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');

    Route::get('anuncios/{anuncio}/eliminar_video', [AnunciosController::class, 'eliminar_video'])->name('eliminar_video')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::post('anuncios/{anuncio}/guardar_video', [AnunciosController::class, 'guardar_video'])->name('guardar_video')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');
    Route::get('anuncios/{anuncio}/cargar_video', [AnunciosController::class, 'cargar_video'])->name('cargar_video')->middleware('verifiedphone')->middleware('compropago'); //->middleware('ensureverificado');

});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
