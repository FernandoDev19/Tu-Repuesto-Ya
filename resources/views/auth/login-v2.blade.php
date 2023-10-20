@extends('layouts.app')

@section('title', 'Login - Tu Repuesto Ya')

<style>
    @media (max-width: 992px) {
        .logo {
            display: none;
        }
    }
</style>

@section('style-body', "background: linear-gradient(180deg, #4794F9 , #0f3d79);
background-size: 200% 100%; min-height: 100%; min-width: 100%;")

@section('content')
    @if (session('message'))
        <div class="alert alert-info" id="message">
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
            <div class="container-login" style="padding: 3% 15%;">
                <div class="page-header min-vh-90" style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59;">
                    <a class="fixed-plugin-button text-dark position-absolute top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
                            alt="logo" style="height: 6vh; width: auto;">
                    </a>
                    <div class="container">
                        <div class="row">
                            <div class="animate__animated animate__fadeIn col-xl-6 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start">
                                        <h4 class="font-weight-bolder">Iniciar sesión</h4>
                                        <p class="mb-0">Ingresa tu correo y tu contraseña para iniciar sesión</p>
                                    </div>
                                    <div class="card-body">
                                        <form role="form" method="POST" action="{{ route('verification') }}">
                                            @csrf
                                            @method('post')
                                            <div class="flex flex-col mb-3">
                                                <input id="email" type="email" name="email"
                                                    class="form-control form-control-lg" value="{{ old('email') }}"
                                                    aria-label="Email" placeholder="Correo electronico" autofocus>
                                                @error('email')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3">
                                                <input id="password" type="password" name="password"
                                                    class="form-control form-control-lg" aria-label="Password"
                                                    value="{{ old('password') }}" placeholder="Contraseña">
                                                @error('password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Iniciar
                                                    sesión</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-1 text-sm mx-auto">
                                            Olvidaste tu contraseña? Restablece tu contraseña
                                            <a href="{{ route('reset-password') }}"
                                                class="text-primary text-gradient font-weight-bold"
                                                style="font-weight: 900 !important; font-size: 15px;">Aquí</a>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-4 text-sm mx-auto">
                                            No tienes una cuenta?
                                            <a href="{{ route('register') }}"
                                                class="text-primary text-gradient font-weight-bold"
                                                style="font-weight: 900 !important; font-size: 15px;">Registrarse</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 px-7 d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('/img/backgrounds/fondo-login-v1.jpg');
                                background-size: cover;">
                                <span class="mask opacity-6" style="background-image: linear-gradient(310deg, #06090D 0%, #132340 100%);"></span>
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
                    <div class="copyright text-center my-auto" >
                        <span>Copyright © Milano Rent a Car 2023</span>
                    </div>
                </div>
            </footer>
        </section>
    </main>


    <script>
        setTimeout(function() {
            var Message = document.getElementById('message');
            if (Message) {
                Message.remove();
            }
        }, 5000);
    </script>

    <script>
        setTimeout(function() {
            var Error = document.getElementById('error');
            if (Error) {
                Error.remove();
            }
        }, 5000);
    </script>
@endsection
