<div>
    <div class="row app-one">

        <div class="col-sm-4 side">
            <div class="side-one">
                <!-- Heading -->
                <div class="row heading">
                    <div class="col-sm-3 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon">
                            <img src="{{ asset('img/logo tu repuesto ya/icono_pagina.webp') }}">
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                        <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                        <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                    </div>
                </div>
                <!-- Heading End -->

                <!-- SearchBox -->
                <div class="row searchBox">
                    <div class="col-sm-12 searchBox-inner">
                        <div class="form-group has-feedback">
                            <input id="searchText" type="text" class="form-control" name="searchText"
                                placeholder="Search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>

                <!-- Search Box End -->
                <!-- sideBar -->
                <div class="row sideBar">
                    @if (count($chats) > 0 )
                        @foreach ($chats as $chat)
                            <div class="row sideBar-body" wire:click="setTelefono('{{ $chat->celular }}')">
                                <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                    <div class="avatar-icon">
                                        <img src="http://shurl.esy.es/y">
                                    </div>
                                </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 sideBar-name">
                                            <strong><span class="name-meta">{{ $chat->celular }}</span></strong>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                            <span class="time-meta pull-right">@if($chat->created_at){{$chat->created_at->diffForHumans()}}@endif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No hay chats
                    @endif
                </div>
                <!-- Sidebar End -->
            </div>
            <div class="side-two">
                <!-- Heading -->
                <div class="row newMessage-heading">
                    <div class="row newMessage-main">
                        <div class="col-sm-2 col-xs-2 newMessage-back">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-10 col-xs-10 newMessage-title">
                            New Chat
                        </div>
                    </div>
                </div>
                <!-- Heading End -->

                <!-- ComposeBox -->
                <div class="row composeBox">
                    <div class="col-sm-12 composeBox-inner">
                        <div class="form-group has-feedback">
                            <input id="composeText" type="text" class="form-control" name="searchText"
                                placeholder="Search People">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <!-- ComposeBox End -->

                <!-- sideBar -->
                <div class="row compose-sideBar">
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar-body">
                        <div class="col-sm-3 col-xs-3 sideBar-avatar">
                            <div class="avatar-icon">
                                <img src="http://shurl.esy.es/y">
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-9 sideBar-main">
                            <div class="row">
                                <div class="col-sm-8 col-xs-8 sideBar-name">
                                    <span class="name-meta">Ankit Jain
                                    </span>
                                </div>
                                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                    <span class="time-meta pull-right">18:18
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->
        </div>


        <!-- New Message Sidebar End -->

        <!-- Conversation Start -->
        <div class="col-sm-8 conversation">
            <!-- Heading -->
            <div class="row heading">
                <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                    <div class="heading-avatar-icon">
                        <img src="http://shurl.esy.es/y">
                    </div>
                </div>
                <div class="col-sm-8 col-xs-7 heading-name">
                    <a class="heading-name-meta">{{$telefono}}
                    </a>
                    <span class="heading-online">Online</span>
                </div>
                <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                    <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                </div>
            </div>
            <!-- Heading End -->

            <!-- Message Box -->
            <div class="row message" id="conversation">

                <div class="row message-previous">
                    <div class="col-sm-12 previous">
                        <a onclick="previous(this)" id="ankitjain28" name="20">
                            Show Previous Message!
                        </a>
                    </div>
                </div>

                <div class="row message-body">
                    @php
                        $mensaje_receive = '';
                        foreach ($mensajes as $mensaje) {
                            $mensaje_receive = $mensaje->where('celular', $telefono)->get();
                        }
                    @endphp
                    @if ($mensaje_receive)
                        @foreach ($mensaje_receive as $receive)
                            <div class="col-sm-12 message-main-receiver">
                                <div class="receiver">
                                    <div class="message-text">
                                        {{$receive->mensaje}}
                                    </div>
                                    <span class="message-time pull-right">
                                        Sun
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="row message-body">
                    @php
                        $mensaje_send = '';
                        foreach ($mensajes as $mensaje) {
                            $mensaje_send = $mensaje->where('tipo', 'enviado')->where('enviado_a', $telefono)->get();
                        }
                    @endphp
                    @if($mensaje_send)
                        @foreach ($mensaje_send as $send)
                            <div class="col-sm-12 message-main-sender">
                                <div class="sender">
                                    <div class="message-text">
                                        {{$send->mensaje}}
                                    </div>
                                    <span class="message-time pull-right">
                                        Sun
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- Message Box End -->

            <!-- Reply Box -->
            <div class="row reply">
                <div class="col-sm-1 col-xs-1 reply-emojis">
                    <i class="fa fa-smile-o fa-2x"></i>
                </div>
                <div class="col-sm-9 col-xs-9 reply-main">
                    <textarea class="form-control" rows="1" id="comment"></textarea>
                </div>
                <div class="col-sm-1 col-xs-1 reply-recording">
                    <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
                </div>
                <div class="col-sm-1 col-xs-1 reply-send">
                    <i class="fa fa-send fa-2x" aria-hidden="true"></i>
                </div>
            </div>
            <!-- Reply Box End -->
        </div>
        <!-- Conversation End -->
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(".heading-compose").click(function() {
            $(".side-two").css({
                "left": "0"
            });
        });

        $(".newMessage-back").click(function() {
            $(".side-two").css({
                "left": "-100%"
            });
        });
    </script>
</div>
