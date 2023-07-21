<x-Arriba_JetFilter>
    <x-slot name="title">
        Nueva Categoría
    </x-slot>
</x-Arriba_JetFilter>

<script>
    function alerta_error(mensaje){
        Swal.fire({
            icon: 'error',
            title: mensaje,
            timer: 1250,
        })
    }
</script>

@error('categoria')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_error(mensaje);    
    </script>
@enderror

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Categoria</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.categorias.index') }}" class="boton">Atras</a>
        </div>
    </section>
    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.categorias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="tabla_edi">
                    <tr>
                        <th>Categoría:</th>
                        <td>
                            <input type="text" id="categoria" name="categoria" required>
                        </td>
                    </tr>

                    <tr>
                        <th>Clase:</th>
                        <td>
                            <select name="clase" id="clase" class="select">
                                <option value="" disabled selected >¿Cuál es la clase?</option>
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}">{{ $clase->clase }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Producto:</th>
                        <td>
                            <select name="producto" id="producto" class="select">
                                <option value="" disabled selected >¿Cuál es el producto?</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr> 
                        <td class="b_td"> 
                            <input class="boton" type="submit" value="Enviar" name="enviar">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </section>
</section>

<x-AbajoJetfilter />