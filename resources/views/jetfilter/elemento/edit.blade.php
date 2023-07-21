<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Filtros de Elemento
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
@error('diametro_ext')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_imagen(mensaje);    
    </script>
@enderror
@error('diametro_int1')
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
            <p>Actualizar Datos de Productos de Elemento</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.elemento') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">  
            <form action="{{ route('jet-filter.catalogo.elemento.update', [ 'filtro_elemento' => $filtro_elemento->id ]) }}" method="POST" class="form_login" enctype="multipart/form-data">  
                @method('PUT')
                <table class="tabla_edi">
                    <tr>
                        <th> Código: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_elemento->codigo }}" name="codigo" id="codigo" required/></td>
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
                        <td><input class="edi_inp" type="number" value="{{ $filtro_elemento->diametroext1 }}" name="diametro_ext" id="diametro_ext" min="0" step=".01" required /></td>  
                    </tr>
                    <tr>
                        <th>Diámetro Int 1: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_elemento->diametroint1 }}" name="diametro_int1" id="diametro_int1" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Diámetro Int 2:</th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_elemento->diametroint2 }}" name="diametro_int2" id="diametro_int2" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Altura: </th>
                        <td><input class="edi_inp" type="number" value="{{ $filtro_elemento->altura }}" name="altura" id="altura" min="0" step=".01" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 1:</th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_elemento->detalle1 }}" name="detalle1" id="detalle1" required/></td>  
                    </tr>
                    <tr>
                        <th>Detalle 2: </th>
                        <td><input class="edi_inp" type="text" value="{{ $filtro_elemento->detalle2 }}" name="detalle2" id="detalle2" required/></td>  
                    </tr>
                    <tr>
                        <td class="b_td">
                            <input type="submit" value="Guardar" name="btn_elemento" class="boton" />
                        </td>
                    </tr>
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