<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Producto de Aplicación Fuera de Carretera
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Producto de Aplicación Fuera de Carretera</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.aplicacion_carretera') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.aplicacion_carretera.store') }}" method="POST" id="nuevo-formulario" class="formulario_aire" enctype="multipart/form-data">
                <table class="tabla_edi">
                    <tr><th colspan="2" style="text-align: center;">Filtro</th></tr>
                    <tr>
                        <th>Código WEB:</th>
                        <td>
                            <input type="text" id="codigo_web" name="codigo_filtro" class="codigo_filtro" required>
                        </td>
                    </tr>
                    @if ( session()->has('codigo_incorrecto') )
                        <td colspan="2">
                            <div>
                                <h3 style='border-radius: 7.5px 7.5px 0px 0px; background-color: #B81616; color:white; text-align:center; padding: 0.3em; margin-top: 1em'>Error</h3>
                                <div style='border-radius: 0px 0px 7.5px 7.5px; background-color: #F78787; color: white; padding: 1em; text-align:center; margin-bottom: 1.5em;'>No se encontraron coincidencias</div>
                            </div>
                        </td>
                    @endif
                    <tr>
                        <th>Marca:</th>
                        <td>
                            <select name="marca" class="select" id="marca" required>
                                @foreach($resultado_marca as $resul)
                                    <option value="{{ $resul->id }}" > {{ $resul->marca }} </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Vehículo:</th>
                        <td>
                            <select name="vehiculo" class="select" id="vehiculo" required>
                                @foreach($resultado_vehiculo as $resul)
                                    <option value="{{ $resul->id }}" > {{ $resul->modelo }} --- {{ $resul->motor }} </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Aplicación:</th>
                        <td>
                            <select name="aplicacion" class="select" required>
                                <option value="Aire" selected>Aire</option>
                                <option value="Aceite">Aceite</option>
                                <option value="Combustible">Combustible</option>
                                <option value="Aire primario">Aire Primario</option>
                                <option value="Aire primario opcional">Aire Primario Opcional</option>
                                <option value="Aire secundario">Aire Secundario</option>
                                <option value="Aire secundario opcional">Aire Secundario Opcional</option>
                                <option value="Aceite primario">Aceite Primario</option>
                                <option value="Aceite secundario">Aceite Secundario</option>
                                <option value="Combustible primario">Combustible Primario</option>
                                <option value="Combustible secundario">Combustible Secundario</option>
                                <option value="Refrigerante">Refrigerante</option>
                                <option value="Separador">Separador</option>
                                <option value="Hidraulico">Hidraulico</option>
                                <option value="Hidraulico primario">Hidraulico Primario</option>
                                <option value="Hidraulico secundario">Hidraulico Secundario</option>
                                <option value="Otros 1">Otros 1</option>
                                <option value="Otros 2">Otros 2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Detalle:</th>
                        <td>
                            <input type="text" id="detalle" name="detalle" required>
                        </td>
                    </tr>
                    <tr> 
                        <td class="b_td"> <input class="boton" type="submit" value="Enviar" name="aplicacion_carretera"></td>
                        <td class="b_td">  <input class="boton" type="reset"></td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
</section>

<x-AbajoJetFilter />