<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Producto de Aplicación Liviano
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Producto de Aplicación Liviano</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.aplicacion_liviano' ) }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.aplicacion_liviano.update', [ 'id' => $aplicacion_liviano->id ] ) }}" method="POST" class="form_login" id="editar-formulario">
                @method('PUT')
                <table class="tabla_edi">
                    <tr><th colspan="2" style="text-align: center;">Filtro</th></tr>
                    <tr>
                        <th>Codigo WEB: </th>
                        <td>  
                            <input class="edi_inp" type="text" value="{{ $aplicacion_liviano->codigo }}" id="codigo_web" name="codigo" id="codigo" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if( session()->has('codigo_incorrecto') )
                            {
                                <div>
                                    <h3 style='border-radius: 7.5px 7.5px 0px 0px; background-color: #B81616; color:white; text-align:center; padding: 0.3em; margin-top: 1em'>Error</h3>
                                    <div style='border-radius: 0px 0px 7.5px 7.5px; background-color: #F78787; color: white; padding: 1em; text-align:center; margin-bottom: 1.5em;'>No se encontraron coincidencias</div>
                                </div>
                            }
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center;">Aplicación Agricola</th>
                    </tr>
                    <tr>
                        <th>Marca: </th>
                        <td>
                            <select name="marca" class="select" id="marca">
                                @foreach( $resultado_marca as $resul )
                                    @if( $resul->id == $aplicacion_liviano->id_marca )
                                        <option value="{{ $resul->id }}" selected>{{ $resul->marca }}</option>
                                    @endif
                                    <option value="{{ $resul->id }}" >{{ $resul->marca }}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <th>Vehiculo: </th>
                        <td>
                            <select name="vehiculo" id="vehiculo" class="select">
                                @foreach($resultado_vehiculo as $resul)
                                    @if( $resul->id == $aplicacion_liviano->id_vehiculo)
                                        <option value="{{ $resul->id }}" selected>{{ $resul->modelo }} ---- {{ $resul->motor }}</option>
                                    @endif
                                    <option value="{{ $resul->id }}">{{ $resul->modelo }} ---- {{ $resul->motor }}</option>
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <th>Aplicación: </th>
                        <td>
                            <select name="aplicacion" class="select" id="marca">
                                @foreach($resultado_aplicacion as $apl)
                                        @if( $apl->aplicacion == $aplicacion_liviano->aplicacion )
                                            <option value="{{ $apl->aplicacion }}" selected> {{ $apl->aplicacion }} </option>
                                        @else
                                            <option value="{{ $apl->aplicacion }}">{{ $apl->aplicacion }} </option>
                                        @endif
                                @endforeach
                            </select>
                        </td>  
                    </tr>
                    <tr>
                        <th>Detalle: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $aplicacion_liviano->detalle }}" name="detalle" id="detalle" />
                        </td>  
                    </tr>
                    <tr ><td class="b_td"><input type="submit" value="Editar" id="aplicacion_liviano" name="aplicacion_liviano" class="boton" /></td></tr>
                </table>
            </form>
        </div>
    </section>
</section>