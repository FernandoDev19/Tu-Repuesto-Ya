<?php

use Illuminate\Support\Facades\Route;

//Controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\WaController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\RespuestasController;


use App\Jobs\NoticiaWhatsappJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NoticiasProveedores;

//Modelos
use App\Models\Category;
use App\Models\Answer;
use App\Models\Provider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name("servicios");
    Route::get('/formulario-cliente', 'modalUrlView')->name('vistaFormulario');
    Route::post('/validacion', 'validation')->name("validation");
    Route::get('/gracias', 'graciasView')->name('graciasView');
});

Route::controller(UsersController::class)->group(function () {
    Route::get("/iniciar-sesion", "login")->name("login");
    Route::get("/iniciar-sesion/b", "login2")->name("login_outAnimate");
    Route::post("/login/verificacion", "verification")->name("verification");
    Route::get("/registro", "register")->name("register");
    Route::post("/registro/almacenar", "store")->name("store");
    Route::get("/restablecer", "resetPassword")->name("reset-password");
    Route::post("/restablecer/verificacion", "emailVerification")->name("emailVerification");
    Route::get("/cambiar/{token}", "changePasswordToken")->name("change-password-token");
    Route::post("/cambiar/verificacion", "changePasswordVerification")->name("change-password");
});

Route::controller(WaController::class)->group(function () {
    route::get('/webhook', 'webhook');
    route::post('/webhook', 'recibe');
    route::post('/send/{telefono}/{message_content}', 'send')->name('sendMessage');
});

Route::middleware('auth')->group(function () {

    Route::controller(AdminController::class)->group(function(){
        Route::get('/administrador/panel', 'index')->name("dashboard")->middleware('can:dashboard');
        Route::get('/registro-de-actividades', 'activityLogView')->name('activityLog');
        Route::post('/administrador/cerrar-sesion', 'logout')->name("logout");
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::get('administrador/perfil', 'index')->name('profile');
        Route::put('administrador/perfil/actualizar/{id?}', 'update')->name('profileUpdate');
    });

    Route::controller(WaController::class)->group(function(){
        Route::get('/administrador/chat-whatsapp-api', 'index')->name('chatView')->middleware(('can:providers.loadProviders'));
    });

    Route::controller(ProvidersController::class)->group(function(){
        Route::get('/administrador/proveedores', 'index')->name("loadProviders")->middleware('can:providers.loadProviders');
        Route::get('/administrador/proveedor/{nit}/{notificationId}', 'show')->name('verProveedor')->middleware('can:notifications.viewNotifications');
        Route::post('/administrador/proveedores/crear', 'store')->name("createProvider")->middleware('can:providers.loadProviders');
        Route::put('/administrador/proveedores/editar', 'update')->name('editarProveedor')->middleware('can:providers.edit');
        Route::delete('/administrador/proveedor/borrar/{id}', 'destroy')->name('eliminarProveedor')->middleware('can:providers.delete');
        Route::get('/administrador/ver-archivo/{filename}', 'viewFiles')->name('mostrarArchivo')->middleware('can:view.files');
        Route::get('/administrador/proveedores/exportar-excel-providers', 'exportExcel')->name('proveedores.excel')->middleware('can:providers.exportExcel');
    });

    Route::controller(SolicitudesController::class)->group(function(){
        Route::get('/administrador/solicitudes', 'index')->name('viewSolicitudes')->middleware('can:solicitudes.view');
        Route::get('/proveedor/{idSoli}/{idNoti}', 'show')->name('verSolicitudNoti')->middleware('can:notifications.viewNotifications');
        Route::delete('/administrador/solicitud/borrar/{id}', 'destroy')->name('eliminarSolicitud')->middleware('can:solicitudes.delete');
        Route::get('/administrador/solicitudes/exportar-excel-solicitudes', 'exportExcel')->name('solicitudes.excel')->middleware('can:solicitudes.exportExcel');
    });

    Route::controller(RespuestasController::class)->group(function(){
        Route::get('/administrador/respuestas', 'index')->name('viewRespuestas')->middleware('can:answers.view');
        Route::get('/administrador/respuestas/exportar-excel-respuestas', 'exportExcel')->name('respuestas.excel')->middleware('can:answers.exportExcel');
    });

    Route::controller(CategoriasController::class)->group(function(){
        Route::get('/categorias', 'index')->name('keywords')->middleware('can:providers.loadProviders');
        Route::post('/categorias/nueva-categoria', 'store')->name('saveCategory')->middleware('can:providers.loadProviders');
        Route::get('/categorias/{categoria}/{id}', function ($categoria, $id) {
            $category = Category::with('keyword')->get();
            return view('admin.keywords.keyword', compact('id', 'categoria', 'category'));
        })->middleware('can:providers.loadProviders');
        Route::delete('/categorias/{categoria}/{id}/eliminar', 'destroy')->middleware('can:providers.loadProviders');
        Route::post('/palabras-claves/crear/{id}', 'store_keyword')->name('saveKeyword')->middleware('can:providers.loadProviders');
        Route::get('/administrador/categorias/exportar-excel-categorias', 'exportExcels')->name('categorias.excel')->middleware('can:providers.exportExcel');

    });

    Route::controller(HomeController::class)->group(function () {
        Route::post('/validacion/{codigo}', 'storeDP')->name("validationDP");
        Route::get('/solicitud/{codigo}/{id?}', 'solicitudRepuesto')->name('solicitud');
        Route::get('/solicitud/{filename}', 'verImagenSolicitud')->name('verImagen');
    });

    Route::get('/administrador/marcar-todo-como-leido', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('marcarLeidas')->middleware('can:notifications.readNotifications');
});

Route::get('public/img/logo_whatsapp.png', function () {
    $imgPath = public_path('img/logo_whatsapp.png');

    return Response::make(file_get_contents($imgPath), 200, [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'inline; filename=logo_whatsapp.png',
    ]);
})->name('video');

// Route::get('public/movies/video_trya.mp4', function () {
//     $videoPath = public_path('movies/video_trya.mp4');

//     return Response::make(file_get_contents($videoPath), 200, [
//         'Content-Type' => 'video/mp4',
//         'Content-Disposition' => 'inline; filename=video_trya.mp4',
//     ]);
// })->name('video_trya');

Route::get('/politica-de-privacidad', function () {
    $name = null;

    if (auth()->check()) {
        $name = auth()->user()->name;
    }

    return view('privacy-policy', compact('name'));
})->name('privacy-policy');

// Route::get('/enviar-mensajes', function () {
//     $proveedores = Provider::all()->where('estado', 1);

//     foreach ($proveedores as $proveedor) {
//         $answer = Answer::where('idProveedor', $proveedor->id)->exists();

//         if (!$answer) {
//             NoticiaWhatsappJob::dispatch(
//                 $proveedor,
//                 $proveedor->celular
//             );
//             Log::info('Enviado a ' . $proveedor->razon_social);

//             $data = [
//                 'email' => $proveedor->email,
//                 'celular' => $proveedor->celular
//             ];

//             Mail::to($proveedor->email)->cc($proveedor->email_secundario)->queue(new NoticiasProveedores($data));
//         }
//     }
// });

Route::controller(WaController::class)->group(function(){
    Route::get('/send_message_template/{$messageId}', 'sendToClient');
});

