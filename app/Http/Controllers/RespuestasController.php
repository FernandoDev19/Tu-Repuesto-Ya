<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

//Modelos
use App\Models\User;
use App\Models\Provider;
use App\Models\message;
use App\Models\Answer;

//Exportar
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RespuestasExport;

class RespuestasController extends Controller
{
    public function index(): view
    {
        $respuestas = Answer::query()->when(request('search'), function ($query) {
            return $query->whereHas('solicitud', function ($subquery) {
                $subquery->where('id', 'like', '%' . request('search') . '%')
                ->orWhere('nombre', 'like', '%' . request('search') . '%')
                ->orWhere('marca', 'like', '%' . request('search') . '%')
                ->orWhere('referencia', 'like', '%' . request('search') . '%')
                ->orWhere('modelo', 'like', '%' . request('search') . '%')
                ->orWhere('tipo_de_transmision', 'like', '%' . request('search') . '%')
                ->orWhere('repuesto', 'like', '%' . request('search') . '%')
                ->orWhere('nombre', 'like', '%' . request('search') . '%')
                ->orWhere('comentario', 'like', '%' . request('search') . '%')
                ->orWhere('numero', 'like', '%' . request('search') . '%')
                ->orWhere('pais', 'like', '%' . request('search') . '%')
                ->orWhere('departamento', 'like', '%' . request('search') . '%')
                ->orWhere('municipio', 'like', '%' . request('search') . '%');
            })
            ->orWhereHas('proveedor', function ($subquery) {
                $subquery->where('nit_empresa', 'like', '%' . request('search') . '%')
                ->orWhere('razon_social', 'like', '%' . request('search') . '%')
                ->orWhere('celular', 'like', '%' . request('search') . '%')
                ->orWhere('telefono', 'like', '%' . request('search') . '%')
                ->orWhere('representante_legal', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->orWhere('email_secundario', 'like', '%' . request('search') . '%');
            })
            ->orWhereJsonContains('repuesto', request('search'))
            ->orWhere('precio', 'like', '%' . request('search') . '%');
        })
            ->with('proveedor', 'solicitud')
            ->latest()->paginate(15)
            ->withQueryString();

        $name = auth()->user()->name;

        $proveedores = Provider::all();
        $preferencias_de_marcas = [];

        foreach ($proveedores as $proveedor_m) {
            if (is_string($proveedor_m->marcas_preferencias)) {
                // Decodificar la cadena JSON y almacenar las preferencias de marcas en un array asociativo
                $preferencias_de_marcas[$proveedor_m->id] = json_decode($proveedor_m->marcas_preferencias, true);
            }
        }

        $viewMessages = Message::all();

        $usuario = User::where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        return view('admin.respuestas', compact('name', 'respuestas', 'preferencias_de_marcas', 'ft', 'viewMessages'));
    }

    public function exportExcel()
    {
        // Exporta el archivo.xlsx (Excel) de todos los proveedores
        return Excel::download(new RespuestasExport, 'Respuestas.xlsx');
    }
}
