<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Filtros Panel
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

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
            <p>Actualizar Datos de Productos de Panel</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.panel') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">  
            <form action="{{ route('jet-filter.catalogo.panel.update', [ 'filtro_panel' => $filtro_panel->id ]) }}" method="POST" class="form_login" enctype="multipart/form-data">  
                @method('PUT')
                <table class="tabla_edi">
                    <tr>
                        <th> Código: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_panel->codigo }}" name="codigo" id="codigo" required/></td>
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
                        <th>Largo: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_panel->largo }}" name="largo" id="largo" min="0" step=".01" required /></td>  
                    </tr>
                    <tr>
                        <th>Ancho: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_panel->ancho }}" name="ancho" id="ancho" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Altura:</th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_panel->altura }}" name="altura" id="altura" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 1:</th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_panel->detalle1 }}" name="detalle1" id="detalle1" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 2: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_panel->detalle2 }}" name="detalle2" id="detalle2" required/></td>  
                    </tr>
                    <tr><td class="b_td"><input type="submit" value="Guardar" name="btn_panel" class="boton" /></td></tr>
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