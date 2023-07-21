<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Filtro de Panel
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Especificación de Panel</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.panel') }}" class="boton" >Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $filtro_panel->id }}
                    </td>
                </tr>
                <tr>
                    <th>Código:</th>
                    <td>
                        {{ $filtro_panel->codigo }}
                    </td>
                </tr>
                <tr>
                    <th>Código buscar:</th>
                    <td>
                        {{ $filtro_panel->codigo_buscar }}
                    </td>
                </tr>
                <tr>
                   <th>Tipo:</th>
                    <td>
                        {{ $tipo }}
                    </td>
                </tr>
                <tr>
                    <th>Largo:</th>
                    <td>
                        {{ $filtro_panel->largo }}
                    </td> 
                </tr>
                <tr>
                    <th>Ancho:</th>
                    <td>
                        {{ $filtro_panel->ancho }}
                    </td>
                </tr>
                <tr>
                   <th>Altura:</th>
                   <td>
                        {{ $filtro_panel->altura }}
                    </td>
                </tr>
                <tr>
                    <th>Detalle 1:</th>
                    <td>
                        {{ $filtro_panel->detalle1 }}
                    </td>
                 </tr>
                 <tr>
                    <th>Detalle 2:</th>
                    <td>
                        {{ $filtro_panel->detalle2 }}
                    </td>
                </tr>    
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $filtro_panel->sincronizado }}
                   </td>
                </tr>
            </table>
        </div>

        <x-ImagenesVer :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
    </section>
</section>

<x-Abajo_Jetfilter />