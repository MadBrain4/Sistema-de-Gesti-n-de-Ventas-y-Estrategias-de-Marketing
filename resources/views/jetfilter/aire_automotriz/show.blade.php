<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Filtro de Aire Automotriz
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Especificación de Aire Automotriz</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.aireautomotriz') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $filtro_automotriz->id }}
                    </td>
                </tr>
                <tr>
                    <th>Código:</th>
                    <td>
                        {{ $filtro_automotriz->codigo }}
                    </td>
                </tr>
                <tr>
                    <th>Código buscar:</th>
                    <td>
                        {{ $filtro_automotriz->codigo_buscar }}
                    </td>
                </tr>
                <tr>
                   <th>Tipo:</th>
                    <td>
                        {{ $tipo }}
                    </td>
                </tr>
                <tr>
                    <th>Diámetro Exterior 1:</th>
                    <td>
                        {{ $filtro_automotriz->diametroext1 }}
                    </td> 
                </tr>
                <tr>
                    <th>Diámetro Exterior 2:</th>
                    <td>
                        {{ $filtro_automotriz->diametroext2 }}
                    </td>
                </tr>
                <tr>
                    <th>Diámetro Interior 1:</th>
                    <td>
                        {{ $filtro_automotriz->diametroint1 }}
                    </td>
                </tr>
                <tr>
                   <th>Diámetro Interior 2:</th>
                   <td>
                        {{ $filtro_automotriz->diametroint2 }}
                    </td>
                </tr>
                <tr>
                    <th>Altura:</th>
                    <td>
                        {{ $filtro_automotriz->altura }}
                   </td>
                </tr>
                <tr>
                    <th>Detalle 1:</th>
                    <td>
                        {{ $filtro_automotriz->detalle1 }}
                    </td>
                 </tr>
                 <tr>
                    <th>Detalle 2:</th>
                    <td>
                        {{ $filtro_automotriz->detalle2 }}
                    </td>
                </tr>    
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $filtro_automotriz->sincronizado }}
                   </td>
                </tr>
            </table>
        </div>

        <x-ImagenesVer :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
    </section>
</section>

<x-Abajo_Jetfilter />