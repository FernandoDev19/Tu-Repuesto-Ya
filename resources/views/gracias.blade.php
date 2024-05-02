@extends('layouts.base')

@section('title', 'Gracias | Tu Repuesto Ya')

<style>
    .nav_active{
        background-color: black !important;
    }

    .container-body{
        height: 100% !important;
    }
</style>

@section('content')
    <div class="container-gracias" id="container-gracias" style="height:100%; width: 100%; padding: 2rem 0;">
        <div class="d-flex justify-content-center" style="align-items: center; height: 100%; width: 100%;">
            <div class="shadow" style="border: 1px solid rgb(175, 175, 175); border-radius: .375rem; width: 70%; max-width: 850px; height: max-content; padding: .5rem .5rem 0 0;">
                <div class="d-flex justify-content-end">
                    <a href="{{route('servicios')}}" class="btn-close" style="margin-left: auto; z-index: 2;"></a>
                </div>
                <div class="w-100 h-100 d-flex justify-content-center text-center" style="flex-direction: column; align-items: center; transform: translate(.5rem, -.5rem); padding: 2rem 0;">
                    <img src="{{asset('icon/check.png')}}" alt="check" height="40" width="40" style="height: 10rem; width: auto;"> <br>
                    <h1 style="font-size: xx-large;">¡Gracias!</h1> <br>
                    <h3 style="font-size: initial;">Revise su Whatsapp <br>o su Correo electrónico</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
