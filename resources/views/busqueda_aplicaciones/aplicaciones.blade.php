    <x-Arriba />
        <title>Por Aplicación</title>
        <div class="aplicacion_producto">
            <x-porAplicacion />
        </div>
    <x-Abajo />

@if( isset($aplic) && isset($marca) && isset($vehic))
    <script>
        var aplic = {!! json_encode($aplic , JSON_HEX_TAG) !!}
        var marca = {!! json_encode($marca , JSON_HEX_TAG) !!}
        var vehic = {!! json_encode($vehic , JSON_HEX_TAG) !!}
        document.getElementById('lista1').value = aplic;
        document.getElementById('lista1').style.display = 'block';
        document.getElementById('lista2').style.display = 'block';
        document.getElementById('label_lista2').style.display = 'block';

        getAplicacion3(aplic, marca, vehic);
    </script>
@elseif( isset($aplic) && isset($marca) )
    <script>
        aplic = {!! json_encode($aplic , JSON_HEX_TAG) !!}
        marca = {!! json_encode($marca , JSON_HEX_TAG) !!}
        document.getElementById('lista1').value = aplic;
        document.getElementById('lista1').style.display = 'block';


        getAplicacion2(aplic, marca);
    </script>
@elseif( isset($aplic) )
    <script>
        aplic = {!! json_encode($aplic , JSON_HEX_TAG) !!}
        document.getElementById('lista1').value = aplic;
        document.getElementById('lista1').style.display = 'block';

        formData = new FormData();
        formData.append('id_aplicacion', document.getElementById('lista1').value);
        fetch("/aplicaciones/marca", {
            method: 'POST',
            body: formData,
        })
        .then( response => response.json() )
        .then(
            data => {
                console.log(data);
                document.getElementById('lista2').style.display = 'block';
                document.getElementById('label_lista2').style.display = 'block';
                document.getElementById('lista2').innerHTML = data;
            }
        )
        .catch(
            error => console.log(error)
        )
    </script>
@endif