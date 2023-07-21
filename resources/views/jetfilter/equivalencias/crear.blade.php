<x-Arriba_JetFilter>
    <x-slot name="title">
        Nueva Equivalencia
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Nueva Equivalencia</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.equivalencias') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="about_tabla_edi">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.equivalencias.store') }}" method="POST" class="formulario_aire">
                <table class="tabla_edi">
                    <tr><th colspan="2" style="text-align: center;">Filtro</th></tr>
                    <tr>
                        <th>Código WEB:</th>
                        <td>
                            <input type="text" id="codigo" name="codigo" class="codigo" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if( session()->has('codigo_incorrecto') )
                                <div>
                                    <h3 style='border-radius: 7.5px 7.5px 0px 0px; background-color: #B81616; color:white; text-align:center; padding: 0.3em; margin-top: 1em'>Error</h3>
                                    <div style='border-radius: 0px 0px 7.5px 7.5px; background-color: #F78787; color: white; padding: 1em; text-align:center; margin-bottom: 1.5em;'>No se encontraron coincidencias</div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center;">Equivalencia</th>
                    </tr>
                    <tr>
                        <th>Marca: </th>
                        <td>
                            <select name="marca" class="select" id="marca" required>
                                @foreach($equivalencia_marca as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Código Marca:</th>
                        <td>
                            <input type="text" id="codigo_marca" name="codigo_marca" class="codigo_marca" required>
                        </td>
                    </tr>
                    <tr> 
                        <td class="b_td"> 
                            <input class="boton" type="submit" value="Enviar" name="equivalencia_nueva">
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

<x-AbajoJetFilter />