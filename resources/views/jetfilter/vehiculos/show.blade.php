<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Vehículos de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Vehículos de Aplicación</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.vehiculos') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $vehiculo_seleccionado->id }}
                    </td>
                </tr>
                <tr>
                    <th>Marca Seleccionada:</th>
                    <td>
                        {{ $marca_seleccionado->marca }}
                    </td>
                </tr>
                <tr>
                    <th>Modelo:</th>
                    <td>
                        {{ $vehiculo_seleccionado->modelo }}
                    </td>
                </tr>
                <tr>
                    <th>Motor:</th>
                    <td>
                        {{ $vehiculo_seleccionado->motor }}
                    </td>
                </tr>
                <tr>
                    <th>Cilindrada:</th>
                    <td>
                        {{ $vehiculo_seleccionado->cilindrada }}
                    </td>
                </tr>
                <tr>
                    <th>Año:</th>
                    <td>
                        {{ $vehiculo_seleccionado->ano }}
                    </td> 
                </tr>    
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $vehiculo_seleccionado->sincronizado }}
                    </td>
                </tr>
            </table>
        </div>
    </section>
</section>