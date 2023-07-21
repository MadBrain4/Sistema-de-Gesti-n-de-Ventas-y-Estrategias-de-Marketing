<x-Arriba_JetFilter>
    <x-slot name="title">
        Marcas - Aplicaciones
    </x-slot>
</x-Arriba_JetFilter>

@if ( session()->has('actualizado') )
    <script>
        var marca = {!! json_encode(session('actualizado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `La información de ${marca} se ha actualizado`,
            timer: 1250,
        })
    </script>
@endif
@if ( session()->has('eliminado') )
    <script>
        var marca = {!! json_encode(session('eliminado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha eliminado la marca: ${marca} `,
            timer: 1250,
        })
    </script>
@endif
@if ( session()->has('creado') )
    <script>
        var marca = {!! json_encode(session('creado'), JSON_HEX_TAG) !!}
        Swal.fire({
            icon: 'success',
            title: `Se ha creado la marca ${marca}`,
            timer: 1750,
        })
    </script>
    @php 
        session()->forget('creado');
    @endphp
@endif

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Marcas - Aplicaciones</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.marcas.crear') }}" class="boton">Nuevo</a>
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
                    <th>Marca</th>
                    <th>Sincronizado</th>
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

<x-AbajoJetfilter />

<script>
    let paginaActual = 1;
    getData(1);

    document.getElementById("campo").addEventListener("keyup", function(){
        getData(paginaActual);
    }, false);

    document.getElementById("num_registros").addEventListener("change", function(){
        getData(paginaActual);
    }, false);

    function getData(pagina){
        let input = document.getElementById('campo').value;
        let content = document.getElementById('contenido');
        let num_registros = document.getElementById("num_registros").value;

        formData = new FormData();
        formData.append('campo', input);
        formData.append('pagina', pagina);
        formData.append('num_registros', num_registros);

        fetch('/jetfilter/catalogo/marcas/cargar', {
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
        );
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