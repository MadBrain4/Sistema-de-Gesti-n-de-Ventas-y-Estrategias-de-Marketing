<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Producto de Panel
    </x-slot>
</x-Arriba_JetFilter>

@error('codigo')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('largo')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('ancho')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('altura')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('detalle1')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('detalle2')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('imagen1')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('imagen2')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('imagen3')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('imagen4')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Producto y Especificaciones de Panel</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.panel') }}" class="boton">Atras</a>
        </div>
    </section>
    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.panel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="tabla_edi">
                    <tr>
                        <th>Código:</th>
                        <td>
                        <input type="text" id="codigo" name="codigo" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Categoría:</th>
                        <td>
                            <select name="categoria" id="categoria" class="select">
                                <option value="" disabled selected >¿Cuál es la categoría?</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td>
                            <select name="tipo" id="tipo" class="select">
                                <option value="" disabled selected >¿Cuál es el tipo?</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Largo:</th>
                        <td>
                        <input type="number" id="largo" name="largo" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Ancho:</th>
                        <td>
                        <input type="number" id="ancho" name="ancho" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Altura:</th>
                        <td>
                        <input type="number" id="altura" name="altura" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Detalle 1:</th>
                        <td>
                        <input type="text" id="detalle1" name="detalle1" >
                        </td>
                    </tr>
                    <tr>
                        <th>Detalle 2:</th>
                        <td>
                        <input type="text" id="detalle2" name="detalle2" >
                        </td>
                    </tr>

                    <tr> 
                        <td class="b_td"> 
                            <input class="boton" type="submit" value="Enviar" name="panel">
                        </td>
                        <td class="b_td">  
                            <input class="boton" type="reset">
                        </td>
                    </tr>
                </table>
            </div>

            <x-ImagenesCrear />
        </form>
    </section>
</section>

<x-AbajoJetfilter />

<script src="/js/jetfilter/comprobar_imagen.js"></script>
<script src="/js/jetfilter/colocar_validacion.js"></script>
<script src="/js/jetfilter/archivo.js"></script>

<script>
    categoria = document.getElementById('categoria');
    categoria.addEventListener('change', (event) => {
        valor = document.getElementById('categoria').value;
        formData = new FormData();
        formData.append('id_categoria', valor);
        fetch("/jetfilter/catalogo/categoria/tipo", {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                document.getElementById("tipo").innerHTML = data;
            }
        )
        .catch(
            error => alert(error)
        )
    })
</script>