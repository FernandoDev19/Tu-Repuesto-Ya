<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

//Modelos
use App\Models\Keyword;
use App\Models\Category;
use App\Models\Activity_log;

//Exportar
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriasExcelExport;

use Carbon\Carbon;

class CategoriasController extends Controller
{
    public function index(): view
    {
        $category = Category::with('keyword')->get();

        return view('admin.categorias', compact('category'));
    }

    public function store(Request $request)
    {
        $newCategory = new Category();
        $newCategory->nombre_categoria = $request->category;

        try{
            $newCategory->save();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Registró una nueva categoria.';
            $new_log->descripcion = 'Se registró una nueva categoria llamada: ' . $newCategory->nombre_categoria;
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }

            return redirect()->back()->with('message', 'Categoría creada exitosamente');

        }catch(\exception $e){
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = auth()->user()->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $admin,
                'type' => 'template',
                'template' => [
                    'name' => 'errors_reports',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => 'https://turepuestoya.co/administrador/proveedores',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al guardar la categoría: ' . $request->category . 'Detalles: ' . $e->getMessage(),
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $mensaje = json_encode($mensajeData);

            $header = [
                "Authorization: Bearer " . $token,
                "Content-Type: application/json",
            ];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($curl), true);

            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            Log::error('Error al guardar la categoría: ' . $e->getMessage());

            return redirect()->back()->with('error', 'No se pudo crear la nueva categoría. Detalles: ' . $e->getMessage());
        }
    }

    public function destroy($categoria, $id){
        $category = Category::with('keyword')->where('id', $id)->first();
        $keyword = Keyword::where('id_categoria', $id)->get();

        foreach($keyword as $palabra){
            $palabra->delete();
        }
        try{
            $category->delete();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Eliminó una categoria.';
            $new_log->descripcion = 'Se eliminó una categoria llamada: ' . $category->nombre_categoria;
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }
        }catch(\exception $e){
            Log::error('No se puedo eliminar la categoria ' . $category->nombre_categoria);
        }


        return redirect()->back()->with('message', 'Categoria eliminada correctamente');
    }

    public function store_keyword(Request $request, $id): RedirectResponse
    {
        $keyword = new Keyword();
        $keyword->palabra_clave = $request->keyword;
        $keyword->id_categoria = $id;

        $category = Category::where('id', $id)->first();

        try{
            $keyword->save();

            $new_log = new Activity_log();
            $new_log->fecha = Carbon::now();
            if(auth()->check()){
                $new_log->usuario = auth()->user()->name;
            }else{
                $new_log->usuario = 'Desconocido';
            }
            $new_log->actividad = 'Registró una nueva palabra clave.';
            $new_log->descripcion = 'Se registró una nueva palabra clave (' . $keyword->palabra_clave . ') en la categoría ' . "'" . $category->nombre_categoria . "'";
            $new_log->navegador = request()->header('user-agent');
            $new_log->direccion_ip = request()->ip();
            $new_log->role = auth()->user()->role;

            try{
                $new_log->save();
            }catch(\exception $e){
                Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
            }

            return redirect()->back()->with('message', 'Palabra clave creada exitosamente');

        }catch(\exception $e){
            $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
            $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';
            $admin = auth()->user()->cel;

            $mensajeData = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $admin,
                'type' => 'template',
                'template' => [
                    'name' => 'errors_reports',
                    'language' => [
                        'code' => 'es',
                    ],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => 'https://turepuestoya.co/administrador/categorias/' . $category->nombre_categoria,
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Error al guardar la palabra clave: ' . $request->keyword . 'Detalles: ' . $e->getMessage(),
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $mensaje = json_encode($mensajeData);

            $header = [
                "Authorization: Bearer " . $token,
                "Content-Type: application/json",
            ];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = json_decode(curl_exec($curl), true);

            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            Log::error('Error al guardar la palabra clave: ' . $e->getMessage());

            return redirect()->back()->with('error', 'No se pudo crear la nueva palabra clave. Detalles: ' . $e->getMessage());
        }
    }

    public function exportExcel(){
        return Excel::download(new categoriasExcelExport, 'Categorias.xlsx');
    }
}
