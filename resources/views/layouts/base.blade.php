<!DOCTYPE html>
<html lang="es">

<head>
    @include('includes.head')
</head>

<body style="display: flex; align-items: center;">
    <div class="container-body">
        @yield('content')

        {{-- Modal cliente --}}
        <div style="max-height: 100vh; max-width: 100vw;" class="modal fade" id="clienteModal" tabindex="-1" role="dialog"
            aria-labelledby="clienteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 800px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear solicitud </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_client" method="post" action="{{ route('validation') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <fieldset class="mb-3">
                                <legend class="text-center">
                                    <h5>Datos del vehiculo</h5>
                                </legend>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="marca" class="form-control text-center"
                                        placeholder="Marca" aria-label="Marca" value="{{ old('marca') }}">
                                    @error('marca')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" name="referencia" class="form-control text-center"
                                        placeholder="Referencia" aria-label="Referencia"
                                        value="{{ old('referencia') }}">
                                    @error('referencia')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" name="modelo" class="form-control text-center"
                                        placeholder="Modelo (año)" aria-label="Modelo" value="{{ old('modelo') }}">
                                    @error('modelo')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <select class="form-control text-center" name="tipo" id="tipo"
                                        style="color: var(--bs-secondary-color);">
                                        <option value="">Tipo de transmisión (caja)</option>
                                        <option value="manual">Manual</option>
                                        <option value="semiautomatica">Semiautomática</option>
                                        <option value="automatica">Automatica</option>
                                    </select>
                                    @error('tipo')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" name="repuesto" class="form-control text-center"
                                        placeholder="Repuesto" aria-label="Repuesto" value="{{ old('repuesto') }}">
                                    @error('repuesto')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3 text-center">
                                    <label id="btn" class="button form-control" for="img_repuesto"
                                        style="margin: 0; cursor: pointer; color: var(--bs-secondary-color);">
                                        Subir imagen del repuesto (opcional) 
                                    </label>
                                    <input type="file" accept=".png, .jpg, .jpeg" name="img_repuesto"
                                        id="img_repuesto" class="form-control text-center" aria-label="img_repuesto"
                                        style="display: none;">
                                    @error('img_repuesto')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </fieldset> <style>body{display: block}</style>

                            {{-- <fieldset>
                                <legend class="text-center">
                                    <h5>Datos del vehiculo</h5>
                                </legend>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="marca" class="form-control text-center"
                                        placeholder="Marca" aria-label="Marca" value="{{ old('marca') }}">
                                    @error('marca')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="group-datos-vehicle-1" style="display: flex; gap: 2%;">
                                    <div class="flex flex-col mb-3 w-50">
                                        <input type="text" name="referencia" class="form-control text-center"
                                            placeholder="Referencia" aria-label="Referencia"
                                            value="{{ old('referencia') }}">
                                        @error('referencia')
                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-3 w-50">
                                        <input type="text" name="modelo" class="form-control text-center"
                                            placeholder="Modelo (año)" aria-label="Modelo" value="{{ old('modelo') }}">
                                        @error('modelo')
                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="flex flex-col mb-3">
                                    <select class="form-control text-center" name="tipo" id="tipo">
                                        <option value="">Tipo de transmisión (caja)</option>
                                        <option value="manual">Manual</option>
                                        <option value="semiautomatica">Semiautomática</option>
                                        <option value="automatica">Automatica</option>
                                    </select>
                                    @error('tipo')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="group-datos-vehicle-2" style="display: flex; gap: 2%;">
                                    <div class="flex flex-col mb-3 w-50">
                                        <input type="text" name="repuesto" class="form-control text-center"
                                            placeholder="Repuesto" aria-label="Repuesto" value="{{ old('repuesto') }}">
                                        @error('repuesto')
                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="flex flex-col mb-3 text-center w-50">
                                        <label id="btn" class="button form-control" for="img_repuesto"
                                            style="margin: 0; cursor: pointer;">
                                            Subir imagen del repuesto (opcional)
                                        </label>
                                        <input type="file" accept=".png, .jpg, .jpeg" name="img_repuesto"
                                            id="img_repuesto" class="form-control text-center" aria-label="img_repuesto"
                                            style="display: none;">
                                        @error('img_repuesto')
                                            <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </fieldset> --}}

                            <fieldset>
                                <legend class="text-center">
                                    <h5>Datos del cliente</h5>
                                </legend>
                                <div class="flex flex-col mb-3">
                                    <input type="text" class="form-control text-center" id="nombre" name="nombre"
                                        placeholder="Nombre" aria-label="Nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" class="form-control text-center"" id="cel"
                                        name="cel" placeholder="Número de celular" aria-label='Cel'
                                        value="{{ old('cel') }}">
                                    @error('cel')
                                        <p class='text-danger text-xs pt-1'>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <input type="text" class="form-control text-center" id="email"
                                        name="email" placeholder="Email" aria-label="Email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <select id="departamento" name="departamento" class="form-control text-center"
                                        style="color: var(--bs-secondary-color);">
                                        <option value="">Seleccione un departamento</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento }}">{{ $departamento }}</option>
                                        @endforeach
                                    </select>
                                    @error('departamento')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <select name="municipio" id="municipio" class="form-control text-center"
                                        style="color: var(--bs-secondary-color);">
                                        <option value="">Seleccione un municipio</option>

                                    </select>
                                    @error('municipio')
                                        <div class="text-danger text-xs pt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex flex-col mb-3">
                                    <textarea name="comentario" class="form-control text-center" placeholder="Comentario..." aria-label="Comentario"
                                        rows="5">{{ old('comentario') }}</textarea>
                                    @error('comentario')
                                        <div class='text-danger text-xs pt-1'> {{ $message }} </div>
                                    @enderror
                                </div>

                            </fieldset>
                            <div class="text-center">
                                <button id="btn_modal_client" type="submit"
                                    class="btn btn-primary w-100 my-4 mb-2">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        @include('includes.scripts')
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
                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                }
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let img_repuesto = document.getElementById('img_repuesto');
                const btn = document.getElementById('btn');

                img_repuesto.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        console.log('Se ha seleccionado al menos un archivo.');
                        btn.style.borderColor = 'rgb(157, 232, 157)';
                        btn.innerHTML = 'Se ha seleccionado un archivo <i id="check" class="fa fa-check" aria-hidden="true"></i>';
                    }
                });
            });
        </script>

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
    </div>
    @include('includes.footer')
</body>

</html>
