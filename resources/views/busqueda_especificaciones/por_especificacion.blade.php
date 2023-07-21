<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/busqueda_aplicaciones.css' )}}">
<link rel="stylesheet" href="{{ asset( 'css/busqueda_especificaciones/busqueda_especificaciones.css' )}}">
<link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/estilos_filtro.css' )}}">
<style>
    .a {
        color: #E2001A;
    }
    .comprar_iconos{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 30%));
        grid-template-rows: repeat(1, minmax(0, 100%));
    }

    .fila1 {
        grid-column: 1 / 3;
    }

    .fila2 {
        display: flex;
    }

    .comprate {
        background-color: #E2001A;
        color: #fff;
        width: 4em;
        height: 3em;
        margin-right: 5px;
    }
</style>

<div>
    <section class="detalle" id="detalle_especificaciones">
        <section>
            <h1 class="title_busqueda">Catálogo de productos por especificaciones técnicas</h1> 
            <section class="about_aplicacion_op" > 
                <div>
                    <div class="about_aplicacion_sel">
                        <label id="tituloSelPrincipal" class="sub_title_busqueda">Línea de filtro:</label><br>
                        <select id="claseFiltros" name="claseFiltros" class="select">
                            <option value="" disabled selected>--Seleccione--</option>
                            <option value="Sellado">Sellado</option>
                            <option value="Panel">Panel</option>
                            <option value="Elemento">Elemento</option>
                            <option value="Combustible en Linea">Combustible en línea</option>
                            <option value="Aire Automotriz">Aire Automotriz</option>
                            <option value="Aire Industrial">Aire Industrial</option>
                        </select>
                    </div>
                    <div class="about_aplicacion_sel" id="tipo_filtro">
                        <label class="sub_title_busqueda">Tipo:</label><br>
                        <select id="tipoFiltros" class="selTipoSellado select">
                        </select>
                    </div>
                    <div class="about_aplicacion_sel" id="rosca_filtro">
                            <label id="RoscaRosca" class="sub_title_busqueda">Rosca:</label><br>
                            <select id="roscaFiltro" class="selRoscaRosca select">
                            </select>
                    </div>
                </div>
                <div>
                    <div class="flex_mostra_espe">
                        <div id="registros_div">
                            <div class="flex_mostra">
                                <div>
                                    <label class="a">Mostrar:</label>
                                </div>
                                <div>
                                    <select name="registros" id="registros_especificaciones">
                                        @foreach($paginas as $pag)
                                            <option value="{{ $pag }}" >{{ $pag }}</option>
                                        @endforeach            
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="about_aplicacion_sel" id="campo_busqueda">
                            <label id="buscar_especificaciones"></label>
                            <input type="text" id="valorBuscar" name="valorBuscar" class="vBuscar" placeholder="Buscar">
                        </div>
                   </div>
                   <div class="about_aplicacion_sel table-responsive" id="resultados">
                  
                   </div>
                   <div id="totalResultado_especificaciones">
       
                   </div>
                   <div id="navegacion_especificaciones" class="links linka">
       
                   </div>
                </div>
            </section>
        </section>
    </section>
</div>

    <script>
        let paginaActual = 1;
        document.getElementById("valorBuscar").addEventListener("keyup", function(){
            getTabla(1);
        }, false);
    
        document.getElementById("registros_especificaciones").addEventListener("change", function(){
            getTabla(1);
        }, false);
    
        window.addEventListener('DOMContentLoaded', function(){
            document.getElementById('tipo_filtro').style.display = "none";
            document.getElementById('rosca_filtro').style.display = "none";
            document.getElementById('buscar_especificaciones').style.display = "none";
            document.getElementById('valorBuscar').style.display = "none";
            document.getElementById('resultados').style.display = "none";
            document.getElementById('registros_div').style.display = "none";
    
            clase_filtro = document.getElementById('claseFiltros');
            tipo_filtro = document.getElementById('tipoFiltros');
            rosca_filtro = document.getElementById('roscaFiltro');

            /*-----------CLASE-------------*/
            clase_filtro.addEventListener("change", () => {

                var valorCambiado = document.getElementById('claseFiltros').value;
                /*----------SI REQUIERE TIPO-----------------*/
                if( valorCambiado == "Sellado" || valorCambiado == "Elemento" || valorCambiado == "Panel"){
                    formData = new FormData();
                    formData.append('especificacion', valorCambiado);
                    fetch('/especificaciones/clase', { 
                        method: 'POST',
                        body: formData,
                    })
                    .then( response => response.json() )
                    .then( data => {
                        document.getElementById('tipoFiltros').innerHTML = data;
                    })
                    .then( document.getElementById('tipo_filtro').style.display = "block" )
                    .then( document.getElementById('tipo_filtro').value = "vacio" )
                    .then( document.getElementById('rosca_filtro').style.display = "none" )
                    .then( document.getElementById('rosca_filtro').style.display = "vacio" )
                    .catch( error => alert(error) )
                }
                /*----------------NO REQUIERE TIPO-----------------*/
                else {
                   roscaFiltro = document.getElementById('rosca_filtro');
                   tipoFiltro = document.getElementById('tipo_filtro');
    
                   tipoFiltro.style.display = "none";
                   roscaFiltro.style.display = "none";
                   roscaFiltro.value = "vacio";
    
                   var especificacion = document.getElementById('claseFiltros').value;
                   formData = new FormData();
                   formData.append('especificacion', especificacion);
                   fetch('/especificaciones/tabla', { 
                        method: 'POST',
                        body: formData,
                   })
                   .then( response => response.json() )
                   .then( 
                        data => {
                            document.getElementById('resultados').innerHTML = data.data;
                            document.getElementById('navegacion_especificaciones').innerHTML = data.paginacion;
                        }, 
                   )
                   .then( () => {
                        document.getElementById('resultados').style.display = "block";
                        document.getElementById('buscar_especificaciones').style.display = "block";
                        document.getElementById('valorBuscar').style.display = "block";
                        document.getElementById('registros_div').style.display = "block";
                    })
                    .catch( error => console.log(error) )
    
                }
            })
            
            tipo_filtro.addEventListener("change", () => {
                var valorCambiado = document.getElementById('claseFiltros').value;
                var valorTipo = document.getElementById('tipoFiltros').value;
                /*-------------SI REQUIERE ROSCA----------------*/
                if( valorCambiado == "Sellado" ){
                    formData = new FormData();
                    formData.append('especificacion', valorCambiado);
                    formData.append('nombre_tipo', valorTipo);
                    fetch('/especificaciones/tipo', { 
                        method: 'POST',
                        body: formData,
                    })
                    .then( response => response.json() )
                    .then( 
                        data => {
                            document.getElementById('roscaFiltro').innerHTML = data;
                        }, 
                    )
                    .then( () => {
                        document.getElementById('rosca_filtro').style.display = "block";
                    })
                    .catch( error => alert(error) )
                    
                }
                /*--------------NO REQUIERE ROSCA-----------------*/
                else {
                    document.getElementById('rosca_filtro').style.display = "none";
    
                    var especificacion = document.getElementById('claseFiltros').value;
                    var tipo = document.getElementById('tipoFiltros').value;

                    formData = new FormData();
                    formData.append('especificacion', especificacion);
                    if( especificacion == 'Elemento' || especificacion == 'Panel' ||  especificacion == 'Sellado' ){
                        formData.append('tipo', tipo);
                    }
                    fetch('/especificaciones/tabla', { 
                        method: 'POST',
                        body: formData,
                    })
                    .then( response => response.json() )
                    .then( 
                        data => {
                            console.log(data);
                            document.getElementById('resultados').innerHTML = data.data;
                            document.getElementById('resultados').style.display = "block";
                            document.getElementById('buscar_especificaciones').style.display = "block";
                            document.getElementById('valorBuscar').style.display = "block";
                            document.getElementById('registros_div').style.display = "block";
                            if(data.totalFiltro != data.totalRegistros){
                                document.getElementById('totalResultado_especificaciones').innerHTML = '<p>Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros</p>';
                            }
                            else {
                                document.getElementById('totalResultado_especificaciones').innerHTML = "";
                            }
                            document.getElementById('navegacion_especificaciones').innerHTML = data.paginacion;
                        }, 
                    )
                    .catch( (error) => console.log(error) ) ;
                }
            })
    
            rosca_filtro.addEventListener('change', () => {
                var especificacion = document.getElementById('claseFiltros').value;
                var tipo = document.getElementById('tipoFiltros').value;
                var rosca = document.getElementById('roscaFiltro').value;

                formData = new FormData();
                formData.append('especificacion', especificacion);
                formData.append('tipo', tipo);
                formData.append('rosca', rosca);

                fetch('/especificaciones/tabla', { 
                    method: 'POST',
                    body: formData,
                })
                .then( response => response.json() )
                .then( 
                    data => {
                        console.log(data);
                        document.getElementById('resultados').innerHTML = data.data;
                        document.getElementById('resultados').style.display = "block";
                        document.getElementById('buscar_especificaciones').style.display = "block";
                        document.getElementById('valorBuscar').style.display = "block";
                        document.getElementById('registros_div').style.display = "block";
                        if( data.totalFiltro != data.totalRegistros ){
                            document.getElementById('totalResultado_especificaciones').innerHTML = '<p>Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros</p>';
                        }
                        else {
                            document.getElementById('totalResultado_especificaciones').innerHTML = "";
                        }
                        document.getElementById('navegacion_especificaciones').innerHTML = data.paginacion;
                    }
                )
                .catch( error => console.log(error) )
            })
        });
    
        function getTabla(pagina){
            var especificacion = document.getElementById('claseFiltros').value;
            let registros = document.getElementById("registros_especificaciones").value;
            let campo = document.getElementById("valorBuscar").value;

            formData = new FormData();
            formData.append('especificacion', especificacion);

            if( especificacion == 'Elemento' || especificacion == 'Panel' ||  especificacion == 'Sellado' ){
                var tipo = document.getElementById('tipoFiltros').value;
                formData.append('tipo', tipo);
            }
            if( especificacion == 'Sellado' ){
                var rosca = document.getElementById('roscaFiltro').value;
                formData.append('rosca', rosca);
            }
            formData.append('registros', registros);
            formData.append('campo', campo);
            formData.append('pagina', pagina);

        
            fetch('/especificaciones/tabla', { 
                method: 'POST',
                body: formData,
            })
            .then( response => response.json() )
            .then( 
                data => {
                    document.getElementById('resultados').innerHTML = data.data;
                    document.getElementById('resultados').style.display = "block";
                    if(data.totalFiltro != data.totalRegistros){
                        document.getElementById('totalResultado_especificaciones').innerHTML = '<p>Mostrando ' + data.totalFiltro + ' de ' + data.totalRegistros + ' registros</p>';
                    }
                    else {
                        document.getElementById('totalResultado_especificaciones').innerHTML = "";
                    }
                    document.getElementById('navegacion_especificaciones').innerHTML = data.paginacion;
                    document.getElementById('buscar_especificaciones').style.display = "block";
                    document.getElementById('valorBuscar').style.display = "block";
                }, 
            )
            .catch( (error) => console.log(error) ) ;
        }
    
    function volver(){
        $('#detalle_especificaciones').css("display","block");
        $('#detalle_producto').css("display","none");
    }
</script>