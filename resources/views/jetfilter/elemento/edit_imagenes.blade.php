<x-Arriba_JetFilter>
    <x-slot name="title">
        Actualizar Datos de Filtros de Elemento
    </x-slot>
</x-Arriba_JetFilter>

@php
    $rann = date('H:i:s'); 
@endphp

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Actualizar Datos de Productos de Elemento</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.elemento') }}" class="boton">Atras</a>
        </div>
    </section>

    <form action="{{ route('jet-filter.catalogo.update_imagenes', ['id' => $id]) }}" method="POST" class="form_login" enctype="multipart/form-data">
        @method('PUT')
        <input type="hidden" value="elemento" name="categoria" id="categoria" required/>
        <x-ImagenesCatalogo :imagenes="[$imagenes[0], $imagenes[1], $imagenes[2], $imagenes[3]]" :rann="date('H:i:s')" />
        <tr>
            <td class="b_td"><input type="submit" value="Guardar" name="btnimg" class="boton1" /></td>
        </tr>
    </form>

</section>

<x-Abajo_Jetfilter />

<script src="/js/jetfilter/comprobar_imagen.js"></script>
<script src="/js/jetfilter/colocar_validacion.js"></script>
<script src="/js/jetfilter/archivo.js"></script>