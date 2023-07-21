<x-Arriba_JetFilter>
    <x-slot name="title">
        Editar Vehículos de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Editar Vehículos de Aplicaciones</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.vehiculos') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.vehiculos.update', ['id' => $vehiculo_seleccionado->id] ) }}" method="POST" class="form_login" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <table class="tabla_edi">
                    <input type="hidden" value="{{ $vehiculo_seleccionado->id }}" name="id">
                    <tr>
                        <th>Marca:</th>
                        <td>
                            <select name="marca" class="select" id="marca" required>
                                @foreach($aplicacion_marca as $resul) 
                                    @if( $resul->id == $marca_seleccionado->id )
                                        <option value="{{ $resul->id }}" selected>{{ $resul->marca }}</option>
                                    @else
                                        <option value="{{ $resul->id }}">{{ $resul->marca }}</option>
                                    @endif        
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Modelo: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $vehiculo_seleccionado->modelo }}" name="modelo" id="modelo" required/>
                        </td>
                    </tr>
                    <tr>
                        <th>Motor: </th>
                        <td>
                            <input  class="edi_inp" type="text" value="{{ $vehiculo_seleccionado->motor }}" name="motor" id="motor" required/>
                        </td>  
                    </tr>
                    <tr>
                        <th>Cilindrada: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $vehiculo_seleccionado->cilindrada }}" name="cilindrada" id="cilindrada" required />
                        </td>  
                    </tr>
                    <tr>
                        <th>Año: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $vehiculo_seleccionado->ano }}" name="ano" id="ano" required/>
                        </td>  
                    </tr>
                    <tr>
                        <td class="b_td"><input type="submit" value="Guardar" name="btnimg" class="boton" /></td>
                    </tr>
                </table> 
            </form>
        </div>
    </section>
</section>