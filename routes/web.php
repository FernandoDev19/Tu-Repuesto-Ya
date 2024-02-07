<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProveedorController;

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
    Route::post('/validation', 'validation')->name("validation");
});

Route::controller(UsersController::class)->group(function () {
    Route::get("/login", "login")->name("login");
    Route::get("/loginb", "login2")->name("login_outAnimate");
    Route::post("/login/verification", "verification")->name("verification");
    Route::get("/register", "register")->name("register");
    Route::post("/register/store", "store")->name("store");
    Route::get("/reset-Password", "resetPassword")->name("reset-password");
    Route::post("/reset-Password/email-Verification", "emailVerification")->name("emailVerification");
    Route::get("/change-Password/{token}", "changePasswordToken")->name("change-password-token");
    Route::post("/change-Password/verification", "changePasswordVerification")->name("change-password");
});

Route::middleware(['auth', 'checkProveedor'])->group(function () {
    Route::get('/provider/{idSoli}/{idNoti}', [ProveedorController::class, 'verSolicitudNoti'])->name('verSolicitudNoti')->middleware('can:notifications.viewNotifications');
});

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::post('/validation/{codigo}', 'storeDP')->name("validationDP");
        Route::get('/solicitud/{codigo}/{id?}', 'solicitudRepuesto')->name('solicitud');
        Route::get('/solicitud/{filename}', 'verImagenSolicitud')->name('verImagen');
    });

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name("dashboard")->middleware('can:dashboard');
    /*Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/profile/update', [AdminController::class, 'profileUpdate'])->name('profileUpdate');*/
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profileUpdate');
    Route::get('/admin/provider/{nit}/{notificationId}', [AdminController::class, 'verProveedor'])->name('verProveedor')->middleware('can:notifications.viewNotifications');
    Route::get('markAsRead', function (){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('marcarLeidas')->middleware('can:notifications.readNotifications');
    Route::get('/admin/solicitudes', [AdminController::class, 'viewSolicitudes'])->name('viewSolicitudes')->middleware('can:solicitudes.view');
    Route::get('/admin/solicitudes/export-excel-solicitudes', [AdminController::class, 'exportExcelSolicitudes'])->name('solicitudes.excel')->middleware('can:solicitudes.exportExcel');
    Route::delete('/admin/solicitud/delete/{id}', [AdminController::class, 'eliminarSolicitud'])->name('eliminarSolicitud')->middleware('can:solicitudes.delete');
    Route::get('/admin/answers', [AdminController::class, 'viewAnswers'])->name('viewRespuestas')->middleware('can:answers.view');
    Route::get('/admin/answers/export-excel-answers', [AdminController::class, 'exportExcelRespuestas'])->name('respuestas.excel')->middleware('can:answers.exportExcel');
    Route::post('/admin/providers/create', [AdminController::class, 'createProvider'])->name("createProvider")->middleware('can:providers.loadProviders');
    Route::get('/admin/providers', [AdminController::class, 'loadProviders'])->name("loadProviders")->middleware('can:providers.loadProviders');
    Route::get('/admin/providers/export-excel-providers', [AdminController::class, 'exportExcel'])->name('proveedores.excel')->middleware('can:providers.exportExcel');
    Route::post('/admin/providers/edit', [AdminController::class, 'edit'])->name('editarProveedor')->middleware('can:providers.edit');
    Route::delete('/admin/providers/delete/{id}', [AdminController::class, 'delete'])->name('eliminarProveedor')->middleware('can:providers.delete');
    Route::get('/admin/view-file/{filename}', [AdminController::class, 'mostrarArchivo'])->name('mostrarArchivo')->middleware('can:view.files');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name("logout");
});


Route::get('/privacy_policy_TRYA', function(){
     $name = null;

    if (auth()->check()) {
        $name = auth()->user()->name;
    }

    return view('privacy-policy', compact('name'));
})->name('privacy-policy');
