<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Categoria
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<script>
    function alerta_error(mensaje){
        Swal.fire({
            icon: 'error',
            title: mensaje,
            timer: 1250,
        })
    }
</script>

@error('categoria')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_error(mensaje);    
    </script>
@enderror


<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Actualizar Datos de Categoria</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.categorias.index') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">  
            <form action="{{ route('jet-filter.catalogo.categorias.update', [ 'categoria' => $categoria->id ]) }}" method="POST" class="form_login">  
                @method('PUT')
                <table class="tabla_edi">
                    <tr>
                        <th>Nombre: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $categoria->nombre }}" name="categoria" id="categoria" required/>
                        </td>
                    </tr>

                    <tr>
                        <th>Clase:</th>
                        <td>
                            <select name="clase" id="clase" class="select">
                                <option value="{{ $clase_seleccionada->id }}" selected >{{ $clase_seleccionada->clase }}</option>
                                @foreach($clases as $clase)
                                    @if( $clase->id == $clase_seleccionada->id )
                                   
                                    @else
                                        <option value="{{ $clase->id }}">{{ $clase->clase }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Producto:</th>
                        <td>
                            <select name="producto" id="producto" class="select">
                                <option value="{{ $producto_seleccionado->id }}" selected >{{ $producto_seleccionado->producto }}</option>
                                @foreach($productos as $producto)
                                    @if( $producto->id == $producto_seleccionado->id )
                                   
                                    @else
                                        <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="b_td">
                            <input type="submit" value="Guardar" name="enviar_producto" class="boton" />
                        </td>
                    </tr>
                </table> 
            </div>
            </form>
        </div>
    </section>
</section>

<x-Abajo_Jetfilter />