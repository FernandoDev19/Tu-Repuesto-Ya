<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

//Modelos
use App\Models\User;
use App\Models\Provider;
use App\Models\Activity_log;
use App\Models\Country_code;
use App\Models\Geolocation;
use App\Models\Category;

//Exportar
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SolicitudesExport;

use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(): view
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        // Lista de codigos celulares
        $codigos = Country_code::all();

        $usuario = User::with('proveedor')->where('name', $name)->first();

        $ft = $usuario->ft_perfil;

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        $categorias = Category::where('nombre_categoria', '!=', 'Prueba')->get();

        if ($usuario) {
            return view('admin.profile', compact('name', 'usuario', 'ft', 'departamentos', 'group', 'codigos', 'categorias'));
        }
    }

    function update(Request $request, $id_provider = null)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'nullable',
                'cel' => 'nullable|numeric|digits_between:7,11',
                'tel' => 'nullable|numeric|digits_between:8,10',
                'email' => 'nullable|email',
                'password' => [
                    'nullable',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d.@!¡?¿]{8,}$/',
                ],
                'confirm_password' => 'nullable|same:password',
                'nit' => 'nullable|numeric|digits_between:8,15',
            ],
            [
                'cel.numeric' => 'Este campo solo permite números',
                'cel.digits_between' => 'Este campo contiene muchos o pocos digitos',
                'tel.numeric' => 'Este campo solo permite números',
                'tel.digits_between' => 'Este campo contiene muchos o pocos digitos',
                'password.regex' => 'La contraseña no es segura. Debe incluir al menos 8 caracteres, 1 número, una mayúscula y una minúscula.',
                'confirm_password.same' => 'Las contraseñas no coinciden',

            ]
        );

        if (auth()->check() && auth()->user()->hasRole('Admin')) {
            // Validar si el name ya está registrado
            $validator->after(function ($validator) use ($request) {
                $name = $request->input('name');

                // Verificar si el nombre existe en la tabla de usuarios
                $userWithName = User::where('name', $name)->first();

                if ($userWithName) {
                    $validator->errors()->add('name', 'Este nombre de usuario ya está registrado.');
                }
            });

            // Validar si el celular ya está registrado
            $validator->after(function ($validator) use ($request) {
                $cel = $request->input('cel');

                // Verificar si el celular existe en la tabla de usuarios
                $userWithCel = User::where('cel', $cel)->first();

                // Verificar si el celular existe en la tabla de proveedores
                $providerWithCel = Provider::where('celular', $cel)->first();

                if ($userWithCel || $providerWithCel) {
                    $validator->errors()->add('cel', 'Este número de celular ya está registrado.');
                }
            });

            if ($request->has('tel') && $request->filled('tel')) {
                // Validar si el telefono ya está registrado
                $validator->after(function ($validator) use ($request) {
                    $tel = $request->input('tel');

                    // Verificar si el telefono existe en la tabla de usuarios
                    $userWithTel = User::where('tel', $tel)->first();

                    // Verificar si el telefono existe en la tabla de proveedores
                    $providerWithTel = Provider::where('telefono', $tel)->first();

                    if ($userWithTel || $providerWithTel) {
                        $validator->errors()->add('tel', 'Este número de telefono ya está registrado.');
                    }
                });
            }

            if ($request->has('email') && $request->filled('email')) {
                // Validar si el correo electronico ya está registrado
                $validator->after(function ($validator) use ($request) {
                    $email = $request->input('email');

                    // Verificar si el correo electrónico existe en la tabla de usuarios
                    $userWithEmail = User::where('email', $email)->first();

                    // Verificar si el correo electrónico existe en la tabla de proveedores
                    $providerWithEmail = Provider::where('email', $email)->first();

                    if ($userWithEmail || $providerWithEmail) {
                        $validator->errors()->add('email', 'Este correo electrónico ya está registrado.');
                    }
                });
            }

            $validator->after(function ($validator) use ($request) {
                $pass = bcrypt($request->password);
                $idUser = auth()->user()->id;

                $userWithPass = User::find($idUser);

                if ($pass == $userWithPass->password) {
                    $validator->errors()->add('password', 'Ya tienes en uso esta contraseña');
                }
            });
        }

        if (auth()->check() && auth()->user()->hasRole('Proveedor')) {

            if ($request->has('email') && $request->filled('email')) {
                // Validar si el correo electrónico ya está registrado
                $validator->after(function ($validator) use ($request) {
                    $email = $request->input('email');

                    // Verificar si el correo electrónico existe en la tabla de usuarios
                    $userWithEmail = User::where('email', $email)->first();

                    // Verificar si el correo electrónico existe en la tabla de proveedores
                    $providerWithEmail = Provider::where('email', $email)->first();

                    if ($userWithEmail || $providerWithEmail) {
                        $validator->errors()->add('email', 'Este correo electrónico ya está registrado.');
                    }
                });
            }

            // Validar si el NIT ya está registrado
            $validator->after(function ($validator) use ($request) {
                $nit = $request->input('nit');
                $existingProvider = Provider::where('nit_empresa', $nit)->first();

                if ($existingProvider) {
                    $validator->errors()->add('nit', 'Este NIT ya está registrado.');
                }
            });

            // Validar si la razón social ya está registrada
            $validator->after(function ($validator) use ($request) {
                $razon = $request->input('razon');
                $existingProvider = Provider::where('razon_social', $razon)->first();

                if ($existingProvider) {
                    $validator->errors()->add('razon', 'Esta razón social ya está registrada.');
                }
            });

            // Validar si el número de celular ya está registrado
            $validator->after(function ($validator) use ($request) {
                $cel = $request->input('cel');

                $existingUser = User::where('cel', $cel)->first();
                $existingProvider = Provider::where('celular', $cel)->first();

                if ($existingUser || $existingProvider) {
                    $validator->errors()->add('cel', 'Este número de celular ya está registrado.');
                }
            });

            // Validar si el número de telefono ya está registrado
            $validator->after(function ($validator) use ($request) {
                $tel = $request->tel;

                $existingUser = User::where('tel', $tel)->where('tel', '!=', "")->first();
                $existingProvider = Provider::where('telefono', $tel)->where('telefono', '!=', "")->first();

                if ($existingUser || $existingProvider) {
                    $validator->errors()->add('tel', 'Este número de celular ya está en uso');
                }
            });

            // Validar el tamaño del archivo RUT
            $validator->after(function ($validator) use ($request) {
                $maxFileSize = 5024 * 1024; // Tamaño máximo en bytes (5 MB)
                $rutFile = $request->file('rut');

                if ($rutFile && $rutFile->getSize() > $maxFileSize) {
                    $validator->errors()->add('rut', 'El archivo RUT es demasiado grande. El tamaño máximo permitido es 5 MB.');
                }
            });

            // Validar el tamaño del archivo de la Cámara de Comercio
            $validator->after(function ($validator) use ($request) {
                $maxFileSize = 5024 * 1024; // Tamaño máximo en bytes (5 MB)
                $camFile = $request->file('cam');

                if ($camFile && $camFile->getSize() > $maxFileSize) {
                    $validator->errors()->add('cam', 'El archivo de la Cámara de Comercio es demasiado grande. El tamaño máximo permitido es 5 MB.');
                }
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'No se pudieron guardar los cambios');
        }

        if (auth()->check() && auth()->user()->hasRole('Admin')) {

            $id = auth()->user()->id;

            $userUpdate = User::findOrFail($id);

            if ($request->has('name') && $request->filled('name')) {
                $userUpdate->name = $request->input('name');
            }

            if ($request->has('cel') && $request->filled('cel')) {
                $userUpdate->cel = $request->input('cel');
            }

            if ($request->has('tel') && $request->filled('tel')) {
                $userUpdate->tel = $request->codigo_cel . $request->input('tel');
            }

            if ($request->has('email') && $request->filled('email')) {
                $userUpdate->email = $request->codigo_cel . $request->input('tel');
            }

            if ($request->has('password') && $request->filled('password')) {
                $userUpdate->password = bcrypt($request->password);
            }
            try {
                $userUpdate->save();

                $new_log = new Activity_log();
                $new_log->fecha = Carbon::now();
                if(auth()->check()){
                    $new_log->usuario = auth()->user()->name;
                }else{
                    $new_log->usuario = 'Desconocido';
                }
                $new_log->actividad = 'Ha iniciado sesión.';
                $new_log->descripcion = 'Se ha iniciado una sesión';
                $new_log->navegador = request()->header('user-agent');
                $new_log->direccion_ip = request()->ip();
                $new_log->role = 'Admin';

                try{
                    $new_log->save();
                }catch(\exception $e){
                    Log::error('Error al registrar la nueva actividad: ' . $e->getMessage());
                }
            } catch (\exception $e) {
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
                                        'text' => 'https://turepuestoya.co/administrador/perfil',
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => 'Error al guardar datos del Administrador. ' . $e->getMessage(),
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

                return redirect()->back()->whithErrors($validator)->with('error', 'Error al guardar. ' . $e->getMessage());
            }
        }

        if (auth()->check() && auth()->user()->hasRole('Proveedor')) {

            $userUpdate = Provider::findOrFail($id_provider);

            $id = auth()->user()->id;

            $account = User::findOrFail($id);

            if ($request->has('nit') && $request->filled('nit')) {
                $userUpdate->nit = $request->input('nit');
            }

            if ($request->has('nombre_establecimiento') && $request->filled('nombre_establecimiento')) {
                $userUpdate->nombre_comercial = $request->input('nombre_establecimiento');
            }

            if ($request->has('razon_social') && $request->filled('razon_social')) {
                $userUpdate->razon_social = $request->input('tel');
            }

            if ($request->has('departamento') && $request->filled('departamento')) {
                $userUpdate->departamento = $request->input('departamento');
            }

            if ($request->has('municipio') && $request->filled('municipio')) {
                $userUpdate->municipio = $request->input('municipio');
            }

            if ($request->has('pais') && $request->filled('pais')) {
                $userUpdate->pais = $request->input('pais');
            }

            if ($request->has('ciudad') && $request->filled('ciudad')) {
                $userUpdate->municipio = $request->input('ciudad');
            }

            if ($request->has('direccion') && $request->filled('direccion')) {
                $userUpdate->direccion = $request->input('direccion');
            }

            if ($request->has('cel') && $request->filled('cel')) {
                $userUpdate->celular = $request->codigo_cel . $request->input('cel');
                $account->cel = $request->codigo_cel . $request->input('cel');
            }

            if ($request->has('tel') && $request->filled('tel')) {
                $userUpdate->telefono = $request->codigo_cel . $request->input('tel');
                $account->tel = $request->codigo_cel . $request->input('tel');
            }

            if ($request->has('representante_legal') && $request->filled('representante_legal')) {
                $userUpdate->representante_legal = $request->input('representante_legal');
            }

            if ($request->has('contacto_principal') && $request->filled('contacto_principal')) {
                $userUpdate->contacto_principal = $request->input('contacto_principal');
            }

            if ($request->has('email') && $request->filled('email')) {
                $userUpdate->email = $request->input('email');
                $account->email = $request->input('email');
            }

            if ($request->has('email2') && $request->filled('email2')) {
                $userUpdate->email_secundario = $request->input('email2');
                $account->email_secundario = $request->input('email2');
            }

            if ($request->json_marcas) {
                $cleanedMarcas = str_replace(["×", "\n", "\r"], "", $request->json_marcas);
                $userUpdate->marcas_preferencias = $cleanedMarcas;
            }

            if ($request->json_categorias) {
                $cleanedCategorias = str_replace(["×", "\n", "\r"], "", $request->json_categorias);
                $userUpdate->especialidad = $cleanedCategorias;
            }

            if ($request->has('password') && $request->filled('password')) {
                $userUpdate->password = bcrypt($request->password);
                $account->password = bcrypt($request->password);
            }

            // if($request->has('password') && $request->filled('password')){
            //     $userUpdate->password = bcrypt($request->password);
            // }

            try {
                $userUpdate->save();
                $account->save();
            } catch (\exception $e) {
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
                                        'text' => 'https://turepuestoya.co/administrador/perfil',
                                    ],
                                    [
                                        'type' => 'text',
                                        'text' => 'Error al guardar datos del Proveedor. ' . $e->getMessage(),
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

                return redirect()->back()->withErrors($validator)->with('error', 'Error al guardar. ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('message', 'Los datos se han guardado correctamente');
    }
}
