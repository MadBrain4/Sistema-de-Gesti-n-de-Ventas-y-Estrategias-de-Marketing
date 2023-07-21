<x-Arriba_JetFilter>
    <x-slot name="title">
        Nueva Marca de Aplicación
    </x-slot>
</x-Arriba_JetFilter>

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Marcas de Aplicación</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.marcas') }}" class="boton">Atras</a>
        </div>
    </section>

    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.marcas.store') }}" method="POST" class="formulario_aire" enctype="multipart/form-data">
                <table class="tabla_edi">
                    <tr>
                        <th>Marca:</th>
                        <td>
                            <input type="text" id="marca" name="marca" required>
                        </td>
                    </tr>
                    <tr> 
                        <td class="b_td"> 
                            <input class="boton" type="submit" value="Enviar" name="marcas">
                        </td>
                        <td class="b_td"> 
                            <input class="boton" type="reset">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
     </section>
</section>