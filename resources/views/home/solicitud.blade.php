@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/solicitudStyle.css') }}" type="text/css">

@section('title', 'Solicitud | Tu Repuesto Ya')

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

    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>

    <main class="main-content  mt-0">
        <section>
            <div class="container-form contenedor-solicitud"
                style="padding: 3% 15%; display: flex; justify-content: center;">
                <div class="bg-transparent-cel flex-col-cel animate__animated animate__fadeIn animate__slow page-header min-vh-90"
                    style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59; max-width: 1328px !important; width: 100%;">
                    <a class="logo-solicitud-cel-position text-dark top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%; position: absolute; z-index: 2;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.webp') }}"
                            alt="logo" style="height: 6vh; width: auto;" height="30" width="30">
                    </a>
                    <div class="container-form-w" style="width: 100%;">
                        <form id="form_provider" action="{{ route('validationDP', $codigo) }}" method="post">
                            @csrf
                            <div class="container-flex-form">

                                <div class="contenedor" style="display: flex; width: 100%;">
                                    <div class="contenedor-form animate__animated animate__fadeIn col-6 d-lg-flex position-relative top-0 start-0 col-md-6 d-flex flex-column"
                                        style="border-right: 0.5px solid aliceblue;">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-center text-cel-center"
                                                style="background-color: transparent;">
                                                <h4 class="font-weight-bolder">Datos del pedido</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="flex flex-col mb-3">
                                                    <div class="text-start">
                                                        <label for="marca" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5 style="font-weight: 700;">Marca</h5>
                                                        </label>
                                                        <span style="background-color: rgb(143 143 143 / 21%);"
                                                            type="text" name="marca"
                                                            class="form-control text-start datos_pedido" placeholder="Marca"
                                                            aria-label="Marca">{{ $marca }}</span>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col mb-3">
                                                    <div class="text-start">
                                                        <label for="referencia" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5 style="font-weight: 700;">Referencia
                                                            </h5>
                                                        </label>
                                                        <span style="background-color: rgb(143 143 143 / 21%);"
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
                                                            <h5 style="font-weight: 700;">Modelo</h5>
                                                        </label>
                                                        <span style="background-color: rgb(143 143 143 / 21%);"
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
                                                            <h5 style="font-weight: 700;">Tipo de
                                                                transmisión</h5>
                                                        </label>
                                                        <span style="background-color: rgb(143 143 143 / 21%);"
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
                                                            <h5 style="font-weight: 700;">Repuestos
                                                            </h5>
                                                        </label>
                                                        <div class="form-control text-start"
                                                            style="background-color: rgb(143 143 143 / 21%); height: auto; display: flex; justify-content: space-between; align-items: center;">
                                                            <div class="items_container">
                                                                @if (is_array($repuesto))
                                                                    @foreach ($repuesto as $repuestos)
                                                                        <button type="button"
                                                                            class="item_selected_cliente">{{ $repuestos }}</button>
                                                                    @endforeach
                                                                @else
                                                                    <button type="button"
                                                                        class="item_selected_cliente">{{ $repuesto }}</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if (!(is_array($nombres) && in_array('No se subió ningun archivo', $nombres)))
                                                    <div class="flex flex-col mb-3">
                                                        <div class="text-start">
                                                            <div class="form-control text-start"
                                                                style="background-color: rgb(143 143 143 / 21%); height: auto; display: flex; justify-content: center; align-items: center;">
                                                                <a title="Ver imagen del repuesto" data-toggle="modal"
                                                                    data-target="#infoModal" href="#"
                                                                    style="text-align: center; font-weight: 700;"><i
                                                                        class="fas fa-image"
                                                                        style="font-size: 30px;"></i><br>Ver Fotos</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="comentario" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5 style="font-weight: 700;">Comentarios
                                                            </h5>
                                                        </label>
                                                        <textarea id="comentariosC" style="background-color: rgb(143 143 143 / 21%);" name="comentario"
                                                            class="form-control text-start datos_pedido" placeholder="Vacio..." aria-label="Comentario" rows="6"
                                                            readonly disabled>{{ $comentario }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count = 0;
                                    $count_btns = 1;
                                    $count_id = 1;
                                    $count_class = 1;
                                    $count_check = 1;
                                    ?>
                                    <div class="contenedor-form animate__animated animate__fadeIn col-6 d-lg-flex position-relative top-0 end-0 col-md-6 d-flex flex-column"
                                        style="border-left: 0.5px solid aliceblue;">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-center text-cel-center"
                                                style="background-color: transparent;">
                                                <h4 class="font-weight-bolder">Datos para cotizar</h4>
                                            </div>
                                            <div class="card-body text-start">
                                                <div class="flex flex-col mb-5">
                                                    <label for="nit" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5 style="font-weight: 700;"><span
                                                                class="text-danger">*</span>NIT del almacén</h5>
                                                    </label>
                                                    <input type="text" name="nit" id="nit"
                                                        class="form-control text-start" placeholder="NIT"
                                                        aria-label="Nit"
                                                        value="@if (auth()->check() and auth()->user()->hasRole('Proveedor')) {{ auth()->user()->proveedor->nit_empresa }}@else{{ old('nit') }} @endif"
                                                        required>
                                                    @error('nit')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @else
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3" style="overflow-x: hidden;">
                                                    <label for="repuesto" class="mb-3"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5 class="mb-2" style="font-weight: 700;">
                                                            <span class="text-danger">*</span>REPUESTOS SOLICITADOS
                                                        </h5>
                                                        <span
                                                            style="color: #344767de; font-size: 1.2rem !important;">¿Tienes
                                                            alguno de estos?</span> <br><br>
                                                        <span class="text-primary pt-1"
                                                            style="font-size: 1rem !important;">¡SELECCIONA!</span>
                                                    </label>

                                                    <div class="form-control"
                                                        style="height: auto; border: none; border: none; padding: 0;">
                                                        <div class="items_container" id="items_container">
                                                            @if (is_array($repuesto))
                                                                @foreach ($repuesto as $repuestos)
                                                                    <div style="width:100%; display: flex; gap: 1rem;">
                                                                        <button type="button"
                                                                            class="item_selected rojo {{ $count_class++ }}"
                                                                            name="item"><input type="checkbox"
                                                                                class="btn_borrar_item"
                                                                                id="check_{{ $count_btns++ }}">{{ $repuestos }}</button>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div style="width:100%; display: flex; gap: 1rem;">
                                                                    <button type="button"
                                                                        class="item_selected rojo {{ $count_class++ }}"
                                                                        name="item"><input type="checkbox"
                                                                            class="btn_borrar_item"
                                                                            id="check_{{ $count_btns++ }}">{{ $repuesto }}</button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <span class="text-primary pt-1"
                                                        style="font-size: 1.2rem !important; font-weight: 700;">COTIZA</span>
                                                    @error('json_repuestos')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                {{-- Tipo de repuesto --}}
                                                {{-- <div class="flex flex-col mb-3">
                                                    <label for="tipo_repuesto" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>*Tipo de repuestos</h5>
                                                    </label>
                                                    <select name="tipo_repuesto" id="tipo_repuesto"
                                                        class="form-control text-start" aria-label="Tipo de repuesto">
                                                        <option
                                                            title="Son los repuestos que vienen instalados de fábrica en tu vehículo. Garantizan la misma calidad y ajuste que cuando el carro era nuevo."
                                                            value="Originales"
                                                            style="display: flex; justify-content: space-between;">
                                                            Repuestos Originales</option>
                                                        <option value="Tipo Original (Elaborado en diferentes fabricas)"
                                                            title="Fabricados por la misma empresa que suministra al fabricante del carro, pero vendidos bajo la marca del fabricante de repuestos.">
                                                            Repuestos de tipo Original</option>
                                                        <option value="Generico"
                                                            title="Repuestos genéricos producidos por diversas empresas, con variaciones en calidad y precio.">
                                                            Repuestos Génericos</option>
                                                        <option value="Nacionales"
                                                            title="Repuestos nacionales fabricados dentro del país, con diferencias en calidad y precio respecto a los originales.">
                                                            Repuestos Nacionales</option>
                                                        <option value="Coreano"
                                                            title="Repuestos coreanos conocidos por su calidad y compatibilidad con modelos específicos de vehículos.">
                                                            Repuestos Coreanos</option>
                                                        <option value="Japones"
                                                            title="Repuestos japoneses que ofrecen alta calidad y rendimiento, ideales para vehículos de marcas japonesas.">
                                                            Repuestos Japoneses</option>
                                                        <option value="Chino"
                                                            title="Repuestos chinos que pueden ser más económicos, pero con una calidad que puede variar significativamente.">
                                                            Repuestos Chinos</option>
                                                        <option value="Remanufacturado"
                                                            title="Repuestos usados que han sido desmontados, inspeccionados y restaurados a condiciones de trabajo como nuevas.">
                                                            Repuestos Remanufacturados</option>
                                                        <option value="Reacondicionado"
                                                            title="Similar a los remanufacturados, pero con un proceso de restauración que puede no ser tan completo.">
                                                            Repuestos Reacondicionados</option>
                                                        <option value="Usado"
                                                            title="Extraídos de vehículos que ya no están en funcionamiento, son una opción más económica pero con una vida útil variable.">
                                                            Repuestos Usados o Reciclados</option>
                                                    </select>
                                                    @error('tipo_repuesto')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div> --}}

                                                {{-- <div class="flex flex-col mb-3">
                                                    <label for="precio" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>*Precio (COP)</h5>
                                                    </label>
                                                    <input type="text" name="precio" id="precio"
                                                        class="form-control text-start" placeholder="ejemplo: 12345..."
                                                        aria-label="Precio" value="{{ old('precio') }}"
                                                        onkeyup="formatoPrecio(this)" required>
                                                    @error('precio')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div> --}}

                                                {{-- Garantia --}}
                                                {{-- <div class="flex flex-col mb-3">
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
                                                </div> --}}

                                                {{-- Para mas de un repuesto --}}
                                                <div class="flex flex-col mb-3">
                                                    <div
                                                        style="width: 100%; display: flex; gap: 5%; flex-wrap: wrap; justify-content: space-between;">
                                                        @php
                                                            $contador = 0;
                                                        @endphp
                                                        @if (is_array($repuesto))
                                                            @foreach ($repuesto as $repuestos)
                                                                <div id="container_{{ $count_id++ }}" class="hide"
                                                                    style="display: flex; flex-direction: column; margin: 2% 2% 0 0; gap: 8px; border: 1px solid darkgray;
                                                                    border-radius: .375rem; border-top: none; border-left: none; border-right: none; padding: 1rem 0;">
                                                                    <h5><strong>{{ ++$count . '. ' . $repuestos }}</strong>
                                                                    </h5>

                                                                    <label for="precio"
                                                                        style="color: #344767; margin: 0;"><span
                                                                            class="text-danger">*</span>Precio</label>
                                                                    <input type="text" name="precio[]" id="precio"
                                                                        class="form-control text-start"
                                                                        placeholder="ejemplo: 12345..."
                                                                        aria-label="Precio"
                                                                        value='{{ old("precio[$count]") }}'
                                                                        onkeyup="formatoPrecio(this)" disabled required>

                                                                    @error('precio')
                                                                        <small
                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                    @enderror

                                                                    <div style="display: flex;">
                                                                        <input type="checkbox" name=""
                                                                            class="sobrepedido {{ ++$contador }}"
                                                                            id="sobrepedido_{{ $contador }}"
                                                                            style="margin-right: .5rem;">
                                                                        <label for="sobrepedido" class="text-primary"
                                                                            style="margin: 0;">Entrega sobre pedido</label>
                                                                    </div>

                                                                    <div id="container_tiempo_entrega_{{ $contador }}"
                                                                        class="container_tiempo_entrega hide">
                                                                        <label for="tiempo_entrega"
                                                                            style="margin: 0;">Tiempo de entrega
                                                                            (Días)
                                                                        </label>
                                                                        <input class="form-control" type="number"
                                                                            name="tiempo_entrega[]" id="tiempo_entrega"
                                                                            placeholder="Ejemplo: 5"
                                                                            style="margin-right: .5rem; appearance: auto;">
                                                                    </div>

                                                                    <label for="tipo_repuesto"
                                                                        style="color: #344767; margin: 0;">Tipo de
                                                                        Repuesto</label>
                                                                    <select name="tipo_repuesto[]" id="tipo_repuesto"
                                                                        class="form-control text-start"
                                                                        aria-label="Tipo de repuesto"
                                                                        style="padding: 0 0 0 0.75rem; appearance: auto;">
                                                                        <option value="Nuevos"
                                                                            style="display: flex; justify-content: space-between;">
                                                                            Repuestos Nuevos</option>
                                                                        <option
                                                                            title="Son los repuestos que vienen instalados de fábrica en tu vehículo. Garantizan la misma calidad y ajuste que cuando el carro era nuevo."
                                                                            value="Originales"
                                                                            style="display: flex; justify-content: space-between;">
                                                                            Repuestos Originales</option>
                                                                        <option
                                                                            value="Tipo Original (Elaborado en diferentes fabricas)"
                                                                            title="Fabricados por la misma empresa que suministra al fabricante del carro, pero vendidos bajo la marca del fabricante de repuestos.">
                                                                            Repuestos de tipo Original</option>
                                                                        <option value="Generico"
                                                                            title="Repuestos genéricos producidos por diversas empresas, con variaciones en calidad y precio.">
                                                                            Repuestos Genéricos</option>
                                                                        <option value="Nacionales"
                                                                            title="Repuestos nacionales fabricados dentro del país, con diferencias en calidad y precio respecto a los originales.">
                                                                            Repuestos Nacionales</option>
                                                                        <option value="Coreano"
                                                                            title="Repuestos coreanos conocidos por su calidad y compatibilidad con modelos específicos de vehículos.">
                                                                            Repuestos Coreanos</option>
                                                                        <option value="Japones"
                                                                            title="Repuestos japoneses que ofrecen alta calidad y rendimiento, ideales para vehículos de marcas japonesas.">
                                                                            Repuestos Japoneses</option>
                                                                        <option value="Chino"
                                                                            title="Repuestos chinos que pueden ser más económicos, pero con una calidad que puede variar significativamente.">
                                                                            Repuestos Chinos</option>
                                                                        <option value="Remanufacturado"
                                                                            title="Repuestos usados que han sido desmontados, inspeccionados y restaurados a condiciones de trabajo como nuevas.">
                                                                            Repuestos Remanufacturados</option>
                                                                        <option value="Reacondicionado"
                                                                            title="Similar a los remanufacturados, pero con un proceso de restauración que puede no ser tan completo.">
                                                                            Repuestos Reacondicionados</option>
                                                                        <option value="Usado"
                                                                            title="Extraídos de vehículos que ya no están en funcionamiento, son una opción más económica pero con una vida útil variable.">
                                                                            Repuestos Usados o Reciclados</option>
                                                                    </select>

                                                                    @error('tipo_repuesto')
                                                                        <small
                                                                            class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                    @enderror


                                                                    <div class="container_descripcion">
                                                                        <label for="descripcion"
                                                                            style="margin: 0;">Descripción</label>
                                                                        <div style="display: flex; align-items: center;">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Campo libre">
                                                                            <i title="Ideas para usar este campo:
-Escribe la marca del repuesto
-Indica si es una promoción
-Si es derecho, izquierdo, delantero o trasero"
                                                                                id="icon_info_description"
                                                                                class="fas fa-info ml-2"
                                                                                onclick="alert('Ideas para usar este campo:\n-Escribe la marca del repuesto\n-Indica si esa una promoción\n-Si es derecho, izquierdo, delantero o trasero')"
                                                                                style="color: #12e912;"></i>

                                                                        </div>

                                                                    </div>

                                                                    <div style="width: 100%; text-align: end;">
                                                                        <small
                                                                            class="agregar_otra_oferta {{ $contador }} text-primary text-xs pt-1"
                                                                            style="margin-left: auto; cursor: pointer; display: block;">Agregar
                                                                            otra
                                                                            oferta</small>
                                                                    </div>

                                                                    <div id="container_ofertas_{{ $contador }}"
                                                                        class="container_ofertas" style="width: 100%;">

                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div id="container_{{ $count_id++ }}" class="hide"
                                                                style="display: flex; flex-direction: column; margin: 2% 2% 0 0; gap: 8px; border-bottom: 1px solid darkgray;
                                                                border-radius: .375rem; padding: 1rem 0;">
                                                                <h5><strong>{{ ++$count . '. ' . $repuesto }}</strong>
                                                                </h5>

                                                                <label for="precio"
                                                                    style="color: #344767; margin: 0;"><span
                                                                        class="text-danger">*</span>Precio</label>
                                                                <input type="text" name="precio[]" id="precio"
                                                                    class="form-control text-start"
                                                                    placeholder="ejemplo: 12345..." aria-label="Precio"
                                                                    value="{{ old('precio[' . $count . ']') }}"
                                                                    onkeyup="formatoPrecio(this)" disabled required>
                                                                @error('precio')
                                                                    <small
                                                                        class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                @enderror

                                                                <div style="display: flex;">
                                                                    <input type="checkbox" name=""
                                                                        id="sobrepedido" style="margin-right: .5rem;">
                                                                    <label for="sobrepedido" class="text-primary" style="margin: 0;">Entrega
                                                                        sobre pedido</label>
                                                                </div>

                                                                <div id="container_tiempo_entrega" class="hide">
                                                                    <label for="tiempo_entrega" style="margin: 0;">Tiempo
                                                                        de entrega (Días)</label>
                                                                    <input class="form-control" type="number"
                                                                        name="tiempo_entrega[]" id="tiempo_entrega"
                                                                        placeholder="Ejemplo: 5"
                                                                        style="margin-right: .5rem; appearance: auto;"
                                                                        maxlength="3">
                                                                </div>

                                                                <label for="tipo_repuesto"
                                                                    style="color: #344767; margin: 0;">Tipo de
                                                                    Repuesto</label>
                                                                <select name="tipo_repuesto[]" id="tipo_repuesto"
                                                                    class="form-control text-start"
                                                                    aria-label="Tipo de repuesto"
                                                                    style="padding: 0 0 0 0.75rem; appearance: auto;">
                                                                    <option value="Nuevos"
                                                                        style="display: flex; justify-content: space-between;">
                                                                        Repuestos Nuevos</option>
                                                                    <option
                                                                        title="Son los repuestos que vienen instalados de fábrica en tu vehículo. Garantizan la misma calidad y ajuste que cuando el carro era nuevo."
                                                                        value="Originales"
                                                                        style="display: flex; justify-content: space-between;">
                                                                        Repuestos Originales</option>
                                                                    <option
                                                                        value="Tipo Original (Elaborado en diferentes fabricas)"
                                                                        title="Fabricados por la misma empresa que suministra al fabricante del carro, pero vendidos bajo la marca del fabricante de repuestos.">
                                                                        Repuestos de tipo Original</option>
                                                                    <option value="Genéricos"
                                                                        title="Repuestos genéricos producidos por diversas empresas, con variaciones en calidad y precio.">
                                                                        Repuestos Genéricos</option>
                                                                    <option value="Nacionales"
                                                                        title="Repuestos nacionales fabricados dentro del país, con diferencias en calidad y precio respecto a los originales.">
                                                                        Repuestos Nacionales</option>
                                                                    <option value="Coreano"
                                                                        title="Repuestos coreanos conocidos por su calidad y compatibilidad con modelos específicos de vehículos.">
                                                                        Repuestos Coreanos</option>
                                                                    <option value="Japones"
                                                                        title="Repuestos japoneses que ofrecen alta calidad y rendimiento, ideales para vehículos de marcas japonesas.">
                                                                        Repuestos Japoneses</option>
                                                                    <option value="Chino"
                                                                        title="Repuestos chinos que pueden ser más económicos, pero con una calidad que puede variar significativamente.">
                                                                        Repuestos Chinos</option>
                                                                    <option value="Remanufacturado"
                                                                        title="Repuestos usados que han sido desmontados, inspeccionados y restaurados a condiciones de trabajo como nuevas.">
                                                                        Repuestos Remanufacturados</option>
                                                                    <option value="Reacondicionado"
                                                                        title="Similar a los remanufacturados, pero con un proceso de restauración que puede no ser tan completo.">
                                                                        Repuestos Reacondicionados</option>
                                                                    <option value="Usado"
                                                                        title="Extraídos de vehículos que ya no están en funcionamiento, son una opción más económica pero con una vida útil variable.">
                                                                        Repuestos Usados o Reciclados</option>
                                                                </select>

                                                                @error('tipo_repuesto')
                                                                    <small
                                                                        class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                @enderror

                                                                <div class="container_descripcion">
                                                                    <label for="descripcion"
                                                                        style="margin: 0;">Descripción</label>
                                                                    <div style="display: flex; align-items: center;">
                                                                        <input type="text" name="descripcion[]" class="form-control"
                                                                            placeholder="Campo libre">
                                                                        <i title="Ideas para usar este campo:
-Escribe la marca del repuesto
-Indica si es una promoción
-Si es derecho, izquierdo, delantero o trasero"
                                                                            id="icon_info_description"
                                                                            class="fas fa-info ml-2"
                                                                            onclick="alert('Ideas para usar este campo:\n-Escribe la marca del repuesto\n-Indica si es una promoción\n-Si es derecho, izquierdo, delantero o trasero')"
                                                                            style="color: #12e912;"></i>

                                                                    </div>

                                                                </div>

                                                                <div style="width: 100%; text-align: end;">
                                                                    <small id="agregar_otra_oferta"
                                                                        style="margin-left: auto; cursor: pointer; display: block;"
                                                                        class="text-primary text-xs pt-1">Agregar otra
                                                                        oferta</small>
                                                                </div>

                                                                <div id="container_ofertas" style="width: 100%;">

                                                                </div>
                                                            </div>

                                                        @endif

                                                    </div>
                                                    <!--Tipo de repuesto, Precio y garantia-->
                                                </div>

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="comentarioP" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5 style="font-weight: 700;">Comentarios
                                                            </h5>
                                                        </label>
                                                        <textarea id="comentario_proveedor" name="comentarioP" class="form-control text-center"
                                                            placeholder="¿Tienes algúnos Comentarios?" aria-label="ComentarioP" rows="6"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="animate__animated animate__fadeIn animate__delay-4s card-footer text-center pt-0 px-lg-4 px-1"
                                style="padding: 0 5% !important; background: transparent;">
                                <div class="d-flex justify-content-end" style="gap: 10px; padding: 0% 1.5rem 0.5% 0;">
                                    <div class="text-center">
                                        @if (auth()->check())
                                            <a id="btn-cancel" href="{{ route('viewSolicitudes') }}"
                                                class="btn btn-secondary w-100 mb-2">Cancelar</a>
                                        @else
                                            <a id="btn-cancel" href="{{ route('servicios') }}"
                                                class="btn btn-danger w-100 mb-2">Cancelar</a>
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

    <!-- Modal de Información -->
    <div class="modal" id="infoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imágenes del repuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (!empty($nombres))
                        <div id="carouselModal" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($nombres as $i => $imagen)
                                    <li data-target="#carouselModal" data-slide-to="{{ $i }}"
                                        class="{{ $i == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($nombres as $i => $imagen)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                        <img src='{{ asset("storage/$imagen") }}' alt="{{ $imagen }}"
                                            class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselModal" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselModal" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                    @else
                        <p>No hay imágenes disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Script para guardar datos de precio, garantia. --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let container_buttons = document.getElementById('items_container');
            let count_buttons = container_buttons.children.length;
            let count = 0;

            container_buttons.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn_borrar_item')) {
                    // Obtener el botón padre
                    let button = event.target.closest('.item_selected');

                    // Toggle de la clase "rojo" en el botón padre
                    if (button) {
                        button.classList.toggle('rojo');
                        button.classList.toggle('acepted');
                        let buttonNumber = button.classList[1];
                        let container_repuestos = document.getElementById('container_' + buttonNumber);
                        let children = container_repuestos.children;

                        if (button.classList.contains('rojo')) {
                            container_repuestos.classList.add('hide');
                            for (let i = 0; i < children.length; i++) {
                                children[i].disabled = true;
                            }
                        } else {
                            container_repuestos.classList.remove('hide');
                            for (let i = 0; i < children.length; i++) {
                                children[i].disabled = false;
                            }
                        }
                    }
                }
            });

            @if (is_array($repuesto))
                let check_sobre_pedido = document.getElementsByClassName('sobrepedido');


                for (let i = 0; i < check_sobre_pedido.length; i++) {
                    check_sobre_pedido[i].addEventListener('change', function() {
                        let number = this.classList[1];
                        let container_tiempo_entrega = document.getElementById('container_tiempo_entrega_' +
                            number);
                        if (this.checked) {
                            container_tiempo_entrega.classList.remove('hide');
                        } else {
                            container_tiempo_entrega.classList.add('hide');
                        }
                    });
                }

                let agregar_oferta_boton = document.getElementsByClassName('agregar_otra_oferta');

                for (let i = 0; i < agregar_oferta_boton.length; i++) {
                    agregar_oferta_boton[i].addEventListener('click', function() {
                        let number = this.classList[1];
                        //obtener contenedor
                        let container_ofertas = document.getElementById('container_ofertas_' + number);

                        if (container_ofertas.children.length < 1) {
                            count++;
                            container_ofertas.style.display = "flex";
                            container_ofertas.style.flexDirection = "column";
                            container_ofertas.style.gap = "5px";

                            //Crear elementos
                            const container = document.createElement('div');
                            const text_container_close = document.createElement('h6');
                            const container_close = document.createElement('div');
                            const btn_close = document.createElement('button');
                            const label_input = document.createElement("label");
                            const label_select = document.createElement("label");
                            const input = document.createElement("input");
                            const select = document.createElement('select');
                            let options = [
                                "Repuestos Nuevos",
                                "Repuestos Originales",
                                "Repuestos de tipo Original",
                                "Repuestos Genéricos",
                                "Repuestos Nacionales",
                                "Repuestos Coreanos",
                                "Repuestos Japoneses",
                                "Repuestos Chinos",
                                "Repuestos Remanufacturados",
                                "Repuestos Reacondicionados",
                                "Repuestos Usados o Reciclados"
                            ];

                            let valueMapping = {
                                "Repuestos Nuevos": "Nuevos",
                                "Repuestos Originales": "Originales",
                                "Repuestos de tipo Original": "Tipo original (Elaborado en distintas fábricas)",
                                "Repuestos Genéricos": "Genéricos",
                                "Repuestos Nacionales": "Nacionales",
                                "Repuestos Coreanos": "Coreanos",
                                "Repuestos Japoneses": "Japoneses",
                                "Repuestos Chinos": "Chinos",
                                "Repuestos Remanufacturados": "Remanufacturados",
                                "Repuestos Reacondicionados": "Reacondicionados",
                                "Repuestos Usados o Reciclados": "Usados"
                            };

                            container.setAttribute('id', 'contenedor_oferta_' + count);
                            container.classList.add('mt-2');
                            container.style.display = "flex";
                            container.style.flexDirection = "column";
                            container.style.gap = "8px";

                            btn_close.classList.add('close');
                            btn_close.textContent = "×";
                            btn_close.setAttribute('type', 'button');
                            btn_close.setAttribute('id', 'eliminar_' + count);
                            btn_close.addEventListener('click', function() {
                                let currentCount = parseInt(this.getAttribute('id').split('_')[1]);
                                eliminarOferta(currentCount);
                                agregar_oferta_boton.style.cursor = "pointer";
                            });
                            container_close.style.width = "100%";
                            container_close.style.display = 'flex';
                            container_close.style.justifyContent = 'space-between';
                            text_container_close.textContent = "Oferta";
                            text_container_close.classList.add('color-primary');
                            text_container_close.style.margin = '0';

                            container_close.appendChild(text_container_close);
                            container_close.appendChild(btn_close);

                            container.appendChild(container_close);

                            container.addEventListener("mouseenter", function() {
                                btn_close.style.color = '#000';
                            });
                            container.addEventListener("mouseleave", function() {
                                btn_close.style.color = 'gray';
                            });

                            //Agregar elementos al contenedor
                            label_input.setAttribute('for', 'nuevo_precio');
                            label_input.textContent = "Precio:";
                            label_input.style.margin = '0';
                            container.appendChild(label_input);

                            input.setAttribute('required', true);
                            input.setAttribute('name', 'precio_oferta[]');
                            input.classList.add('form-control');
                            input.setAttribute('placeholder', 'Ejemplo: 999.999');
                            input.setAttribute('id', 'nuevo_precio');
                            container.appendChild(input);

                            label_select.setAttribute('for', 'tipo_repuesto');
                            label_select.textContent = "Tipo de Repuesto:";
                            label_select.style.margin = '0';
                            container.appendChild(label_select);

                            select.classList.add('form-control');
                            select.setAttribute('name', 'tipo_repuesto_oferta[]');
                            select.setAttribute('id', 'tipo_repuesto');
                            select.style.padding = '0 0 0 0.75rem';
                            select.style.appearance = "auto";
                            for (let i = 0; i < options.length; i++) {
                                let option = document.createElement('option');
                                let texto = options[i];
                                let valor = valueMapping[texto];
                                option.setAttribute('value', valor);
                                option.textContent = texto;
                                select.appendChild(option);
                            }
                            container.appendChild(select);

                            container_ofertas.appendChild(container);
                        } else {
                            agregar_oferta_boton.style.cursor = "not-allowed";
                        }
                    });
                }

                function eliminarOferta(count) {
                    let contenedor = document.getElementById('contenedor_oferta_' + count);
                    contenedor.parentNode.removeChild(contenedor);
                }



                document.getElementById('form_provider').addEventListener('submit', function(event) {
                    event.preventDefault();

                    // Obtener los textos de los botones seleccionados
                    let textosSeleccionados = Array.from(container_buttons.getElementsByClassName(
                            'acepted'))
                        .map(button => button.textContent);

                    // Convertir el arreglo a una cadena JSON
                    let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                    // Agregar un campo oculto al formulario y asignarle la cadena JSON
                    let inputJson = document.createElement('input');
                    inputJson.type = 'hidden';
                    inputJson.name = 'json_repuestos';
                    inputJson.value = jsonTextosSeleccionados.replace(/[×\n]/g, '');
                    this.appendChild(inputJson);

                    // Salida de consola para verificar el valor de 'json_repuestos'
                    console.log('json_repuestos:', jsonTextosSeleccionados);

                    // Ahora, puedes enviar el formulario
                    this.submit();
                });
            @else

                let check_sobre_pedido = document.getElementById('sobrepedido');
                let container_tiempo_entrega = document.getElementById('container_tiempo_entrega');

                check_sobre_pedido.addEventListener('change', function() {
                    if (this.checked) {
                        container_tiempo_entrega.classList.remove('hide');
                    } else {
                        container_tiempo_entrega.classList.add('hide');
                    }
                });
                const agregar_oferta_boton = document.getElementById('agregar_otra_oferta');

                function eliminarOferta(count) {
                    let contenedor = document.getElementById('contenedor_oferta_' + count);
                    contenedor.parentNode.removeChild(contenedor);
                }

                agregar_oferta_boton.addEventListener('click', function() {
                    //obtener contenedor
                    let container_ofertas = document.getElementById('container_ofertas');

                    if (container_ofertas.children.length < 2) {
                        count++;
                        container_ofertas.style.display = "flex";
                        container_ofertas.style.flexDirection = "column";
                        container_ofertas.style.gap = "8px";

                        //Crear elementos
                        const container = document.createElement('div');
                        const text_container_close = document.createElement('h6');
                        const container_close = document.createElement('div');
                        const btn_close = document.createElement('button');
                        const label_input = document.createElement("label");
                        const label_select = document.createElement("label");
                        const input = document.createElement("input");
                        const select = document.createElement('select');
                        let options = [
                            "Repuestos Nuevos",
                            "Repuestos Originales",
                            "Repuestos de tipo Original",
                            "Repuestos Genéricos",
                            "Repuestos Nacionales",
                            "Repuestos Coreanos",
                            "Repuestos Japoneses",
                            "Repuestos Chinos",
                            "Repuestos Remanufacturados",
                            "Repuestos Reacondicionados",
                            "Repuestos Usados o Reciclados"
                        ];

                        let valueMapping = {
                            "Repuestos Nuevos": "Nuevos",
                            "Repuestos Originales": "Originales",
                            "Repuestos de tipo Original": "Tipo original (Elaborado en distintas fábricas)",
                            "Repuestos Genéricos": "Genéricos",
                            "Repuestos Nacionales": "Nacionales",
                            "Repuestos Coreanos": "Coreanos",
                            "Repuestos Japoneses": "Japoneses",
                            "Repuestos Chinos": "Chinos",
                            "Repuestos Remanufacturados": "Remanufacturados",
                            "Repuestos Reacondicionados": "Reacondicionados",
                            "Repuestos Usados o Reciclados": "Usados"
                        };

                        container.setAttribute('id', 'contenedor_oferta_' + count);
                        container.classList.add('mt-2');
                        container.style.display = "flex";
                        container.style.flexDirection = "column";
                        container.style.gap = "5px";

                        btn_close.classList.add('close');
                        btn_close.textContent = "×";
                        btn_close.setAttribute('type', 'button');
                        btn_close.setAttribute('id', 'eliminar_' + count);
                        btn_close.addEventListener('click', function() {
                            let currentCount = parseInt(this.getAttribute('id').split('_')[1]);
                            eliminarOferta(currentCount);
                            agregar_oferta_boton.style.cursor = "pointer";
                        });
                        container_close.style.width = "100%";
                        container_close.style.display = 'flex';
                        container_close.style.justifyContent = 'space-between';
                        text_container_close.textContent = "Oferta";
                        text_container_close.classList.add('color-primary');
                        text_container_close.style.margin = '0';

                        container_close.appendChild(text_container_close);
                        container_close.appendChild(btn_close);

                        container.appendChild(container_close);

                        container.addEventListener("mouseenter", function() {
                            btn_close.style.color = '#000';
                        });
                        container.addEventListener("mouseleave", function() {
                            btn_close.style.color = 'gray';
                        });

                        //Agregar elementos al contenedor
                        label_input.setAttribute('for', 'nuevo_precio');
                        label_input.textContent = "Precio:";
                        label_input.style.margin = '0';
                        container.appendChild(label_input);

                        input.setAttribute('required', true);
                        input.setAttribute('name', 'precio_oferta[]');
                        input.classList.add('form-control');
                        input.setAttribute('placeholder', 'Ejemplo: 999.999');
                        input.setAttribute('id', 'nuevo_precio');
                        container.appendChild(input);

                        label_select.setAttribute('for', 'tipo_repuesto');
                        label_select.textContent = "Tipo de Repuesto:";
                        label_select.style.margin = '0';
                        container.appendChild(label_select);

                        select.classList.add('form-control');
                        select.setAttribute('name', 'tipo_repuesto_oferta[]');
                        select.setAttribute('id', 'tipo_repuesto');
                        select.style.padding = '0 0 0 0.75rem';
                        select.style.appearance = "auto";
                        for (let i = 0; i < options.length; i++) {
                            let option = document.createElement('option');
                            let texto = options[i];
                            let valor = valueMapping[texto];
                            option.setAttribute('value', valor);
                            option.textContent = texto;
                            select.appendChild(option);
                        }
                        container.appendChild(select);

                        container_ofertas.appendChild(container);
                    } else {
                        agregar_oferta_boton.style.cursor = "not-allowed";
                    }
                });

                document.getElementById('form_provider').addEventListener('submit', function(event) {
                    event.preventDefault();

                    // Obtener los textos de los botones seleccionados
                    let textosSeleccionados = Array.from(container_buttons.getElementsByClassName(
                            'acepted'))
                        .map(button => button.textContent);

                    // Convertir el arreglo a una cadena JSON
                    let jsonTextosSeleccionados = JSON.stringify(textosSeleccionados);

                    // Agregar un campo oculto al formulario y asignarle la cadena JSON
                    let inputJson = document.createElement('input');
                    inputJson.type = 'hidden';
                    inputJson.name = 'json_repuestos';
                    inputJson.value = jsonTextosSeleccionados.replace(/[×\n]/g, '');
                    this.appendChild(inputJson);

                    // Salida de consola para verificar el valor de 'json_repuestos'
                    console.log('json_repuestos:', jsonTextosSeleccionados);

                    // Ahora, puedes enviar el formulario
                    this.submit();
                });
            @endif
        });
    </script>

    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tipo_repuesto = document.getElementById('tipo_repuesto');
            let valor_inicial = sessionStorage.getItem('tipo_repuesto') || 'Originales';
            tipo_repuesto.value = valor_inicial;

            function datos_anteriores() {
                sessionStorage.setItem('tipo_repuesto', tipo_repuesto.value);
            }

            // Llama a datos_anteriores() cada vez que el usuario cambie la selección
            tipo_repuesto.addEventListener('change', datos_anteriores);
        });
    </script>

    <script>
        function formatoPrecio(input) {
            // Elimina cualquier caracter que no sea un número
            let valor = input.value.replace(/\D/g, '');

            // Limita la longitud máxima del número
            valor = valor.slice(0, 9);

            // Formatea el valor con comas cada tres dígitos
            valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Establece el valor formateado en el campo de entrada
            input.value = valor;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let comentario = document.getElementById('comentario_proveedor');

            function restringirCaracteresComentario() {
                let texto = comentario.value;
                let numEspacios = (texto.match(/ /g) || []).length;
                let numSaltosLinea = (texto.match(/\n/g) || []).length;

                if (numEspacios > 1) {
                    comentario.value = texto.replace(/ +/g, ' '.repeat(1));
                }
                if (numSaltosLinea > 1) {
                    comentario.value = texto.replace(/\n+/g, '\n'.repeat(1));
                }
                if (texto.length > 160) {
                    comentario.value = texto.slice(0, 160);
                }
            }

            comentario.addEventListener('input', function() {
                restringirCaracteresComentario();
            });
        });
    </script>

@endsection
