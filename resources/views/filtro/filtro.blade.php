<x-Arriba />
    <title>Filtro</title>

    @if( session()->has('producto_agregado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `El filtro ha sido agregado al carrito de compras`,
                timer: 2500,
            })
        </script>
        @php
            session()->forget('producto_agregado');
        @endphp
    @endif

    @if( session()->has('producto_lista_agregado') )
        <script>
            Swal.fire({
                icon: 'success',
                title: `El filtro ha sido agregado a la lista de deseos`,
                timer: 2500,
            })
        </script>
        @php
            session()->forget('producto_lista_agregado');
        @endphp
    @endif

    <link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/estilos_filtro.css' )}}">
    <link rel="stylesheet" href="{{ asset( 'css/busqueda_aplicaciones/busqueda_aplicaciones.css' )}}">
    <div class="aplicacion_producto">
        <section class="filtro_selec" id="detalle_producto" style="grid-template-columns: repeat(2, 49%);">
            <div id="filtro_titulo" style="grid-column: 1 / 2;" >
                
            </div>
            <div id="filtro_compra" style="grid-column: 2 / 3;" >
                
            </div>
            <div id="filtro_carrusel" style="grid-column: 1 / 2;">

            </div>
            <div id="filtro_especificaciones" style="grid-column: 2 / 3;">
                
            </div>
            <div id="filtro_aplicacion" style="grid-column: 1 / 2;">

            </div> 
            <div id="filtro_equivalencia" style="grid-column: 2 / 3;">
                    
            </div>                            
        </section>
    </div>
<x-Abajo />

<script>
    function getFiltro(codigo, codigoVehiculo = null){
            $.ajax({
                data: {
                    'codigoVehiculo': codigoVehiculo,
                    'codigo': codigo,
                },
                url: "/aplicaciones/filtro",
                type: "POST",
                dataType: "json",
                success: function (response){
                    document.getElementById('detalle_producto').style.display = "grid";
                    document.getElementById('filtro_titulo').innerHTML = response.titulo;
                    document.getElementById('filtro_compra').innerHTML = response.compras;
                    document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                    document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                    document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                    document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
                },
                error: function (error){
                    console.log(error.responseText);
                }
            });
    }

    function getFiltroCodigo(){
        $.ajax({
            data: {
                'buscarCodigo': 1,
                'codigo': codigo,
            },
            url: "/aplicaciones/filtro",
            type: "POST",
            dataType: "json",
            success: function (response){
                document.getElementById('detalle_producto').style.display = "grid";
                document.getElementById('filtro_titulo').innerHTML = response.titulo;
                document.getElementById('filtro_compra').innerHTML = response.compras;
                document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
            },
            error: function (error){
                console.log(error.responseText);
            }
        });
    }

    function getFiltroEspecificacion(){
        $.ajax({
            data: {
                'buscarEspecificacion': 1,
                'codigo': codigo,
            },
            url: "/aplicaciones/filtro",
            type: "POST",
            dataType: "json",
            success: function (response){
                document.getElementById('detalle_producto').style.display = "grid";
                document.getElementById('filtro_titulo').innerHTML = response.titulo;
                document.getElementById('filtro_compra').innerHTML = response.compras;
                document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
            },
            error: function (error){
                console.log(error.responseText);
            }
        });
    }

    function getFiltroCarrito(){
        $.ajax({
            data: {
                'carr': 1,
                'codigo': codigo,
            },
            url: "/aplicaciones/filtro",
            type: "POST",
            dataType: "json",
            success: function (response){
                document.getElementById('detalle_producto').style.display = "grid";
                document.getElementById('filtro_titulo').innerHTML = response.titulo;
                document.getElementById('filtro_compra').innerHTML = response.compras;
                document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
            },
            error: function (error){
                console.log(error.responseText);
            }
        });
    }

    function getFiltroLista(){
        $.ajax({
            data: {
                'des': 1,
                'codigo': codigo,
            },
            url: "/aplicaciones/filtro",
            type: "POST",
            dataType: "json",
            success: function (response){
                document.getElementById('detalle_producto').style.display = "grid";
                document.getElementById('filtro_titulo').innerHTML = response.titulo;
                document.getElementById('filtro_compra').innerHTML = response.compras;
                document.getElementById('filtro_carrusel').innerHTML = response.carrusel;
                document.getElementById('filtro_especificaciones').innerHTML = response.especificaciones;
                document.getElementById('filtro_aplicacion').innerHTML = response.aplicacion;
                document.getElementById('filtro_equivalencia').innerHTML = response.equivalencia;
            },
            error: function (error){
                console.log(error.responseText);
            }
        });
    }
</script>

@isset( $codigoVehiculo )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        var codigoVehiculo = {!! json_encode($codigoVehiculo , JSON_HEX_TAG) !!}
        getFiltro(codigo, codigoVehiculo);
    </script>
@endisset
@isset( $cod )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        var cod = {!! json_encode($cod , JSON_HEX_TAG) !!}
        getFiltroCodigo(codigo);
    </script>
@endisset
@isset( $esp )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        var esp = {!! json_encode($esp , JSON_HEX_TAG) !!}
        getFiltroEspecificacion(codigo);
    </script>
@endisset
@isset( $carr )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        getFiltroCarrito(codigo);
    </script>
@endisset
@isset( $des )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        getFiltroLista(codigo);
    </script>
@endisset
@if( !isset( $esp ) && !isset( $cod ) && !isset( $codigoVehiculo ) && !isset( $carr ) && !isset( $des ) )
    <script>
        var codigo = {!! json_encode($codigo , JSON_HEX_TAG) !!}
        getFiltro(codigo);
    </script>
@endif
