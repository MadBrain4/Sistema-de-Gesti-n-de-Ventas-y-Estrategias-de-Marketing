<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Filtro de Combustible en Línea
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Especificación de Combustible en Línea</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.combustiblelinea') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $filtro_combustible->id }}
                    </td>
                </tr>
                <tr>
                    <th>Código:</th>
                    <td>
                        {{ $filtro_combustible->codigo }}
                    </td>
                </tr>
                <tr>
                    <th>Código buscar:</th>
                    <td>
                        {{ $filtro_combustible->codigo_buscar }}
                    </td>
                </tr>
                <tr>
                   <th>Tipo:</th>
                    <td>
                        {{ $tipo }}
                    </td>
                </tr>
                <tr>
                    <th>Diámetro Exterior:</th>
                    <td>
                        {{ $filtro_combustible->diametroext }}
                    </td> 
                </tr>
                <tr>
                    <th>Altura:</th>
                    <td>
                        {{ $filtro_combustible->altura }}
                    </td>
                </tr>
                <tr>
                    <th>Entrada:</th>
                    <td>
                        {{ $filtro_combustible->entrada }}
                    </td>
                </tr>
                <tr>
                   <th>Salida:</th>
                   <td>
                        {{ $filtro_combustible->salida }}
                    </td>
                </tr>
                <tr>
                    <th>Detalle 1:</th>
                    <td>
                        {{ $filtro_combustible->detalle1 }}
                    </td>
                 </tr>
                 <tr>
                    <th>Detalle 2:</th>
                    <td>
                        {{ $filtro_combustible->detalle2 }}
                    </td>
                </tr>    
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $filtro_combustible->sincronizado }}
                   </td>
                </tr>
            </table>
        </div>

        <x-ImagenesVer :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
    </section>
</section>

<x-Abajo_Jetfilter />