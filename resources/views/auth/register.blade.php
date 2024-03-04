@extends('layouts.app')
@section('title', 'Registro | Tu Repuesto Ya')

<link rel="stylesheet" href="{{ asset('css/registerStyle.css') }}">

@section('style-body',
    "background: linear-gradient(180deg, #4794F9 , #0f3d79);
    background-size: 200% 100%; min-height: 100%; min-width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;")

@section('content')
    @if ($errors->has('file'))
        <div class="alert alert-danger">
            {{ $errors->first('file') }}
        </div>
    @endif

    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>

    <main class="main-content  mt-0">
        <section>
            <div class="container-register contenedor-register"
                style="padding: 3% 15%; display: flex;
            justify-content: center;">
                <div class="bg-transparent-cel flex-col-cel page-header"
                    style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59; max-width: 1328px !important;
                    width: 100%;">
                    <a class="logo-register-cel-position text-dark top-0 end-0" href="{{ route('servicios') }}"
                        style="padding: 1% 1% 0 0; position: absolute; z-index: 2;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.webp') }}"
                            alt="logo" style="height: 6vh; width: auto;" height="30" width="30">
                    </a>
                    <div class="container contenedor-register" style="margin-right: unset;">
                        <div class="">
                            <div class="animate__animated animate__fadeIn animate__delay-1s animate__faster col-lg-6 end-0 text-center justify-content-center flex-column mx-lg-0 mx-auto"
                                style="margin-left: auto !important;">
                                <div class="card card-plain">
                                    <div class="text-cel-center card-header pb-0 text-start"
                                        style="background: transparent;">
                                        <h4 class="font-weight-bolder">Registrate</h4>
                                    </div>
                                    <div class="card-body pd-cel">
                                        <form id="registrationForm" role="form" method="POST"
                                            action="{{ route('store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="nit" id="nit" class="form-control"
                                                    placeholder="*NIT de la empresa" aria-label="Nit"
                                                    value="{{ old('nit') }}" maxlength="12" required>
                                                @error('nit')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @else
                                                    <div id="nit-error" class="text-danger text-xs pt-1 hide"></div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="razon" id="razonSocial" class="form-control"
                                                    placeholder="*Razón social" aria-label="Razon"
                                                    value="{{ old('razon') }}" maxlength="50" required>
                                                @error('razon')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @else
                                                    <div id="razon-error" class="text-danger text-xs pt-1 hide"></div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="nombre_establecimiento" id="nombre_establecimiento" class="form-control"
                                                    placeholder="*Nombre del establecimiento" aria-label="Nombre del establecimiento"
                                                    value="{{ old('nombre_establecimiento') }}" maxlength="100" required>
                                                @error('nombre_establecimiento')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @else
                                                    <div id="nombre-error" class="text-danger text-xs pt-1 hide"></div>
                                                @enderror
                                            </div>

                                            <div class="group" style="display: flex; flex-direction: column;">
                                                <div class="flex flex-col mb-3 text-center">
                                                    <div class="form-control"
                                                        style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                        <select name="codigo_cel" id="codigo-cel"
                                                            style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                            @foreach ($codigos as $codigo)
                                                                <option id="{{ $codigo->pais }}"
                                                                    value="{{ $codigo->codigo }}"
                                                                    title="{{ $codigo->pais }}">
                                                                    {{ $codigo->iso . ' ' . $codigo->codigo }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" id="cel" class="form-control"
                                                            name="cel" placeholder="*Número de celular" aria-label='Cel'
                                                            value="{{ old('cel') }}" style="width: 100%; border: none;"
                                                            required>
                                                    </div>
                                                    @error('cel')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @else
                                                        <small class="text-xs text-color-secondary">¡Debe tener Whatsapp! <i
                                                                class="fa fa-whatsapp" aria-hidden="true"
                                                                style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                            </i></small>
                                                    @enderror
                                                </div>

                                                <!--<div class="container-inputs-contact"
                                                        style="display:flex; justify-content: space-between;">
                                                        <div class="flex flex-col mb-3" style="width: 49%;">
                                                            <input type="text" class="text-center form-control" id="cel"
                                                                name="cel" placeholder="*Número de celular" aria-label='Cel'
                                                                value="{{ old('cel') }}" style="width: 100%;">
                                                            </div>
                                                            @error('cel')
        <div class="text-danger text-xs pt-1">{{ $message }}</div>
    @enderror
                                                        </div>-->

                                                <div class="flex flex-col mb-3">
                                                    <input type="text" name="tel" id="numeroTel" class="form-control"
                                                        placeholder="Número de celular 2°" aria-label="Tel"
                                                        value="{{ old('tel') }}">
                                                    @error('tel')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @else
                                                        <div id="errorTel" class="text-danger text-xs pt-1 hide"></div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div id="pais" class="flex flex-col mb-3 text-center hide">
                                                <div class="form-control">
                                                    <span id="text-pais"></span>
                                                </div>
                                            </div>

                                            <div id="location_container" class="container-inputs-location"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="flex flex-col mb-3" style="width: 49%;">
                                                    <select id="departamento" name="departamento" class="form-control">
                                                        <option value="{{ old('departamento') }}" selected>
                                                            {{ old('departamento') ? old('departamento') . ' (Seleccionado)' : '*Seleccione un departamento' }}
                                                        </option>
                                                        @foreach ($departamentos as $departamento)
                                                            <option value="{{ $departamento }}">{{ $departamento }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('departamento')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3" style="width: 49%;">
                                                    <select name="municipio" id="municipio" class="form-control">
                                                        <option value="{{ old('municipio') }}" disabled selected>
                                                            {{ old('municipio') ? old('municipio') . ' (Seleccionado)' : '*Seleccione un municipio' }}
                                                        </option>

                                                    </select>
                                                    @error('municipio')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="direccion" id="direccion"
                                                    class="form-control" placeholder="Dirección" aria-label="Direccion"
                                                    value="{{ old('direccion') }}" maxlength="50">
                                                @error('direccion')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="*Correo electronico" aria-label="Email"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                                @else
                                                    <p id="email-error" class='text-danger text-xs pt-1 hide'></p>
                                                @enderror
                                            </div>

                                            <div class="container-inputs-password"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="form-group" style="width: 49%;">
                                                    <div class="input-group">
                                                        <input id="password" type="password" name="password"
                                                            class="form-control form-control-lg" aria-label="Password"
                                                            value="{{ old('password') }}" placeholder="*Contraseña"
                                                            required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                    id="togglePassword" class="fas fa-eye"
                                                                    style="cursor: pointer;"></i></span>
                                                        </div>
                                                    </div>

                                                    @error('password')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @else
                                                        <small class="text-xs text-secondary">Incluir al menos 8 caracteres, 1
                                                            número, una mayúscula y una minúscula.</small>
                                                    @enderror

                                                </div>

                                                <div class="form-group" style="width: 49%;">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="confirm_password"
                                                            name="confirm_password" placeholder="*Confirmar contraseña"
                                                            aria-label='Confirm_contraseña'
                                                            value="{{ old('confirm_password') }}" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                    id="toggleConfirmPassword" class="fas fa-eye"
                                                                    style="cursor: pointer;"></i></span>
                                                        </div>
                                                    </div>
                                                    @error('confirm_password')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="flex flex-col">
                                                    <select title="Seleccióne marcas" name="marcas" id="marcas"
                                                        class="form-control" style="color: var(--bs-secondary-color);">
                                                        <option value="" disabled selected>*Preferencias de Marcas
                                                        </option>
                                                        <option value="Todas las marcas">Todas las
                                                            marcas</option>
                                                        <!--<option value="AKT">AKT</option>-->
                                                        <option value="Alfa Romeo">Alfa Romeo</option>
                                                        <option value="Alpine">Alpine</option>
                                                        <option value="Aston Martin">Aston Martin</option>
                                                        <!--<option value="Apollo Motors">Apollo Motors</option>-->
                                                        <!--<option value="Aprilia">Aprilia</option>-->
                                                        <option value="Acura">Acura</option>
                                                        <option value="Audi">Audi</option>
                                                        <!--<option value="Auteco">Auteco</option>-->
                                                        <!--<option value="Ayco">Ayco</option>-->
                                                        <option value="BAIC">BAIC</option>
                                                        <!--<option value="Bajaj">Bajaj</option>-->
                                                        <!--<option value="Benelli">Benelli</option>-->
                                                        <option value="Bugatti">Bugatti</option>
                                                        <option value="Brabus">Brabus</option>
                                                        <option value="BMW">BMW</option>
                                                        <option value="BYD">BYD</option>
                                                        <!--<option value="CF Moto">CF Moto</option>-->
                                                        <option value="Changan">Changan</option>
                                                        <option value="Chery">Chery</option>
                                                        <option value="Cupra">Cupra</option>
                                                        <option value="Chevrolet">Chevrolet</option>
                                                        <option value="Cadillac">Cadillac</option>
                                                        <option value="Citroën">Citroën</option>
                                                        <option value="Dodge">Dodge</option>
                                                        <option value="DFSK">DFSK</option>
                                                        <option value="DS">DS</option>
                                                        <!--<option value="Ducati">Ducati</option>-->
                                                        <!--<option value="FAW">FAW</option>-->
                                                        <option value="Fiat">Fiat</option>
                                                        <option value="Ferrari">Ferrari</option>
                                                        <option value="Ford">Ford</option>
                                                        <option value="Foton">Foton</option>
                                                        <option value="Great Wall">Great Wall</option>
                                                        <option value="GMC">GMC</option>
                                                        <option value="Haval">Haval</option>
                                                        <!--<option value="Harley Davidson">Harley Davidson</option>-->
                                                        <!--<option value="Hero Motos">Hero Motos</option>-->
                                                        <option value="Honda">Honda</option>
                                                        <option value="Hummer">Hummer</option>
                                                        <option value="Hennessey">Hennessey</option>
                                                        <option value="Hyundai">Hyundai</option>
                                                        <option value="Infiniti">Infiniti</option>
                                                        <!--<option value="Husqvarna">Husqvarna</option>-->
                                                        <option value="JAC">JAC</option>
                                                        <!--<option value="Jialing Motos">Jialing Motos</option>-->
                                                        <option value="JMC">JMC</option>
                                                        <option value="Jeep">Jeep</option>
                                                        <!--<option value="Kawasaki">Kawasaki</option>-->
                                                        <!--<option value="Keeway">Keeway</option>-->
                                                        <option value="Kia">Kia</option>
                                                        <!--<option value="KTM">KTM</option>-->
                                                        <option value="Kenworth">Kenworth</option>
                                                        <option value="Koenigsegg">Koenigsegg</option>
                                                        <!--<option value="Kymco">Kymco</option>-->
                                                        <option value="Land Rover">Land Rover</option>
                                                        <option value="Lamborghini">Lamborghini</option>
                                                        <option value="Lexus">Lexus</option>
                                                        <option value="Lotus">Lotus</option>
                                                        <option value="Lincoln">Lincoln</option>
                                                        <!--<option value="Lifan">Lifan</option>-->
                                                        <option value="Mahindra">Mahindra</option>
                                                        <option value="Mazda">Mazda</option>
                                                        <option value="McLaren">McLaren</option>
                                                        <option value="Maserati">Maserati</option>
                                                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                                                        <option value="MG">MG</option>
                                                        <option value="Mini">Mini</option>
                                                        <option value="Mitsubishi">Mitsubishi</option>
                                                        <!--<option value="Moto Guzzi Colombia">Moto Guzzi Colombia</option>-->
                                                        <option value="Nissan">Nissan</option>
                                                        <option value="Opel">Opel</option>
                                                        <option value="Peugeot">Peugeot</option>
                                                        <option value="Pontiac">Pontiac</option>
                                                        <!--<option value="Piaggio">Piaggio</option>-->
                                                        <option value="Porsche">Porsche</option>
                                                        <option value="Pagani">Pagani</option>
                                                        <!--<option value="Pulsar">Pulsar</option>-->
                                                        <option value="Renault">Renault</option>
                                                        <option value="Rivian">Rivian</option>
                                                        <option value="Rolls Royce">Rolls Royce</option>
                                                        <!--<option value="Royal Enfield">Royal Enfield</option>-->
                                                        <option value="SEAT">SEAT</option>
                                                        <!--<option value="Sherco">Sherco</option>-->
                                                        <option value="Skoda">Skoda</option>
                                                        <option value="SsangYong">SsangYong</option>
                                                        <!--<option value="Starker">Starker</option>-->
                                                        <option value="Subaru">Subaru</option>
                                                        <option value="Scania">Scania</option>
                                                        <option value="Suzuki">Suzuki</option>
                                                        <!--<option value="SYM">SYM</option>-->
                                                        <option value="Tesla">Tesla</option>
                                                        <option value="Toyota">Toyota</option>
                                                        <!--<option value="Triumph">Triumph</option>-->
                                                        <!--<option value="TVS">TVS</option>-->
                                                        <!--<option value="Vespa">Vespa</option>-->
                                                        <option value="Volkswagen">Volkswagen</option>
                                                        <option value="Volvo">Volvo</option>
                                                        <!--<option value="Yamaha">Yamaha</option>-->
                                                        <!--<option value="Zotye">Zotye</option>-->
                                                        <option value="otro">Otro</option>

                                                    </select>
                                                </div>
                                                <div id="marcas_preferencias" class="flex flex-col mb-3">
                                                    <div id="items_container" class="form-control">

                                                    </div>
                                                </div>
                                                @error('json_marcas')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @else
                                                    <div class="text-secondary text-xs pt-1">¡Solo te llegaran solicitudes de
                                                        las marcas que elijas!.</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <select title="Especialidad: ¿En que repuestos se especializa?"
                                                    class="form-control" name="categoria_repuesto"
                                                    id="categoria_repuesto" style="color: var(--bs-secondary-color);"
                                                    required>
                                                    <option value="" disabled selected>*Especialidad</option>
                                                    <option value="Todas las especialidades">Todas
                                                        las especialidades</option>
                                                    <option value="LLantas">LLantas</option>
                                                    <option value="Frenos">Frenos</option>
                                                    <option value="Suspensión">Suspensión</option>
                                                    <option value="Dirección">Sistema de Dirección</option>
                                                    <option value="Motor">Motor</option>
                                                    <option value="Latas">Latas</option>
                                                    <option value="Refrigeración">Refrigeración</option>
                                                    <option value="Eléctricos">Eléctricos
                                                    </option>
                                                    <option value="otros">Otros</option>
                                                </select>
                                                <div id="categorias_preferencias" class="flex flex-col mb-3">
                                                    <div id="items_container_categorias" class="form-control"></div>

                                                </div>
                                                @error('json_categorias')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @else
                                                    <div class="text-secondary text-xs pt-1">¿En que repuestos se especializa?
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="container-inputs-files mb-3"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="flex flex-col" style="width: 49%;">
                                                    <label id="btn1" class="button form-control" for="rut"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div>*RUT
                                                        </div>
                                                        <div><i id="check1" class="fa fa-check"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="rut" id="rut"
                                                        class="form-control" aria-label="Rut" style="display: none;">
                                                    @error('rut')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @else
                                                        <div class="text-danger text-xs pt-1">*El RUT es obligatorio</div>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col" style="width: 49%;">
                                                    <label id="btn2" class="button form-control" for="cam"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div>*Camara de comercio</div>
                                                        <div><i id="check2" class="fa fa-check"
                                                                aria-hidden="true"></i></div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="cam" id="cam"
                                                        class="form-control" aria-label="Cam" style="display: none;">
                                                    @error('cam')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @else
                                                        <div class="text-danger text-xs pt-1">*La cámara de comercio es obligatoria</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-check form-check-info text-start">
                                                <input class="form-check-input" type="checkbox" name="terms"
                                                    id="flexCheckDefault" {{ old('terms') ? 'checked' : '' }} required>
                                                <label class="form-check-label text-white-cel" for="flexCheckDefault">
                                                    Acepto los <a href="javascript:;"
                                                        class="text-primary font-weight-bolder">Términos y
                                                        Condiciones</a>
                                                </label>
                                                @error('terms')
                                                    <p class='text-danger text-xs'> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn bg-gradient-primary w-100 my-4 mb-2">Registrarse</button>
                                            </div>

                                            <p class="text-sm mt-3 mb-0">Ya tienes una cuenta? <a
                                                    href="{{ route('login') }}"
                                                    class="font-weight-bolder text-primary">Iniciar sesión</a></p>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="animate__animated animate__bounceInRight animate__fast col-6 d-lg-flex d-none h-100 my-auto position-absolute top-0 start-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 px-7 d-flex flex-column justify-content-center overflow-hidden"
                                    style="background-image: url('/img/backgrounds/img_register.webp');
                                    background-size: cover; background-repeat: no-repeat; background-position: center;">
                                    <span class="mask opacity-6"
                                        style="background-image: linear-gradient(60deg, #06090D 0%, #132340 100%);"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-footer">
                <div class="footer w-100">
                    <div class="container-flex">
                        <div class="container-items">
                            <a class="item" href="#">Terminos y condiciones</a>
                            <a class="item" href="{{ route('privacy-policy') }}">Politica de privacidad</a>
                            <a class="item" href="#">Acerca de...</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const password = document.querySelector('#password');
        const confirmPassword = document.querySelector('#confirm_password');

        const togglePassword = document.querySelector('#togglePassword');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function(e) {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        // Obtener el formulario por su ID
        const formulario = document.getElementById('registrationForm');

        // Manejador de eventos para el evento 'submit'
        formulario.addEventListener('submit', function(event) {
            // Verificar si el formulario es válido
            if (formulario.checkValidity()) {
                // Si el formulario es válido, borrar todos los datos en localStorage
                localStorage.clear();
            } else {
                // Si el formulario no es válido, prevenir la acción por defecto (la recarga de la página)
                event.preventDefault();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let codigo = document.getElementById('codigo-cel');
            let valorInicial = sessionStorage.getItem('codigo') || '+57';
            codigo.value = valorInicial;
            let cel = document.getElementById('cel');
            let tel = document.getElementById('numeroTel');
            let proveedores = @json($proveedores);

            let errorTel = document.getElementById('errorTel');

            let pais = document.getElementById('pais');
            let textPais = document.getElementById('text-pais');
            let departamento = document.getElementById('departamento');
            let municipio = document.getElementById('municipio');

            // Establece los campos como obligatorios
            departamento.setAttribute('required', true);
            municipio.setAttribute('required', true);

           // Función para limpiar el número de celular
            function limpiarCelular() {
                cel.value = cel.value.replace(/[^\d]/g, '');
                if (codigo.value == '+54') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+591') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+55') {
                    cel.value = cel.value.slice(0, 11);
                    tel.value = tel.value.slice(0, 11);
                } else if (codigo.value == '+56') {
                    cel.value = cel.value.slice(0, 9);
                    tel.value = tel.value.slice(0, 9);
                } else if (codigo.value == '+593') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+594') {
                    cel.value = cel.value.slice(0, 9);
                    tel.value = tel.value.slice(0, 9);
                } else if (codigo.value == '+592') {
                    cel.value = cel.value.slice(0, 7);
                    tel.value = tel.value.slice(0, 7);
                } else if (codigo.value == '+595') {
                    cel.value = cel.value.slice(0, 9);
                    tel.value = tel.value.slice(0, 9);
                } else if (codigo.value == '+51') {
                    cel.value = cel.value.slice(0, 9);
                    tel.value = tel.value.slice(0, 9);
                } else if (codigo.value == '+597') {
                    cel.value = cel.value.slice(0, 7);
                    tel.value = tel.value.slice(0, 7);
                } else if (codigo.value == '+598') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+58') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+57') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+1') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+506') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+503') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+502') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+504') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+52') {
                    cel.value = cel.value.slice(0, 10);
                    tel.value = tel.value.slice(0, 10);
                } else if (codigo.value == '+505') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                } else if (codigo.value == '+507') {
                    cel.value = cel.value.slice(0, 8);
                    tel.value = tel.value.slice(0, 8);
                }
            }

            // Asigna la función al evento input del campo de celular
            cel.addEventListener('input', limpiarCelular);
            tel.addEventListener('input', limpiarCelular);

            function updateVisibility() {
                sessionStorage.setItem('codigo', codigo.value);

                let celValue = codigo.value + cel.value;
                let telValue = codigo.value + tel.value;

                if (codigo.value == '+54') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');

                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }

                    textPais.textContent = 'Argentina';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+591') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');

                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }

                    textPais.textContent = 'Bolivia';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+55') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 11) {
                        cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 11) {
                        tel.setCustomValidity("El número de celular debe tener 11 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Brasil';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+56') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');

                    if (isNaN(cel.value) || cel.value.length != 9) {
                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 9) {
                        tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Chile';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+593') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Ecuador';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+594') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 9) {
                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 9) {
                        tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Guayana Francesa';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+592') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 7) {
                        cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 7) {
                        tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Guyana';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+595') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 9) {
                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 9) {
                        tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Paraguay';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+51') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 9) {
                        cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 9) {
                        tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Peru';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+597') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 7) {
                        cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 7) {
                        tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Surinam';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+598') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Uruguay';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+58') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Venezuela';

                    // Elimina el atributo 'required'
                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+57') {
                    departamento.classList.remove('hide');
                    municipio.classList.remove('hide');
                    pais.classList.add('hide');

                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }

                    // Establece los campos como obligatorios
                    departamento.setAttribute('required', true);
                    municipio.setAttribute('required', true);
                } else if (codigo.value == '+1') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Estados Unidos';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+506') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Costa Rica';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+503') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'El Salvador';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+502') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Guatemala';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+504') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Honduras';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+52') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 10) {
                        cel.setCustomValidity("El número de celular debe tener 10 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 10) {
                        tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Mexico';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+505') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Nicaragua';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                } else if (codigo.value == '+507') {
                    departamento.classList.add('hide');
                    municipio.classList.add('hide');
                    pais.classList.remove('hide');
                    if (isNaN(cel.value) || cel.value.length != 8) {
                        cel.setCustomValidity("El número de celular debe tener 8 dígitos")
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if (proveedores[i].celular == celValue) {
                                cel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                cel.setCustomValidity('');
                            }
                        }
                    }

                    if (tel.value == "") {
                        tel.setCustomValidity("");
                    } else if (isNaN(tel.value) || tel.value.length != 8) {
                        tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                    } else {
                        for (let i = 0; i < proveedores.length; i++) {
                            if(proveedores[i].telefono == telValue && telValue != ''){
                                errorTel.classList.remove('hide');
                                errorTel.textContent = 'El número de celular ya está registrado';
                                tel.setCustomValidity('El número de celular ya está registrado');
                                return;
                            }else{
                                errorTel.classList.add('hide');
                                errorTel.textContent = '';
                                tel.setCustomValidity('');
                            }
                        }
                    }


                    textPais.textContent = 'Panamá';

                    departamento.removeAttribute('required');
                    municipio.removeAttribute('required');
                }

            }

            codigo.addEventListener('change', updateVisibility);
            cel.addEventListener('change', updateVisibility);
            tel.addEventListener('change', updateVisibility);

            updateVisibility();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let nit = document.getElementById('nit');
            let error = document.getElementById('nit-error');
            let proveedores = @json($proveedores);

            function nitValidity() {
                if (nit.value.length != 0) {
                    nit.value = nit.value.slice(0, 12);
                    if (isNaN(nit.value)) {
                        nit.setCustomValidity("El nit debe contener solo números");
                        error.classList.remove('hide');
                        error.textContent = 'El nit debe contener solo números';
                    } else if (nit.value.length < 8) {
                        nit.setCustomValidity("El nit es muy corto");
                        error.classList.remove('hide');
                        error.textContent = 'El nit es muy corto';
                    } else {
                        nit.setCustomValidity("");
                        error.classList.add('hide');
                        error.textContent = '';
                    }

                    let nitValue = nit.value; // Corrección aquí
                    for (let i = 0; i < proveedores.length; i++) { // Corrección aquí
                        if (proveedores[i].nit_empresa == nitValue) { // Corrección aquí
                            error.classList.remove('hide');
                            error.textContent = 'El nit ya está registrado';
                            nit.setCustomValidity("El nit ya está registrado");
                            return; // Corrección aquí
                        }
                    }
                } else {
                    nit.setCustomValidity("");
                    error.classList.add('hide');
                    error.textContent = '';
                }
            }

            nit.addEventListener('input', nitValidity);

            nitValidity();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let razon = document.getElementById('razonSocial');
            let proveedores = @json($proveedores);
            let error = document.getElementById('razon-error');

            function razonValidity(){
                if (razon.value.length != 0) {
                    let razonValue = razon.value;

                    for(let i = 0; i < proveedores.length; i++){
                        if(proveedores[i].razon_social.toLowerCase() == razonValue.toLowerCase()){
                            razon.setCustomValidity('Esta razón social ya está registrada');
                            error.classList.remove('hide');
                            error.textContent = 'Esta razón social ya está registrada';
                            return;
                        }else{
                            razon.setCustomValidity('');
                            error.classList.add('hide');
                            error.textContent = '';
                        }
                    }
                }else {
                    razon.setCustomValidity("");
                    error.classList.add('hide');
                    error.textContent = '';
                }
            }

            razon.addEventListener('input', razonValidity);

            razonValidity();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let email = document.getElementById('email');
            let proveedores = @json($proveedores);
            let error = document.getElementById('email-error');

            function emailValidity(){
                if (email.value.length != 0) {
                    let emailValue = email.value;

                    for(let i = 0; i < proveedores.length; i++){
                        if(proveedores[i].email.toLowerCase() == emailValue.toLowerCase()){
                            email.setCustomValidity('Esta correo electrónico ya está registrado');
                            error.classList.remove('hide');
                            error.textContent = 'Esta correo electrónico ya está registrado';
                            return;
                        }else{
                            email.setCustomValidity('');
                            error.classList.add('hide');
                            error.textContent = '';
                        }
                    }
                }else {
                    email.setCustomValidity("");
                    error.classList.add('hide');
                    error.textContent = '';
                }
            }

            email.addEventListener('input', emailValidity);

            emailValidity();
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let nombre = document.getElementById('nombre_establecimiento');
        let proveedores = @json($proveedores);
        let error = document.getElementById('nombre-error');

        function nombreValidity(){
            if (nombre.value.length != 0) {
                let nombreValue = nombre.value;

                for(let i = 0; i < proveedores.length; i++){
                    if(proveedores[i].nombre_comercial.toLowerCase() == nombreValue.toLowerCase()){
                        nombre.setCustomValidity('Este nombre ya está registrado');
                        error.classList.remove('hide');
                        error.textContent = 'Este nombre ya está registrado';
                        return;
                    }else{
                        nombre.setCustomValidity('');
                        error.classList.add('hide');
                        error.textContent = '';
                    }
                }
            }else {
                nombre.setCustomValidity("");
                error.classList.add('hide');
                error.textContent = '';
            }
        }

        nombre.addEventListener('input', emailValidity);

        nombreValidity();
    });
</script>

    <script>
        // Obtener los elementos del formulario
        const departamentoSelect = document.getElementById('departamento');
        const municipioSelect = document.getElementById('municipio');

        // Función para cargar los municipios según el departamento seleccionado
        function cargarMunicipios(departamento) {

            municipioSelect.innerHTML = '<option value="">*Municipio</option>';

            // Obtener los municipios del departamento seleccionado de $group
            const municipios = {!! json_encode($group) !!}[departamento];

            if (municipios) {
                // Agregar las opciones de los municipios al campo de municipio
                municipios.forEach(municipio => {
                    const option = document.createElement('option');
                    option.value = municipio;
                    option.text = municipio;

                    // Verificar si el municipio coincide con el valor anterior
                    if (municipio === "{{ old('municipio') }}") {
                        option.selected = true;
                    }

                    municipioSelect.add(option);
                });
            }
        }

        // Evento para cargar los municipios al seleccionar un departamento
        departamentoSelect.addEventListener('change', function() {
            const selectedDepartamento = departamentoSelect.value;
            if (selectedDepartamento) {
                cargarMunicipios(selectedDepartamento);
            } else {
                municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
            }
        });

        // Añade un evento para inicializar el estado cuando la página se carga
        document.addEventListener('DOMContentLoaded', function() {
            const selectedDepartamento = departamentoSelect.value;
            if (selectedDepartamento) {
                cargarMunicipios(selectedDepartamento);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let marcas = document.getElementById('marcas');
            let container = document.getElementById('items_container');
            let marcas_preferencias = document.getElementById('marcas_preferencias');
            marcas_preferencias.classList.add('hide');

            // Intentar recuperar las marcas seleccionadas del localStorage
            let seleccionados = JSON.parse(localStorage.getItem('seleccionados')) || {};

            // Función para agregar un botón
            function agregarBoton(item) {
                let button = document.createElement('button');
                button.classList.add('item_selected');
                button.setAttribute('name', 'item');
                button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                marcas.setCustomValidity('');

                // Agregar un evento de escucha de clics al botón
                button.addEventListener('click', function() {
                    event.preventDefault();

                    // Eliminar el botón del contenedor
                    container.removeChild(button);

                    // Eliminar la opción del objeto seleccionados
                    delete seleccionados[item];

                    // Guardar las marcas seleccionadas en el localStorage
                    localStorage.setItem('seleccionados', JSON.stringify(seleccionados));

                    if (container.children.length === 0) {
                        marcas_preferencias.classList.add('hide');
                        marcas.setCustomValidity('No has agregado ninguna marca');
                    }
                    else{
                        marcas.setCustomValidity('');
                    }
                });

                container.appendChild(button);

                // Marcar la opción como seleccionada
                seleccionados[item] = true;

                // Guardar las marcas seleccionadas en el localStorage
                localStorage.setItem('seleccionados', JSON.stringify(seleccionados));
            }

            // Si hay marcas seleccionadas, recrear los botones
            if (Object.keys(seleccionados).length > 0) {
                marcas_preferencias.classList.remove('hide');
                marcas.removeAttribute('required');
                for (let item in seleccionados) {
                    agregarBoton(item);
                }
            }

            if (container.children.length > 0) {
                marcas_preferencias.classList.remove('hide');
                marcas.removeAttribute('required');
            }

            marcas.addEventListener('change', function() {

                let item = marcas.value;
                if (item !== "") {
                    if (!seleccionados[item]) {
                        agregarBoton(item);
                        marcas_preferencias.classList.remove('hide');
                        if (Object.keys(seleccionados).length === 0) {
                            marcas.setAttribute('required', true);
                        }
                    }
                }
            });

            if (Object.keys(seleccionados).length === 0) {
                marcas.setAttribute('required', true);
            } else {
                marcas.removeAttribute('required');
                marcas.setCustomValidity('');
            }

            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                // Obtener los textos de los botones en un arreglo
                let textosSeleccionados = Array.from(container.children).map(button => button.textContent);

                // Convertir el arreglo a una cadena JSON
                let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                // Agregar un campo oculto al formulario y asignarle la cadena JSON
                let inputJson = document.createElement('input');
                inputJson.type = 'hidden';
                inputJson.name = 'json_marcas';
                inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '').replace(/\r/g, '');
                this.appendChild(inputJson);

                // Limpiar los datos en localStorage después de enviar el formulario
                localStorage.removeItem('seleccionados');

                // Ahora, puedes enviar el formulario
                this.submit();
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let categoria = document.getElementById('categoria_repuesto');
            let container = document.getElementById('items_container_categorias');
            let categorias_preferencias = document.getElementById('categorias_preferencias');
            categorias_preferencias.classList.add('hide');

            // Intentar recuperar las categorias seleccionadas del localStorage
            let categoriaSeleccionados = JSON.parse(localStorage.getItem('categoriaSeleccionados')) || {};

            // Función para agregar un botón
            function agregarBoton(item_category) {
                let button = document.createElement('button');
                button.classList.add('item_selected');
                button.setAttribute('name', 'item_category');
                button.innerHTML = item_category + '<span class="btn_borrar_item">×</span>';

                categoria.setCustomValidity('');

                // Agregar un evento de escucha de clics al botón
                button.addEventListener('click', function() {
                    // Eliminar el botón del contenedor
                    container.removeChild(button);

                    // Eliminar la opción del objeto seleccionados
                    delete categoriaSeleccionados[item_category];

                    // Guardar las categorias seleccionadas en el localStorage
                    localStorage.setItem('categoriaSeleccionados', JSON.stringify(categoriaSeleccionados));

                    if (container.children.length === 0) {
                        categorias_preferencias.classList.add('hide');
                        categoria.setCustomValidity('No has agregado ninguna caterogia');
                    }
                    else{
                        categoria.setCustomValidity('');
                    }
                });

                container.appendChild(button);

                // Marcar la opción como seleccionada
                categoriaSeleccionados[item_category] = true;

                // Guardar las categorias seleccionadas en el localStorage
                localStorage.setItem('categoriaSeleccionados', JSON.stringify(categoriaSeleccionados));
            }

            // Si hay categorias seleccionadas, recrear los botones
            if (Object.keys(categoriaSeleccionados).length > 0) {
                categorias_preferencias.classList.remove('hide');
                categoria.removeAttribute('required');
                for (let item_category in categoriaSeleccionados) {
                    agregarBoton(item_category);
                }
            }

            if (container.children.length > 0) {
                categorias_preferencias.classList.remove('hide');
                categoria.removeAttribute('required');
            }

            categoria.addEventListener('change', function() {
                let item_category = categoria.value;
                if (item_category !== "") {
                    if (!categoriaSeleccionados[item_category]) {
                        agregarBoton(item_category);
                        categorias_preferencias.classList.remove('hide');
                        categoria.removeAttribute('required');
                    }
                }
            });

            if (Object.keys(categoriaSeleccionados).length === 0) {
                categoria.setAttribute('required', true);
            }else {
                categoria.removeAttribute('required');
                categoria.setCustomValidity('');
            }

            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                // Obtener los textos de los botones en un arreglo
                let textosSeleccionados = Object.keys(categoriaSeleccionados);

                // Convertir el arreglo a una cadena JSON
                let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                // Agregar un campo oculto al formulario y asignarle la cadena JSON
                let inputJson = document.createElement('input');
                inputJson.type = 'hidden';
                inputJson.name = 'json_categorias';
                inputJson.value = jsonTextosSeleccionados;
                this.appendChild(inputJson);

                // Limpiar los datos en localStorage después de enviar el formulario
                localStorage.removeItem('categoriaSeleccionados');

                // Ahora, puedes enviar el formulario
                this.submit();
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rut = document.getElementById('rut');
            let cam = document.getElementById('cam');

            const btn1 = document.getElementById('btn1');
            const i1 = document.getElementById('check1');

            const btn2 = document.getElementById('btn2');
            const i2 = document.getElementById('check2');

            rut.addEventListener('change', function() {
                if (this.files.length > 0) {
                    console.log('Se ha seleccionado al menos un archivo.');
                    btn1.style.borderColor = 'rgb(157, 232, 157)';
                    i1.style.display = 'block';
                }
            });

            cam.addEventListener('change', function() {
                if (this.files.length > 0) {
                    btn2.style.borderColor = 'rgb(157, 232, 157)';
                    i2.style.display = 'block';
                }
            });
        });

        //loader

        const form = document.getElementById('form_client');
        const overlay = document.getElementById('overlay');

        // Ocultar el loader inicialmente
        hideLoadingOverlay();

        form.addEventListener('submit', function() {
            showLoadingOverlay(); // Mostrar superposición y icono de carga
        });

        function showLoadingOverlay() {
            overlay.style.display = 'flex'; // Mostrar superposición
        }

        function hideLoadingOverlay() {
            overlay.style.display = 'none'; // Ocultar superposición
        }
    </script>

@endsection
