<link rel="stylesheet" href="{{ asset( 'css/busqueda_codigos/busqueda_codigos.css' )}}">
<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/busqueda_aplicaciones.css' )}}">
<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/estilos_filtro.css' )}}">


<div class="aplicacion_producto"  style="overflow-y: scroll;">
    <section class="infor_aplica2" id="buscar">
        <section class="detalle">
            <div class="about_aplicacion_sel">
                <h3 class="title_busqueda">Buscar filtros por código</h3> 
                <p class="if">
                    <em>Introduzca un código Web o de otro fabricante para encontrar su equivalencia Web</em><br>
                    <span class="resaltar">[*]</span> Indicará una coincidencia exacta
                </p>
                <div class="li_boton">
                    <div>
                        <input type="text" name="keywords" class="vBuscar" id="keywords" autocomplete="off" />
                    </div>
                    <div>
                        <a onclick="buscar()" id="boton-busqueda" name="search" >
                            <img src="{{ asset('img/tipo/bt__buscar.png') }}" alt="" class="bt_busq" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <section class="infor_aplica" id="busquedas">
        <div class="tabla_resultados" id="resultados_busqueda"></div>
        <div class="tabla_resultados" id="resultados_busqueda_equivalencias"></div>
    </section>
</div>


<script src='/js/busqueda_filtros/volver_registros.js'></script>
<script src='/js/busqueda_filtros/buscar.js'></script>

<script>
    paginaActual = 1;

    document.addEventListener("DOMContentLoaded", function(event) { 
        document.getElementById('resultados_busqueda').style.display = "none";
        document.getElementById('resultados_busqueda_equivalencias').style.display = "none";

        document.addEventListener('keydown', function(event) {
            input = document.getElementById("keywords").value;
            if (event.keyCode  == 13 && input != "") {
                buscar();
            }
        }, false);
    });

    function volver(){
        document.getElementById('buscar').style.display = "block";
        document.getElementById('busquedas').style.display = "flex";
    }
</script>