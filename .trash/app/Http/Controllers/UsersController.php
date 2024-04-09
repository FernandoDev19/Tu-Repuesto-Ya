<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use App\Models\Country_code;
use App\Models\Geolocation;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Mail\RegistroProveedorMail;
use App\Mail\RestablecerContrasenia;

use App\Notifications\NuevoProveedorRegistrado;


class UsersController extends Controller
{
    public function login(Request $request): view
    {
        return view('auth.login-v1');
    }

    public function login2(Request $request): view
    {
        return view('auth.login-v2');
    }

    public function verification(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            if ($user) {

                $request->session()->regenerate();

                if ($user->role === 'Admin') {
                    return redirect()->intended(route('dashboard'));
                } elseif ($user->role === 'Proveedor') {
                    if (!$user->proveedor->estado) {
                        // El usuario es un proveedor con cuenta inactiva
                        auth()->logout();
                        return redirect()->route('login_outAnimate')->withErrors([
                            'email' => 'Tu cuenta está inactiva. Contacta al administrador para obtener acceso.',
                        ]);
                    }

                    return redirect()->intended(route('dashboard'));
                }
            } else {
                // No se pudo obtener el usuario autenticado
                auth()->logout();
                return redirect()->route('login_outAnimate')->withErrors([
                    'email' => 'Error al autenticar al usuario.',
                ]);
            }
        }

        return redirect()->route('login_outAnimate')->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function resetPassword(): view
    {
        $proveedores = Provider::all();
        return view("auth.reset-password", compact('proveedores'));
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->orWhere('email_secundario', $request->email)->first();

        if ($user) {
            // Genera un token único
            $token = Str::random(60);

            // Asigna el token al usuario en la base de datos
            $user->remember_token = $token;
            $user->save();

            $email = [
                'name' => $user->name,
                'email' => $request->email,
                'token' => $token, // Pasamos el token al correo
            ];

            Mail::to($request->email)->send(new RestablecerContrasenia($email));

            return redirect()->route('login_outAnimate')->with('message', 'Se ha enviado un correo con instrucciones para cambiar la contraseña.');
        }

        return back()->withErrors([
            'email' => 'No se encontró una cuenta con el correo proporcionado.',
        ]);
    }

    public function changePasswordToken($token)
    {
        // Verifica si el token es válido y si existe un usuario con ese token
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            $email = $user->email;
        }
        if (!$user) {
            // Si el token no es válido, muestra un mensaje de error o redirecciona a otra página
            return redirect()->route('login')->with('error', 'El enlace no es válido.');
        }

        // Si el token es válido, muestra la vista para cambiar la contraseña
        return view('auth.change-password', ['token' => $token], compact('email'));
    }

    public function changePasswordVerification(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required', // Requisitos de seguridad de contraseña
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d.@!¡?¿]{8,}$/',
            ],
            'confirm-password' => 'required|same:password', // Debe coincidir con la contraseña
        ], [
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.regex' => 'La contraseña no es segura. Debe incluir al menos 8 caracteres, 1 número, una mayúscula y una minúscula.',
            'confirm-password.required' => 'El campo confirmar contraseña es obligatorio.',
            'confirm-password.same' => 'Las contraseñas no coinciden.',
        ]);

        // Buscar al usuario por su dirección de correo electrónico
        $user = User::where('email', $request->email)->first();

        // Comprobar que el correo electrónico en el formulario coincide con el de la URL
        if ($request->email !== $request->input('email')) {
            return back()->withErrors([
                'email' => 'El correo electrónico no coincide con el enlace original.',
            ]);
        }

        if ($user) {
            // Generar un nuevo token aleatorio
            $token = Str::random(60);

            // Actualizar la contraseña del usuario con la nueva contraseña proporcionada en el formulario
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Actualizar el token de recordar contraseña del usuario
            $user->remember_token = $token;
            $user->save();

            // Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
            return redirect()->route('login_outAnimate')->with('message', 'Se ha cambiado la contraseña');
        }

        // Si no se encuentra un usuario con el correo electrónico proporcionado, mostrar un error
        return back()->withErrors([
            'email' => 'No se encontró una cuenta con el correo proporcionado.',
        ]);
    }

    public function register(Request $request): view
    {
        // Lista de codigos
        $codigos = Country_code::all();

        $proveedores = Provider::all();

        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');

        // Lista de municipios
        $group = [];

        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        return view('auth.register', compact('departamentos', 'group', 'codigos', 'proveedores'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario utilizando
        $validator = Validator::make(
            $request->all(),
            [
                'nit' => 'required|numeric|digits_between:8,16',
                'razon' => 'required',
                'direccion' => 'required',
                'codigo_cel' => 'required',
                'cel' => 'required|numeric|digits:10',
                'tel' => 'nullable|numeric|digits:10',
                'email' => 'required|email',
                'password' => [
                    'required',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d.@!¡?¿]{8,}$/',
                ],
                'confirm_password' => 'required| ',
                'json_marcas' => 'required',
                'json_categorias' => 'required',
                'rut' => 'required|file|mimes:pdf|max:5024',
                'cam' => 'required|file|mimes:pdf|max:5024',
                'terms' => 'required',
            ],
            [
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.regex' => 'La contraseña no es segura. Debe incluir al menos 8 caracteres, 1 número, una mayúscula y una minúscula.',
                'confirm_password.required' => 'El campo confirmar contraseña es obligatorio.',
                'confirm_password.same' => 'Las contraseñas no coinciden.',
                'terms.required' => 'Los términos y condiciones son obligatorios'
            ]
        );

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

        if ($validator->fails()) {
            // Si la validación falla, redirigir de nuevo al formulario con errores y datos anteriores
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear un nuevo proveedor
        $proveedor = new Provider();
        $proveedor->nit_empresa = $request->nit;
        $proveedor->razon_social = $request->razon;
        $proveedor->departamento = $request->departamento;
        $proveedor->municipio = $request->municipio;
        $proveedor->direccion = $request->direccion;
        $paises = [
            '+57' => 'Colombia',
            '+54' => 'Argentina',
            '+591' => 'Bolivia',
            '+55' => 'Brasil',
            '+56' => 'Chile',
            '+593' => 'Ecuador',
            '+594' => 'Guyana Francesa',
            '+592' => 'Guyana',
            '+595' => 'Paraguay',
            '+51' => 'Perú',
            '+597' => 'Surinam',
            '+598' => 'Uruguay',
            '+58' => 'Venezuela',
            '+1' => 'Estados Unidos',
            '+506' => 'Costa Rica',
            '+503' => 'El Salvador',
            '+502' => 'Guatemala',
            '+504' => 'Honduras',
            '+52' => 'México',
            '+505' => 'Nicaragua',
            '+507' => 'Panamá',
        ];

        $proveedor->pais = $paises[$request->codigo_cel];
        $proveedor->celular = $request->codigo_cel . $request->cel;
        $proveedor->telefono = $request->tel;
        $proveedor->email = $request->email;
        $proveedor->password = bcrypt($request->password); // Encriptar la contraseña

        if ($request->input('json_marcas')) {
            $jsonMarcas = $request->input('json_marcas');
            $proveedor->marcas_preferencias = $jsonMarcas;
        } else {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->input('json_categorias')) {
            $jsonCategorias = $request->input('json_categorias');
            $proveedor->especialidad = $jsonCategorias;
        } else {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $proveedor->estado = false;

        // Obtener los archivos RUT y Cámara de Comercio
        $archivoRut = $request->file('rut');
        $archivoCam = $request->file('cam');

        // Guardar los archivos con nombres personalizados
        if ($archivoRut && $archivoCam) {
            $nit = $request->nit;
            $nombreRutPersonalizado = 'RUT_' . $nit . '.pdf';
            $nombreCamPersonalizado = 'Camara_de_comercio_' . $nit . '.pdf';

            // Mover y guardar los archivos con los nombres personalizados en la carpeta 'uploads'
            $archivoRut->storeAs('uploads', $nombreRutPersonalizado);
            $archivoCam->storeAs('uploads', $nombreCamPersonalizado);

            // Asignar los nombres personalizados a los campos en la base de datos
            $proveedor->rut = $nombreRutPersonalizado;
            $proveedor->camara_comercio = $nombreCamPersonalizado;

            // Guardar el proveedor en la base de datos
            $proveedor->save();

            // Crear y guardar un usuario asociado al proveedor
            $user = new User();
            $user->name = $proveedor->razon_social;
            $user->cel = $proveedor->celular;
            if ($request->has('tel') && $request->filled('tel')) {
                $user->tel = $proveedor->telefono;
            }
            $user->email = $request->email;
            $user->role = 'Proveedor';
            $user->password = bcrypt($request->password); // Encriptar la contraseña
            $user->proveedor()->associate($proveedor);
            $user->assignRole('Proveedor');
            $user->save();

            //Envia confirmación de registro por email al proveedor
            $data = [
                'name' => $user->name,
            ];

            Mail::to($user->email)->send(new RegistroProveedorMail($data));

            // Notificar al administrador
            $admin = User::where('role', 'Admin')->first();

            if ($admin) {
                Notification::send($admin, new NuevoProveedorRegistrado($proveedor));

                foreach (auth()->user()->unreadNotifications as $notification) {
                    $enlace = "$request->nit/$notification->id";
                }
                $token = 'EAAyaksOlpN4BO64MEL1cjlEGMvDQb6liWd3oCOIhvnUZBMeF5tbhAvjZABvBnnaYh9V9waBGZCBJW0LnCFaDcUQMZArNbLSKCUEL1MLmgdoRpQHyvEGdAC0CYOxt3l5N2u2Wi0yAlVFE7mCRtHVkZCSOyZAXyVtbrxxeOjkJqOkFDjloKrVuZBLXJUF4S1KG3u7';
                $url = 'https://graph.facebook.com/v17.0/196744616845968/messages';

                $mensajeData = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $admin->cel,
                    'type' => 'template',
                    'template' => [
                        'name' => 'nuevo_proveedor',
                        'language' => [
                            'code' => 'es',
                        ],
                        'components' => [
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => '0',
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $enlace,
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
            }

            // Redirigir a la página de inicio con un mensaje de éxito
            return redirect()->route("servicios")->with('message', '¡Registro exitoso! Por favor, revise su correo electrónico en unos minutos.');
        }
    }
}
