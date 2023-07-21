<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Producto de Aire Automotriz
    </x-slot>
</x-Arriba_JetFilter>

<script>
    function alerta_imagen(mensaje){
        Swal.fire({
            icon: 'error',
            title: mensaje,
            timer: 1250,
        })
    }
</script>

@error('codigo')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('diametro_ext')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('diametro_ext2')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('diametro_int')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('diametro_int2')
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
            <p>Crear Producto y Especificaciones de Aire Automotriz</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.aireautomotriz') }}" class="boton">Atras</a>
        </div>
    </section>
    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.aireautomotriz.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="tabla_edi">
                    <tr>
                        <th>Código:</th>
                        <td>
                            <input type="text" id="codigo" name="codigo" required>
                        </td>
                    </tr>
                    @if ( session()->has('codigo_incorrecto') )
                        <td colspan="2">
                            <div>
                                <h3 style='border-radius: 7.5px 7.5px 0px 0px; background-color: #B81616; color:white; text-align:center; padding: 0.3em; margin-top: 1em'>Error</h3>
                                <div style='border-radius: 0px 0px 7.5px 7.5px; background-color: #F78787; color: white; padding: 1em; text-align:center; margin-bottom: 1.5em;'>Este filtro ya existe</div>
                            </div>
                        </td>
                    @endif
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
                            <select name="tipo" id="tipo" class="select" required>
                                <option value="" disabled selected >¿Cuál es el tipo?</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Externo 1:</th>
                        <td>
                            <input type="number" id="diametro_ext" name="diametro_ext" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Externo 2:</th>
                        <td>
                            <input type="number" id="diametro_ext2" name="diametro_ext2" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Interno 1:</th>
                        <td>
                            <input type="number" id="diametro_int" name="diametro_int" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Interno 2:</th>
                        <td>
                            <input type="number" id="diametro_int2" name="diametro_int2" min="0" step=".01" required>
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
                            <input type="text" id="detalle1" name="detalle1">
                        </td>
                    </tr>
                    <tr>
                        <th>Detalle 2:</th>
                        <td>
                            <input type="text" id="detalle2" name="detalle2">
                        </td>
                    </tr>

                    <tr> 
                        <td class="b_td"> <input class="boton" type="submit" value="Enviar" name="aire_automotriz"></td>
                        <td class="b_td">  <input class="boton" type="reset"></td>
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