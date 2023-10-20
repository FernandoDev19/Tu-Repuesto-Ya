@extends('layouts.app')

@section('title', 'Solicitud - Tu Repuesto Ya')

<style>
    .datos_pedido {
        border-style: none !important;
    }

    @media (max-width: 975px) {
        .contenedor {
            flex-direction: column;
        }

        .contenedor div {
            min-width: 100% !important;
            border: none !important;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@section('style-body',
    "background: linear-gradient(180deg, #4794F9 , #0f3d79);
    background-size: 200% 100%; min-height: 100%; min-width: 100%;")

@section('content')

    @if (session('message'))
        <div class="alert alert-info" id="registration-message">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error">
            {{ session('error') }}
        </div>
    @endif

    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>

    <main class="main-content  mt-0">
        <section>
            <div class="container-form" style="padding: 3% 15%;">
                <div class="animate__animated animate__fadeIn animate__slow page-header min-vh-90"
                    style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59;">
                    <div class="container-form-w" style="width: 100%;">
                        <form id="form_provider" action="{{ route('validationDP', $codigo) }}" method="post">
                            @csrf
                            <div class="container-img mb-4" style="display: flex; justify-content: center; width: 100%;">
                                <a class="fixed-plugin-button text-dark" href="{{ route('servicios') }}"
                                    style="padding: 1% 1% 0 0; z-index: 2;">
                                    <img decoding="async" class="logo"
                                        src="{{ asset('img/logo tu repuesto ya/logo tu repuesto.png') }}" alt="logo"
                                        style="height: 8vh; width: auto;">
                                </a>
                            </div>
                            <div class="container-flex-form" style="padding: 0 5%;">

                                <div class="contenedor" style="display: flex; width: 100%;">
                                    <div class="contenedor-form animate__animated animate__fadeIn col-6 d-lg-flex position-relative top-0 start-0 col-md-6 d-flex flex-column"
                                        style="border-right: 0.5px solid aliceblue;">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-center">
                                                <h4 class="font-weight-bolder">Datos del pedido</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="flex flex-col mb-3">
                                                    <div class="text-start">
                                                        <label for="marca" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Marca</h5>
                                                        </label>
                                                        <span style="background-color: rgba(218, 218, 218, 0.21);"
                                                            type="text" name="marca"
                                                            class="form-control text-start datos_pedido" placeholder="Marca"
                                                            aria-label="Marca">{{ $marca }}</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <div class="text-start">
                                                        <label for="referencia" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Referencia</h5>
                                                        </label>
                                                        <span style="background-color: rgba(218, 218, 218, 0.21);"
                                                            type="text" name="referencia"
                                                            class="form-control text-start datos_pedido"
                                                            placeholder="Referencia"
                                                            aria-label="Referencia">{{ $referencia }}</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="modelo" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Modelo</h5>
                                                        </label>
                                                        <span style="background-color: rgba(218, 218, 218, 0.21);"
                                                            type="text" name="modelo"
                                                            class="form-control text-start datos_pedido"
                                                            placeholder="Modelo"
                                                            aria-label="Modelo">{{ $modelo }}</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <div class="text-start">
                                                        <label for="tipo" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Tipo de transmisión</h5>
                                                        </label>
                                                        <span style="background-color: rgba(218, 218, 218, 0.21);"
                                                            type="text" name="tipo"
                                                            class="form-control text-start datos_pedido"
                                                            placeholder="Tipo de transmision"
                                                            aria-label="Tipo">{{ $tipo }}</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="repuesto" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Repuesto</h5>
                                                        </label>
                                                        <div>
                                                            <span
                                                                style="background-color: rgba(218, 218, 218, 0.21); display: flex; justify-content: space-between; align-items: center;"
                                                                type="text" name="repuesto"
                                                                class="form-control text-start datos_pedido"
                                                                placeholder="Repuesto"
                                                                aria-label="Repuesto">{{ $repuesto }}
                                                                @if ($img_repuesto == 'No se subió ningun archivo')
                                                                    <small><strong>No hay imagen</strong></small>
                                                                @elseif ($img_repuesto)
                                                                    <a title="Ver imagen del repuesto" data-toggle="modal"
                                                                        data-target="#infoModal" href="#"><i
                                                                            class="fas fa-image"
                                                                            style="font-size: 18px;"></i></a>
                                                                @else
                                                                    No hay imagen
                                                                @endif
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="comentario" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Comentarios</h5>
                                                        </label>
                                                        <textarea style="background-color: rgba(218, 218, 218, 0.21);" name="comentario"
                                                            class="form-control text-start datos_pedido" placeholder="Vacio..." aria-label="Comentario" rows="5"
                                                            readonly disabled>{{ $comentario }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contenedor-form animate__animated animate__fadeIn col-6 d-lg-flex position-relative top-0 end-0 col-md-6 d-flex flex-column"
                                        style="border-left: 0.5px solid aliceblue;">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-center">
                                                <h4 class="font-weight-bolder">Datos del proveedor</h4>
                                            </div>
                                            <div class="card-body text-start">
                                                <div class="flex flex-col mb-3">
                                                    <label for="nit" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>NIT</h5>
                                                    </label>
                                                    <input type="text" name="nit" id="nit"
                                                        class="form-control text-start" placeholder="NIT del proveedor"
                                                        aria-label="Nit"
                                                        @if ($nit) value="{{ $nit }}" @else value="{{ old('nit') }}" @endif>
                                                    @error('nit')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="repuesto" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>repuesto</h5>
                                                    </label>
                                                    <input type="text" name="repuesto" id="repuesto"
                                                        class="form-control text-start" placeholder="{{ $repuesto }}"
                                                        aria-label="Repuesto" value="{{ $repuesto }}">
                                                    @error('repuesto')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="tipo_repuesto" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>Tipo de repuesto</h5>
                                                    </label>
                                                    <input type="text" name="tipo_repuesto" id="tipo_repuesto"
                                                        class="form-control text-start" placeholder="Chino"
                                                        aria-label="Tipo_repuesto" value="{{ old('tipo_repuesto') }}">
                                                    @error('tipo_repuesto')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="precio" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>Precio (cop)</h5>
                                                    </label>
                                                    <input type="text" name="precio" id="precio"
                                                        class="form-control text-start" placeholder="ejemplo: 12345..."
                                                        aria-label="Precio" value="{{ old('precio') }}"
                                                        onkeyup="formatoPrecio(this)">
                                                    @error('precio')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <label for="garantia" class="mb-2"
                                                        style="color: blue; font-weight: 900;">
                                                        <h5>Garantía</h5>
                                                    </label>
                                                    <div class="container_form" style="display: flex; gap: 1%; ">
                                                        <input type="text" id="garantia" name="garantia"
                                                            class="form-control text-start" placeholder="Ejemplo: 6"
                                                            aria-label="Garantia" value="{{ old('garantia') }}"
                                                            onkeyup="garantiaSelect(this)">
                                                        <select name="garantiaSeleccion" id="garantiaSeleccion"
                                                            class="form-control" style="width: auto;">
                                                            <option value="mes">mes</option>
                                                            <option value="año">año</option>
                                                        </select>
                                                    </div>
                                                    @error('garantia')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>


                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="comentarioP" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Comentarios</h5>
                                                        </label>
                                                        <textarea name="comentarioP" class="form-control text-center" placeholder="Comentarios..." aria-label="ComentarioP"
                                                            rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="animate__animated animate__fadeIn animate__delay-4s card-footer text-center pt-0 px-lg-4 px-1"
                                style="padding: 0 5% !important;">
                                <div class="d-flex justify-content-end" style="gap: 10px; padding: 0% 1.5rem 0.5% 0;">
                                    <div class="text-center">
                                        @if (auth()->check())
                                            <a id="btn-cancel" href="{{ route('viewSolicitudes') }}"
                                                class="btn btn-secondary w-100 mb-2">Cancelar</a>
                                        @else
                                            <a id="btn-cancel" href="{{ route('servicios') }}"
                                                class="btn btn-secondary w-100 mb-2">Cancelar</a>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button id="btn" type="submit"
                                            class="btn btn-primary w-100 mb-2">Enviar</button>
                                    </div>
                                </div>

                            </div>
                        </form>
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

    <!-- Modal de Información -->
    <div style="min-height: 100vh; min-width: 100vw;" class="modal fade" id="infoModal" tabindex="-1" role="dialog"
        aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1000px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">
                        Imagen del repuesto</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body d-flex justify-content-center">
                    <div class="text-wrap">
                        <div style="display: flex; justify-content: center; box-sizing: border-box">
                            <img src="{{ asset("storage/$img_repuesto") }}" alt="imagen"
                                style="height: 100%; width: 100%;">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        setTimeout(function() {
            var registrationMessage = document.getElementById('registration-message');
            if (registrationMessage) {
                registrationMessage.remove();
            }
        }, 5000);
    </script>

    <script>
        setTimeout(function() {
            var error = document.getElementById('error');
            if (error) {
                error.remove();
            }
        }, 5000);
    </script>

    <script>
        function formatoPrecio(input) {
            // Obtén el valor actual del campo de entrada
            let valor = input.value.replace(/\D/g, ''); // Elimina cualquier caracter que no sea un número

            // Formatea el valor con comas cada tres dígitos
            valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Establece el valor formateado en el campo de entrada
            input.value = valor;
        }

        function garantiaSelect(input) {
            let value = input.value.replace(/\D/g, '');
            var select = document.getElementById('garantiaSeleccion');

            if (value == 0 || value == 1) {
                select.options[0].innerHTML = 'Mes';
                select.options[0].value = 'mes';
                select.options[1].innerHTML = 'Año';
                select.options[1].value = 'año';
            } else {
                select.options[0].innerHTML = 'Meses';
                select.options[0].value = 'meses';
                select.options[1].innerHTML = 'Años';
                select.options[1].value = 'años';
            }
        }
    </script>
@endsection
