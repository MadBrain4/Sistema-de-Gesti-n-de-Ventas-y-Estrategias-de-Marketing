<link rel="stylesheet" href="{{ asset( 'css/descargas.css' )}}">

<x-Arriba />
    <title>Descargas</title>

    <section class="infor_descarga">
        <br>
        <h3>Descargas</h3>
        <p class="if">Descarga de todas las versiones del catálogo de productos en formato pdf. </p>
        <section class="about_descarga_co">
            <div class="about_descarg_f">
                <h3 class="h3descarga">  
                    <a href="{{ route('documentos', ['catalogo' => 'especificaciones']) }}" class="h3des">CATÁLOGO DE ESPECIFICACIONES</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">  
                    <a href="{{ route('documentos', ['catalogo' => 'especificaciones']) }}">Ver Más </a>
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes"> 
                    <a href="{{ route('documentos', ['catalogo' => 'especificaciones']) }}" download> Descargar</a> 
                </p> 
                <br>
                <br>
            </div>
            <div class="about_descarg_f">
                <h3 class="h3descarga">
                    <a href="{{ route('documentos', ['catalogo' => 'equivalencias']) }}" class="h3des">CATÁLOGO DE EQUIVALENCIAS</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">
                    <a href="{{ route('documentos', ['catalogo' => 'equivalencias']) }}"> Ver Más</a> 
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes">
                    <a href="jetfilter/PDF/equivalencias.pdf" download> Descargar </a> 
                </p>  
                <br>
                <br>
            </div>
        
            <div class="about_descarg_f">
                <h3 class="h3descarga">
                    <a href="{{ route('documentos', ['catalogo' => 'fuera_carretera']) }}" class="h3des">CATÁLOGO DE VEHÍCULOS FUERA DE CARRETERA</a>
                </h3> 
                <p class="if"><img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">
                    <a href="{{ route('documentos', ['catalogo' => 'fuera_carretera']) }}"> Ver Más </a>
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes"> 
                    <a href="jetfilter/PDF/fuera_de_carretera.pdf" download>Descargar</a> 
                </p>  
                <br><br>     
            </div>
        
            <div class="about_descarg_f">
                <h3 class="h3descarga">
                    <a href="{{ route('documentos', ['catalogo' => 'agricola']) }}" class="h3des"> CATÁLOGO DE VEHÍCULOS AGRÍCOLAS</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">
                    <a href="{{ route('documentos', ['catalogo' => 'agricola']) }}">Ver Más</a> 
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes"> 
                    <a href="jetfilter/PDF/vehiculos_agricolas.pdf" download>Descargar</a> 
                </p>  
                <br><br>
            </div>
        
            <div class="about_descarg_f">
                <h3 class="h3descarga">
                    <a href="{{ route('documentos', ['catalogo' => 'comercial']) }}" class="h3des"> CATÁLOGO DE VEHÍCULOS COMERCIALES</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">  
                    <a href="{{ route('documentos', ['catalogo' => 'comercial']) }}"> Ver Más </a>
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes">
                    <a href="jetfilter/PDF/vehiculos_comerciales.pdf" download>Descargar</a> 
                </p>  
            <br><br>
            </div>
        
            <div class="about_descarg_f">
                <h3 class="h3descarga"> 
                    <a href="{{ route('documentos', ['catalogo' => 'pasajero']) }}" class="h3des"> CATÁLOGO DE VEHÍCULOS DE PASAJEROS</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">
                    <a href="documento.php?CATALOGO=PASAJERO"> Ver Más</a>
                </p>  
                <p class="if">
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes"> 
                    <a href="{{ route('documentos', ['catalogo' => 'pasajero']) }}" download>Descargar </a>
                </p>  
                <br><br>
            </div>
        
            <div class="about_descarg_f">
                <h3 class="h3descarga">
                    <a href="{{ route('documentos', ['catalogo' => 'completo']) }}" class="h3des">CATÁLOGO COMPLETO</a>
                </h3> 
                <p class="if">
                    <img src="{{ asset('/img/svg/visto.svg') }}" class="imgdes">
                    <a href="{{ route('documentos', ['catalogo' => 'completo']) }}"> Ver Más</a>
                </p> 
                    <img src="{{ asset('/img/svg/descarga.svg') }}" class="imgdes"> 
                    <a href="documentos/completo.pdf" download>Descargar </a>
                </p>  
                <br><br>
            
            
            </div>
        </section>
    </section>
<x-Abajo />