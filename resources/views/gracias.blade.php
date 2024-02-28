@extends('layouts.base')

@section('title', 'Gracias | Tu Repuesto Ya')

<style>
    .nav_active{
        background-color: black !important;
    }
</style>

@section('content')
    <div class="container-gracias" id="container-gracias" style="height:80vh; width: 100%;">
        <div class="d-flex justify-content-center" style="align-items: center; height: 100%; width: 100%;">
            <div class="shadow" style="border: 1px solid rgb(175, 175, 175); border-radius: .375rem; width: 70%; max-width: 850px; height: 300px; padding: .5rem .5rem 0 0;">
                <div class="d-flex justify-content-end">
                    <a href="{{route('servicios')}}" class="btn-close" style="margin-left: auto; z-index: 2;"></a>
                </div>
                <div class="w-100 h-100 d-flex justify-content-center text-center" style="flex-direction: column; align-items: center; transform: translate(.5rem, -.5rem);">
                    <h1>¡Gracias!</h1> <br>
                    <h3>Revise su Whatsapp o su Correo electrónico</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
