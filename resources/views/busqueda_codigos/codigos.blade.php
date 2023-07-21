<x-Arriba />
    <title>Por Codigo</title>
    <x-porCodigo />
<x-Abajo />

@isset( $codigo )
    <script>
        var codigo = {!! json_encode($codigo, JSON_HEX_TAG) !!}
        document.getElementById("keywords").value = codigo;
        buscar();
    </script>
@endisset