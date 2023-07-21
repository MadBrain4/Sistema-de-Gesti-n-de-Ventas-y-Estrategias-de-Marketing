<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/busqueda_aplicaciones.css' )}}">
<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/estilos_filtro.css' )}}">

<section class="infor_aplica" style="display: inline;">
    <section class="detalle" id="detalle">
        <h1 class="title_busqueda">Buscar filtros por aplicaciones</h1> 
        <section class="about_aplicacion_op">
            <div class="about_aplicacion_sel about_sel">
                <label>Aplicación :</label>
                <select id="lista1" name="lista1" class="aplicacion selectap">
                    <option value="0" disabled selected>Seleccionar aplicación</option>
                    @foreach( $tipo_aplicaciones as $tipo )
                        <option value="{{ $tipo->id }}" >{{ $tipo->aplicacion }}</option>
                    @endforeach
                </select> 

                <div id="contenido">
                    <div id="select2lista">
                        <label id="label_lista2">Marca :</label>
                        <select id="lista2" name="lista2" class="aplicacion selectap">                            
                        </select>
                    </div>
                </div>
                <div id="boton_volver">
                    <a onclick="volver_registros()"><img src=" {{ asset( 'img/tipo/bt__vm.png' ) }}" alt="" class="bt_vm"></a>
                </div>
            </div>
            <div class="about_aplicacion_sel">
                <div id="contenido2">
                    <div id="tabla">
                        <label>Mostrar:</label>
                        <select name="registros" id="registros" >
                            @foreach( $paginas as $paginas )
                                <option value="{{ $paginas }}" >{{ $paginas }}</option>
                            @endforeach
                        </select>
                        <input type='text' id='texto' name="texto" class='vBuscar'>
                        <table id="contenido" class='busqueda_apli table-responsive'>
                            <thead class='busqueda_apli'>
                                <tr class='busqueda_apli'> 
                                    <td class='busqueda_apli'>Nombre</td>
                                    <td class='busqueda_apli'>Cilindrada</td>
                                    <td class='busqueda_apli'>Año</td>
                                </tr>
                            </thead>
                            <tbody id="resultado" class='busqueda_apli'>
                            </tbody>
                        </table>
                        <div id="totalResultado">

                        </div>
                        <div id="navegacion" class="links linka">

                        </div>
                    </div>
                    <div id="vehiculo_seleccionado">

                    </div>
                </div>
            </div>
        </section>
    </section>
</section>

<script src='/js/busqueda_filtros/cambio_aplicacion.js'></script>
<script src='/js/busqueda_filtros/cambio_marca.js'></script>
<script src='/js/busqueda_filtros/aplicacion2.js'></script>
<script src='/js/busqueda_filtros/aplicacion3.js'></script>
<script src='/js/busqueda_filtros/getData.js'></script>
<script src='/js/busqueda_filtros/getRegistro.js'></script>
<script src='/js/busqueda_filtros/volver_registros.js'></script>

<script>
    paginaActual = 1;


    document.getElementById("texto").addEventListener("keyup", function(){
        getData(1);
    }, false);
    document.getElementById("registros").addEventListener("change", function(){
        getData(1);
    }, false);

    $(document).ready(function(){
        $('#tabla').css("display","none");
        $('#boton_volver').css("display","none");
        $('#lista2').css("display","none");
        $('#label_lista2').css("display","none");
    });

    function getFiltro(codigo){
        $('#detalle').css("display","none");

        $.ajax({
            data: {
                'codigo': codigo,
            },
            url: "/aplicaciones/filtro",
            type: "POST",
            dataType: "json",
            success: function (response){
                document.getElementById('filtro_titulo').innerHTML = response.titulo;
                document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
            },
            error: function (error){
                alert("Error");
            }
        });
    }

    function volver(){
        $('#detalle').css("display","block");
    }

    function comprar(id){
        $.ajax({
            data: {
                'id': id,
            },
            url: "/compras",
            type: "POST",
            dataType: 'json',
            success: function (response){
                alert(response);
                console.log(response);

            },
            error: function(error){
                alert(error);
            }
        });
    }
</script>