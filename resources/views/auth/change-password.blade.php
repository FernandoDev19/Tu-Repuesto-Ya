@extends('layouts.app')

@section('title', 'Change password - Tu Repuesto Ya')

<link rel="stylesheet" href="{{asset('css/change-password-style.css')}}">

@section('style-body', "background: linear-gradient(180deg, #4794F9 , #0f3d79);
background-size: 200% 100%; min-height: 100%; min-width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;")

@section('content')
    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="container-change contenedor-reset" style="padding: 3% 15%; display: flex;
            justify-content: center;">
                <div class="page-header bg-transparent-cel flex-col-cel"
                style="border-radius: 0.75rem; background-color: white; box-shadow: 0em 0em 12px -2px #2c3e59; max-width: 1328px !important;
                width: 100%;">
                <a class="text-dark logo-reset-cel-position top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%; position: absolute; margin-bottom: 20%;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
                            alt="logo" style="height: 6vh; width: auto;" height="30" width="30">
                    </a>
                    <div class="container contenedor-reset">
                        <div class="row">
                            <div class="animate__animated animate__fadeIn animate__delay-1s animate__faster col-xl-6 col-lg-6 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="bg-transparent-cel card-header pb-0 text-start">
                                        <h4 class="font-weight-bolder">Cambiar contraseña</h4>
                                        <p class="mb-0">Establezca una nueva contraseña</p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" method="POST"
                                            action="{{ route('change-password', ['token' => $token]) }}">
                                            @csrf

                                            <div class="flex flex-col mb-3">
                                                <input type="hidden" name="email" class="form-control form-control-lg"
                                                    placeholder="Email" value="{{ $email }}" aria-label="Email">
                                                @error('email')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3">
                                               <div class="input-group">
                                                <input id="password" type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="{{ old('password') }}" placeholder="Nueva Contraseña">
                                                <div class="input-group-append">
                                                  <span class="input-group-text" style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i id="togglePassword" class="fas fa-eye" style="cursor: pointer;"></i></span>
                                                </div>
                                              </div>
                                                @error('password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @else
                                                    <small class="text-xs text-secondary">Incluir al menos 8 caracteres, 1 número, una mayúscula y una minúscula.</small>
                                                @enderror
                                            </div>
                                            
                                            <div class="flex flex-col mb-3">
                                                <div class="input-group">
                                                 <input type="password" id="confirm_password" name="confirm-password"
                                                    class="form-control form-control-lg"
                                                    value="{{ old('confirm-password') }}" placeholder="Confirmar Contraseña"
                                                    aria-label="Confirm Password">
                                                <div class="input-group-append">
                                                  <span class="input-group-text" style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i id="toggleConfirmPassword" class="fas fa-eye" style="cursor: pointer;"></i></span>
                                                </div>
                                              </div>
                                                @error('confirm-password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn-reset btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Cambiar
                                                    contraseña</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="alert">
                                        @include('components.alert')
                                    </div>
                                </div>
                            </div>
                            <div
                                class="animate__animated animate__bounceInLeft animate__fast col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 px-7 d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('/img/backgrounds/fondo-login-v1.jpg');
                                background-size: cover;">
                                <span class="mask opacity-6" style="background-image: linear-gradient(310deg, #06090D 0%, #132340 100%);"></span>
                                   
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
                            <a class="item" href="{{route('privacy-policy')}}">Politica de privacidad</a>
                            <a class="item" href="#">Acerca de...</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm_password');
    
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    
    toggleConfirmPassword.addEventListener('click', function(e){
       const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
       confirmPassword.setAttribute('type', type);
       this.classList.toggle('fa-eye-slash');
    });

</script>
@endsection
