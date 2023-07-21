<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Tipo
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

@error('tipo')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_error(mensaje);    
    </script>
@enderror


<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Actualizar Datos de Tipo</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.tipos.index') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">  
            <form action="{{ route('jet-filter.catalogo.tipos.update', [ 'tipo' => $tipo->id ]) }}" method="POST" class="form_login">  
                @method('PUT')
                <table class="tabla_edi">
                    <tr>
                        <th>Tipo: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $tipo->tipo }}" name="tipo" id="tipo" required/>
                        </td>
                    </tr>

                    <tr>
                        <th>Categoría:</th>
                        <td>
                            <select name="categoria" id="categoria" class="select">
                                <option value="{{ $categoria_seleccionada->id }}" selected >{{ $categoria_seleccionada->nombre }} --- {{ $categoria_seleccionada->clase->clase }}</option>
                                @foreach($categorias as $categoria)
                                    @if( $categoria->id == $categoria_seleccionada->id )
                                   
                                    @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }} --- {{ $categoria->clase->clase }}</option>
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