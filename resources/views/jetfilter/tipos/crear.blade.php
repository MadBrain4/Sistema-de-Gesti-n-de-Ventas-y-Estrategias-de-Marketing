<x-Arriba_JetFilter>
    <x-slot name="title">
        Nuevo Tipo
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

@error('tipo')
    <script>
        var mensaje = {!! json_encode($message, JSON_HEX_TAG) !!}
        alerta_error(mensaje);    
    </script>
@enderror

<section class="about_tabla_espe">
    <section class="about-if_tabla_esp">
        <div class="tex_tablas">
            <p>Crear Tipo</p>
        </div>
        <div class="tex_tablas">
            <a href="{{ route('jet-filter.catalogo.tipos.index') }}" class="boton">Atras</a>
        </div>
    </section>
    <section class="es_tabla">
        <div class="tex_tablas">
           <form action="{{ route('jet-filter.catalogo.tipos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="tabla_edi">
                    <tr>
                        <th>Tipo:</th>
                        <td>
                            <input type="text" id="tipo" name="tipo" required>
                        </td>
                    </tr>

                    <tr>
                        <th>Categorías:</th>
                        <td>
                            <select name="categoria" id="categoria" class="select">
                                <option value="" disabled selected >¿Cuál es la categoria?</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">Categoria: {{ $categoria->nombre }} - Clase: {{$categoria->clase->clase}}</option>
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