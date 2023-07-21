<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Equivalencia
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Equivalencia</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.equivalencias') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>ID Filtro:</th>
                    <td>
                        {{ $equivalencia_seleccionada->id }}
                    </td>
                </tr>
                <tr>
                    <th>Código:</th>
                    <td>
                        {{ $equivalencia_seleccionada->codigo }}
                    </td>
                </tr>
                <tr>
                    <th>Código Busqueda:</th>
                    <td>
                        {{ $equivalencia_seleccionada->codigo_buscar }}
                    </td>
                </tr>
                <tr>
                    <th>Marca:</th>
                    <td>
                    {{ $equivalencia_seleccionada->marca }}
                    </td>
                </tr>
                <tr>
                    <th>Código de la Equivalencia:</th>
                    <td>
                        {{ $equivalencia_seleccionada->codigo_marca }}
                    </td> 
                </tr>
                <tr>
                    <th>Código de Busqueda de la Equivalencia:</th>
                    <td>
                        {{ $equivalencia_seleccionada->codigo_marca_buscar }}
                    </td>
                </tr>
                <tr>
                    <th>ID Marca:</th>
                    <td>
                        {{ $equivalencia_seleccionada->id_marca }}
                    </td>
                </tr>
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $equivalencia_seleccionada->sincronizado }}
                     </td>
                 </tr>
            </table>
        </div>
    </section>
</section>

<x-AbajoJetFilter />