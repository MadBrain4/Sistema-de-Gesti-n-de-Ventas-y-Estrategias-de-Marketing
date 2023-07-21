<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de las Equivalencias 
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Actualizar Datos de las Equivalencias</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.equivalencias') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="about_tabla_edi">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.equivalencias.update', ['id' => $equivalencia_seleccionada->id] ) }}" method="POST" class="form_login">
                @csrf
                @method('PUT')
                <table class="tabla_edi">
                    <tr><th colspan="2" style="text-align: center;">Filtro</th></tr>
                    <tr>
                        <th>Código WEB: </th>
                        <td>  
                            <input class="edi_inp" type="text" value="{{ $equivalencia_seleccionada->codigo }}" name="codigo" id="codigo" />
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
                            <select name="marca" id="marca" class="select">
                                @foreach($marca_act as $ma)
                                    @if($ma->marca == $equivalencia_seleccionada->marca)                                       
                                        <option value="{{ $ma->id }}" selected>{{ $ma->marca }}</option>
                                    @else 
                                        <option value="{{ $ma->id }}">{{ $ma->marca }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <th>Código Marca: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $equivalencia_seleccionada->codigo_marca }}" name="codigo_marca" id="codigo_marca" />
                        </td>  
                    </tr>
                    <tr>
                        <td class="b_td">
                            <input type="submit" value="Editar" name="equivalencia_marca" class="boton" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
</section>

<x-AbajoJetFilter />