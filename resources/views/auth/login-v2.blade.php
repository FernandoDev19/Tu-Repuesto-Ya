@extends('layouts.app')

@section('title', 'Login - Tu Repuesto Ya')
<link rel="stylesheet" href="{{asset('css/loginStyle.css')}}">

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
            <div class="container-login contenedor-login" style="padding: 3% 15%; display: flex;
            justify-content: center;">
                <div class="bg-transparent-cel flex-col-cel page-header" style="border-radius: 0.75rem; background-color: rgb(255, 255, 255); box-shadow: 0em 0em 12px -2px #2c3e59; max-width: 1328px !important;
                width: 100%;">
                    <a class="logo-login-cel-position text-dark top-0 left-0" href="{{ route('servicios') }}"
                        style="padding: 1% 0 0 1%; position: absolute; z-index: 2;">
                        <img decoding="async" class="logo" src="{{ asset('img/logo tu repuesto ya/icono_pagina.png') }}"
                            alt="logo" style="height: 6vh; width: auto;">
                    </a>
                    <div style="position: absolute; bottom: 3%; right: 3%; z-index: 2;color: white; background: transparent; border: none;"><img id="muteButton" height="20" style="height: 25px; width: auto;" src="{{asset('icon/mute.png')}}"></div>
                    <div class="container contenedor-login">
                        <div class="row">
                            <div class="animate__animated animate__fadeIn col-xl-6 col-lg-6 d-flex flex-column mx-lg-0 mx-auto">
                                <div class="card card-plain">
                                    <div class="text-cel-center bg-transparent-cel card-header pb-0 text-start">
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
                                              <div class="input-group">
                                                <input id="password" type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="{{ old('password') }}" placeholder="Contraseña">
                                                <div class="input-group-append">
                                                  <span class="input-group-text" style="height: 100%; border-radius: 0% 0.5rem 0.5rem 0% !important; border: 1px solid lightgray;"><i id="togglePassword" class="fas fa-eye"></i></span>
                                                </div>
                                              </div>
                                              @error('password')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                              @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn-login btn btn-lg btn-primary btn-lg w-100 mt-2 mb-0">Iniciar
                                                    sesión</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-1 text-sm mx-auto">
                                            Olvidaste tu contraseña? Restablece tu contraseña
                                            <a href="{{ route('reset-password') }}"
                                                class="text-primary font-weight-bold"
                                                style="font-weight: 900 !important; font-size: 15px;">Aquí</a>
                                        </p>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-4 text-sm mx-auto">
                                            No tienes una cuenta?
                                            <a href="{{ route('register') }}"
                                                class="text-primary font-weight-bold"
                                                style="font-weight: 900 !important; font-size: 15px;">Registrarse</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="animate__animated animate__bounceInLeft animate__fast col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div class="video-container position-relative bg-gradient-primary h-100 px-7 d-flex flex-column justify-content-center overflow-hidden">
                                    <video autoplay muted loop id="myVideo">
                                        <source src="{{asset('movies/video_auth.mp4')}}" type="video/mp4">
                                        Tu navegador no soporta el elemento de video
                                    </video>
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
  var video = document.getElementById("myVideo");
  var button = document.getElementById("muteButton");

  button.addEventListener("click", function() {
    if (video.muted) {
      video.muted = false;
      button.src = '{{asset('icon/volume.png')}}';
    } else {
      video.muted = true;
      button.src = '{{asset('icon/mute.png')}}';
    }
  });
</script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });

</script>

@endsection
