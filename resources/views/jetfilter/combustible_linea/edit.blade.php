<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Filtros de Combustible en Línea
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

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
@error('salida')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('entrada')
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
            <p>Actualizar Datos de Productos de Combustible en Linea</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.combustiblelinea') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">  
            <form action="{{ route('jet-filter.catalogo.combustiblelinea.update', [ 'filtro_combustible' => $filtro_combustible->id ]) }}" method="POST" class="form_login" enctype="multipart/form-data">  
                @method('PUT')
                <table class="tabla_edi">
                    <tr>
                        <th> Código: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_combustible->codigo }}" name="codigo" id="codigo" required/></td>
                    </tr>
                    <tr>
                        <th>Categoría:</th>
                        <td>
                            <select name="categoria" id="categoria" class="select">
                                <option value="" disabled selected >¿Quiere cambiar la categoría?</option>
                                @foreach($categorias as $categoria)
                                    @if( $categoria->id == $categoria_seleccionada->id )
                                        <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                                    @else
                                        <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td>
                            <select name="tipo" id="tipo" class="select">
                                <option value="{{ $tipo_seleccionado->id }}" selected>{{ $tipo_seleccionado->tipo }}</option>
                                @foreach($tipos as $tipo)
                                    @if( $tipo->id == $tipo_seleccionado->id )
            
                                    @else
                                        <option value="{{ $tipo->id }}" >{{ $tipo->tipo }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Diámetro Exterior: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_combustible->diametroext }}" name="diametro_ext" id="diametro_ext" min="0" step=".01" required /></td>  
                    </tr>
                    <tr>
                        <th>Altura: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_combustible->altura }}" name="altura" id="altura" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Entrada:</th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_combustible->entrada }}" name="entrada" id="entrada" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Salida: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_combustible->salida }}" name="salida" id="salida" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 1:</th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_combustible->detalle1 }}" name="detalle1" id="detalle1" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 2: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_combustible->detalle2 }}" name="detalle2" id="detalle2" required/></td>  
                    </tr>
                    <tr><td class="b_td"><input type="submit" value="Guardar" name="btn_combustible" class="boton" /></td></tr>
                </table> 
            </div>

                <x-ImagenesCatalogo :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
            </form>
        </div>
    </section>
</section>

<x-Abajo_Jetfilter />

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