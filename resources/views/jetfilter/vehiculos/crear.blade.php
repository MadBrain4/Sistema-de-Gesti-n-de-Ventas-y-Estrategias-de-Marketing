<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Vehículos de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Vehículos de Aplicación</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.vehiculos') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.vehiculos.store') }}" method="POST" class="formulario_aire" enctype="multipart/form-data">
                @csrf
                <table class="tabla_edi">
                    <tr>
                        <th>Marca:</th>
                        <td>
                            <select name="marca" class="select" id="marca" required>
                                @foreach($aplicacion_marca as $resul) 
                                        <option value="{{ $resul->id }}" >{{ $resul->marca }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Modelo:</th>
                        <td>
                            <input type="text" id="modelo" name="modelo" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Motor:</th>
                        <td>
                            <input type="text" id="motor" name="motor" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Cilindrada:</th>
                        <td>
                            <input type="text" id="cilindrada" name="cilindrada" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Año:</th>
                        <td>
                            <input type="text" id="ano" name="ano" required>
                        </td>
                    </tr>

                    <tr> 
                        <td class="b_td">
                            <input class="boton" type="submit" value="Enviar" name="vehiculos">
                        </td>
                        <td class="b_td">  
                            <input class="boton" type="reset">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
</section>