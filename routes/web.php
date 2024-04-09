<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProveedorController;
use App\Livewire\KeyWords;
use App\Models\Category;

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

/*Route::get('/', function(){
   return view('mantenimiento');
});*/

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

Route::middleware(['auth', 'checkProveedor'])->group(function () {
    Route::get('/proveedor/{idSoli}/{idNoti}', [ProveedorController::class, 'verSolicitudNoti'])->name('verSolicitudNoti')->middleware('can:notifications.viewNotifications');
});

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::post('/validacion/{codigo}', 'storeDP')->name("validationDP");
        Route::get('/solicitud/{codigo}/{id?}', 'solicitudRepuesto')->name('solicitud');
        Route::get('/solicitud/{filename}', 'verImagenSolicitud')->name('verImagen');
    });
    
    Route::get('/categorias', [AdminController::class, 'categoriesView'])->name('keywords');
    Route::get('/categorias/{categoria}/{id}', function($categoria, $id){
        $category = Category::with('keyword')->get();
        return view('admin.keywords.keyword', compact('id', 'categoria', 'category'));
    });

    Route::post('/palabras-claves/crear/{id}', [AdminController::class, 'saveKeyword'])->name('saveKeyword');
    
    Route::get('/registro-de-actividades', [AdminController::class, 'activityLogView'])->name('activityLog');
        
    Route::post('/categorias/nueva-categoria', [AdminController::class, 'saveCategory'])->name('saveCategory');

    Route::get('/administrador/panel', [AdminController::class, 'index'])->name("dashboard")->middleware('can:dashboard');
    /*Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/profile/update', [AdminController::class, 'profileUpdate'])->name('profileUpdate');*/
    Route::get('administrador/perfil', [AdminController::class, 'profile'])->name('profile');
    Route::post('administrador/perfil/actualizar/{id?}', [AdminController::class, 'profileUpdate'])->name('profileUpdate');
    Route::get('/administrador/proveedor/{nit}/{notificationId}', [AdminController::class, 'verProveedor'])->name('verProveedor')->middleware('can:notifications.viewNotifications');
    Route::get('/administrador/marcar-todo-como-leido', function (){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('marcarLeidas')->middleware('can:notifications.readNotifications');
    Route::get('/administrador/solicitudes', [AdminController::class, 'viewSolicitudes'])->name('viewSolicitudes')->middleware('can:solicitudes.view');
    Route::get('/administrador/solicitudes/exportar-excel-solicitudes', [AdminController::class, 'exportExcelSolicitudes'])->name('solicitudes.excel')->middleware('can:solicitudes.exportExcel');
    Route::delete('/administrador/solicitud/borrar/{id}', [AdminController::class, 'eliminarSolicitud'])->name('eliminarSolicitud')->middleware('can:solicitudes.delete');
    Route::get('/administrador/respuestas', [AdminController::class, 'viewAnswers'])->name('viewRespuestas')->middleware('can:answers.view');
    Route::get('/administrador/respuestas/exportar-excel-respuestas', [AdminController::class, 'exportExcelRespuestas'])->name('respuestas.excel')->middleware('can:answers.exportExcel');
    Route::post('/administrador/proveedores/crear', [AdminController::class, 'createProvider'])->name("createProvider")->middleware('can:providers.loadProviders');
    Route::get('/administrador/proveedores', [AdminController::class, 'loadProviders'])->name("loadProviders")->middleware('can:providers.loadProviders');
    Route::get('/administrador/proveedores/exportar-excel-providers', [AdminController::class, 'exportExcel'])->name('proveedores.excel')->middleware('can:providers.exportExcel');
    Route::post('/administrador/proveedores/editar', [AdminController::class, 'edit'])->name('editarProveedor')->middleware('can:providers.edit');
    Route::delete('/administrador/proveedor/borrar/{id}', [AdminController::class, 'delete'])->name('eliminarProveedor')->middleware('can:providers.delete');
    Route::get('/administrador/ver-archivo/{filename}', [AdminController::class, 'mostrarArchivo'])->name('mostrarArchivo')->middleware('can:view.files');
    Route::post('/administrador/cerrar-sesion', [AdminController::class, 'logout'])->name("logout");
});

Route::get('public/img/logo_whatsapp.png', function () {
    $imgPath = public_path('img/logo_whatsapp.png');

    return Response::make(file_get_contents($imgPath), 200, [
        'Content-Type' => 'image/png',
        'Content-Disposition' => 'inline; filename=logo_whatsapp.png',
    ]);
})->name('video');

Route::get('/politica-de-privacidad', function(){
     $name = null;

    if (auth()->check()) {
        $name = auth()->user()->name;
    }

    return view('privacy-policy', compact('name'));
})->name('privacy-policy');
