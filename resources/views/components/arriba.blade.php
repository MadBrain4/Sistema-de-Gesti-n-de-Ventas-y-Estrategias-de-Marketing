<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width"/>
        <link rel="icon" href="{{ asset('img/icono/web.ico') }}">

        <link rel="stylesheet" href="{{ asset( 'css/estilos_menu.css' )}}">
        <link rel="stylesheet" href="{{ asset( 'css/estilos.css' )}}">
        <link rel="stylesheet" href="{{ asset( 'css/header_estilos.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/estilos_t_filtro.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/estilos_video.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/busqueda_rapida.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/estilos_links.css' ) }}">
        <link rel="stylesheet" href="{{ asset( 'css/bootstrap.css' ) }}">
        <script src="/js/sweetAlerta.js"></script>
        <script src="/js/bootstrap.js"></script>
        @vite(['resources/js/app2.js'])

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset( 'img/logo/web.png' ) }}" width="170" height="50" class="d-inline-block align-top" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Líneas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('lineas.aceite') }}">Aceite</a></li>
                            <li><a class="dropdown-item" href="{{ route('lineas.aire') }}">Aíre</a></li>
                            <li><a class="dropdown-item" href="{{ route('lineas.combustible') }}">Combustible</a></li>
                            <li><a class="dropdown-item" href="{{ route('lineas.fluidos') }}">Fluidos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Catálogos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('aplicaciones.index') }}">Por Aplicación</a></li>
                            <li><a class="dropdown-item" href="{{ route('codigo.index') }}">Por Código</a></li>
                            <li><a class="dropdown-item" href="{{ route('especificaciones.index') }}">Por Especificación</a></li>
                            <li><a class="dropdown-item" href="{{ route('descargas.index') }}">Descargas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('distribuidores.index') }}">Distribuidores</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Nosotros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route( 'jet-filter.index' ) }}">Jet-Filter</a></li>
                            <li><a class="dropdown-item" href="{{ route( 'nosotros.noticias' ) }}">Noticias</a></li>
                            <li><a class="dropdown-item" href="{{ route( 'nosotros.ayuda' ) }}">Ayuda</a></li>
                            <li><a class="dropdown-item" href="{{ route( 'nosotros.instrucciones.uso' ) }}">Instrucciones de Uso</a></li>        
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="" id="nav">
                <ul class="navbar-nav bg-danger m-0 ml-lg-auto p-3 p-lg-0">
                    <li class="nav-item">
                        @if( session()->has('carrito') && session('carrito') != null && session()->has('email_web'))
                            <a href="{{ route('carrito') }}" class="nav-link text-truncate">
                                Carrito({{ count(session('carrito')) }})
                            </a>
                        @elseif( session()->has('email_web'))
                            <a href="{{ route('carrito') }}" class="nav-link text-truncate">
                                Carrito(0) 
                            </a>
                        @endif
                    </li>
                    <li class="nav-item px-2">
                        @if( session()->has('lista') && session('lista') != null && session()->has('email_web'))
                            <a href="{{ route('lista_deseos') }}" class="nav-link text-truncate">
                                Lista({{ count(session('lista')) }})
                            </a>
                        @elseif( session()->has('email_web'))
                            <a href="{{ route('lista_deseos') }}" class="nav-link text-truncate">
                                Lista(0)
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if( !session()->has('email_web') )
                            <li class="lista">
                                <a href="{{ route('registrarse') }}" class="nav-link text-truncate">Registrarse</a>
                            </li>
                            <li class="lista">
                                <a href="{{ route('iniciar_sesion') }}" class="nav-link text-truncate">Iniciar Sesión</a>
                            </li>
                        @else
                            <li class="lista">
                                <a href="{{ route('iniciar_sesion') }}" class="nav-link text-truncate">{{ session('name_web') }}</a>
                            </li>
                            <li class="lista">
                                <form action="{{ route('cerrar_sesion') }}" method="POST">
                                    <input type="submit" value="Cerrar Sesión" class="nav-link text-truncate" style="background-color: #E2001A; border-color: #E2001A; " />
                                </form>
                            </li>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

   