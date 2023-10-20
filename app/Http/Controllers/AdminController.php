<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

//Modelos
use App\Models\Provider;
use App\Models\User;
use App\Models\Solicitude;
use App\Models\Answer;
use App\Models\Geolocation;

//Exportar excel
use App\Exports\ProveedorExport;
use App\Exports\SolicitudesExport;
use App\Exports\RespuestasExport;

use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller

{

    function index()
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Vista principal del administrador
        return view('admin.index', compact('name', 'ft'));
    }

    function profile()
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        if ($usuario) {
            return view('admin.profile', compact('name', 'usuario', 'ft', 'departamentos', 'group'));
        }
    }

    function profileUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                ''
            ]
        );
    }

    function viewSolicitudes()
    {
        $solicitudes = Solicitude::paginate(15);
    
        $name = auth()->user()->name;
    
        $id = auth()->user()->id;
        $user = User::find($id);
        $answers = [];
    
        if ($user) {
            $idP = $user->proveedor_id;
    
            if ($idP !== null) { // Verifica si $idP no es nulo
                // Iterar sobre cada solicitud y buscar respuestas
                foreach ($solicitudes as $solicitud) {
                    $answer = Answer::where('idProveedor', $idP)
                        ->where('idSolicitud', $solicitud->id)
                        ->get();
                    $answers[$solicitud->id] = $answer;
                }
            }
        }
    
        $usuario = User::where('name', $name)->first();
    
        $ft = $usuario->ft_perfil;
    
        return view('admin.solicitudes', compact('name', 'solicitudes', 'ft', 'answers'));
    }
    

    function viewAnswers()
    {
        $respuestas = Answer::with('proveedor', 'solicitud')->paginate(15);

        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        return view('admin.respuestas', compact('name', 'respuestas', 'ft'));
    }

    public function loadProviders()
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $proveedor = Provider::paginate(15);

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        // Retorna la vista de la lista de proveedores, usando compact para enviar los datos a la vista
        return view('livewire.admin.providers', compact('name', 'ft', 'proveedor', 'departamentos', 'group'));
    }

    public function verProveedor($nit, $notificationId)
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $proveedores = Provider::where('nit_empresa', $nit)->first();

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $notification = auth()->user()->unreadNotifications->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        } else {
            if ($proveedores) {
                return redirect()->route('loadProviders')->with('message', 'Proveedor editado exitosamente');
            }
            return redirect()->route('loadProviders')->with('message', 'Proveedor eliminado exitosamente');
        }

        return view('admin.proveedorRegistrado', compact('name', 'ft', 'proveedores', 'departamentos', 'group'));
    }

    public function edit(Request $request)
    {
        // Obtiene el id
        $id = $request->input('id');

        // Se busca al proveedor por el id obtenido
        $proveedor = Provider::find($id);

        // Validacion de datos a editar
        $validator = Validator::make(
            $request->all(),
            [
                'cel_edit' => 'nullable|numeric|digits: 10',
                'tel_edit' => 'nullable|numeric|digits_between:7,10',
                'email_edit' => 'nullable|email'
            ],
            [
                'cel_edit.numeric' => 'El campo celular debe ser un número.',
                'tel_edit.numeric' => 'El campo telefono debe ser un número.',
                'cel_edit.digits' => 'El campo celular debe ser un número de 10 digitos',
                'tel_edit.digits_between' => 'El campo telefono debe ser un número de entre 7 a 10 digitos'
            ]
        );

        // Valida si el valor agregado en el campo ya existe en la base de datos
        $validator->after(function ($validator) use ($request) {
            $cel = "57$request->cel_edit";
            $existingUser = User::where('email', $cel)->first();
            $existingProvider = Provider::where('celular', $cel)->first();

            if ($existingUser || $existingProvider) {
                $validator->errors()->add('cel_edit', 'Este número de celular ya está en uso.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $telefono = $request->input('tel_edit');

            $existingUser = User::where('email', $telefono)->first();
            $existingProvider = Provider::where('telefono', $telefono)->first();

            if ($existingUser || $existingProvider) {
                $validator->errors()->add('tel_edit', 'Este número de teléfono ya está en uso.');
            }
        });


        $validator->after(function ($validator) use ($request) {
            $razon = $request->input('razon_social_edit');

            $existingProvider = Provider::where('razon_social', $razon)->first();

            if ($existingProvider) {
                $validator->errors()->add('razon_social_edit', 'Esta razón social ya está en uso.');
            }
        });

        $validator->after(function ($validator) use ($request) {
            $email = $request->input('email_edit');

            $existingUser = User::where('email', $email)->first();
            $existingProvider = Provider::where('email', $email)->first();

            if ($existingUser || $existingProvider) {
                $validator->errors()->add('email_edit', 'El correo electronico ingresado se encuentra en uso.');
            }
        });

        // Si hay algun fallo, retorna la misma vista pero con los errores y un mensaje de error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', "¡No se pudieron actualizar los datos del proveedor $proveedor->razon_social! Revise nuevamente");
        }

        // Cambia los datos que se encuentran en la base de datos, solo si hay algo escrito en el campo
        if ($request->has('razon_social_edit') && $request->filled('razon_social_edit')) {
            $proveedor->razon_social = $request->input('razon_social_edit');
        }

        if ($request->has('departamento_edit') && $request->filled('departamento_edit')) {
            $proveedor->departamento = $request->input('departamento_edit');
        }

        if ($request->has('municipio_edit') && $request->filled('municipio_edit')) {
            $proveedor->municipio = $request->input('municipio_edit');
        }

        if ($request->has('direccion_edit') && $request->filled('direccion_edit')) {
            $proveedor->direccion = $request->input('direccion_edit');
        }

        if ($request->has('cel_edit') && $request->filled('cel_edit')) {
            $proveedor->celular = "57$request->cel_edit";
        }

        if ($request->has('tel_edit') && $request->filled('tel_edit')) {
            $proveedor->telefono = $request->input('tel_edit');
        }

        if ($request->has('email_edit') && $request->filled('email_edit')) {
            $proveedor->email = $request->input('email_edit');
        }

        if ($request->has('estado_edit') && $request->filled('estado_edit')) {
            $proveedor->estado = $request->input('estado_edit');
        }

        // Guarda los datos en la db (Base de datos)
        $proveedor->save();

        // Obtiene el usuario por id
        $user = User::where('proveedor_id', $id)->first();

        // si el usuario existe se hacen las condicionales if, identicas a las condicionales anteriores
        if ($user) {
            if ($request->has('razon_social_edit') && $request->filled('razon_social_edit')) {
                $user->name = $request->input('razon_social_edit');
            }

            if ($request->has('cel_edit') && $request->filled('cel_edit')) {
                $user->cel = "57$request->cel_edit";
            }

            if ($request->has('tel_edit') && $request->filled('tel_edit')) {
                $user->tel = $request->input('tel_edit');
            }

            if ($request->has('email_edit') && $request->filled('email_edit')) {
                $user->email = $request->input('email_edit');
            }

            // Obtiene la hora actual
            $user->email_verified_at = Carbon::now();
            $user->save();
        }

        return redirect()->back()->with('message', 'Proveedor editado exitosamente');
    }

    public function delete($id)
    {
        $proveedor = Provider::findOrFail($id);

        if ($proveedor) {

            // Obtener la ruta de los archivos asociados al proveedor
            $rutaArchivoRut = $proveedor->rut;
            $rutaArchivoCam = $proveedor->camara_comercio;

            $user = $proveedor->user;

            if ($user) {
                // Eliminar el usuario asociado al proveedor
                $user->delete();
            }

            // Eliminar el proveedor
            $proveedor->delete();

            // Eliminar los archivos asociados al proveedor desde el storage
            if ($rutaArchivoRut and $rutaArchivoCam) {
                Storage::delete('uploads/' . $rutaArchivoRut);
                Storage::delete('uploads/' . $rutaArchivoCam);
            }

            return redirect()->back()->with('message', 'Proveedor eliminado exitosamente');
        }

        return redirect()->back()->with('error', 'No se pudo encontrar el proveedor');
    }

    public function eliminarSolicitud($id)
    {
        $solicitud = Solicitude::findOrFail($id);

        if ($solicitud) {

            // Obtener la ruta de los archivos
            $rutaArchivo = $solicitud->img_repuesto;

            // Eliminar solicitud
            $solicitud->delete();

            // Eliminar los archivos desde el storage
            if ($rutaArchivo) {
                Storage::delete('public/' . $rutaArchivo);
            }

            return redirect()->back()->with('message', 'Solicitud eliminada exitosamente');
        }

        return redirect()->back()->with('error', 'No se pudo encontrar la solicitud');
    }

    public function mostrarArchivo($filename)
    {
        // Ruta del archivo a mostrar
        $rutaArchivo = storage_path('app/uploads/' . $filename);

        // Verificar si el archivo existe
        if (Storage::disk('local')->exists('uploads/' . $filename)) {
            $contenido = file_get_contents($rutaArchivo);

            // Obtener el tipo MIME del archivo
            $tipoMIME = mime_content_type($rutaArchivo);

            return response($contenido)
                ->header('Content-Type', $tipoMIME) // Usar el tipo MIME detectado
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        } else {
            return redirect()->back()->with('error', 'El archivo no existe');
        }
    }

    public function exportExcel()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new ProveedorExport, 'Proveedores.xlsx');
    }

    public function exportExcelSolicitudes()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new SolicitudesExport, 'Solicitudes.xlsx');
    }

    public function exportExcelRespuestas()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new RespuestasExport, 'Respuestas.xlsx');
    }

    public function logout(Request $request)
    {
        //Cierra sesión del usuario

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
