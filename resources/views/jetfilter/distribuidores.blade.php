<link rel="stylesheet" href="{{asset('css/jetfilter/estilos_especificaciones.css')}}">

<x-ArribaInicio>
    <x-slot name="title">
        Distribuidoras
    </x-slot>
</x-ArribaInicio>

<div>
    <table>
        <div>
            <h2 class="catalogo">Administración de los Distribuidores</h2>  
        </div>
        <tr>
            <td class="titulo">Paises</td>
        </tr>
        <tr>
            <td>
                <ul class="lista">
                    <li class="espe"><a href="{{ route('jet-filter.distribuidoras.venezuela') }}">Venezuela</a></li>
                </ul>
            </td>
    </table>
</div>

<x-Abajo_JetFilter />