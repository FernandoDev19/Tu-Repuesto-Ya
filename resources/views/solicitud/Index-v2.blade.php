@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/solicitudStyle.css') }}" type="text/css">

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
            <div class="container-form contenedor-solicitud"
                style="padding: 3% 15%; display: flex; justify-content: center;">
                <div class="bg-transparent-cel flex-col-cel animate__animated animate__fadeIn animate__slow page-header min-vh-90"
                    style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59; max-width: 1328px !important; width: 100%;">
                    <a class="logo-solicitud-cel-position text-dark top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%; position: absolute; z-index: 2;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
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
                                                            <h5>Marca</h5>
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
                                                            <h5>Referencia</h5>
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
                                                            <h5>Modelo</h5>
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
                                                            <h5>Tipo de transmisión</h5>
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
                                                            <h5>Repuesto</h5>
                                                        </label>
                                                        <div class="form-control text-start"
                                                            style="background-color: rgb(143 143 143 / 21%); height: auto; display: flex; justify-content: space-between; align-items: center;">
                                                            <div class="items_container">
                                                                @foreach ($repuesto as $repuestos)
                                                                    <button type="button"
                                                                        class="item_selected_cliente">{{ $repuestos }}</button>
                                                                @endforeach
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
                                                            <h5>Comentarios</h5>
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
                                    $count = 1;
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
                                                <h4 class="font-weight-bolder">Datos del proveedor</h4>
                                            </div>
                                            <div class="card-body text-start">
                                                <div class="flex flex-col mb-3">
                                                    <label for="nit" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>*NIT</h5>
                                                    </label>
                                                    <input type="text" name="nit" id="nit"
                                                        class="form-control text-start" placeholder="NIT"
                                                        aria-label="Nit"
                                                        value="@if(auth()->check()and auth()->user()->hasRole('Proveedor')){{ auth()->user()->proveedor->nit_empresa }}@else{{ old('nit') }}@endif"
                                                        required>
                                                    @error('nit')
                                                        <small class="text-danger text-xs pt-1">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="flex flex-col mb-3" style="overflow-x: hidden;">
                                                    <label for="repuesto" class="mb-2"
                                                        style="color:blue; font-weigth: 900;">
                                                        <h5>*Repuestos</h5>
                                                    </label>
                                                    <div class="form-control" style="height: auto; border: none; border: none; padding: 0;">
                                                        <div class="items_container" id="items_container">
                                                            @foreach ($repuesto as $repuestos)
                                                            <div style="width:100%; display: flex; gap: 1rem;">
                                                                <label for="check_{{$count_check++}}" style="margin: 0;
                                                                    height: max-content;
                                                                    width: max-content;"><i class="fas fa-check"></i>
                                                                    <input type="checkbox" class="btn_borrar_item" id="check_{{$count_btns++}}">
                                                                </label>
                                                                <div class="item_selected rojo {{ $count_class++ }}"
                                                                    name="item">{{ $repuestos }}</div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

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
                                                        @foreach ($repuesto as $repuestos)
                                                            <div id="container_{{ $count_id++ }}" class="hide"
                                                                style="display: flex; flex-direction: column; margin: 2% 2% 0 0; gap: 5px;">
                                                                <h5><strong>{{ $count++ . '. ' . $repuestos }}</strong>
                                                                </h5>


                                                                <small class="text-xs" style="color: #344767;">Tipo de Repuesto</small>
                                                                <select name="tipo_repuesto[]" id="tipo_repuesto"
                                                                    class="form-control text-start"
                                                                    aria-label="Tipo de repuesto"
                                                                    style="padding: 0 0 0 0.75rem;" disabled>
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
                                                                    <small
                                                                        class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                @enderror


                                                                <small class="text-xs" style="color: #344767;">Precio</small>
                                                                <input type="text" name="precio[]" id="precio"
                                                                    class="form-control text-start"
                                                                    placeholder="ejemplo: 12345..." aria-label="Precio"
                                                                    value="{{ old('precio[' . $count . ']') }}"
                                                                    onkeyup="formatoPrecio(this)" disabled required>


                                                                @error('precio')
                                                                    <small
                                                                        class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                @enderror


                                                                <small class="text-xs" style="color: #344767;">Garantia</small>

                                                                    <input type="text" id="garantia"
                                                                        name="garantia[]" class="form-control text-start"
                                                                        placeholder="Ejemplo: 6" aria-label="Garantia"
                                                                        value="{{ old('garantia[' . $count . ']') }}"
                                                                        onkeyup="garantiaSelect(this)" disabled>
                                                                    <select name="garantiaSeleccion[]"
                                                                        id="garantiaSeleccion" class="form-control"
                                                                        style="width: auto; padding: 0 0.75rem;" disabled>
                                                                        <option value="mes">mes</option>
                                                                        <option value="año">año</option>
                                                                    </select>


                                                                @error('garantia')
                                                                    <small
                                                                        class="text-danger text-xs pt-1">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!--Tipo de repuesto, Precio y garantia-->
                                                </div>

                                                <div class="flex flex-col mb-3">

                                                    <div class="text-start">
                                                        <label for="comentarioP" class="mb-2"
                                                            style="color:blue; font-weigth: 900;">
                                                            <h5>Comentarios</h5>
                                                        </label>
                                                        <textarea name="comentarioP" class="form-control text-center" placeholder="¿Tienes algúnos Comentarios?"
                                                            aria-label="ComentarioP" rows="6"></textarea>
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
        document.addEventListener('DOMContentLoaded', function () {
            let container_buttons = document.getElementById('items_container');
            let count_buttons = container_buttons.children.length;

            container_buttons.addEventListener('click', function (event) {
                let checkbox = event.target.closest('div').querySelector('.btn_borrar_item');
                let itemSelected = event.target.closest('div').querySelector('.item_selected');

                if (checkbox && itemSelected) {
                    checkbox.checked = !checkbox.checked;
                    itemSelected.classList.toggle('acepted');
                    itemSelected.classList.toggle('rojo');

                    for (let i = 1; i <= count_buttons; i++) {
                        let container_repuestos = document.getElementById('container_' + i);
                        let children = container_repuestos.children;

                        if ((checkbox.checked && itemSelected.classList.contains(i)) ||
                            (itemSelected.classList.contains('rojo') && itemSelected.classList.contains(i))) {
                            container_repuestos.classList.add('hide');
                            for (let j = 0; j < children.length; j++) {
                                children[j].disabled = true;
                            }
                        } else if (itemSelected.classList.contains(i)) {
                            container_repuestos.classList.remove('hide');
                            for (let j = 0; j < children.length; j++) {
                                children[j].disabled = false;
                            }
                        }
                    }
                }
            });

            document.getElementById('form_provider').addEventListener('submit', function (event) {
                event.preventDefault();

                // Obtener los textos de los botones seleccionados
                let textosSeleccionados = Array.from(container_buttons.getElementsByClassName('acepted'))
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
