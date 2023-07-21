<link rel="stylesheet" href="{{ asset( 'css/jetfilter/estilos_figura.css' ) }} ">

<x-Arriba_JetFilter>
    <x-slot name="title">
        Distribuidoras - Venezuela
    </x-slot>
</x-Arriba_JetFilter>

@php
    $paginas = [10, 25, 50, 100];
@endphp

@if ( session('actualizado') )
    <script>
        var distribuidora = {!! json_encode(session('actualizado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `La información de ${distribuidora} se ha actualizado`,
            timer: 1250,
        })
    </script>
@endif
@if ( session('creado') )
    <script>
        var distribuidora = {!! json_encode(session('creado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha creado la distribuidora ${distribuidora}`,
            timer: 1250,
        })
    </script>
@endif
@if ( session('eliminado') )
    <script>
        var distribuidora = {!! json_encode(session('eliminado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha eliminado la distribuidora ${distribuidora}`,
            timer: 1250,
        })
    </script>
@endif

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Distribuidoras - Venezuela</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.distribuidoras.venezuela.nuevo') }}" class="boton_nuevo">Nuevo</a>
        </div>
    </section>

    <div class="about_tabla_edi">
        <label for="campo" >Mostrar:</label>
        <select name="num_registros" id="num_registros" class="mostar_textbox" >
            @foreach( $paginas as $pagina )
                <option value="{{ $pagina }}" > {{ $pagina }} </option>
            @endforeach
        </select>

        <input type="text" class="textbox inline" name="campo" id="campo" size="30" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Ciudad</th>
                    <th>TLF</th>
                    <th>TLF 2</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido">

            </tbody>
        </table>
        <div id="row">
            <div id="lbl-total"></div>
            <div id="paginacion" class="links">
            </div>
        </div>
    </div>
</section>

<x-AbajoJetFilter />

<script>
    let paginaActual = 1;
    getData(paginaActual);
    document.getElementById("campo").addEventListener("keyup", function(){
        getData(paginaActual);
    }, false);
    
    document.getElementById("num_registros").addEventListener("change", function(){
        getData(paginaActual);
    }, false);

    function getData(pagina){
        let input = document.getElementById("campo").value;
        let content = document.getElementById("contenido");
        let num_registros = document.getElementById("num_registros").value;
        columnas = ["id", "id_filtro", "codigo", "codigo_buscar", "tipo", "diametroext1", "diametroext2","diametroint1", "diametroint2", "altura", "detalle1", "detalle2"];

        formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('campo', input);
        formData.append('num_registros', num_registros);
        formData.append('pais', 'Venezuela')

        fetch('/jetfilter/distribuidoras/cargar', {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                content.innerHTML = data.data;
                if(data.totalFiltro != data.totalRegistros){
                    document.getElementById("lbl-total").innerHTML = "<p>Mostrando " + data.totalFiltro + " de " + data.totalRegistros + " registros</p>";
                }
                else {
                    document.getElementById('lbl-total').innerHTML = "";
                }
                document.getElementById('paginacion').innerHTML =  data.paginacion;
            }
        )
        .catch(
            error => alert(error)
        )
    }
</script>

<script>
    function eliminado(event, j){
        event.preventDefault();

        Swal.fire({
                icon: "warning",
                title: "Eliminar",
                text: `¿Está seguro que desea eliminar el registro?`,
                showCancelButton: true,
                cancelButtonColor: '#838383',
                confirmButtonColor: '#E2001A',
                confirmButtonText: 'Si, eliminalo',
                buttonsStyling: true,
                cancelButtonText: "Cancelar",
                footer: "Si se elimina, no se podra recuperar el registro",
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("formulario-eliminar-"+j).submit();
            }
        })
    }
</script>