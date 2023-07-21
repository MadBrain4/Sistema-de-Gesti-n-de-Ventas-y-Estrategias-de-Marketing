<x-ArribaJetFilter>
    <x-slot name='title'>
        Crear Nueva Distribuidora - Ecuador
    </x-slot>
</x-ArribaJetFilter>

@php 
    $paginas = [10, 25, 50, 100];
@endphp

<section class="about_tabla_espe">
    <x-Encabezado>
        <x-slot name='title'>
            Crear Nueva Distribuidora - Ecuador
        </x-slot>

        <x-slot name="nuevo">
            <a href="{{ route('jet-filter.distribuidoras.ecuador') }}" class="boton">Atras</a>
        </x-slot>
    </x-Encabezado>

    <section class="about_tabla_edi">
        <div class="tex_tablas">
            <form action="{{ route('jet-filter.distribuidoras.store') }}" method="POST" class="formulario_aire" enctype="multipart/form-data">
                <input type="hidden" name="pais" value="Ecuador" required>
                <table class="tabla_edi">
                    <tr>
                        <th>Nombre:</th>
                        <td>
                            <input type="text" id="nombre" name="nombre" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Direccion:</th>
                        <td>
                            <input type="text" id="direccion" name="direccion" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>
                            <input type="email" id="email" name="email" required>
                        </td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                           <select id="estados_ecuador" name="estado" class="select" required>
                              <option value="" disabled>--Seleccione--</option>
                              <option value="Anzoategui">Anzoategui</option>
                              <option value="Apure">Apure</option>
                              <option value="Aragua">Aragua</option>
                              <option value="Barinas">Barinas</option>
                              <option value="Bolivar">Bolivar</option>
                              <option value="Carabobo">Carabobo</option>
                              <option value="Cojedes">Cojedes</option>
                              <option value="Falcon">Falcon</option>
                              <option value="Guarico">Guarico</option>
                              <option value="Lara">Lara</option>
                              <option value="Merida">Merida</option>
                              <option value="Miranda">Miranda</option>
                              <option value="Monagas">Monagas</option>
                              <option value="Nueva_esparta">Nueva Esparta</option>
                              <option value="Portuguesa">Portuguesa</option>
                              <option value="Sucre">Sucre</option>
                              <option value="Tachira">Tachira</option>
                              <option value="Trujillo">Trujillo</option>
                              <option value="Zulia">Zulia</option>
                              <option value="Nacional">Territorio Nacional</option>
                           </select>
                        </td>
                     </tr>
                     <tr>
                        <th>Ciudad</th>
                        <td>
                           <input type="text" id="ciudad" name="ciudad" required>
                        </td>
                     </tr>
                     <tr>
                        <th>TLF 1</th>
                        <td>
                           <input type="text" id="telefono" name="telefono" required>
                        </td>
                     </tr> 
                     <tr>
                        <th>TLF 2</th>
                        <td>
                           <input type="text" id="telefono" name="telefono_2">
                        </td>
                     </tr>
                     <tr> 
                        <td class="b_td"> <input class="boton" type="submit" value="Enviar" name="distribuidor"></td>
                        <td class="b_td">  <input class="boton" type="reset"></td>
                     </tr>
                </table>
            </form>
        </div>
    </section>
</section>