<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use App\Models\Geolocation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Mail\RegistroProveedorMail;
use App\Mail\RestablecerContraseña;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NuevoProveedorRegistrado;
use Illuminate\Support\Facades\Notification;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login-v1');
    }

    public function login2(Request $request)
    {
        return view('auth.login-v2');
    }

    public function verification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            $user = auth()->user();

            if ($user->role === 'Admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            } else if ($user->role === 'Proveedor') {
                if (!$user->proveedor->estado) {
                    // El usuario es un proveedor con cuenta inactiva
                    auth()->logout();
                    return redirect()->route('login_outAnimate')->withErrors([
                        'email' => 'Tu cuenta está inactiva. Contacta al administrador para obtener acceso.',
                    ]);
                }
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }
        }

        return redirect()->route('login_outAnimate')->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function resetPassword()
    {
        return view("auth.reset-password");
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

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

            Mail::to($user->email)->send(new RestablecerContraseña($email));

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
                'required',
                'regex:/^(?=.*\d.*\d.*\d.*\d.*\d)(?=.*[A-Z])(?=.*[a-z])/', // Requisitos de seguridad de contraseña
                'min:8', // Mínimo 8 caracteres
            ],
            'confirm-password' => 'required|same:password', // Debe coincidir con la contraseña
        ], [
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.regex' => 'La contraseña no es segura. Debe incluir al menos 5 números, una mayúscula y una minúscula.',
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


    public function register(Request $request)
    {
        // Lista de departamentos
        $departamentos = Geolocation::distinct()->pluck('departamento');
    
        // Lista de municipios
        $group = [];
    
        foreach ($departamentos as $departamento) {
            $municipios = Geolocation::where('departamento', $departamento)->pluck('municipio');
            $group[$departamento] = $municipios;
        }

        return view('auth.register', compact('departamentos', 'group'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario utilizando
        $validator = Validator::make(
            $request->all(),
            [
                'nit' => [
                    'required',
                    'alpha_dash',
                    'min:8',
                    'max:16',
                    'regex:/^[a-zA-Z0-9]+$/',
                    'not_regex:/[.\-_+!@#$%^&*()=]/',
                ],
                'razon' => 'required',
                'departamento' => 'required',
                'municipio' => 'required',
                'direccion' => 'required',
                'cel' => 'required|numeric|digits:10',
                'tel' => 'numeric|digits:10',
                'email' => 'required|email',
                'password' => [
                    'required',
                    'regex:/^(?=.*\d.*\d.*\d.*\d.*\d)(?=.*[A-Z])(?=.*[a-z])/',
                    'min:8',
                ],
                'confirm_password' => 'required|same:password',
                'rut' => 'required|file|mimes:pdf|max:5024',
                'cam' => 'required|file|mimes:pdf|max:5024',
                'terms' => 'required',
            ],
            [
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.regex' => 'La contraseña no es segura. Debe incluir al menos 5 números, una mayúscula y una minúscula.',
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
            $cel = "57" . $request->input('cel');
            $existingProvider = Provider::where('celular', $cel)->first();

            if ($existingProvider) {
                $validator->errors()->add('cel', 'Este número de celular ya está registrado.');
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
        $proveedor->celular = "57$request->cel";
        $proveedor->telefono = $request->tel;
        $proveedor->email = $request->email;
        $proveedor->password = bcrypt($request->password); // Encriptar la contraseña
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
            $user->tel = $proveedor->telefono;
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
              }           

            // Redirigir a la página de inicio con un mensaje de éxito
            return redirect()->route("servicios")->with('message', '¡Registro exitoso! Por favor, revise su correo electrónico en unos minutos.');
        }
    }
}
