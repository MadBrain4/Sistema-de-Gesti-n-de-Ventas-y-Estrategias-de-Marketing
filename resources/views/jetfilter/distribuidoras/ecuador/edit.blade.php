<link rel="stylesheet" href="{{ asset( 'css/jetfilter/estilos_figura.css' ) }} ">

@php 
    $estados = ['Amazonas', 'Anzoategui', 'Apure','Aragua', 'Barinas', 'Bolivar', 'Carabobo', 'Caracas', 'Cojedes', 'Delta Amacuro', 'Falcon', 'Guarico', 'Lara', 'Merida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguera', 'Sucre', 'Tachira', 'Trujillo', 'Vargas', 'Yaracuy', 'Zulia']
@endphp

<x-Arriba_JetFilter>
    <x-slot name="title">
        Editar Distribuidoras - Ecuador
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Editar Distribuidoras - Ecuador</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.distribuidoras.ecuador') }}" class="boton_nuevo">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.distribuidoras.update', ['id' => $distribuidora->id]) }}" method="POST" class="form_login" enctype="multipart/form-data">
                <input type="hidden" value="Ecuador" name="pais" required />
                <table class="tabla_edi">
                    <tr>
                        <th> Nombre: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $distribuidora->nombre }}" name="nombre" id="nombre" required />
                        </td>
                    </tr>
                    <tr>
                        <th>Correo: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $distribuidora->email }}" name="email" id="email" required />
                        </td>  
                    </tr>
                    <tr>
                        <th>Estado: </th>
                        <td> 
                            <select id="estados_ecuador" name="estado" class="select" required>
                                <option value="" disabled>--Seleccione--</option>
                                @foreach($estados as $estado)
                                    @php 
                                        $estado_sin_espacio = str_replace(' ', '_', $estado);
                                    @endphp
                                    @if($estado == $distribuidora->estado)
                                        <option value="{{ $estado_sin_espacio }}" selected>{{ $estado }}</option>
                                    @else
                                        <option value="{{ $estado_sin_espacio }}">{{ $estado }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>  
                    </tr>
                    <tr>
                        <th>Ciudad: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $distribuidora->ciudad }}" name="ciudad" id="ciudad" required />
                        </td>  
                    </tr>
                    <tr>
                        <th>Telefono:</th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $distribuidora->telefono }}" name="telefono" id="telefono" required />
                        </td>  
                    </tr>
                    <tr>
                        <th>Telefono 2:</th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $distribuidora->telefono2 }}" name="telefono_2" id="telefono_2" />
                        </td>  
                    </tr>
                    <tr>
                        <td class="b_td">
                            <input type="submit" value="Guardar" name="btnimg" class="boton" />
                        </td>
                    </tr>
                </table> 
            </form>
        </div>
    </section>
</section>