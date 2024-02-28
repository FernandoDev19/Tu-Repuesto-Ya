@extends('layouts.baseAdmin')

<link rel="stylesheet" href="{{asset('css/profileStyle.css')}}">

@section('title', 'Perfil | Tu Repuesto Ya')

@section('sidebar')
    <nav
    class="navbar navbar-expand navbar-light bg-white shadow topbar static-top d-flex justify-content-center">

    <!-- Topbar Navbar -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"> </i>
                <span class="nav-items-cel-small">Panel</span></a>
        </li>

        @can('providers.loadProviders')
            <li class="nav-item">
                <a href="{{ route('loadProviders') }}" class="nav-link" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-users"> </i><span class="nav-items-cel-small">Proveedores</span> </a>
            </li>
        @endcan

        @can('solicitudes.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewSolicitudes') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-file-alt"> </i> <span class="nav-items-cel-small">Solicitudes</span></a>
            </li>
        @endcan

        @can('answers.view')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewRespuestas') }}" style="color: var(--gray); padding: 0 .50rem; gap: 3px;"><i
                        class="fas fa-reply"> </i><span class="nav-items-cel-small">Respuestas</span> </a>
            </li>
        @endcan

    </ul>
    </nav>
@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="h-100">
            <div class="row h-100 justify-content-center">
                <div class="col-lg-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="container-form" style="display: flex;">
                            @if (auth()->check() &&
                                    auth()->user()->hasRole('Admin'))
                                <form id="form_profile_edit" action="{{ route('profileUpdate') }}" method="POST"
                                    class="form w-100">
                                    @csrf
                                    <div class="container-cols">
                                        <div class="col" id="col1" >
                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Información personal</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <!-- Información del perfil -->
                                                        <div class="form-group">
                                                            <label for="name">Nombre:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="name" name="name"
                                                                placeholder="{{ $name }}"
                                                                value="{{ old('name') }}" autocomplete="on">
                                                            @error('name')
                                                                <small
                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cel_edit">Celular:</label>
                                                            <div class="form-control form-control-lg"
                                                                style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                                <select name="codigo_cel" id="codigo-cel"
                                                                    style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                                    @foreach ($codigos as $codigo)
                                                                        <option value="{{ $codigo->codigo }}"
                                                                            title="{{ $codigo->pais }}">
                                                                            {{ $codigo->iso . ' ' . $codigo->codigo }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" class="form-control form-control-lg"
                                                                    id="cel" name="cel" style="z-index: 1;"
                                                                    placeholder="{{ substr($usuario->cel, 3) }}"
                                                                    value="{{ old('cel') }}" autocomplete="on">
                                                            </div>
                                                            @error('cel')
                                                                <p class='text-danger text-xs pt-1'>
                                                                    {{ $message }}</p>
                                                            @else
                                                                <div class="w-100 text-center">
                                                                    <small
                                                                        class="text-center text-xs text-color-secondary">¡Debe
                                                                        tener Whatsapp! <i class="fa fa-whatsapp"
                                                                            aria-hidden="true"
                                                                            style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                                        </i></small>
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tel">Telefono:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="tel" name="tel"
                                                                placeholder="{{ $usuario->tel }}"
                                                                value="{{ old('tel') }}" autocomplete="on">
                                                            @error('tel')
                                                                <small
                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" id="col2" >
                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Acceso a la plataforma</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <!-- Información del perfil -->
                                                        <div class="form-group">
                                                            <label for="email">Correo electrónico:</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email" name="email"
                                                                placeholder="{{ $usuario->email }}"
                                                                value="{{ old('email') }}" autocomplete="on">
                                                            @error('email')
                                                                <small
                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Nueva contraseña:</label>
                                                            <div class="input-group">
                                                                <input id="password" type="password" name="password"
                                                                    class="form-control form-control-lg"
                                                                    aria-label="Password" value="{{ old('password') }}"
                                                                    placeholder="Nueva contraseña">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"
                                                                        style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                            id="togglePassword"
                                                                            class="fas fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Confirmar nueva contraseña:</label>
                                                            <div class="input-group">
                                                                <input id="confirm_password" type="password"
                                                                    name="confirm_password"
                                                                    class="form-control form-control-lg"
                                                                    aria-label="Confirm Password"
                                                                    value="{{ old('confirm_password') }}"
                                                                    placeholder="Confirmar contraseña">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"
                                                                        style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                            id="toggleConfirmPassword"
                                                                            class="fas fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            @error('confirm_password')
                                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="boton-container" style="display: flex; justify-content: flex-end;">
                                        <button id="btn_submit" type="submit"
                                            class="btn btn-primary mt-3 mx-3">Enviar</button>
                                    </div>
                                </form>
                            @else
                                <form id="form_profile_edit" action="{{ route('profileUpdate', $usuario->proveedor_id) }}" method="POST"
                                    class="form w-100">
                                    @csrf
                                    <div class="container-cols">
                                        <div class="col" id="col1">
                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Información básica</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <!-- Información del perfil -->
                                                        <div class="form-group">
                                                            <label for="nit">NIT:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="nit" name="nit"
                                                                placeholder="{{ $usuario->proveedor->nit_empresa }}"
                                                                value="{{ old('nit') }}" autocomplete="on"
                                                                onkeyup="cambios(this)" maxlength="12">
                                                            @error('nit')
                                                                <small
                                                                    class="text-danger text-xs pt-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="name">Nombre del establecimiento:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                name="nombre_establecimiento" id="nombre_establecimiento"
                                                                placeholder="{{ $usuario->proveedor->nombre_comercial }}"
                                                                value="{{ old('nombre_establecimiento') }}"
                                                                autocomplete="on" maxlength="50">
                                                            @error('nombre_establecimiento')
                                                                <small
                                                                    class="text-xs pt-1 text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="razon_social">Razon social:</label>
                                                            <input type="text" id="razon_social" name="razon_social"
                                                                placeholder="{{ $usuario->proveedor->razon_social }}"
                                                                value="{{ old('razon_social') }}"
                                                                class="form-control form-control-lg" autocomplete="on"
                                                                maxlength="100">
                                                            @error('razon_social')
                                                                <small
                                                                    class="text-xs text-danger pt-1">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div id="pais" class="flex flex-col mb-3 hide">
                                                            <label>País:</label>
                                                            <div class="form-control">
                                                                <span type="text" id="text-pais" name="pais"
                                                                    style="border: none !important;">{{ $usuario->proveedor->pais }}</span>
                                                            </div>
                                                        </div>

                                                        <div id="ciudad" class="flex flex-col mb-3 hide">
                                                            <label for="ciudad">Ciudad:</label>
                                                            <input id="ciudad_input" type="text" class="form-control"
                                                                name="ciudad"
                                                                value="{{ $usuario->proveedor->municipio }}">
                                                        </div>

                                                        <div class="form-group" id="departamentos">
                                                            <label for="departamento">Departamento:</label>
                                                            <select id="departamento" name="departamento"
                                                                class="form-control form-control-lg" autocomplete="on">
                                                                <option value="">
                                                                    Seleccione un departamento
                                                                </option>
                                                                @foreach ($departamentos as $departamento)
                                                                    <option value="{{ $departamento }}">
                                                                        {{ $departamento }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div id="municipios" class="form-group">
                                                            <label for="municipio">Municipio:</label>
                                                            <select id="municipio" name="municipio"
                                                                class="form-control form-control-lg" autocomplete="on">
                                                                <option value="">
                                                                    Seleccione un municipio
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="direccion">Dirección:</label>
                                                            <input type="text" id="direccion" name="direccion"
                                                                placeholder="{{ $usuario->proveedor->direccion }}"
                                                                value="{{ old('direccion') }}"
                                                                class="form-control form-control-lg" autocomplete="on"
                                                                maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Información de contacto</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <!-- Información del perfil -->
                                                        <div class="form-group">
                                                            <label for="cel_edit">Celular:</label>
                                                            <div class="form-control form-control-lg"
                                                                style="display: flex; justify-content: space-between; align-items: center; padding: 0;">
                                                                <select name="codigo_cel" id="codigo-cel"
                                                                    style="border: none; transform: translate(1.5%, 0px); height: auto;">
                                                                    @foreach ($codigos as $codigo)
                                                                        <option value="{{ $codigo->codigo }}"
                                                                            title="{{ $codigo->pais }}">
                                                                            {{ $codigo->iso . ' ' . $codigo->codigo }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" class="form-control form-control-lg"
                                                                    id="cel" name="cel" style="z-index: 1;"
                                                                    placeholder="{{ substr($usuario->cel, 3) }}"
                                                                    value="{{ old('cel') }}" autocomplete="on">
                                                            </div>
                                                            @error('cel')
                                                                <p class='text-danger text-xs pt-1'>
                                                                    {{ $message }}</p>
                                                            @else
                                                                <div class="w-100 text-center">
                                                                    <small
                                                                        class="text-center text-xs text-color-secondary">¡Debe
                                                                        tener Whatsapp! <i class="fa fa-whatsapp"
                                                                            aria-hidden="true"
                                                                            style="color: #25D366; font-size: 15px; transform: translate(0px, 2.4px);">
                                                                        </i></small>
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tel">Celular 2°:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="tel" name="tel"
                                                                placeholder="{{ substr($usuario->tel, 3) }}"
                                                                value="{{ old('tel') }}" autocomplete="on">
                                                            @error('tel')
                                                                <small class="text-danger text-xs pt-1"></small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="representante_legal">Representante legal:</label>
                                                            <input type="text" name="representante_legal"
                                                                class="form-control form-control-lg"
                                                                id="representante_legal"
                                                                placeholder="{{ $usuario->proveedor->representante_legal }}"
                                                                value="{{ old('representante_legal') }}"
                                                                autocomplete="on" maxlength="60">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="contacto_principal">Contacto principal:</label>
                                                            <input type="text" name="contacto_principal"
                                                                id="contacto_principal"
                                                                class="form-control form-control-lg"
                                                                placeholder="{{ $usuario->proveedor->contacto_principal }}"
                                                                value="{{ old('contacto_principal') }}"
                                                                autocomplete="on">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Correo electrónico:</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email" name="email"
                                                                placeholder="{{ $usuario->email }}"
                                                                value="{{ old('email') }}" autocomplete="on">
                                                            @error('email')
                                                                <small class="text-danger text-xs pt-1"></small>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email2">Correo electrónico 2°:</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email2" name="email2"
                                                                placeholder="{{ $usuario->proveedor->email_secundario }}"
                                                                value="{{ old('email') }}" autocomplete="on">
                                                            @error('email2')
                                                                <small class="text-danger text-xs pt-1"></small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col" id="col2">

                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Información legal</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <div class="form-group flex flex-col">
                                                            <span>RUT:</span>
                                                            <label id="btn1"
                                                                class="button form-control form-control-lg" for="rut"
                                                                style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                <div id="text_file_rut"
                                                                    placeholder="{{ $usuario->proveedor->rut }}">
                                                                </div>
                                                                <div><i id="check1" class="fa fa-check"
                                                                        aria-hidden="true"></i>
                                                                </div>
                                                            </label>
                                                            <input type="file" accept=".pdf" name="rut"
                                                                id="rut" class="form-control" aria-label="Rut"
                                                                style="display: none;">
                                                            @error('rut')
                                                                <div class="text-danger text-xs pt-1">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group flex flex-col">
                                                            <span>Camara de comercio:</span>
                                                            <label id="btn2"
                                                                class="button form-control form-control-lg" for="cam"
                                                                style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                                <div id="text_file_cam"
                                                                    placeholder="{{ $usuario->proveedor->camara_comercio }}">
                                                                </div>
                                                                <div><i id="check2" class="fa fa-check"
                                                                        aria-hidden="true"></i></div>
                                                            </label>
                                                            <input type="file" accept=".pdf" name="cam"
                                                                id="cam" class="form-control" aria-label="Cam"
                                                                style="display: none;">
                                                            @error('cam')
                                                                <div class="text-danger text-xs pt-1">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Preferencias</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <div class="form-group">
                                                            <div class="flex flex-col">
                                                                <label for="marcas">Marcas:</label>
                                                                <select name="marcas" id="marcas"
                                                                    class="form-control form-control-lg"
                                                                    style="color: var(--bs-secondary-color);">
                                                                    {{-- <option value="" disabled selected>
                                                                        Seleccionar Preferencias</option> --}}
                                                                    <option value="Todas las marcas">Todas las
                                                                        marcas</option>
                                                                    <!--<option value="AKT">AKT</option>-->
                                                                    <option value="Alfa Romeo">Alfa Romeo
                                                                    </option>
                                                                    <option value="Alpine">Alpine</option>
                                                                    <option value="Aston Martin">Aston Martin
                                                                    </option>
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
                                                                    <option value="Chevrolet">Chevrolet
                                                                    </option>
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
                                                                    <option value="Great Wall">Great Wall
                                                                    </option>
                                                                    <option value="GMC">GMC</option>
                                                                    <option value="Haval">Haval</option>
                                                                    <!--<option value="Harley Davidson">Harley Davidson</option>-->
                                                                    <!--<option value="Hero Motos">Hero Motos</option>-->
                                                                    <option value="Honda">Honda</option>
                                                                    <option value="Hummer">Hummer</option>
                                                                    <option value="Hennessey">Hennessey
                                                                    </option>
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
                                                                    <option value="Koenigsegg">Koenigsegg
                                                                    </option>
                                                                    <!--<option value="Kymco">Kymco</option>-->
                                                                    <option value="Land Rover">Land Rover
                                                                    </option>
                                                                    <option value="Lamborghini">Lamborghini
                                                                    </option>
                                                                    <option value="Lexus">Lexus</option>
                                                                    <option value="Lotus">Lotus</option>
                                                                    <option value="Lincoln">Lincoln</option>
                                                                    <!--<option value="Lifan">Lifan</option>-->
                                                                    <option value="Mahindra">Mahindra</option>
                                                                    <option value="Mazda">Mazda</option>
                                                                    <option value="McLaren">McLaren</option>
                                                                    <option value="Maserati">Maserati</option>
                                                                    <option value="Mercedes-Benz">Mercedes-Benz
                                                                    </option>
                                                                    <option value="MG">MG</option>
                                                                    <option value="Mini">Mini</option>
                                                                    <option value="Mitsubishi">Mitsubishi
                                                                    </option>
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
                                                                    <option value="Rolls Royce">Rolls Royce
                                                                    </option>
                                                                    <!--<option value="Royal Enfield">Royal Enfield</option>-->
                                                                    <option value="SEAT">SEAT</option>
                                                                    <!--<option value="Sherco">Sherco</option>-->
                                                                    <option value="Skoda">Skoda</option>
                                                                    <option value="SsangYong">SsangYong
                                                                    </option>
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
                                                                    <option value="Volkswagen">Volkswagen
                                                                    </option>
                                                                    <option value="Volvo">Volvo</option>
                                                                    <!--<option value="Yamaha">Yamaha</option>-->
                                                                    <!--<option value="Zotye">Zotye</option>-->
                                                                    <option value="otro">Otro</option>

                                                                </select>
                                                            </div>
                                                            <div id="marcas_preferencias"
                                                                class="marcas_preferencias flex flex-col mb-3">
                                                                <div id="items_container"
                                                                    class="items_container form-control">
                                                                    @if (is_string($usuario->proveedor->marcas_preferencias))
                                                                        @php
                                                                            $marcas = json_decode($usuario->proveedor->marcas_preferencias);
                                                                        @endphp
                                                                        @foreach ($marcas as $marca)
                                                                            <button type="button" class="item_selected" name="item">{{ $marca }}<span class="btn_borrar_item">×</span></button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <div class="text-secondary text-xs pt-1">¡Solo
                                                                    le llegaran solicitudes de las marcas que
                                                                    elijas!.</div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="categoria_repuesto}">Especialidades:</label>
                                                            <select title="Especialidad: ¿En que repuestos se especializa?"
                                                                class="form-control form-control-lg"
                                                                name="categoria_repuesto" id="categoria_repuesto"
                                                                style="color: var(--bs-secondary-color);" required>
                                                                <option value="Todas las especialidades">Todas las especialidades</option>
                                                                <option value="LLantas">LLantas</option>
                                                                <option value="Frenos">Frenos</option>
                                                                <option value="Suspensión">Suspensión</option>
                                                                <option value="Dirección">Sistema de Dirección</option>
                                                                <option value="Motor">Motor</option>
                                                                <option value="Transmisión">Transmisión</option>
                                                                <option value="Tren motriz">Tren motriz</option>
                                                                <option value="Latas">Latas</option>
                                                                <option value="Refrigeración">Refrigeración</option>
                                                                <option value="Eléctricos">Eléctricos
                                                                </option>
                                                                <option value="otros">Otros</option>
                                                            </select>
                                                            <div id="categorias_preferencias"
                                                                class="categorias_preferencias flex flex-col mb-3">
                                                                <div id="items_container_categorias"
                                                                    class="items_container form-control">
                                                                    @if (is_string($usuario->proveedor->especialidad))
                                                                        @php
                                                                            $preferencias = json_decode($usuario->proveedor->especialidad);
                                                                        @endphp
                                                                        @foreach ($preferencias as $preferencia)
                                                                            <button type="button" class="item_selected" name="item_category">{{ $preferencia }}<span class="btn_borrar_item">×</span></button>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                @error('json_cateogrias')
                                                                    <div class="text-danger text-xs pt-1">
                                                                        {{ $message }}</div>
                                                                @else
                                                                    <div class="text-secondary text-xs pt-1">¡Solo
                                                                        le llegaran solicitudes de las especialidades que
                                                                        elijas!.</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row_cols"
                                                style="display: flex; flex-direction: column; padding-left: 6%;  padding-top: 2%">
                                                <div class="titles" style="margin-bottom: 1%; padding: 0;">
                                                    <div class="text">
                                                        <h4 class="text-primary">Acceso a la plataforma</h4>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="w-default">
                                                        <div class="form-group">
                                                            <label for="password">Nueva contraseña:</label>
                                                            <div class="input-group">
                                                                <input id="password" type="password" name="password"
                                                                    class="form-control form-control-lg"
                                                                    aria-label="Password" value="{{ old('password') }}"
                                                                    placeholder="Nueva contraseña">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"
                                                                        style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                            id="togglePassword"
                                                                            class="fas fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="password">Confirmar nueva contraseña:</label>
                                                            <div class="input-group">
                                                                <input id="confirm_password" type="password"
                                                                    name="confirm_password"
                                                                    class="form-control form-control-lg"
                                                                    aria-label="Confirm Password"
                                                                    value="{{ old('confirm_password') }}"
                                                                    placeholder="Confirmar contraseña">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"
                                                                        style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                            id="toggleConfirmPassword"
                                                                            class="fas fa-eye"></i></span>
                                                                </div>
                                                            </div>
                                                            @error('confirm_password')
                                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="boton-container" style="display: flex; justify-content: flex-end;">
                                        <button id="btn_submit" type="submit"
                                            class="btn btn-primary mt-3 mx-3">Enviar</button>
                                    </div>
                                    {{-- <div id="modalConfirmation" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar envío</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Por favor, ingrese su contraseña para confirmar el envío del
                                                        formulario.
                                                    </p>

                                                    <div class="input-group">
                                                        <input id="password_actual" type="password"
                                                            name="password_actual" class="form-control form-control-lg"
                                                            aria-label="Password actual" placeholder="Contraseña">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i
                                                                    id="togglePasswordActual"
                                                                    class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                    @error('password_actual')
                                                        <small class="text-xs text-danger pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button id="btn_confirm" type="submit"
                                                        class="btn btn-primary">Confirmar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if ($usuario->role == 'Proveedor')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let codigo = document.getElementById('codigo-cel');

                let codigoProveedor = '{{ $usuario->proveedor->pais }}';

                if (codigoProveedor == 'Argentina') {
                    codigo.value = "+54";
                } else if (codigoProveedor == 'Bolivia') {
                    codigo.value = "+591";
                } else if (codigoProveedor == 'Brasil') {
                    codigo.value = "+55";
                } else if (codigoProveedor == 'Chile') {
                    codigo.value = "+56";
                } else if (codigoProveedor == 'Ecuador') {
                    codigo.value = "+593";
                } else if (codigoProveedor == 'Guayana Francesa') {
                    codigo.value = "+594";
                } else if (codigoProveedor == 'Guyana') {
                    codigo.value = "+592";
                } else if (codigoProveedor == 'Paraguay') {
                    codigo.value = "+595";
                } else if (codigoProveedor == 'Perú') {
                    codigo.value = "+51";
                } else if (codigoProveedor == 'Surinam') {
                    codigo.value = "+597";
                } else if (codigoProveedor == 'Uruguay') {
                    codigo.value = "+598";
                } else if (codigoProveedor == 'Venezuela') {
                    codigo.value = "+58";
                } else if (codigoProveedor == 'Colombia') {
                    codigo.value = "+57";
                } else if (codigoProveedor == 'Estados Unidos') {
                    codigo.value = "+1";
                } else if (codigoProveedor == 'Costa Rica') {
                    codigo.value = "+506";
                } else if (codigoProveedor == 'El Salvador') {
                    codigo.value = "+503";
                } else if (codigoProveedor == 'Guatemala') {
                    codigo.value = "+502";
                } else if (codigoProveedor == 'Honduras') {
                    codigo.value = "+504";
                } else if (codigoProveedor == 'México') {
                    codigo.value = "+52";
                } else if (codigoProveedor == 'Nicaragua') {
                    codigo.value = "+505";
                } else if (codigoProveedor == 'Panamá') {
                    codigo.value = "+507";
                }

                let cel = document.getElementById('cel')
                let tel = document.getElementById('tel')

                let pais = document.getElementById('pais');
                let ciudad = document.getElementById('ciudad');
                let textPais = document.getElementById('text-pais');
                let departamento = document.getElementById('departamentos');
                let municipio = document.getElementById('municipios');

                // Función para limpiar el número de celular
                function limpiarCelular() {
                    cel.value = cel.value.replace(/[^\d]/g, '');
                    if (codigo.value == '+54') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+591') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+55') {
                        cel.value = cel.value.slice(0, 11);
                    } else if (codigo.value == '+56') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+593') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+594') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+592') {
                        cel.value = cel.value.slice(0, 7);
                    } else if (codigo.value == '+595') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+51') {
                        cel.value = cel.value.slice(0, 9);
                    } else if (codigo.value == '+597') {
                        cel.value = cel.value.slice(0, 7);
                    } else if (codigo.value == '+598') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+58') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+57') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+1') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+506') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+503') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+502') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+504') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+52') {
                        cel.value = cel.value.slice(0, 10);
                    } else if (codigo.value == '+505') {
                        cel.value = cel.value.slice(0, 8);
                    } else if (codigo.value == '+507') {
                        cel.value = cel.value.slice(0, 8);
                    }
                }

                // Asigna la función al evento input del campo de celular
                cel.addEventListener('input', limpiarCelular);

                function updateVisibility() {
                    sessionStorage.setItem('codigo', codigo.value);

                    if (codigo.value == '+54') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Argentina';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+591') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');


                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Bolivia';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+55') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 11) {
                            cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 11) {
                            tel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Brasil';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+56') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Chile';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+593') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Ecuador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+594') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guayana Francesa';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+592') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 7) {
                            tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guyana';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+595') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }


                        textPais.textContent = 'Paraguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+51') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Perú';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+597') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        ciudad.classList.remove('hide');
                        pais.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 7) {
                            tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Surinam';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+598') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Uruguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+58') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Venezuela';

                        // Elimina el atributo 'required'
                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+57') {
                        departamento.classList.remove('hide');
                        municipio.classList.remove('hide');
                        pais.classList.add('hide');
                        ciudad.classList.add('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Colombia';

                        // Establece los campos como obligatorios
                        departamento.setAttribute('required', true);
                        municipio.setAttribute('required', true);
                    } else if (codigo.value == '+1') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Estados Unidos';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+506') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Costa Rica';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+503') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'El Salvador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+502') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guatemala';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+504') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Honduras';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+52') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'México';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+505') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Nicaragua';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+507') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
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
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let codigo = document.getElementById('codigo-cel');

                let cel = document.getElementById('cel')
                let tel = document.getElementById('tel')

                let pais = document.getElementById('pais');
                let ciudad = document.getElementById('ciudad');
                let textPais = document.getElementById('text-pais');
                let departamento = document.getElementById('departamentos');
                let municipio = document.getElementById('municipios');

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

                    if (codigo.value == '+54') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Argentina';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+591') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');


                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Bolivia';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+55') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 11) {
                            cel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 11) {
                            tel.setCustomValidity("El número de celular debe tener 11 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Brasil';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+56') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');

                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }
                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Chile';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+593') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Ecuador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+594') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guayana Francesa';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+592') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 7) {
                            tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Guyana';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+595') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }


                        textPais.textContent = 'Paraguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+51') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 9) {
                            cel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (isNaN(tel.value) || tel.value.length != 9) {
                            tel.setCustomValidity("El número de celular debe tener 9 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Perú';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+597') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        ciudad.classList.remove('hide');
                        pais.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 7) {
                            cel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 7) {
                            tel.setCustomValidity("El número de celular debe tener 7 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Surinam';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+598') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Uruguay';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+58') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }

                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Venezuela';

                        // Elimina el atributo 'required'
                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+57') {
                        departamento.classList.remove('hide');
                        municipio.classList.remove('hide');
                        pais.classList.add('hide');
                        ciudad.classList.add('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Colombia';

                        // Establece los campos como obligatorios
                        departamento.setAttribute('required', true);
                        municipio.setAttribute('required', true);
                    } else if (codigo.value == '+1') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Estados Unidos';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+506') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Costa Rica';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+503') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'El Salvador';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+502') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Guatemala';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+504') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }

                        textPais.textContent = 'Honduras';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+52') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 10) {
                            cel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 10) {
                            tel.setCustomValidity("El número de celular debe tener 10 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'México';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+505') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
                        }
                        textPais.textContent = 'Nicaragua';

                        departamento.removeAttribute('required');
                        municipio.removeAttribute('required');
                    } else if (codigo.value == '+507') {
                        departamento.classList.add('hide');
                        municipio.classList.add('hide');
                        pais.classList.remove('hide');
                        ciudad.classList.remove('hide');
                        if (cel.value == "") {
                            cel.setCustomValidity("");
                        } else if (isNaN(cel.value) || cel.value.length != 8) {
                            cel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            cel.setCustomValidity("");
                        }


                        if (tel.value == "") {
                            tel.setCustomValidity("");
                        } else if (isNaN(tel.value) || tel.value.length != 8) {
                            tel.setCustomValidity("El número de celular debe tener 8 dígitos");
                        } else {
                            tel.setCustomValidity("");
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
    @endif

    <script>
        // Obtener los elementos del formulario dentro de cada iteración
        const departamentoSelect = document.getElementById('departamento');
        const municipioSelect = document.getElementById('municipio');

        // Función para cargar los municipios según el departamento seleccionado
        function cargarMunicipios(departamento) {
            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
            // Obtener los municipios del departamento seleccionado del objeto PHP $group
            const municipios = {!! json_encode($group) !!}[departamento];
            if (municipios) {
                // Agregar las opciones de los municipios al campo de municipio
                municipios.forEach(municipio => {
                    municipioSelect.innerHTML +=
                        `<option value="${municipio}">${municipio}</option>`;
                });
            }
        }

        // Evento para cargar los municipios al seleccionar un departamento
        departamentoSelect.addEventListener('change', function() {
            const selectedDepartamento = departamentoSelect.value;
            if (selectedDepartamento) {
                cargarMunicipios(selectedDepartamento);
            } else {
                // Si no se ha seleccionado un departamento, limpiar el campo de municipio
                municipioSelect.innerHTML =
                    '<option value="">Seleccione un municipio</option>';
            }

            // Guardar la selección actual en localStorage cuando cambia
            localStorage.setItem('selectedDepartamento', selectedDepartamento);
        });

        // Obtener el valor anterior de 'departamento' almacenado en localStorage
        const storedDepartamento = localStorage.getItem(
            'selectedDepartamento');

        // Verificar si hay un valor almacenado y establecerlo como la opción seleccionada
        if (storedDepartamento) {
            departamentoSelect.value = storedDepartamento;
            cargarMunicipios(storedDepartamento);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let marcas = document.getElementById('marcas');
            let container = document.getElementById('items_container');
            let marcas_preferencias = document.getElementById('marcas_preferencias');
            marcas_preferencias.classList.add('hide');

            // Función para agregar un botón
            function agregarBoton(item) {
                const botonesExistentes = Array.from(container.children).map(button => button.textContent.replace(/×/g, ''))

                if (!botonesExistentes.includes(item)) {
                    let button = document.createElement('button');
                    button.type = 'button'; // Cambiamos el tipo de submit a button
                    button.classList.add('item_selected');
                    button.setAttribute('name', 'item');
                    button.innerHTML = item  + '<span class="btn_borrar_item">×</span>';

                    // Agregar un evento de escucha de clics al botón
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Evitar la recarga de la página

                        // Eliminar el botón del contenedor
                        container.removeChild(button);

                        if (container.children.length === 0) {
                            marcas_preferencias.classList.add('hide');
                            marcas.removeAttribute('required');
                        }
                    });

                    container.appendChild(button);
                }

            }

            // Si hay marcas seleccionadas, recrear los botones
            if (container.children.length > 0) {
                marcas_preferencias.classList.remove('hide');
                marcas.removeAttribute('required');

                // Agregar el evento de clic a los botones existentes
                let botones = container.querySelectorAll('.item_selected');
                botones.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        container.removeChild(button);

                        if (container.children.length === 0) {
                            marcas_preferencias.classList.add('hide');
                            marcas.removeAttribute('required');
                        }
                    });
                });
            }

            marcas.addEventListener('change', function() {

                let item = marcas.value;
                const botonesExistentes = Array.from(container.children).map(button => button.textContent);
                if (item !== "" && !botonesExistentes.includes(item)) {
                    agregarBoton(item);
                    marcas_preferencias.classList.remove('hide');
                }
            });

            document.getElementById('form_profile_edit').addEventListener('submit', function(
                event) {
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


            // Función para agregar un botón
            function agregarBoton(item) {
                const botonesExistentes = Array.from(container.children).map(button => button.textContent.replace(/×/g, ''));

                if (!botonesExistentes.includes(item)) {
                    let button = document.createElement('button');
                    button.type = 'button'; // Cambiamos el tipo de submit a button
                    button.classList.add('item_selected');
                    button.setAttribute('name', 'item_category');
                    button.innerHTML = item + '<span class="btn_borrar_item">×</span>';

                    // Agregar un evento de escucha de clics al botón
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); // Evitar la recarga de la página

                        // Eliminar el botón del contenedor
                        container.removeChild(button);

                        if (container.children.length === 0) {
                            categorias_preferencias.classList.add('hide');
                            categoria.removeAttribute('required');
                        }
                    });

                    container.appendChild(button);
                }

            }

            // Si hay categorias seleccionadas, recrear los botones
            if (container.children.length > 0) {
                categorias_preferencias.classList.remove('hide');
                categoria.removeAttribute('required');

                // Agregar el evento de clic a los botones existentes
                let botones = container.querySelectorAll('.item_selected');
                botones.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        container.removeChild(button);

                        if (container.children.length === 0) {
                            categorias_preferencias.classList.add('hide');
                            categoria.removeAttribute('required');
                        }
                    });
                });
            }

            categoria.addEventListener('change', function() {

                let item = categoria.value;
                const botonesExistentes = Array.from(container.children).map(button => button.textContent);
                if (item !== "" && !botonesExistentes.includes(item)) {
                    agregarBoton(item);
                    categorias_preferencias.classList.remove('hide');
                }
            });

            document.getElementById('form_profile_edit').addEventListener('submit', function(
                event) {
                event.preventDefault(); // Evitar el envío del formulario para manejarlo manualmente

                // Obtener los textos de los botones en un arreglo
                let textosSeleccionados = Array.from(container.children).map(button => button.textContent);

                // Convertir el arreglo a una cadena JSON
                let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                // Agregar un campo oculto al formulario y asignarle la cadena JSON
                let inputJson = document.createElement('input');
                inputJson.type = 'hidden';
                inputJson.name = 'json_categorias';
                inputJson.value = jsonTextosSeleccionados.replace(/×/g, '').replace(/\n/g, '').replace(/\r/g, '');
                this.appendChild(inputJson);

                // Ahora, puedes enviar el formulario
                this.submit();
            });
        });
    </script>

    @if ($usuario->role == 'Proveedor')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                let text_rut = document.getElementById('text_file_rut');
                let text_cam = document.getElementById('text_file_cam');

                text_rut.innerHTML = "{{ $usuario->proveedor->rut }}";
                text_cam.innerHTML = "{{ $usuario->proveedor->camara_comercio }}";

                let rut = document.getElementById('rut');
                let cam = document.getElementById('cam');

                const btn1 = document.getElementById('btn1');
                const i1 = document.getElementById('check1');
                i1.style.display = "none";

                const btn2 = document.getElementById('btn2');
                const i2 = document.getElementById('check2');
                i2.style.display = 'none';

                rut.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        console.log('Se ha seleccionado al menos un archivo.');
                        btn1.style.borderColor = 'rgb(157, 232, 157)';
                        i1.style.display = 'block';
                        text_rut.innerHTML = this.files[0].name;
                    }
                });

                cam.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        btn2.style.borderColor = 'rgb(157, 232, 157)';
                        i2.style.display = 'block';
                        text_cam.innerHTML = this.files[0].name;
                    }
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let nit = document.getElementById('nit');

            function nitValidity() {
                if (nit.value.length != 0) {
                    if (nit.value.length > 12 || nit.value.length < 8) {
                        nit.setCustomValidity("El nit es muy largo o muy corto");
                    } else if (isNaN(nit.value)) {
                        nit.setCustomValidity("El nit debe contener solo números");
                    } else {
                        nit.setCustomValidity("");
                    }
                } else {
                    nit.setCustomValidity("");
                }
            }

            nit.addEventListener('change', nitValidity);

            nitValidity();
        });
    </script>

    <script>
        const password = document.querySelector('#password');
        const confirmPassword = document.querySelector('#confirm_password');
        // const password_actual = document.querySelector('#password_actual');

        const togglePassword = document.querySelector('#togglePassword');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        // const togglePasswordActual = document.querySelector('#togglePasswordActual');

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

@endsection
