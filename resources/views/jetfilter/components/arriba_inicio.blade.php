<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title }}</title>

        <link rel="shortcut icon" href="{{ asset( '/img_jetfilter/icon/jf.ico' ) }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset( 'css/jetfilter/normalize.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/jetfilter/estilos_gestion.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/jetfilter/estilos_perfil.css' ) }}">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <nav class="nav container" id ="menu_s">
            <div class="nav__logo">
                <a href="{{ route( 'jet-filter.sesion' ) }}"> <img src="{{ asset( '/img_jetfilter/logo/logojf2.png' ) }}" class="img_log"></a>
            </div>
            <ul class="nav__link nav__link--menu">
                <li class="nav__items ">
                    <a href="{{ route( 'jet-filter.sesion' )}} " class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="{{route('jet-filter.catalogo')}}" class="nav__links">Catálogo</a>
                </li>
                <li class="nav__items">
                    <a href="{{route('jet-filter.distribuidoras')}}" class="nav__links">Distribuidores</a>
                </li>
                <li class="nav__items">
                    <a href="{{route('jet-filter.marketing.index')}}" class="nav__links">Marketing</a>
                </li>
                <li class="nav__items_usuario">
                    <a href="#" class="nav__links_usuario">
                        {{ auth()->user()->name }}
                     </a>
                </li>
                <li class="nav__items">
                    <a href="{{route('jet-filter.logout')}}" class="nav__icons"> <img src="/img_jetfilter/svg/log-out.svg"></a>
                </li>
            </ul>
        </nav>