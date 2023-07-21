<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Producto de Sellado
    </x-slot>
</x-Arriba_JetFilter>

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
@error('diametroempext')
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
@error('diametroempint')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('espesoremp')
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
            <p>Crear Producto y Especificaciones de Sellado</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.sellado') }}" class="boton">Atras</a>
        </div>
    </section>
    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.sellado.store') }}" method="POST" enctype="multipart/form-data">
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
                        <th>Diámetro Externo:</th>
                        <td>
                            <input type="number" id="diametro_ext" name="diametro_ext" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Interno:</th>
                        <td>
                            <input type="text" id="diametro_int" name="diametro_int" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Altura:</th>
                        <td>
                            <input type="number" id="altura" name="altura" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Emp Ext:</th>
                        <td>
                            <input type="number" id="diametroempext" name="diametroempext" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Emp Int:</th>
                        <td>
                            <input type="number" id="diametroempint" name="diametroempint" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Espesor Emp:</th>
                        <td>
                            <input type="number" id="espesoremp" name="espesoremp" min="0" step=".01" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Válvula AL:</th>
                        <td>
                            <select class="select" id="valvulaal" name="valvulaal">
                                <option value="1" selected>SI</option>
                                <option value="0" >NO</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Válvula AD:</th>
                        <td>
                            <select class="select" id="valvulaad" name="valvulaad">
                                <option value="1" selected>SI</option>
                                <option value="0" >NO</option>
                            </select>
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
                        <td class="b_td"> <input class="boton" type="submit" value="Enviar" name="sellado"></td>
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