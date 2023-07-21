<x-ArribaJetFilter>
    <x-slot name='title'>
        Ver Aplicación Comercial
    </x-slot>
</x-ArribaJetFilter>

<section class="about_tabla_espe">
    <x-Encabezado>
        <x-slot name='title'>
            Ver Aplicación Comercial
        </x-slot>

        <x-slot name="nuevo">
            <a href="{{ route('jet-filter.catalogo.aplicacion_comercial') }}" class="boton">Atras</a>       
        </x-slot>
    </x-Encabezado>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Tipo:</th>
                    <td>
                        Comercial
                    </td>
                </tr>
                <tr>
                    <th>Vehículo:</th>
                    <td>
                        {{ $modelo_seleccionado }}
                    </td>
                </tr>
                <tr>
                    <th>Motor:</th>
                    <td>
                        {{ $motor_seleccionado }}
                    </td>
                </tr>
                <tr>
                    <th>Marca:</th>
                    <td>
                        {{ $marca_seleccionada }}
                    </td>
                </tr>
                <tr>
                    <th>Aplicación:</th>
                    <td>
                        {{ $aplicacion_seleccionada[0]->aplicacion }}
                    </td>
                </tr>
                <tr>
                    <th>ID Filtro:</th>
                    <td>
                        {{ $aplicacion_seleccionada[0]->id_filtro }}
                    </td> 
                </tr>
                    <tr>
                        <th>Código:</th>
                        <td>
                            {{ $aplicacion_seleccionada[0]->codigo }}
                        </td>
                    </tr>
                    <tr>
                        <th>Detalle:</th>
                        <td>
                            {{ $aplicacion_seleccionada[0]->detalle }}
                        </td>
                    </tr>
                    <tr>
                        <th>Sincronizado:</th>
                        <td>
                            {{ $aplicacion_seleccionada[0]->sincronizado }}
                        </td>
                    </tr>
            </table>
        </div>
    </section>
</section>