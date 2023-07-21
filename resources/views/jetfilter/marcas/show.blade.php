<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Marca de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Marcas de Aplicación</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.marcas') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $marca_seleccionado->id }}
                    </td>
                </tr>
                <tr>
                    <th>Marca:</th>
                    <td>
                        {{ $marca_seleccionado->marca }}
                    </td>
                </tr>
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $marca_seleccionado->sincronizado }}
                    </td>
                </tr>
            </table>
        </div>
    </section>
</section>