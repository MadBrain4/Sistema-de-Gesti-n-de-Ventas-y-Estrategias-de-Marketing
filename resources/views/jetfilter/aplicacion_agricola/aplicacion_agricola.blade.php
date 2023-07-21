<x-ArribaJetFilter>
    <x-slot name='title'>
        Aplicación Agrícola
    </x-slot>
</x-ArribaJetFilter>

@if ( session()->has('creado') )
    <script>
        var codigo = {!! json_encode(session('creado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha creado la aplicación del filtro ${codigo}`,
            timer: 1250,
        })
    </script>
@endif
@if ( session()->has('eliminado') )
    <script>
        var codigo = {!! json_encode(session('eliminado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha eliminado la aplicación del filtro ${codigo}`,
            timer: 1250,
        })
    </script>
@endif

@php 
    $paginas = [10, 25, 50, 100];
@endphp

<section class="about_tabla_espe">
    <x-Encabezado>
        <x-slot name='title'>
            Aplicación Agrícola
        </x-slot>

        <x-slot name="nuevo">
            <a href="{{ route('jet-filter.catalogo.aplicacion_agricola.nuevo') }}" class="boton">Nuevo</a>
        </x-slot>
    </x-Encabezado>

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
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Vehículo</th>
                    <th>Motor</th>
                    <th>Aplicación</th>
                    <th>Id Código</th>
                    <th>Código</th>
                    <th>Detalle</th>
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
        let tipo_aplicacion = 4;

        formData = new FormData();
        formData.append('pagina', pagina);
        formData.append('campo', input);
        formData.append('num_registros', num_registros);
        formData.append('tipo', tipo_aplicacion);

        fetch('/jetfilter/catalogo/cargar_aplicacion', {
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
