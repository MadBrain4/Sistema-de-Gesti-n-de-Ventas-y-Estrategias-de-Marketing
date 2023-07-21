<x-Arriba_JetFilter>
    <x-slot name="title">
        Ver Filtro de Sellado
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Ver Especificación de Sellado</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.sellado') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <table class="tabla_ver">
                <tr>
                    <th>Id:</th>
                    <td>
                        {{ $filtro_sellado->id }}
                    </td>
                </tr>
                <tr>
                    <th>Código:</th>
                    <td>
                        {{ $filtro_sellado->codigo }}
                    </td>
                </tr>
                <tr>
                    <th>Código buscar:</th>
                    <td>
                        {{ $filtro_sellado->codigo_buscar }}
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
                        {{ $filtro_sellado->diametroext }}
                    </td> 
                </tr>
                <tr>
                    <th>Diámetro Exterior 2:</th>
                    <td>
                        {{ $filtro_sellado->diametroint }}
                    </td>
                </tr>
                <tr>
                    <th>Diámetro Emp Interior:</th>
                    <td>
                        {{ $filtro_sellado->diametroempint }}
                    </td>
                </tr>
                <tr>
                   <th>Diámetro Emp Exterior:</th>
                   <td>
                        {{ $filtro_sellado->diametroempext }}
                    </td>
                </tr>
                <tr>
                    <th>Altura:</th>
                    <td>
                        {{ $filtro_sellado->altura }}
                   </td>
                </tr>
                <tr>
                    <th>Espesor EMP:</th>
                    <td>
                        {{ $filtro_sellado->espesoremp }}
                   </td>
                </tr>
                <tr>
                    <th>Válvula AL:</th>
                    <td>
                        {{ $filtro_sellado->valvulaal }}
                   </td>
                </tr>
                <tr>
                    <th>Válvula AD:</th>
                    <td>
                        {{ $filtro_sellado->valvulaad }}
                   </td>
                </tr>
                <tr>
                    <th>Detalle 1:</th>
                    <td>
                        {{ $filtro_sellado->detalle1 }}
                    </td>
                 </tr>
                 <tr>
                    <th>Detalle 2:</th>
                    <td>
                        {{ $filtro_sellado->detalle2 }}
                    </td>
                </tr>    
                <tr>
                    <th>Sincronizado:</th>
                    <td>
                        {{ $filtro_sellado->sincronizado }}
                   </td>
                </tr>
            </table>
        </div>

        <x-ImagenesVer :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
    </section>
</section>

<x-Abajo_Jetfilter />