
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width"/>


  <link rel="stylesheet" href="./../css/estilos.css">

    <script type="text/javascript" src='./../js/zoom.js'></script>
    <script type="text/javascript" src='./../js/jquery.min.js'></script>

  <?php
    include ('../../conexion.php');   
    $paginas = [10, 25, 50, 100]; 
    ?> 

    <div class="aplicacion_producto">
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
                            <a onclick="buscar()" id="boton-busqueda" name="search" ><img src="./../img/tipo/bt__buscar.png" alt="" class="bt_busq"></a>
                        </div> 
                    </div>
                </div>
            </section>
        </section>

        <section class="infor_aplica" id="busquedas">
            <div class="tabla_resultados" id="resultados_busqueda"></div>
            <div class="tabla_resultados" id="resultados_busqueda_equivalencias"></div>
        </section>

        <section class="infor_aplica" id="infor_aplica" style="display: inline;">
            <section class="detalle" id="detalle">
                <h1 class="title_busqueda">Buscar filtros por aplicaciones</h1> 
                <section class="about_aplicacion_op">
                    <div class="about_aplicacion_sel about_sel">
                        <label>Aplicacion :</label>
                        <select id="lista1" name="lista1" class="aplicacion selectap">
                            <option value="0" disabled selected>Seleccionar aplicacion</option>
                            <?php
                                $sentencia = $base_de_datos->query("SELECT aplicacion, id FROM aplicacion_tipo ");
                                $sentencia->setFetchMode(PDO::FETCH_ASSOC); 

                                while ($row = $sentencia->fetch()) {
                                    $row['aplicacion'] = substr($row['aplicacion'], 1);
                                    if($row['id'] == $tipo){
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" selected><?php echo $row['aplicacion']; ?></option>
                                    <?php
                                    }
                                    else {
                                    echo '<option value="'.$row['id'].'">'.$row['aplicacion'].'</option>';
                                    }
                                } 
                            ?>
                        </select>
                    <div id="contenido">
                        <div id="select2lista">
                            <label id="label_lista2">Marca :</label>
                            <select id="lista2" name="lista2" class="aplicacion selectap">                            
                            </select>
                        </div>
                    </div>
                    <div id="boton_volver">
                        <a onclick="volver_registros()"><img src="./../img/tipo/bt__vm.png" alt="" class="bt_volver"></a>
                    </div>
                </div>
                    <div class="about_aplicacion_sel">
                        <div style="display: none;" id="contenido2">
                            <div id="tabla">
                                <label>Mostrar:</label>
                                <select name="registros" id="registros" >
                                    <?php 
                                        foreach($paginas as $pag){
                                        if($pag == $perPage){
                                                ?>
                                                    <option value="<?php echo $perPage; ?>" selected><?php echo $perPage; ?></option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <option value="<?php echo $pag; ?>"><?php echo $pag; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>      
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
                            </div>
                            <div id="totalResultado">

                            </div>
                            <div id="navegacion" class="links linka">

                            </div>
                        </div>
                        <div id="vehiculo_seleccionado">

                        </div>
                    </div>
            </section>
        </section>
        <section class="filtro_selec" id="detalle_producto">
            <div class="datos4" id="filtro_titulo">

            </div>
            <div class="datos3" id="filtro_carrusel">

            </div>
            <div class="datos2" id="filtro_especificaciones">

            </div>
            <div class="datos" id="filtro_aplicacion">

            </div> 
            <div class="datos" id="filtro_equivalencia">
                
            </div>                            
        </section>
    </section>
    </div>

    <script src='./../js/busqueda_filtros/cambio_aplicacion.js'></script>
    <script src='./../js/busqueda_filtros/cambio_marca.js'></script>
    <script src='./../js/busqueda_filtros/aplicacion2.js'></script>
    <script src='./../js/busqueda_filtros/aplicacion3.js'></script>
    <script src='./../js/busqueda_filtros/getData.js'></script>
    <script src='./../js/busqueda_filtros/getRegistro.js'></script>
    <script src='./../js/busqueda_filtros/volver_registros.js'></script>   


      <script>
        paginaActual = 1;

        document.getElementById("texto").addEventListener("keyup", function(){
            getData(1);
        }, false);

        document.getElementById("registros").addEventListener("change", function(){
            getData(paginaActual);
        }, false);

        $(document).ready(function(){
            $('#tabla').css("display","none");
            $('#boton_volver').css("display","none");
            $('#volver').css("display","none");
            $('#detalle').css("display","none");
            $('#detalle_producto').css("display","none");
            $('#vuelta_atras').css("display","none");
            $('#formulario_busqueda_aplicacion').css("display","none");
        });

        function buscar(){
            if (document.getElementById("keywords").value != "") {
                input = document.getElementById("keywords").value;
                $.ajax({ 
                    data: {
                        'codigo': input,
                    },
                    url: "./busqueda_codigos.php",
                    type: "POST",
                    dataType: 'json',
                    success: function (response){
                        document.getElementById("resultados_busqueda").innerHTML = response.especificaciones;
                        document.getElementById("resultados_busqueda_equivalencias").innerHTML = response.equivalencias;
                        document.getElementById("resultados_busqueda").style.display = 'block';
                        document.getElementById("resultados_busqueda_equivalencias").style.display = 'block';
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            }
        }

        function getFiltro(codigo){
            $('#buscar').css("display","none");
            $('#busquedas').css("display","none");
            $('#detalle').css("display","none");
            $.ajax({
                data: {
                    'codigo': codigo,
                },
                url: "./../ajax_busquedas/filtro_seleccionado.php",
                type: "POST",
                dataType: "json",
                success: function (response){
                    $('#detalle_producto').css("display","flex");
                    $('#formulario_busqueda_aplicacion').css("display","flex");
                    $('#volver').css("display","none");
                    document.getElementById('filtro_titulo').innerHTML = response.titulo;
                    document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                    document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                    document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                    document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
                    zoomImagen();
                    
                    
                },
                error: function (error){
                    alert("Error");
                }
            });
        }

        document.addEventListener('keydown', function(event) {
            input = document.getElementById("keywords").value;
            if (event.keyCode  == 13 && input != "") {
                buscar();
                document.getElementById("keywords").value = "";
            }
        }, false);

        function volver(){
            $('#buscar').css("display","block");
            $('#busquedas').css("display","flex");
            $('#detalle_producto').css("display","none");
        }

      </script>



    <?php 
        if(isset($_GET['codigo']) ){
    ?>
        <script>
            document.getElementById("keywords").value = "<?php echo $_GET['codigo'] ?>";
            buscar();
        </script>
    <?php
        }   
    ?>

    <?php
        if( isset($_POST['codigo']) ){
            ?>
                <script>
                    document.getElementById("keywords").value = "<?php echo $_POST['codigo']; ?>";
                    buscar();
                </script>
            <?php
        }
    ?>