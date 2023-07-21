<x-Arriba_JetFilter>
    <x-slot name="title">
        Editar Marca de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Editar Marca de Aplicación</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.marcas') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.catalogo.marcas.update', ['id' => $marca_seleccionado->id]) }}" method="POST" class="form_login">
                @csrf 
                @method('PUT')
                <input type="hidden" name="id" value="{{ $marca_seleccionado->id }} ">
                <table class="tabla_edi">
                    <tr>
                        <th> Marca: </th>
                        <td>
                            <input class="edi_inp" type="text" value="{{ $marca_seleccionado->marca }}" name="marca" id="marca" required/>
                        </td>
                    </tr>
                    <tr>
                        <td class="b_td">
                            <input type="submit" value="Guardar" name="btnimg" class="boton" />
                        </td>
                    </tr>
                </table> 
            </form>
        </div>
    </section>
                

</section>