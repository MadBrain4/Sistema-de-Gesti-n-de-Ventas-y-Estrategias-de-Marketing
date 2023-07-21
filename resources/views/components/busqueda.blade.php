<form class="form-inline my-2 my-lg-0" id="form-submit" action="{{ route('codigo.index') }}" method="GET">
    <input class="form-control mr-sm-2" type="text" name="codigo" placeholder="Buscar" id="campo_busqueda" aria-label="Search" required>
    <button class="btn btn-outline-success" id="boton_busqueda">Buscar</button>
</form>

<!-- <div class="buscar">
        <form action="{{ route('codigo.index') }}" method="GET" id="form-submit">
            <input type="text" name="codigo" id="campo_busqueda" placeholder="Buscar" required>
            <div class="btn">
                <img src=" {{ asset( 'img/svg/buscar.svg' ) }}" id="boton_busqueda" class="lupa"> 
            </div>    
        </form>   
    </div>

  <div class="buscar_apli">
        <form action="{{ route('aplicaciones.index') }}" method="GET" id="form-submit-aplicacion-2">
            <select name="aplicacion" id="aplicacion-select-2" >
                <option value="0" selected disabled>Aplicacion:</option>
                <option value="1">Liviano / SUV</option>
                <option value="2">Comercial</option>
                <option value="3">Fuera de carretera</option>
                <option value="4">Agrícola</option>
            </select>
        </form>
    </div> -->

<script>   
    boton_busqueda = document.getElementById('boton_busqueda-2');

    boton_busqueda.addEventListener('click', function(){
        codigo = document.getElementById('campo_busqueda-2');


        if( codigo.value != null && codigo.value != "" ){
            document.getElementById('form-submit-2').submit();
        }
        else {

        }
    })
</script>

<script>   
    select = document.getElementById('aplicacion-select-2');

    select.addEventListener('change', function(){
        document.getElementById('form-submit-aplicacion-2').submit();
    })
</script>