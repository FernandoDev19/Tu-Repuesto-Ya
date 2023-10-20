@extends('layouts.app')
@section('title', 'Register - Tu Repuesto Ya')

<link rel="stylesheet" href="{{ asset('css/registerStyle.css') }}">

@section('style-body',
    "background: linear-gradient(180deg, #4794F9 , #0f3d79);
    background-size: 200% 100%; min-height: 100%; min-width: 100%;")

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
            <div class="container-register" style="padding: 3% 15%;">
                <div class="page-header min-vh-90"
                    style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59;">
                    <a class="fixed-plugin-button text-dark position-absolute top-0 end-0" href="{{ route('servicios') }}"
                        style="padding: 1% 1% 0 0;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
                            alt="logo" style="height: 6vh; width: auto;">
                    </a>
                    <div class="container" style="margin-right: unset;">
                        <div class="">
                            <div class="animate__animated animate__fadeIn animate__delay-1s animate__faster col-lg-6 end-0 text-center justify-content-center flex-column mx-lg-0 mx-auto"
                                style="margin-left: auto !important;">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start" style="background: transparent;">
                                        <h4 class="font-weight-bolder">Registrate</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="registrationForm" role="form" method="POST"
                                            action="{{ route('store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="nit" class="form-control"
                                                    placeholder="NIT de la empresa" aria-label="Nit"
                                                    value="{{ old('nit') }}">
                                                @error('nit')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="razon" class="form-control"
                                                    placeholder="Razón social" aria-label="Razon"
                                                    value="{{ old('razon') }}">
                                                @error('razon')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="container-inputs-location"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="flex flex-col mb-3" style="width: 49%;">
                                                    <select id="departamento" name="departamento" class="form-control">
                                                        <option value="">Seleccione un departamento</option>
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
                                                        <option value="">Seleccione un municipio</option>

                                                    </select>
                                                    @error('municipio')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="text" name="direccion" class="form-control"
                                                    placeholder="Dirección" aria-label="Direccion"
                                                    value="{{ old('direccion') }}">
                                                @error('direccion')
                                                    <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="container-inputs-contact"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="flex flex-col mb-3" style="width: 49%;">
                                                    <input type="text" name="cel" class="form-control"
                                                        placeholder="Número de celular" aria-label="Cel"
                                                        value="{{ old('cel') }}">
                                                    @error('cel')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3" style="width: 49%;">
                                                    <input type="text" name="tel" class="form-control"
                                                        placeholder="Número de telefono" aria-label="Tel"
                                                        value="{{ old('tel') }}">
                                                    @error('tel')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-col mb-3">
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Correo electronico" aria-label="Email"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="container-inputs-password"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="form-group" style="width: 49%;">
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" placeholder="Contraseña" arua-label="Contraseña"
                                                        value="{{ old('password') }}">
                                                    @error('password')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group" style="width: 49%;">
                                                    <input type="password" class="form-control" id="confirm_password"
                                                        name="confirm_password" placeholder="Confirmar contraseña"
                                                        aria-label='Confirm_contraseña'
                                                        value="{{ old('confirm_password') }}">
                                                    @error('confirm_password')
                                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="container-inputs-files mb-3"
                                                style="display:flex; justify-content: space-between;">
                                                <div class="flex flex-col" style="width: 49%;">
                                                    <label id="btn1" class="button form-control" for="rut"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div>RUT (Actualizado)
                                                        </div>
                                                        <div><i id="check1" class="fa fa-check"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="rut" id="rut"
                                                        class="form-control" aria-label="Rut" style="display: none;">
                                                    @error('rut')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col" style="width: 49%;">
                                                    <label id="btn2" class="button form-control" for="cam"
                                                        style="margin: 0; cursor: pointer; display: flex; justify-content: space-between;">
                                                        <div>Camara de comercio (Actualizada)</div>
                                                        <div><i id="check2" class="fa fa-check"
                                                                aria-hidden="true"></i></div>
                                                    </label>
                                                    <input type="file" accept=".pdf" name="cam" id="cam"
                                                        class="form-control" aria-label="Cam" style="display: none;">
                                                    @error('cam')
                                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="form-check form-check-info text-start">
                                                <input class="form-check-input" type="checkbox" name="terms"
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Acepto los <a href="javascript:;"
                                                        class="text-dark font-weight-bolder">Términos y
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
                                                    class="text-dark font-weight-bolder">Iniciar sesión</a></p>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div
                                class="animate__animated animate__bounceInRight animate__fast col-6 d-lg-flex d-none h-100 my-auto position-absolute top-0 start-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 px-7 d-flex flex-column justify-content-center overflow-hidden"
                                    style="background-image: url('/img/backgrounds/fondo-login-v1.jpg');
                                    background-size: cover;">
                                    <span class="mask opacity-6"
                                        style="background-image: linear-gradient(60deg, #06090D 0%, #132340 100%);"></span>
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the
                                        new
                                        currency"</h4>
                                    <p class="text-white position-relative">The more effortless the writing looks, the
                                        more
                                        effort the writer actually put into the process.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Milano Rent a Car 2023</span>
                    </div>
                </div>
            </footer>
        </section>
    </main>

    <script>
        // Obtener los elementos del formulario
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
                    municipioSelect.innerHTML += `<option value="${municipio}">${municipio}</option>`;
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
                municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
            }
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
