@extends('layouts.app')

@section('title', 'Change password - Tu Repuesto Ya')

@section('style-body', "background: linear-gradient(180deg, #4794F9 , #0f3d79);
background-size: 200% 100%; min-height: 100%; min-width: 100%;")

@section('content')
    <div id="overlay" class="overlay" style="display:flex; flex-direction:column;">
        <div class="loader"></div>
        <div style="margin-top: 10px; color: white; font-size:15px;"><small>Cargando...</small></div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="container-change" style="padding: 3% 15%;">
                <div class="page-header min-vh-90"
                style="border-radius: 0.75rem; background-color: white; box-shadow: 0em 0em 12px -2px #2c3e59;">
                <a class="fixed-plugin-button text-dark position-absolute top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
                            alt="logo" style="height: 6vh; width: auto;">
                    </a>
                    <div class="container">
                        <div class="row">
                            <div class="animate__animated animate__fadeIn animate__delay-1s animate__faster col-xl-6 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-start">
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
                                                <input type="password" name="password" class="form-control form-control-lg"
                                                    value="{{ old('password') }}" placeholder="New password"
                                                    aria-label="Password">
                                                @error('password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3">
                                                <input type="password" name="confirm-password"
                                                    class="form-control form-control-lg"
                                                    value="{{ old('confirm-password') }}" placeholder="Confirm password"
                                                    aria-label="Confirm Password">
                                                @error('confirm-password')
                                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Cambiar
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
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                        currency"</h4>
                                    <p class="text-white position-relative">The more effortless the writing looks, the more
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
@endsection
