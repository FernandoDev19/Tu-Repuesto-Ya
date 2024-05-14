<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

//Modelos
use App\Models\User;
use App\Models\Provider;
use App\Models\Activity_log;
use App\Models\message;
use App\Models\Solicitude;
use App\Models\Answer;

//Exportar
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SolicitudesExport;

use Carbon\Carbon;

class SolicitudesController extends Controller
{
    public function index(): view
    {
        //Para hacer busquedas y filtrar la tabla, se usa when('name del campo buscar', function($variable){ return $variable->where()->orWhere() })
        $solicitudes = Solicitude::query()->when(request('search'), function ($query) {
            return $query->where('id', 'like', '%' . request('search') . '%')
                ->orWhere('codigo', request('search'))
                ->orWhere('respuestas', 'like', '%' . request('search') . '%')
                ->orWhere('marca', 'like', '%' . request('search') . '%')
                ->orWhere('referencia', 'like', '%' . request('search') . '%')
                ->orWhere('modelo', 'like', '%' . request('search') . '%')
                ->orWhere('tipo_de_transmision', 'like', '%' . request('search') . '%')
                ->orWhereJsonContains('repuesto', request('search'))
                ->orWhereJsonContains('categoria', request('search'))
                ->orWhere('nombre', 'like', '%' . request('search') . '%')
                ->orWhere('correo', 'like', '%' . request('search') . '%')
                ->orWhere('comentario', 'like', '%' . request('search') . '%')
                ->orWhere('numero', 'like', '%' . request('search') . '%')
                ->orWhere('pais', 'like', '%' . request('search') . '%')
                ->orWhere('departamento', 'like', '%' . request('search') . '%')
                ->orWhere('municipio', 'like', '%' . request('search') . '%');
        })->latest()->paginate(15)->withQueryString();

        $name = auth()->user()->name;

        $id = auth()->user()->id;
        $user = User::find($id);
        $answers = [];


        if ($user) {
            $idP = $user->proveedor_id;
            if ($idP !== null) {
                foreach ($solicitudes as $solicitud) {
                    $answer = Answer::where('idProveedor', $idP)
                        ->where('idSolicitud', $solicitud->id)
                        ->get();
                    $answers[$solicitud->id] = $answer;
                }
            }
        }

        $answer2 = null;
        $messages = null;

        foreach ($solicitudes as $solicitud) {
            $answer2 = Answer::with('proveedor')->get();
            $messages = message::where('idSolicitud', '!=', null)->get();

        }
        $viewMessages = Message::all();

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $proveedores = Provider::all();

        return view('admin.solicitudes', compact('name', 'solicitudes', 'ft', 'answers', 'answer2', 'messages', 'proveedores', 'viewMessages'));
    }

    public function show(int $idSoli, $idNoti):view
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        $solicitud = Solicitude::where('id', $idSoli)->first();

        $notification = auth()->user()->unreadNotifications->find($idNoti);

        if ($notification) {
            $notification->markAsRead();
        }

        return view('admin.nuevaSolicitudRepuesto', compact('name', 'ft', 'solicitud'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $solicitud = Solicitude::findOrFail($id);

        if ($solicitud) {

            // Obtener la ruta de los archivos
            $rutaArchivo = json_decode($solicitud->img_repuesto);

            $answer = Answer::where('idSolicitud', $id);

            $answer->delete();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Eliminó una solicitud.';
            $new_log->descripcion = 'Se eliminó la solicitud N° ' . $solicitud->id . '(ID) con todas sus respuestas desde el administrador';
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }

            // Eliminar solicitud
            $solicitud->delete();

            // Eliminar los archivos desde el storage
            if ($rutaArchivo) {
                foreach ($rutaArchivo as $archivo) {
                    Storage::delete('public/' . $archivo);
                }
            }

            return redirect()->back()->with('message', 'Solicitud eliminada exitosamente');
        }

        return redirect()->back()->with('error', 'No se pudo encontrar la solicitud');
    }

    public function exportExcel()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new SolicitudesExport, 'Solicitudes.xlsx');
    }
}
